@extends('sidebar.main_master')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn row">
        <div class="col-lg-6  ">
            <form action="{{ url('home') }}" method="GET" class="mb-3 d-flex">
              <div class="row">
                <div class="col-md-5 p-2">
                  <label for="start_date">Start Date:</label>
                  <div class="input-group">
                    <input type="text" name="start_date" class="form-control datepicker" value="{{ session('start_date', request('start_date')) }}">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                  </div>
                </div>
                <div class="col-md-5 p-2">
                  <label for="end_date">End Date:</label>
                  <div class="input-group">
                    <input type="text" name="end_date" class="form-control datepicker" value="{{ session('end_date', request('end_date')) }}">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>  
                  </div>
                </div>   
                <div class="col-md-2 p-2 d-flex align-items-end"> 
                  <button type="submit" class="btn btn-primary flex-fill">Filter</button>
                </div>                  
              </div>
            </form>
          </div>
        
        <div class="row">
            <div class="col-lg-3">
                <a href="{{ url('Transaksi') }}">
                    <div class="card rounded-2 show">
                        <div class="card-body ">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="fa fa-file-text-o text-success border-success"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Jumlah Daftung</div>
                                    <div class="stat-digit">{{ $totalDaftung }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        
            <div class="col-lg-3">
                <a href="{{ url('transaksi/permohonan') }}">
                    <div class="card rounded-2 show">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Jumlah Permohonan</div>
                                    <div class="stat-digit">{{ $totalPermohonan }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        
            <div class="col-lg-3">
                <a href="{{ url('transaksi/bayar') }}">
                    <div class="card rounded-2 show">
                        <div class="card-body ">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="fa fa-money text-warning border-warning"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Jumlah Bayar</div>
                                    <div class="stat-digit">{{ $totalBayar }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ url('transaksi/validasi') }}">
                    <div class="card rounded-2 show">
                        <div class="card-body ">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-check text-success border-success"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Validasi</div>
                                    <div class="stat-digit">{{ $totalValidasi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        
        </div>
        
    </div>

    <div class="panel">
        <div class="card">
            <div class="card-header">
                <strong>Jumlah Transaksi</strong>
            </div>
            <div class="card-body">
                <canvas id="myChart" style="width: 580px; height: 200px;"></canvas>
            </div>
        </div>        
    </div>
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <strong>Statistik Pelanggan Per Bulan</strong>
            </div>
            <div class="card-body">
                <canvas id="monthlyChart" style="width: 580px; height: 200px;"></canvas>
            </div>
        </div>
    </div>
    
</div>

<footer class="footer py-3 mt-5">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-auto ms-auto ">
                <a href="https://www.smkn-2sbg.sch.id/rpl" class="text-muted">&copy; 2024 rplsmkn2subang</a>
            </div>               
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Jumlah Transaksi',
                data: @json($data),            
                backgroundColor: 'rgb(104, 177, 240)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
    scales: {
        y: {
            beginAtZero: true,
            ticks: {
                stepSize: 20 
            }
        }
    }
}
    });
</script>
<script>
    // Ambil data dari PHP yang dikirimkan dari controller
    var labelsMonthly = @json($labelsMonthly);  // Label bulan (misal: Januari, Februari, dll.)
    var dataTotalMonthly = @json($dataTotalMonthly);  // Data total daftung per bulan
    var dataValidasiMonthly = @json($dataValidasiMonthly);  // Data validasi per bulan

    // Inisialisasi Chart.js untuk menggambar grafik bar chart
    var ctx = document.getElementById('monthlyChart').getContext('2d');
    var monthlyChart = new Chart(ctx, {
        type: 'line',  // Bisa diganti dengan 'line' jika ingin line chart
        data: {
            labels: labelsMonthly,  // Nama bulan
            datasets: [
                {
                    label: 'Total Daftung',
                    data: dataTotalMonthly,  // Total daftung per bulan
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',  // Warna bar
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Daftung Tervalidasi',
                    data: dataValidasiMonthly,  // Data daftung yang tervalidasi per bulan
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',  // Warna bar
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                      // Mulai grafik dari 0
                      ticks: {
                stepSize: 20 
            }
                }
            },
            responsive: true,  // Agar chart responsif
            plugins: {
                legend: {
                    position: 'top',  // Posisi legend
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            }
        }
    });
</script>



<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd', // Format tanggal
            autoclose: true, // Menutup setelah memilih tanggal
            todayHighlight: true // Menyoroti tanggal hari ini
        });

        $('.input-group-addon').on('click', function() {
            $(this).siblings('.datepicker').datepicker('show'); // Menampilkan datepicker saat ikon diklik
        });
    });
</script>

@endsection
