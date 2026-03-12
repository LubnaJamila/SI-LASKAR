<?php

namespace App\Services;

class KMeansService
{
    private const FEATURE_COUNT   = 4;
    private const K               = 4;
    private const MAX_ITER        = 300;
    private const CONVERGENCE_TOL = 1e-6;

    public function run(array $data): array
    {
        $k = self::K;
        if (count($data) < $k) {
            throw new \InvalidArgumentException("Jumlah data kurang dari K={$k}.");
        }

        // 1. Normalisasi Z-Score dari data aktual (ddof=0, identik Excel)
        [$normalized, $means, $stds] = $this->normalizeFromData($data);

        // 2. Pilih centroid awal dari data aktual (identik Excel):
        //    C1 = titik dengan semua fitur = 0 atau terendah  → index fitur[0]+fitur[1] min
        //    C2 = titik dengan WPS & Hotspot tertinggi        → max fitur[0]+fitur[1]
        //    C3 = titik dengan Tes_Rate tertinggi             → max fitur[2]
        //    C4 = titik dengan Positif_Rate tertinggi         → max fitur[3]
        $centroids = $this->pickInitialCentroids($normalized);

        // 3. Iterasi
        $assignments = [];
        $iterations  = 0;

        for ($iter = 0; $iter < self::MAX_ITER; $iter++) {
            $iterations++;

            $newAssignments = [];
            foreach ($normalized as $point) {
                $newAssignments[$point['id']] = $this->nearestCentroid(
                    $point['features'], $centroids
                );
            }

            $newCentroids = $this->recalcCentroids($normalized, $newAssignments, $k);
            $converged    = $this->centroidsConverged($centroids, $newCentroids);
            $assignments  = $newAssignments;
            $centroids    = $newCentroids;

            if ($converged) break;
        }

        // 4. Labeling berdasarkan rata-rata fitur RAW
        $labelMap = $this->rankByRawFeatures($data, $assignments);

        // 5. Susun hasil
        $results = [];
        foreach ($data as $item) {
            $cluster   = $assignments[$item['id']];
            $results[] = [
                'id'      => $item['id'],
                'cluster' => $cluster + 1,
                'label'   => $labelMap[$cluster],
            ];
        }

        return [
            'results'    => $results,
            'centroids'  => $centroids,
            'iterations' => $iterations,
            'label_map'  => $labelMap,
            'sse'        => $this->calcSSE($normalized, $assignments, $centroids),
        ];
    }

    // ────────────────────────────────────────────────────────────
    // NORMALISASI — hitung dari data aktual, ddof=0 (identik Excel)
    // ────────────────────────────────────────────────────────────
    private function normalizeFromData(array $data): array
    {
        $n  = count($data);
        $fc = self::FEATURE_COUNT;

        $means = array_fill(0, $fc, 0.0);
        foreach ($data as $item) {
            for ($f = 0; $f < $fc; $f++) {
                $means[$f] += $item['features'][$f];
            }
        }
        for ($f = 0; $f < $fc; $f++) {
            $means[$f] /= $n;
        }

        $stds = array_fill(0, $fc, 0.0);
        foreach ($data as $item) {
            for ($f = 0; $f < $fc; $f++) {
                $stds[$f] += ($item['features'][$f] - $means[$f]) ** 2;
            }
        }
        for ($f = 0; $f < $fc; $f++) {
            $stds[$f] = sqrt($stds[$f] / $n);
            if ($stds[$f] < 1e-10) $stds[$f] = 1.0;
        }

        $normalized = [];
        foreach ($data as $item) {
            $scaled = [];
            for ($f = 0; $f < $fc; $f++) {
                $scaled[] = ($item['features'][$f] - $means[$f]) / $stds[$f];
            }
            $normalized[] = ['id' => $item['id'], 'features' => $scaled];
        }

        return [$normalized, $means, $stds];
    }

