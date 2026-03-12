@extends('templates.app')

@section('title', 'Dashboard')

@section('content')
<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .dash-wrap {
        font-family: 'Segoe UI', system-ui, sans-serif;
        color: #1a1a2e;
    }

    /* ── Summary Cards ── */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }
    @media (max-width: 900px) { .summary-grid { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 480px) { .summary-grid { grid-template-columns: 1fr; } }

    .s-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px 22px;
        box-shadow: 0 2px 12px rgba(0,0,0,.07);
        display: flex;
        align-items: center;
        gap: 16px;
        border-left: 4px solid var(--accent);
        transition: transform .2s, box-shadow .2s;
    }
    .s-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,.12); }
    .s-card:nth-child(1) { --accent: #bf3131; }
    .s-card:nth-child(2) { --accent: #1565C0; }
    .s-card:nth-child(3) { --accent: #2E7D32; }
    .s-card:nth-child(4) { --accent: #E65100; }

    .s-icon {
        width: 46px; height: 46px;
        border-radius: 10px;
        background: var(--accent);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; color: #fff; flex-shrink: 0;
    }
    .s-info .s-val { font-size: 24px; font-weight: 700; color: #1a1a2e; line-height: 1; }
    .s-info .s-lbl { font-size: 12px; color: #777; margin-top: 4px; }

    /* ── Panel ── */
    .panel {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,.07);
        margin-bottom: 28px;
        position: relative;
    }
    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }
    .panel-title {
        font-size: 15px; font-weight: 700; color: #1a1a2e;
        padding-left: 12px;
        border-left: 4px solid #bf3131;
    }

    /* ── Periode select ── */
    .periode-select {
        display: flex; align-items: center; gap: 8px;
        font-size: 13px; color: #555;
    }
    .periode-select select {
        padding: 5px 10px; border-radius: 8px;
        border: 1.5px solid #ddd; font-size: 13px;
        background: #fff; cursor: pointer;
        outline: none;
    }
    .periode-select select:focus { border-color: #bf3131; }

    /* ── Map ── */
    #map {
        width: 100%; height: 520px;
        border-radius: 10px;
        border: 1.5px solid #e0e0e0;
    }

    .map-legend {
        position: absolute;
        bottom: 36px; right: 36px;
        background: #fff;
        border-radius: 10px;
        padding: 14px 18px;
        box-shadow: 0 4px 16px rgba(0,0,0,.15);
        z-index: 1000;
        min-width: 185px;
    }
    .leg-title {
        font-size: 13px; font-weight: 700; color: #333;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 8px; margin-bottom: 10px;
    }
    .leg-item {
        display: flex; align-items: center;
        gap: 10px; margin-bottom: 8px;
        font-size: 13px; color: #444;
    }
    .leg-dot { width: 14px; height: 14px; border-radius: 3px; flex-shrink: 0; }

    /* ── Cluster filter buttons ── */
    .cluster-filters { display: flex; gap: 8px; flex-wrap: wrap; }
    .cf-btn {
        padding: 5px 14px; border-radius: 20px;
        border: 2px solid transparent; cursor: pointer;
        font-size: 12px; font-weight: 600;
        background: #f0f0f0; color: #555;
        transition: all .15s;
    }
    .cf-btn[data-label="Semua"].active         { background:#1a1a2e; border-color:#1a1a2e; color:#fff; }
    .cf-btn[data-label="Tinggi"].active        { background:#E53935; border-color:#E53935; color:#fff; }
    .cf-btn[data-label="Sedang"].active        { background:#FB8C00; border-color:#FB8C00; color:#fff; }
    .cf-btn[data-label="Rendah"].active        { background:#FDD835; border-color:#FDD835; color:#333; }
    .cf-btn[data-label="Sangat Rendah"].active { background:#43A047; border-color:#43A047; color:#fff; }

    /* ── Popup ── */
    .popup-kec .pk-name {
        font-weight: 700; font-size: 15px; color: #1a1a2e;
        border-bottom: 2px solid #bf3131;
        padding-bottom: 6px; margin-bottom: 10px;
    }
    .popup-kec .pk-badge {
        display: inline-block; padding: 2px 10px;
        border-radius: 20px; font-size: 12px; font-weight: 600;
        margin-bottom: 10px;
    }
    .popup-kec .pk-row {
        display: flex; justify-content: space-between;
        font-size: 13px; margin-bottom: 4px; color: #555;
    }
    .popup-kec .pk-row span:last-child { font-weight: 600; color: #1a1a2e; }

    /* ── Loading overlay ── */
    .map-loading {
        position: absolute; inset: 0;
        background: rgba(255,255,255,.85);
        display: flex; align-items: center; justify-content: center;
        z-index: 2000; border-radius: 10px;
        flex-direction: column; gap: 12px;
    }
    .map-loading .spinner-border { width: 36px; height: 36px; }
    .map-loading p { font-size: 13px; color: #777; }

    /* ── Chart ── */
    .chart-wrap { width: 100%; height: 380px; position: relative; }
</style>

<div class="dash-wrap">

    {{-- Periode filter (atas) --}}
    <div class="d-flex justify-content-end mb-3">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="periode-select">
            <label for="periodeSelect">Periode :</label>
            <select id="periodeSelect" name="periode_id" onchange="this.form.submit()">
                @foreach ($periodes as $p)
                    <option value="{{ $p->id }}" {{ $p->id == $periodeId ? 'selected' : '' }}>
                        {{ $p->nama_periode }} — {{ $p->tahun }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Summary Cards --}}
    <div class="summary-grid">
        <div class="s-card">
            <div class="s-icon">👥</div>
            <div class="s-info">
                <div class="s-val">{{ number_format($summary['total_wps']) }}</div>
                <div class="s-lbl">Total WPS</div>
            </div>
        </div>
        <div class="s-card">
            <div class="s-icon">📍</div>
            <div class="s-info">
                <div class="s-val">{{ number_format($summary['total_hotspot']) }}</div>
                <div class="s-lbl">Total Hotspot Dikunjungi</div>
            </div>
        </div>
        <div class="s-card">
            <div class="s-icon">🧪</div>
            <div class="s-info">
                <div class="s-val">{{ number_format($summary['total_tes']) }}</div>
                <div class="s-lbl">Sudah Dites HIV</div>
            </div>
        </div>
        <div class="s-card">
            <div class="s-icon">⚠️</div>
            <div class="s-info">
                <div class="s-val">{{ number_format($summary['total_positif']) }}</div>
                <div class="s-lbl">HIV Positif</div>
            </div>
        </div>
    </div>

    {{-- Peta Cluster --}}
    <div class="panel">
        <div class="panel-header">
            <h2 class="panel-title">Peta Sebaran Klaster Risiko HIV per Kecamatan</h2>
            <div class="cluster-filters">
                <button class="cf-btn active" data-label="Semua">Semua</button>
                <button class="cf-btn" data-label="Tinggi">Tinggi</button>
                <button class="cf-btn" data-label="Sedang">Sedang</button>
                <button class="cf-btn" data-label="Rendah">Rendah</button>
                <button class="cf-btn" data-label="Sangat Rendah">Sangat Rendah</button>
            </div>
        </div>

        <div style="position:relative;">
            <div id="mapLoading" class="map-loading">
                <div class="spinner-border text-danger" role="status"></div>
                <p>Memuat peta kecamatan...</p>
            </div>
            <div id="map"></div>
            <div class="map-legend">
                <div class="leg-title">🎯 Klaster Risiko</div>
                <div class="leg-item"><span class="leg-dot" style="background:#E53935;"></span>Tinggi</div>
                <div class="leg-item"><span class="leg-dot" style="background:#FB8C00;"></span>Sedang</div>
                <div class="leg-item"><span class="leg-dot" style="background:#FDD835;"></span>Rendah</div>
                <div class="leg-item"><span class="leg-dot" style="background:#43A047;"></span>Sangat Rendah</div>
                <div class="leg-item"><span class="leg-dot" style="background:#9E9E9E;"></span>Tidak Ada Data</div>
            </div>
        </div>
    </div>

    {{-- Diagram Garis --}}
    <div class="panel">
        <div class="panel-header">
            <h2 class="panel-title">Statistik WPS, Hotspot, Tes &amp; Positif per Kecamatan</h2>
            <select id="chartFilter" class="form-select form-select-sm" style="width:auto;">
                <option value="all">Semua Indikator</option>
                <option value="wps_hotspot">WPS &amp; Hotspot</option>
                <option value="tes_positif">Tes &amp; Positif</option>
            </select>
        </div>
        <div class="chart-wrap">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
/* ── Data dari controller ── */
const kecCluster = @json($kecClusterMap);
const chartRaw   = @json($chartData);

/* ── Lookup nama kecamatan → info cluster ── */
function getInfo(nama) {
    const key = Object.keys(kecCluster).find(
        k => k.toLowerCase() === (nama || '').toLowerCase()
    );
    return key ? kecCluster[key] : {
        label: 'Tidak Ada Data', color: '#9E9E9E',
        total_wps: 0, total_hotspot: 0, total_tes: 0, total_positif: 0,
    };
}

/* ════════════════════════
   LEAFLET MAP
════════════════════════ */
let map, geojsonLayer;
let activeFilter = 'Semua';

function darkenHex(hex, pct) {
    const f = parseInt(hex.replace('#',''), 16);
    const p = pct / 100;
    const R = f >> 16, G = (f >> 8) & 0xff, B = f & 0xff;
    return '#' + (0x1000000
        + Math.round(R * (1 - p)) * 0x10000
        + Math.round(G * (1 - p)) * 0x100
        + Math.round(B * (1 - p))
    ).toString(16).slice(1);
}

function featureStyle(feature) {
    const info    = getInfo(feature.properties.nama_kecamatan);
    const visible = activeFilter === 'Semua' || info.label === activeFilter;
    return {
        fillColor  : info.color,
        color      : darkenHex(info.color, 40),
        weight     : 1.8,
        fillOpacity: visible ? 0.72 : 0.10,
        opacity    : visible ? 1    : 0.30,
    };
}

function initMap() {
    map = L.map('map').setView([-8.17, 113.7], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
    }).addTo(map);

    fetch('{{ route('geojson.kecamatan') }}')
        .then(r => r.json())
        .then(data => {
            geojsonLayer = L.geoJSON(data, {
                style: featureStyle,
                onEachFeature(feature, layer) {
                    const nama = feature.properties.nama_kecamatan;
                    const info = getInfo(nama);
                    const badgeStyle = info.color === '#FDD835'
                        ? `background:${info.color};color:#333`
                        : `background:${info.color};color:#fff`;

                    layer.bindPopup(`
                        <div class="popup-kec">
                            <div class="pk-name">${nama}</div>
                            <span class="pk-badge" style="${badgeStyle}">${info.label}</span>
                            <div class="pk-row"><span>Total WPS</span><span>${(info.total_wps||0).toLocaleString('id-ID')}</span></div>
                            <div class="pk-row"><span>Hotspot Dikunjungi</span><span>${(info.total_hotspot||0).toLocaleString('id-ID')}</span></div>
                            <div class="pk-row"><span>Sudah Dites HIV</span><span>${(info.total_tes||0).toLocaleString('id-ID')}</span></div>
                            <div class="pk-row"><span>HIV Positif</span><span>${(info.total_positif||0).toLocaleString('id-ID')}</span></div>
                        </div>`, { maxWidth: 260 });

                    layer.on({
                        mouseover(e) {
                            e.target.setStyle({ weight: 3, fillOpacity: 0.9 });
                            e.target.bringToFront();
                        },
                        mouseout(e) { geojsonLayer.resetStyle(e.target); },
                        click(e)    { map.fitBounds(e.target.getBounds(), { padding: [40, 40] }); },
                    });
                },
            }).addTo(map);

            map.fitBounds(geojsonLayer.getBounds());
            document.getElementById('mapLoading').style.display = 'none';
        })
        .catch(() => {
            document.getElementById('mapLoading').innerHTML =
                '<p style="color:#bf3131;font-size:14px;">⚠️ GeoJSON tidak ditemukan di /public/geojson/kecamatan.geojson</p>';
        });
}

/* Filter tombol */
document.querySelectorAll('.cf-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.cf-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        activeFilter = this.dataset.label;
        if (geojsonLayer) geojsonLayer.setStyle(featureStyle);
    });
});

/* ════════════════════════
   LINE CHART
════════════════════════ */
const chartLabels = chartRaw.map(d => d.nama);
const allSeries = [
    {
        id: 'wps',
        label: 'Total WPS',
        data: chartRaw.map(d => d.total_wps),
        borderColor: '#1565C0',
        backgroundColor: 'rgba(21,101,192,.07)',
        borderWidth: 2.5, pointRadius: 4, pointHoverRadius: 7,
        tension: 0.35, fill: false,
    },
    {
        id: 'hotspot',
        label: 'Hotspot Dikunjungi',
        data: chartRaw.map(d => d.total_hotspot),
        borderColor: '#6A1B9A',
        backgroundColor: 'rgba(106,27,154,.07)',
        borderWidth: 2.5, pointRadius: 4, pointHoverRadius: 7,
        tension: 0.35, fill: false,
    },
    {
        id: 'tes',
        label: 'Sudah Dites HIV',
        data: chartRaw.map(d => d.total_tes),
        borderColor: '#2E7D32',
        backgroundColor: 'rgba(46,125,50,.07)',
        borderWidth: 2.5, pointRadius: 4, pointHoverRadius: 7,
        tension: 0.35, fill: false,
    },
    {
        id: 'positif',
        label: 'HIV Positif',
        data: chartRaw.map(d => d.total_positif),
        borderColor: '#bf3131',
        backgroundColor: 'rgba(191,49,49,.07)',
        borderWidth: 2.5, pointRadius: 4, pointHoverRadius: 7,
        tension: 0.35, fill: false,
    },
];

let lineChart;

function buildChart(filter) {
    const ids = filter === 'wps_hotspot' ? ['wps','hotspot']
              : filter === 'tes_positif' ? ['tes','positif']
              : ['wps','hotspot','tes','positif'];

    if (lineChart) lineChart.destroy();

    lineChart = new Chart(
        document.getElementById('lineChart').getContext('2d'), {
        type: 'line',
        data: { labels: chartLabels, datasets: allSeries.filter(s => ids.includes(s.id)) },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true, pointStyle: 'circle',
                        padding: 20, font: { size: 12, weight: '600' },
                    },
                },
                tooltip: {
                    backgroundColor: 'rgba(26,26,46,.92)',
                    titleFont: { size: 13, weight: '700' },
                    bodyFont: { size: 12 },
                    padding: 12, cornerRadius: 8,
                },
            },
            scales: {
                x: {
                    grid: { color: 'rgba(0,0,0,.04)' },
                    ticks: { maxRotation: 55, minRotation: 45, font: { size: 11 }, color: '#555' },
                },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,.05)' },
                    ticks: { font: { size: 11 }, color: '#555' },
                },
            },
        },
    });
}

document.getElementById('chartFilter').addEventListener('change', function () {
    buildChart(this.value);
});

/* ── Init ── */
document.addEventListener('DOMContentLoaded', () => {
    initMap();
    buildChart('all');
});
</script>
@endpush