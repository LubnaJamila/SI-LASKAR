<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeoJsonController extends Controller
{
    /**
     * Serve semua kecamatan sebagai GeoJSON FeatureCollection.
     * Dipakai oleh Leaflet di halaman peta clustering.
     *
     * Route: GET /geojson/kecamatan
     */
    public function kecamatan(): JsonResponse
    {
        $kecamatans = Kecamatan::select('id', 'nama_kecamatan', 'geojson')
            ->whereNotNull('geojson')
            ->get();

        $features = $kecamatans->map(function ($kec) {
            $geometry = json_decode($kec->geojson, true);

            return [
                'type'       => 'Feature',
                'properties' => [
                    'id'             => $kec->id,
                    'nama_kecamatan' => $kec->nama_kecamatan,
                ],
                'geometry' => $geometry,
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $features,
        ]);
    }
}