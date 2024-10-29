@extends('sidebar.main_transaksi')


@section('breadcrumbs')
<div class="breadcrumbs ">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Transaksi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header pull-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="">transaksi</a></li>
                    <li><a href="#">Jumlah Daftung</a></li>                    
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<d class="content mt-3">
    <div class="animated fadeIn">
         @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card"> 
            <div class="mt-3 ms-3 pull-left nav nav-tabs">
                <a href="{{ url('Transaksi') }}" class="nav-link {{ (request()->is('Transaksi')) ? 'active bg-primary text-light lead' : '' }}">
                    <strong>Transaksi</strong>
                </a>
                <a href="{{ url('transaksi/permohonan') }}" class="nav-link {{ (request()->is('transaksi/permohonan')) ? 'active bg-primary text-light lead' : '' }}">
                    <strong>Jumlah Permohonan</strong>
                </a>
                <a href="{{ url('transaksi/bayar') }}" class="nav-link {{ (request()->is('transaksi/bayar')) ? 'active bg-primary text-light lead' : '' }}">
                    <strong>Jumlah Bayar</strong>
                </a>
                <a href="{{ url('transaksi/validasi') }}" class="nav-link {{ (request()->is('transaksi/validasi')) ? 'active bg-primary text-light lead' : '' }}">
                    <strong>Validasi</strong>
                </a>   
            </div>
            
            <div class=" ms-3 me-3 mt-3">
                       
                <div class="pull-right">
                    <a href="{{ url('transaksi/add') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambahkan
                    </a>
                </div>
            </div>
            <div class="card-body ms-3 table-responsive">           
            <table id="bootstrap-data-table" class="table table-bordeless  table-hover">
            <thead class="table-primary" align="center">                
                <th>NO</th>
                <th>Tgl Permohonan</th>
                {{-- <th>Nama pemohon</th> --}}
                <th>Nama Pelanggan</th>
                <th>Idpel</th>
                <th>Transaksi</th>
                {{-- <th>No HP</th> --}}
                {{-- <th>Daya</th> --}}
                {{-- <th>Tarif</th> --}}
                {{-- <th>Alamat</th> --}}
                <th>Status</th>
                <th>Aksi</th>
                {{-- <th align="center">Aksi</th> --}}
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                    <tr align="center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item-> Tgl_permohonan }}</td>
                        {{-- <td>{{ $item-> Nama_Pemohon }}</td> --}}
                        <td>{{ $item-> Nama_Pelanggan }}</td>
                        <td>{{ $item-> idpel }}</td>
                        <td>{{ $item-> Transaksi}}</td>
                        {{-- <td>{{ $item-> No_HP }}</td> --}}
                        {{-- <td>{{ $item-> Daya }}</td> --}}
                        {{-- <td>{{ $item-> Tarif }}</td> --}}
                        {{-- <td {{ $item-> Alamat }}</td>  --}}
                        <td>{{ $item-> Status}}</td>
                        <td>
                            <!-- Tooltip muncul di atas ikon mata (fa-eye) -->
                            <a href="{{ url('transaksi/show/' . $item->id) }}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
                              <i class="fa fa-eye"></i>
                            </a>
                          
                            <!-- Tooltip muncul di atas ikon pensil (fa-pencil) -->
                            <a href="{{ url('transaksi/edit/' . $item->id) }}" class="btn btn-outline-warning btn-sm disabled" data-toggle="tooltip" data-placement="top" title="Edit Transaksi">
                              <i class="fa fa-pencil"></i>
                            </a>
                          </td>                                                                                                                                                 
                    </tr>
                @endforeach
            </tbody>
            </table>
         </div>
        </div>




    </div><!-- .animated -->
    <footer class="footer py-3 mt-5">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-auto ms-auto">
                    <a href="https://www.smkn-2sbg.sch.id/rpl" class="text-muted">&copy; 2024 rplsmkn2subang</a>
                </div>               
            </div>
        </div>
    </footer>    
</div><!-- .content -->

</div><!-- /#right-panel -->


@endsection
