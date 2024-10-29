@extends('sidebar.main_laporan')

@section('breadcrumbs')
<div class="breadcrumbs ">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Laporan</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header pull-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="">Laporan</a></li>
                    <li><a href="#">Laporan Transaksi</a></li>                    
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="">
            <form action="{{ route('transaksi.laporan') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}" required>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row mt-5">
            <div class="col-md-4 ms-auto">
                <form action="{{ route('transaksi.laporan') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="Cari IDPEL..." aria-label="Cari IDPEL" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary ms-2">
                            <i class="fa fa-solid fa-search fa-sm"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <a href="{{ route('export.laporan', ['start_date' => $startDate, 'end_date' => $endDate]) }}" type="button" class="btn btn-success rounded-3 me-3" style="width: auto;">
                    <i class="fa fa-file-text-o"></i> Ekspor
                </a>
                <a href="{{ route('transaksi.laporan') }}" class="btn btn-danger rounded"> <i class="fa fa-solid fa-rotate-right me-2"></i>Reset</a>

            </div>
        </div>
        <div class="card hv-100 mt-2">
            <div class="card-body table-responsive">
                <table id="bootstrap-data-table" class="table table-bordeless table-hover fs-24">
                    <thead class="table-primary" align="center">
                        <tr>
                            <th>NO</th>
                            <th>Tgl Permohonan</th>
                            <th>Nama Pelanggan</th>
                            <th>Idpel</th>
                            <th>Transaksi</th>
                            <th>Di input oleh</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @forelse ($daftung as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration + ($daftung->currentPage() - 1) * $daftung->perPage() }}</td>
                                <td>{{ $item->Tgl_permohonan }}</td>
                                <td>{{ $item->Nama_Pelanggan }}</td>
                                <td>{{ $item->idpel }}</td>
                                <td>{{ $item->Transaksi }}</td>
                                <td>{{ $item->Nama_Admin }}</td>
                            </tr>
                        @empty
                            <tr align="center">
                                <td colspan="6">Tidak ada data transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex h-25 w-50">
                    {{ $daftung->links('pagination::bootstrap-5') }} <!-- Menggunakan $daftung untuk pagination -->
                </div>            
            </div>
        </div>
    </div><!-- .animated -->

    <footer class="footer py-3 mt-5">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-auto ms-auto ">
                    <a href="https://www.smkn-2sbg.sch.id/rpl" class="text-muted">&copy; 2024 rplsmkn2subang</a>
                </div>               
            </div>
        </div>
    </footer>
</div><!-- .content -->
@endsection
