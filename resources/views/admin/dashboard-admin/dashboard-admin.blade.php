@extends('templates.app')

@section('title', 'Dashboard')



@section('content')

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .dashboard-container {
            max-width: 100%;
            padding: 0px;
        }

        .map-section {
            margin-bottom: 50px;
            position: relative;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .map-section h2,
        .chart-section h2 {
            font-size: 16px;
            color: #444444;
            margin-bottom: 20px;
            font-weight: 600;
            padding-left: 10px;
            border-left: 4px solid #bf3131;
        }

        #map {
            width: 100%;
            height: 500px;
            border: 2px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .legend {
            position: absolute;
            bottom: 50px;
            right: 50px;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            min-width: 180px;
        }

        .legend-title {
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 14px;
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 8px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin: 8px 0;
            font-size: 13px;
        }

        .legend-color {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            border-radius: 4px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .chart-section {
            margin-bottom: 50px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .chart-container {
            width: 100%;
            height: 400px;
            padding: 20px;
            background: #fafafa;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .chart-container canvas {
            max-height: 100%;
        }

        /* Leaflet Popup Styling */
        .leaflet-popup-content-wrapper {
            border-radius: 8px;
            padding: 5px;
        }

        .leaflet-popup-content {
            margin: 15px;
            font-size: 14px;
            line-height: 1.6;
        }

        .popup-title {
            font-weight: 600;
            font-size: 16px;
            color: #1976D2;
            margin-bottom: 10px;
            border-bottom: 2px solid #2196F3;
            padding-bottom: 5px;
        }

        .popup-info {
            margin: 5px 0;
        }

        .popup-label {
            font-weight: 600;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 10px;
            }

            .map-section,
            .chart-section {
                padding: 15px;
            }

            .header h1 {
                font-size: 22px;
            }

            #map {
                height: 400px;
            }

            .legend {
                bottom: 30px;
                right: 30px;
                padding: 10px;
                min-width: 150px;
            }

            .chart-container {
                height: 300px;
                padding: 10px;
            }
        }

        /* Loading Spinner */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 500px;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #2196F3;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="dashboard-container">

        {{-- Tombol Tambah Hotspot dan Filter --}}
        <div class="d-flex justify-content-start align-items-center mb-3 gap-3 flex-wrap">
            {{-- Dropdown Filter --}}
            <div class="filter-container" id="filterContainer">
                <select id="filterJenis" class="form-select-custom">
                    <option value="">Periode Kunjungan</option>
                    <option value="WPS">WPS</option>
                    <option value="LSL">LSL</option>
                </select>
            </div>

        </div>

        <!-- Peta Section -->
        <div class="map-section">
            <h2>Peta QTR Pasca-Peradilan (PP) Berdasarkan Kewenangan WPS & LSL</h2>
            <div id="map"></div>
            <div class="legend">
                <div class="legend-title">Kategori</div>
                <div class="legend-item">
                    <span class="legend-color" style="background: #FF0000;"></span>
                    <span>Tinggi (> 30)</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color" style="background: #FFFF00;"></span>
                    <span>Sedang (21-30)</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color" style="background: #008000;"></span>
                    <span>Sangat Rendah (≤ 10)</span>
                </div>
            </div>
        </div>

        <!-- Diagram Total WPS & LSL -->
        <div class="chart-section">
            <h2>Diagram Pendataan Total WPS & LSL</h2>
            <div class="chart-container">
                <canvas id="chartTotal"></canvas>
            </div>
        </div>

        <!-- Diagram Total Realisasi WPS & LSL -->
        <div class="chart-section">
            <h2>Diagram Total Realisasi WPS & LSL</h2>
            <div class="chart-container">
                <canvas id="chartRealisasi"></canvas>
            </div>
        </div>
    </div>
@endsection


<script>
    // Data dummy untuk kecamatan
    const dummyData = {
        'Kencong': {
            wps: 12,
            lul: 8,
            realisasi_wps: 10,
            realisasi_lul: 6
        },
        'Gumukmas': {
            wps: 18,
            lul: 15,
            realisasi_wps: 15,
            realisasi_lul: 12
        },
        'Puger': {
            wps: 7,
            lul: 5,
            realisasi_wps: 6,
            realisasi_lul: 4
        },
        'Wuluhan': {
            wps: 22,
            lul: 19,
            realisasi_wps: 18,
            realisasi_lul: 16
        },
        'Ambulu': {
            wps: 14,
            lul: 11,
            realisasi_wps: 12,
            realisasi_lul: 9
        },
        'Tempurejo': {
            wps: 9,
            lul: 6,
            realisasi_wps: 7,
            realisasi_lul: 5
        },
        'Silo': {
            wps: 16,
            lul: 13,
            realisasi_wps: 14,
            realisasi_lul: 11
        },
        'Mayang': {
            wps: 11,
            lul: 8,
            realisasi_wps: 9,
            realisasi_lul: 7
        },
        'Mumbulsari': {
            wps: 13,
            lul: 10,
            realisasi_wps: 11,
            realisasi_lul: 8
        },
        'Jenggawah': {
            wps: 19,
            lul: 16,
            realisasi_wps: 16,
            realisasi_lul: 14
        },
        'Ajung': {
            wps: 15,
            lul: 12,
            realisasi_wps: 13,
            realisasi_lul: 10
        },
        'Rambipuji': {
            wps: 10,
            lul: 7,
            realisasi_wps: 8,
            realisasi_lul: 6
        },
        'Balung': {
            wps: 20,
            lul: 17,
            realisasi_wps: 17,
            realisasi_lul: 15
        },
        'Umbulsari': {
            wps: 8,
            lul: 6,
            realisasi_wps: 7,
            realisasi_lul: 5
        },
        'Semboro': {
            wps: 17,
            lul: 14,
            realisasi_wps: 15,
            realisasi_lul: 12
        },
        'Jombang': {
            wps: 12,
            lul: 9,
            realisasi_wps: 10,
            realisasi_lul: 8
        },
        'Sumberbaru': {
            wps: 14,
            lul: 11,
            realisasi_wps: 12,
            realisasi_lul: 9
        },
        'Tanggul': {
            wps: 21,
            lul: 18,
            realisasi_wps: 18,
            realisasi_lul: 16
        },
        'Bangsalsari': {
            wps: 16,
            lul: 13,
            realisasi_wps: 14,
            realisasi_lul: 11
        },
        'Panti': {
            wps: 11,
            lul: 8,
            realisasi_wps: 9,
            realisasi_lul: 7
        },
        'Sukorambi': {
            wps: 13,
            lul: 10,
            realisasi_wps: 11,
            realisasi_lul: 9
        },
        'Arjasa': {
            wps: 9,
            lul: 7,
            realisasi_wps: 8,
            realisasi_lul: 6
        },
        'Pakusari': {
            wps: 15,
            lul: 12,
            realisasi_wps: 13,
            realisasi_lul: 10
        },
        'Kalisat': {
            wps: 18,
            lul: 15,
            realisasi_wps: 16,
            realisasi_lul: 13
        },
        'Ledokombo': {
            wps: 10,
            lul: 8,
            realisasi_wps: 9,
            realisasi_lul: 7
        },
        'Sumberjambe': {
            wps: 12,
            lul: 9,
            realisasi_wps: 10,
            realisasi_lul: 8
        },
        'Sukowono': {
            wps: 14,
            lul: 11,
            realisasi_wps: 12,
            realisasi_lul: 10
        },
        'Jelbuk': {
            wps: 8,
            lul: 6,
            realisasi_wps: 7,
            realisasi_lul: 5
        },
        'Kaliwates': {
            wps: 25,
            lul: 22,
            realisasi_wps: 22,
            realisasi_lul: 19
        },
        'Sumbersari': {
            wps: 23,
            lul: 20,
            realisasi_wps: 20,
            realisasi_lul: 18
        },
        'Patrang': {
            wps: 24,
            lul: 21,
            realisasi_wps: 21,
            realisasi_lul: 18
        }
    };

    /* =======================
       LEAFLET MAP
    ======================= */

    let map;
    let geojsonLayer;

    // warna kategori
    function getColor(wps, hotspot) {
        if (wps >= 100 || hotspot >= 8) return "#FF0000";
        if ((wps >= 50 && wps < 100) || (hotspot >= 4 && hotspot < 8)) return "#FFFF00";
        return "#008000";
    }

    // gelapkan border
    function shadeColor(color, percent) {
        const f = parseInt(color.slice(1), 16),
            t = percent < 0 ? 0 : 255,
            p = Math.abs(percent) / 100,
            R = f >> 16,
            G = (f >> 8) & 255,
            B = f & 255;

        return "#" + (
            0x1000000 +
            (Math.round((t - R) * p) + R) * 0x10000 +
            (Math.round((t - G) * p) + G) * 0x100 +
            (Math.round((t - B) * p) + B)
        ).toString(16).slice(1);
    }

    function featureStyle(feature) {
        const fill = getColor(
            feature.properties.total_wps,
            feature.properties.total_hotspot
        );

        return {
            fillColor: fill,
            color: shadeColor(fill, -40),
            weight: 2,
            fillOpacity: 0.5
        };
    }

    function initMap() {

        map = L.map("map").setView([-8.17, 113.7], 10);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; OSM'
        }).addTo(map);

        fetch("/geojson/kecamatan.geojson")
            .then(res => res.json())
            .then(data => {

                geojsonLayer = L.geoJSON(data, {
                    style: featureStyle,
                    onEachFeature: function(feature, layer) {

                        layer.bindPopup(`
                        <b>${feature.properties.nama_kecamatan}</b><br>
                        Total WPS : ${feature.properties.total_wps}<br>
                        Total Hotspot : ${feature.properties.total_hotspot}
                    `);

                        layer.on({
                            mouseover: e => e.target.setStyle({
                                weight: 3
                            }),
                            mouseout: e => geojsonLayer.resetStyle(e.target),
                            click: e => map.fitBounds(e.target.getBounds())
                        });
                    }
                }).addTo(map);

                map.fitBounds(geojsonLayer.getBounds());
            })
            .catch(err => {
                console.error(err);
                alert("GeoJSON tidak ditemukan di /public/geojson/kecamatan.geojson");
            });
    }

    // Inisialisasi Chart Total WPS & LUL
    function initChartTotal() {
        const ctx = document.getElementById('chartTotal').getContext('2d');

        // Ambil data dari dummyData
        const labels = Object.keys(dummyData);
        const wpsData = labels.map(kec => dummyData[kec].wps);
        const lulData = labels.map(kec => dummyData[kec].lul);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'WPS',
                        data: wpsData,
                        backgroundColor: 'rgba(33, 150, 243, 0.7)',
                        borderColor: 'rgba(33, 150, 243, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'LUL',
                        data: lulData,
                        backgroundColor: 'rgba(255, 152, 0, 0.7)',
                        borderColor: 'rgba(255, 152, 0, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: false
                    },
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    },
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 45
                        }
                    }
                }
            }
        });
    }

    // Inisialisasi Chart Realisasi WPS & LUL
    function initChartRealisasi() {
        const ctx = document.getElementById('chartRealisasi').getContext('2d');

        // Ambil data dari dummyData
        const labels = Object.keys(dummyData);
        const realisasiWpsData = labels.map(kec => dummyData[kec].realisasi_wps);
        const realisasiLulData = labels.map(kec => dummyData[kec].realisasi_lul);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Realisasi WPS',
                        data: realisasiWpsData,
                        borderColor: 'rgba(76, 175, 80, 1)',
                        backgroundColor: 'rgba(76, 175, 80, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Realisasi LUL',
                        data: realisasiLulData,
                        borderColor: 'rgba(244, 67, 54, 1)',
                        backgroundColor: 'rgba(244, 67, 54, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: false
                    },
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    },
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 45
                        }
                    }
                }
            }
        });
    }

    // Jalankan semua inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
        initChartTotal();
        initChartRealisasi();
    });
</script>
{{-- @push('scripts')
    
    <!-- Custom JS -->
    <script src="{{ asset('../public/assets/js/dashboard-admin.js') }}"></script>
@endpush --}}
