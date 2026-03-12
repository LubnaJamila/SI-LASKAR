@extends('templates.app')

@section('title', 'Clustering WPS')

@section('content')

    <style>
        .section-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 24px;
            margin-bottom: 28px;
        }

        .section-title {
            font-size: 15px;
            font-weight: 700;
            color: #333;
            margin-bottom: 18px;
            padding-left: 12px;
            border-left: 4px solid #bf3131;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-tinggi {
            background: #f8d7da;
            color: #842029;
        }

        .badge-sedang {
            background: #fff3cd;
            color: #664d03;
        }

        .badge-rendah {
            background: #d1e7dd;
            color: #0f5132;
        }

        .badge-sangat-rendah {
            background: #cfe2ff;
            color: #084298;
        }

        .cluster-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-klaster {
            background: #bf3131;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 9px 22px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: background .2s;
            text-decoration: none;
        }

        .btn-klaster:hover {
            background: #9b2525;
            color: #fff;
        }

        .btn-klaster:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .table thead th {
            background: #f8f8f8;
            font-size: 13px;
            font-weight: 700;
            color: #555;
            border-bottom: 2px solid #e9e9e9;
            white-space: nowrap;
        }

        .table tbody td {
            font-size: 13px;
            color: #444;
            vertical-align: middle;
        }

        #map {
            width: 100%;
            height: 520px;
            border-radius: 10px;
            border: 2px solid #e5e5e5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .map-wrapper {
            position: relative;
        }

        .legend {
            position: absolute;
            bottom: 30px;
            right: 20px;
            background: #fff;
            padding: 14px 18px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
            z-index: 999;
            min-width: 190px;
        }

        .legend-title {
            font-weight: 700;
            font-size: 13px;
            color: #333;
            margin-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 6px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 6px 0;
            font-size: 13px;
        }

        .legend-dot {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            flex-shrink: 0;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .alert-belum {
            background: #fff8e1;
            border: 1px solid #ffe082;
            border-radius: 10px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 14px;
            color: #7c5a00;
            font-size: 14px;
        }

        .alert-belum i {
            font-size: 24px;
            color: #f59e0b;
        }

        .btn-klaster .spinner-border {
            width: 14px;
            height: 14px;
            border-width: 2px;
        }
    </style>

    <div class="container-fluid px-2">

        {{-- ── Header ── --}}
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h5 class="mb-0 fw-bold">Clustering WPS</h5>
                @if ($periode)
                    <small class="text-muted">
                        Periode: <strong>{{ $periode->nama_periode }}</strong>
                        ({{ \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d M Y') }}
                        – {{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d M Y') }})
                    </small>
                @endif
            </div>

            <div class="d-flex align-items-center gap-2 flex-wrap">

                {{-- ── Dropdown Filter Periode ── --}}
                <form method="GET" action="{{ route('wps') }}" id="formFilterPeriode">
                    <div class="input-group" style="min-width:260px">
                        <label class="input-group-text" for="periode_id" style="font-size:13px;background:#f8f8f8">
                            <i class="bi bi-calendar3 me-1"></i> Periode
                        </label>
                        <select name="periode_id" id="periode_id" class="form-select form-select-sm" style="font-size:13px"
                            onchange="document.getElementById('formFilterPeriode').submit()">
                            @foreach ($semuaPeriode as $p)
                                <option value="{{ $p->id }}"
                                    {{ $periode && $p->id == $periode->id ? 'selected' : '' }}>
                                    {{ $p->nama_periode }}
                                    @if ($p->status === 'open')
                                        (Aktif)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                {{-- ── Tombol Run K-Means ── --}}
                @if ($periode)
                    <form action="{{ route('klastering.run') }}" method="POST" id="formKlaster">
                        @csrf
                        {{-- Kirim periode_id agar setelah run redirect ke periode yang sama --}}
                        <input type="hidden" name="periode_id" value="{{ $periode->id }}">
                        <button type="submit" class="btn-klaster" id="btnKlaster">
                            <i class="bi bi-cpu"></i>
                            {{ $sudahRun ? 'Jalankan Ulang K-Means' : 'Klasterkan Sekarang' }}
                        </button>
                    </form>
                @endif

            </div>
        </div>

        {{-- ── Tidak ada periode ── --}}
        @if (!$periode)
            <div class="alert-belum">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>Tidak ada periode aktif (<em>status: open</em>). Buka periode terlebih dahulu.</span>
            </div>
        @else
            {{-- ── Flash messages ── --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle me-2"></i>{{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ════════════════════════════════════
             TABEL DATA AGREGAT + HASIL KLASTER
        ════════════════════════════════════ --}}
            <div class="section-card">
                <div class="section-title">
                    <i class="bi bi-table"></i> Data Agregat Per Kecamatan
                    @if ($sudahRun)
                        <span class="ms-2 badge bg-success" style="font-size:11px;font-weight:600;border-radius:20px">
                            ✓ Sudah Dicluster
                        </span>
                    @endif
                </div>

                 <div class="table-responsive" style="border-radius: 12px;">
                    <table id="example" class="table table-hover align-middle"
                        style="min-width: 700px; width: 100%; border-collapse: collapse; white-space: nowrap;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kecamatan</th>
                                <th>Jumlah Penduduk</th>
                                <th>Total WPS</th>
                                <th>Total Hotspot</th>
                                <th>Total Dites HIV</th>
                                <th>Total HIV+</th>
                                @if ($sudahRun)
                                    <th>Cluster</th>
                                    <th>Label Potensi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agregat as $i => $row)
                                @php
                                    // {{-- ✅ $hasilMap adalah Collection of Models → get() / [] operator --}}
                                    $hasilRow = $sudahRun ? $hasilMap->get($row->kecamatan_id) : null;
                                    $label = $hasilRow?->label ?? '-';
                                    $badgeClass = match ($label) {
                                        'Tinggi' => 'badge-tinggi',
                                        'Sedang' => 'badge-sedang',
                                        'Rendah' => 'badge-rendah',
                                        'Sangat Rendah' => 'badge-sangat-rendah',
                                        default => '',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td><strong>{{ $row->kecamatan->nama_kecamatan ?? '-' }}</strong></td>
                                    <td>{{ number_format($row->kecamatan->jumlah_penduduk ?? 0) }}</td>
                                    <td>{{ number_format($row->total_wps) }}</td>
                                    <td>{{ number_format($row->total_hotspot_dikunjungi) }}</td>
                                    <td>{{ number_format($row->total_tes_wps) }}</td>
                                    <td>{{ number_format($row->total_positif_wps) }}</td>
                                    @if ($sudahRun)
                                        <td>{{ $hasilRow?->cluster ?? '-' }}</td>
                                        <td>
                                            @if ($hasilRow)
                                                <span class="cluster-badge {{ $badgeClass }}">{{ $label }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $sudahRun ? 9 : 7 }}" class="text-center text-muted py-5">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        Belum ada data kunjungan untuk periode ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ════════════════════════════════════
             PETA LEAFLET
        ════════════════════════════════════ --}}
            @if (!$sudahRun)
                <div class="section-card">
                    <div class="section-title"><i class="bi bi-map"></i> Peta Sebaran Klaster</div>
                    <div class="alert-belum">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>Peta akan muncul setelah clustering dijalankan.
                            Klik tombol <strong>"Klasterkan Sekarang"</strong> di atas.</span>
                    </div>
                </div>
            @else
                <div class="section-card">
                    <div class="section-title"><i class="bi bi-map"></i> Peta Sebaran Klaster WPS</div>
                    <div class="map-wrapper">
                        <div id="map"></div>
                        <div class="legend">
                            <div class="legend-title">Potensi Risiko</div>
                            <div class="legend-item">
                                <span class="legend-dot" style="background:#ef4444;"></span>Tinggi
                            </div>
                            <div class="legend-item">
                                <span class="legend-dot" style="background:#f59e0b;"></span>Sedang
                            </div>
                            <div class="legend-item">
                                <span class="legend-dot" style="background:#22c55e;"></span>Rendah
                            </div>
                            <div class="legend-item">
                                <span class="legend-dot" style="background:#3b82f6;"></span>Sangat Rendah
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ✅ Data klaster di-embed untuk JS --}}
                <script>
                    const hasilKlaster = @json($hasilGeoData);
                </script>
            @endif

        @endif {{-- end $periode --}}
    </div>

@endsection

@push('scripts')
    {{-- Loading spinner saat submit --}}
    <script>
        document.getElementById('formKlaster')?.addEventListener('submit', function() {
            const btn = document.getElementById('btnKlaster');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Memproses...';
        });
    </script>

    @if (($sudahRun ?? false) && ($periode ?? false))
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // ── Warna per label ──────────────────────────────────────────
                const warnLabel = {
                    'Tinggi': '#ef4444',
                    'Sedang': '#f59e0b',
                    'Rendah': '#22c55e',
                    'Sangat Rendah': '#3b82f6',
                };

                function shadeColor(hex, pct) {
                    const f = parseInt(hex.slice(1), 16),
                        t = pct < 0 ? 0 : 255,
                        p = Math.abs(pct) / 100,
                        R = f >> 16,
                        G = (f >> 8) & 255,
                        B = f & 255;
                    return '#' + (0x1000000 +
                        (Math.round((t - R) * p) + R) * 0x10000 +
                        (Math.round((t - G) * p) + G) * 0x100 +
                        (Math.round((t - B) * p) + B)
                    ).toString(16).slice(1);
                }

                // ── Init peta ────────────────────────────────────────────────
                const map = L.map('map').setView([-8.17, 113.7], 10);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                // ── Lookup hasil cluster by nama_kecamatan (lowercase) ───────
                const lookup = {};
                hasilKlaster.forEach(h => {
                    lookup[h.nama_kecamatan.toLowerCase().trim()] = h;
                });

                // ── Fetch GeoJSON dari endpoint ──────────────────────────────
                fetch('{{ route('geojson.kecamatan') }}')
                    .then(r => r.json())
                    .then(geojson => {

                        const layer = L.geoJSON(geojson, {

                            style: function(feature) {
                                const nama = (feature.properties.nama_kecamatan ?? '').toLowerCase()
                                    .trim();
                                const info = lookup[nama];
                                const fill = info ? (warnLabel[info.label] ?? '#aaaaaa') : '#cccccc';
                                return {
                                    fillColor: fill,
                                    color: shadeColor(fill, -30),
                                    weight: 2,
                                    fillOpacity: 0.65,
                                };
                            },

                            onEachFeature: function(feature, lyr) {
                                const nama = (feature.properties.nama_kecamatan ?? '').toLowerCase()
                                    .trim();
                                const info = lookup[nama];
                                const label = info?.label ?? 'Belum ada data';
                                const warna = warnLabel[label] ?? '#888888';

                                lyr.bindPopup(`
                        <div style="min-width:220px">
                            <div style="font-weight:700;font-size:15px;color:#1d4ed8;
                                border-bottom:2px solid #e5e7eb;padding-bottom:6px;margin-bottom:8px">
                                ${feature.properties.nama_kecamatan ?? '-'}
                            </div>
                            <table style="width:100%;font-size:13px;border-collapse:collapse">
                                <tr>
                                    <td style="color:#666;padding:3px 0">Total WPS</td>
                                    <td style="font-weight:600;text-align:right">${info?.total_wps ?? '-'}</td>
                                </tr>
                                <tr>
                                    <td style="color:#666;padding:3px 0">Total Hotspot</td>
                                    <td style="font-weight:600;text-align:right">${info?.total_hotspot ?? '-'}</td>
                                </tr>
                                <tr>
                                    <td style="color:#666;padding:3px 0">Dites HIV</td>
                                    <td style="font-weight:600;text-align:right">${info?.total_tes ?? '-'}</td>
                                </tr>
                                <tr>
                                    <td style="color:#666;padding:3px 0">HIV+</td>
                                    <td style="font-weight:600;text-align:right">${info?.total_positif ?? '-'}</td>
                                </tr>
                            </table>
                            <div style="margin-top:10px;text-align:center">
                                <span style="background:${warna};color:#fff;
                                    padding:4px 16px;border-radius:20px;
                                    font-size:12px;font-weight:700;letter-spacing:.5px">
                                    ${label}
                                </span>
                            </div>
                        </div>
                    `);

                                lyr.on({
                                    mouseover: e => e.target.setStyle({
                                        weight: 3,
                                        fillOpacity: 0.85
                                    }),
                                    mouseout: e => layer.resetStyle(e.target),
                                    click: e => map.fitBounds(e.target.getBounds()),
                                });
                            }

                        }).addTo(map);

                        map.fitBounds(layer.getBounds());
                    })
                    .catch(err => {
                        console.error('GeoJSON gagal dimuat:', err);
                        document.getElementById('map').innerHTML =
                            '<div class="d-flex align-items-center justify-content-center h-100 text-danger">' +
                            '<i class="bi bi-exclamation-triangle me-2"></i> Gagal memuat peta.</div>';
                    });
            });
        </script>
    @endif
@endpush