    // ────────────────────────────────────────────────────────────
    // CENTROID AWAL — pilih dari data aktual (identik Excel)
    //
    // C1 = titik dengan nilai Z paling rendah (semua fitur ≈ 0 / negatif)
    //      → min(f[0] + f[1])   ← WPS & Hotspot terendah
    // C2 = titik dengan WPS & Hotspot tertinggi
    //      → max(f[0] + f[1])
    // C3 = titik dengan Tes_Rate tertinggi
    //      → max(f[2])
    // C4 = titik dengan Positif_Rate tertinggi
    //      → max(f[3])
    // ────────────────────────────────────────────────────────────
    private function pickInitialCentroids(array $normalized): array
    {
        $minScore = PHP_FLOAT_MAX;
        $maxWpsHotspot = -PHP_FLOAT_MAX;
        $maxTes = -PHP_FLOAT_MAX;
        $maxPos = -PHP_FLOAT_MAX;

        $c1 = $c2 = $c3 = $c4 = null;

        foreach ($normalized as $point) {
            $f = $point['features'];

            $wpsHotspot = $f[0] + $f[1];
            $sum        = $f[0] + $f[1] + $f[2] + $f[3];

            if ($sum < $minScore) {
                $minScore = $sum;
                $c1 = $f;
            }
            if ($wpsHotspot > $maxWpsHotspot) {
                $maxWpsHotspot = $wpsHotspot;
                $c2 = $f;
            }
            if ($f[2] > $maxTes) {
                $maxTes = $f[2];
                $c3 = $f;
            }
            if ($f[3] > $maxPos) {
                $maxPos = $f[3];
                $c4 = $f;
            }
        }

        return [$c1, $c2, $c3, $c4];
    }

    // ────────────────────────────────────────────────────────────
    // HELPERS
    // ────────────────────────────────────────────────────────────
    private function nearestCentroid(array $point, array $centroids): int
    {
        $minDist  = PHP_FLOAT_MAX;
        $minIndex = 0;
        foreach ($centroids as $i => $c) {
            $d = $this->euclidean($point, $c);
            if ($d < $minDist) {
                $minDist  = $d;
                $minIndex = $i;
            }
        }
        return $minIndex;
    }

    private function euclidean(array $a, array $b): float
    {
        $sum = 0.0;
        foreach ($a as $i => $v) {
            $sum += ($v - $b[$i]) ** 2;
        }
        return sqrt($sum);
    }

    private function recalcCentroids(array $data, array $assignments, int $k): array
    {
        $fc     = self::FEATURE_COUNT;
        $sums   = array_fill(0, $k, array_fill(0, $fc, 0.0));
        $counts = array_fill(0, $k, 0);

        foreach ($data as $point) {
            $c = $assignments[$point['id']];
            $counts[$c]++;
            for ($f = 0; $f < $fc; $f++) {
                $sums[$c][$f] += $point['features'][$f];
            }
        }

        $centroids = [];
        for ($c = 0; $c < $k; $c++) {
            $centroid = [];
            for ($f = 0; $f < $fc; $f++) {
                $centroid[] = $counts[$c] > 0 ? $sums[$c][$f] / $counts[$c] : 0.0;
            }
            $centroids[] = $centroid;
        }

        return $centroids;
    }

    private function centroidsConverged(array $old, array $new): bool
    {
        foreach ($old as $i => $centroid) {
            foreach ($centroid as $f => $val) {
                if (abs($val - $new[$i][$f]) > self::CONVERGENCE_TOL) {
                    return false;
                }
            }
        }
        return true;
    }

    private function calcSSE(array $data, array $assignments, array $centroids): float
    {
        $sse = 0.0;
        foreach ($data as $point) {
            $c    = $assignments[$point['id']];
            $sse += $this->euclidean($point['features'], $centroids[$c]) ** 2;
        }
        return $sse;
    }

    private function rankByRawFeatures(array $data, array $assignments): array
    {
        $k      = self::K;
        $fc     = self::FEATURE_COUNT;
        $sums   = array_fill(0, $k, array_fill(0, $fc, 0.0));
        $counts = array_fill(0, $k, 0);

        foreach ($data as $item) {
            $c = $assignments[$item['id']];
            $counts[$c]++;
            for ($f = 0; $f < $fc; $f++) {
                $sums[$c][$f] += $item['features'][$f];
            }
        }

        $scores = [];
        for ($c = 0; $c < $k; $c++) {
            $total = 0.0;
            for ($f = 0; $f < $fc; $f++) {
                $total += $counts[$c] > 0 ? $sums[$c][$f] / $counts[$c] : 0.0;
            }
            $scores[$c] = $total;
        }

        arsort($scores);

        $labels   = ['Tinggi', 'Sedang', 'Rendah', 'Sangat Rendah'];
        $labelMap = [];
        $idx      = 0;
        foreach ($scores as $cluster => $_) {
            $labelMap[$cluster] = $labels[$idx++] ?? 'Sangat Rendah';
        }

        return $labelMap;
    }
}