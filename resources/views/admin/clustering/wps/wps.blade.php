@extends('templates.app')

@section('title', 'Clustering WPS')

@section('content')

<style>
    .map-section {
            margin-top: 50px;
            position: relative;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .map-section h2{
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
            

            .map-section {
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

    <div class="container">

        {{-- Tombol Tambah Hotspot dan Filter --}}
        <div class="d-flex justify-content-start align-items-center mb-3 gap-3 flex-wrap">

            {{-- Dropdown Filter --}}
            <div class="filter-container" id="filterContainer">
                <select id="filterJenis" class="form-select-custom">
                    <option value="">Semua Periode</option>
                    <option value="WPS">WPS</option>
                    <option value="LSL">LSL</option>
                </select>
            </div>
        </div>

        {{-- Tabel Hotspot --}}
        <div class="card shadow-sm border-0 rounded-2">
            <div class="card-body px-3 py-4">

                {{-- Bungkus tabel agar scrollable di layar kecil --}}
                <div class="table-responsive" style="border-radius: 12px;">
                    <table id="example" class="table table-hover align-middle"
                        style="min-width: 700px; width: 100%; border-collapse: collapse; white-space: nowrap;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Hotspot</th>
                                <th>Jenis Hotspot</th>
                                <th>Jenis Populasi</th>
                                <th>Koordinat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Hotspot Mawar</td>
                                <td>Tempat Rekreasi</td>
                                <td>WPS</td>
                                <td>-6.175392, 106.827153</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Hotspot Melati</td>
                                <td>Rumah Bordir</td>
                                <td>LSL</td>
                                <td>-6.175392, 106.827153</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Hotspot Kenanga</td>
                                <td>WPS</td>
                                <td>Jl. Kenanga No. 3</td>
                                <td>-6.175392, 106.827153</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
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
    </div>



@endsection

<script>
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
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>
