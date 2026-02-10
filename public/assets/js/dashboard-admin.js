// Data dummy untuk kecamatan
const dummyData = {
    'Kencong': { wps: 12, lul: 8, realisasi_wps: 10, realisasi_lul: 6 },
    'Gumukmas': { wps: 18, lul: 15, realisasi_wps: 15, realisasi_lul: 12 },
    'Puger': { wps: 7, lul: 5, realisasi_wps: 6, realisasi_lul: 4 },
    'Wuluhan': { wps: 22, lul: 19, realisasi_wps: 18, realisasi_lul: 16 },
    'Ambulu': { wps: 14, lul: 11, realisasi_wps: 12, realisasi_lul: 9 },
    'Tempurejo': { wps: 9, lul: 6, realisasi_wps: 7, realisasi_lul: 5 },
    'Silo': { wps: 16, lul: 13, realisasi_wps: 14, realisasi_lul: 11 },
    'Mayang': { wps: 11, lul: 8, realisasi_wps: 9, realisasi_lul: 7 },
    'Mumbulsari': { wps: 13, lul: 10, realisasi_wps: 11, realisasi_lul: 8 },
    'Jenggawah': { wps: 19, lul: 16, realisasi_wps: 16, realisasi_lul: 14 },
    'Ajung': { wps: 15, lul: 12, realisasi_wps: 13, realisasi_lul: 10 },
    'Rambipuji': { wps: 10, lul: 7, realisasi_wps: 8, realisasi_lul: 6 },
    'Balung': { wps: 20, lul: 17, realisasi_wps: 17, realisasi_lul: 15 },
    'Umbulsari': { wps: 8, lul: 6, realisasi_wps: 7, realisasi_lul: 5 },
    'Semboro': { wps: 17, lul: 14, realisasi_wps: 15, realisasi_lul: 12 },
    'Jombang': { wps: 12, lul: 9, realisasi_wps: 10, realisasi_lul: 8 },
    'Sumberbaru': { wps: 14, lul: 11, realisasi_wps: 12, realisasi_lul: 9 },
    'Tanggul': { wps: 21, lul: 18, realisasi_wps: 18, realisasi_lul: 16 },
    'Bangsalsari': { wps: 16, lul: 13, realisasi_wps: 14, realisasi_lul: 11 },
    'Panti': { wps: 11, lul: 8, realisasi_wps: 9, realisasi_lul: 7 },
    'Sukorambi': { wps: 13, lul: 10, realisasi_wps: 11, realisasi_lul: 9 },
    'Arjasa': { wps: 9, lul: 7, realisasi_wps: 8, realisasi_lul: 6 },
    'Pakusari': { wps: 15, lul: 12, realisasi_wps: 13, realisasi_lul: 10 },
    'Kalisat': { wps: 18, lul: 15, realisasi_wps: 16, realisasi_lul: 13 },
    'Ledokombo': { wps: 10, lul: 8, realisasi_wps: 9, realisasi_lul: 7 },
    'Sumberjambe': { wps: 12, lul: 9, realisasi_wps: 10, realisasi_lul: 8 },
    'Sukowono': { wps: 14, lul: 11, realisasi_wps: 12, realisasi_lul: 10 },
    'Jelbuk': { wps: 8, lul: 6, realisasi_wps: 7, realisasi_lul: 5 },
    'Kaliwates': { wps: 25, lul: 22, realisasi_wps: 22, realisasi_lul: 19 },
    'Sumbersari': { wps: 23, lul: 20, realisasi_wps: 20, realisasi_lul: 18 },
    'Patrang': { wps: 24, lul: 21, realisasi_wps: 21, realisasi_lul: 18 }
};

// Fungsi untuk menentukan warna berdasarkan jumlah total
function getColor(total) {
    if (total > 30) return '#d32f2f';      // Merah - Tinggi
    if (total > 20) return '#f57c00';      // Orange - Sedang
    if (total > 10) return '#fdd835';      // Kuning - Rendah
    return '#7cb342';                       // Hijau - Sangat Rendah
}

// Inisialisasi Peta
let map;
let geojsonLayer;

function initMap() {
    // Buat peta dengan center di Jember
    map = L.map('map').setView([-8.1706, 113.7097], 10);

    // Tambahkan tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18
    }).addTo(map);

    // Load GeoJSON
    fetch('/public/geojson/kecamatan.geojson')
        .then(response => response.json())
        .then(data => {
            geojsonLayer = L.geoJSON(data, {
                style: function(feature) {
                    const nama = feature.properties.NAMOBJ || feature.properties.name || feature.properties.NAME;
                    const dataKec = dummyData[nama] || { wps: 0, lul: 0 };
                    const total = dataKec.wps + dataKec.lul;
                    
                    return {
                        fillColor: getColor(total),
                        weight: 2,
                        opacity: 1,
                        color: '#666',
                        fillOpacity: 0.7
                    };
                },
                onEachFeature: function(feature, layer) {
                    const nama = feature.properties.NAMOBJ || feature.properties.name || feature.properties.NAME;
                    const dataKec = dummyData[nama] || { wps: 0, lul: 0, realisasi_wps: 0, realisasi_lul: 0 };
                    
                    const popupContent = `
                        <div class="popup-title">${nama}</div>
                        <div class="popup-info">
                            <span class="popup-label">Total WPS:</span> ${dataKec.wps}
                        </div>
                        <div class="popup-info">
                            <span class="popup-label">Total LUL:</span> ${dataKec.lul}
                        </div>
                        <div class="popup-info">
                            <span class="popup-label">Realisasi WPS:</span> ${dataKec.realisasi_wps}
                        </div>
                        <div class="popup-info">
                            <span class="popup-label">Realisasi LUL:</span> ${dataKec.realisasi_lul}
                        </div>
                        <div class="popup-info">
                            <span class="popup-label">Total:</span> <strong>${dataKec.wps + dataKec.lul}</strong>
                        </div>
                    `;
                    
                    layer.bindPopup(popupContent);
                    
                    // Hover effect
                    layer.on('mouseover', function() {
                        this.setStyle({
                            weight: 3,
                            color: '#333',
                            fillOpacity: 0.9
                        });
                    });
                    
                    layer.on('mouseout', function() {
                        geojsonLayer.resetStyle(this);
                    });
                }
            }).addTo(map);
        })
        .catch(error => {
            console.error('Error loading GeoJSON:', error);
            alert('Gagal memuat data peta. Pastikan file geojson/kecamatan.geojson ada di folder public.');
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
            datasets: [
                {
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
            datasets: [
                {
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