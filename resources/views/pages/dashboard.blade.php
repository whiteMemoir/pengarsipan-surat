@extends('layouts.template')

@section('content-app')
    <form action="" method="GET">
        <div class="row d-flex justify-content-end">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                        value="{{ request('tanggal') ?? date('Y-m-d') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <div class="form-group">
                    <a href="{{ url('/dashboard') }}" class="btn btn-danger">
                        <i class="fa fa-refresh"></i> Reset</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
        </div>
    </form>

    <div id="originalDashboardContainer">
        <div class="row" id="contentBox">
            <div class="col-md-3 col-sm-6">
                <div class="card gradient-1 bg-info shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white">
                            <i class="fa fa-envelope"></i> SURAT MASUK
                        </h6>
                        <h2 class="text-white">1</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card gradient-2 bg-success shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white">
                            <i class="fa fa-envelope"></i> SURAT KELUAR
                        </h6>
                        <h2 class="text-white">1</h2>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">Statistik Surat Keluar Masuk</div>
                    <div class="card-body">
                        <div class="chart-loading"
                            style="display:none; position:absolute; top:0; left:0; right:0; bottom:0; background:rgba(255,255,255,0.8); z-index:10; text-align:center; padding-top:80px;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <p>Memuat grafik...</p>
                        </div>
                        <canvas id="chartPerJam" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Chart.js CDN -->
    <script src="{{ asset('theme/js') }}/chart.js"></script>

    <script>
        let chartRuangan = null;
        let chartPerJam = null;
        let chartGender = null;

        // ajax get data
        function getData() {
            $.ajax({
                url: "{{ url('/home') }}",
                type: "GET",
                data: {
                    tanggal: $('#tanggal').val(),
                },
                // beforeSend: function () {
                //     $('.chart-loading').show();
                // },
                dataType: "json",
                success: function(res) {
                    $('.chart-loading').hide();
                    $('#contentBox').html(res.htmlContentBox);

                    const backgrounds = [
                        '#17a2b8',
                        '#ffc107',
                        '#dc3545',
                        '#07b3f4',
                        '#9b59b6',
                        '#364f80',
                        '#f67019',
                        '#07b3f4',
                        '#9b59b6',
                    ];

                    // Data untuk chart
                    const male = res.male;
                    const female = res.female;

                    const labelsChartJam = res.labelsChartJam;
                    const dataChartJam = res.finalData;

                    const labelsChart1 = res.labelsChart1;
                    const dataChart1 = res.dataChart1;

                    let backgroundChart1 = [];
                    for (let i = 0; i < labelsChart1.length; i++) {
                        backgroundChart1.push(backgrounds[i % backgrounds.length]);
                    }

                    // Destroy charts lama agar bisa diganti
                    if (chartRuangan) chartRuangan.destroy();
                    if (chartPerJam) chartPerJam.destroy();
                    if (chartGender) chartGender.destroy();

                    // Chart Ruangan
                    chartRuangan = new Chart(document.getElementById('chartRuangan'), {
                        type: 'bar',
                        data: {
                            labels: labelsChart1,
                            datasets: [{
                                label: 'Jumlah',
                                data: dataChart1,
                                backgroundColor: backgroundChart1
                            }]
                        },
                        options: {
                            responsive: true,
                            animation: false,
                            maintainAspectRatio: false,
                            indexAxis: 'y',
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    suggestedMax: 10,
                                    ticks: {
                                        stepSize: 1,
                                        precision: 0,
                                        callback: function(value) {
                                            return Number.isInteger(value) ? value : null;
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    // Chart Per Jam
                    chartPerJam = new Chart(document.getElementById('chartPerJam'), {
                        type: 'line',
                        data: {
                            labels: labelsChartJam,
                            datasets: [{
                                label: 'Total Pemeriksaan',
                                data: dataChartJam,
                                borderColor: '#6610f2',
                                backgroundColor: 'rgba(102,16,242,0.1)',
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            animation: false,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    ticks: {
                                        minRotation: 45,
                                        maxRotation: 45
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: 10,
                                    ticks: {
                                        stepSize: 1,
                                        callback: function(value) {
                                            return Number.isInteger(value) ? value : null;
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Chart Gender
                    chartGender = new Chart(document.getElementById('chartGender'), {
                        type: 'pie',
                        data: {
                            labels: ['Laki-laki', 'Perempuan'],
                            datasets: [{
                                data: [male, female],
                                backgroundColor: ['#20c997', '#fd7e14']
                            }]
                        },
                        options: {
                            responsive: true,
                            animation: false,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                }
            });
        }

        // Jalankan pertama kali dan ulangi setiap 2 detik
        getData();
        setInterval(getData, 2000);
    </script>

    <script>
        const modal = document.getElementById('fullscreenModal');
        const content = document.getElementById('fullscreenContent');
        const dashboard = document.getElementById('originalDashboardContainer');

        const openBtn = document.getElementById('openFullscreenBtn');
        const closeBtn = document.getElementById('closeFullscreenBtn');

        let originalParent;

        openBtn.addEventListener('click', () => {
            // Simpan referensi parent asli
            originalParent = dashboard.parentNode;

            // Pindahkan dashboard ke modal
            content.appendChild(dashboard);
            modal.style.display = 'block';
        });

        closeBtn.addEventListener('click', () => {
            // Balikkan dashboard ke tempat semula
            originalParent.appendChild(dashboard);
            modal.style.display = 'none';
        });


        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                closeBtn.click();
            }
        });
    </script>
@endsection
