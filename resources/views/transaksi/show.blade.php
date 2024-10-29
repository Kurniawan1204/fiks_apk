@extends('sidebar.main_transaksi')

@section('title', 'Transaksi')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Detail Transaksi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header pull-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="">Transaksi</a></li>
                    <li><a href="">Detail Transaksi</a></li>                                   
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left nav">
                    <strong><i class="fa fa-align-justify "></i><span class="ms-3">Detail Transaksi</span></strong>             
                </div>                               
            </div>
            <div class="card-body">
                @if ($transaksi)
                <div class="row">
                    <div class="form-group mb-3 col-md-3 ms-3">
                        <label class="form-label">TANGGAL PERMOHONAN </label>
                            <div class="card-body">
                                <p class="fw-bold  bg-light p-3 rounded">{{ $transaksi->Tgl_permohonan }}</p>
                            </div>
                    </div>
                    <div class="form-group mb-3 col-md-3 ms-5">
                        <label class="form-label">TRANSAKSI</label>
                        <p  class="bg-light p-3 rounded">{{ $transaksi->Transaksi }}</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="form-group col-md-6 ms-3">
                        <label class="form-label">IDPEL</label>
                        <p class="bg-light p-3 rounded">{{ $transaksi->idpel }}</p>
                    </div>                            
                </div>   

                <div class="row mt-3">
                    <div class="form-group col-md-4 mt-5 ms-3">
                        <label class="form-label">NAMA PELANGGAN</label>
                        <p  class="bg-light p-3 rounded">{{ $transaksi->Nama_Pelanggan }}</p>
                    </div>
                    <div class="form-group col-md-4 mt-5 ms-3">
                        <label class="form-label">NAMA PEMOHON</label>
                        <p  class="bg-light p-3 rounded">{{ $transaksi->Nama_Pemohon }}</p>
                    </div>
                    <div class="form-group col-md-4 mt-5 ms-3">
                        <label class="form-label">NO HP</label>
                        <p  class="bg-light p-3 rounded">{{ $transaksi->No_HP }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="form-group col-md-3 mt-5 ms-3">
                        <label class="form-label">DAYA</label>
                        <p class="bg-light p-3 rounded">{{ $transaksi->Daya }}</p>
                    </div>
                    <div class="form-group col-md-3 mt-5 ms-3">
                        <label class="form-label">TARIF</label>
                        <p  class="bg-light p-3 rounded">{{ $transaksi->Tarif }}</p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="form-group mb-3 col-md-3 ms-3">
                        <label class="form-label">STATUS</label>
                        <p  class="bg-light p-3 rounded">{{ $transaksi->Status }}</p>
                    </div>   
                    <div class="row mt-3 mb-3">
                        <div class="form-group ms-3 col-md-7">
                            <div class="form-floating">       
                                <textarea class="form-control" name="alamat" placeholder="Leave a comment here" id="floatingTextarea" value="{{ $transaksi->Alamat }}" disabled></textarea>                                    
                                <label for="alamat" class="form-label">ALAMAT</label>
                            </div>
                        </div>  
                    </div>
                    <hr class="shadow-lg bg-body-tertiary border border-primary border-3 opacity-25" style="width: 70rem; margin-left: 1.4rem; " >                           
                    <div class="row mt-3">
                        <div class="col d-flex justify-content-end">
                            <a href="{{ url('Transaksi') }}" class="btn btn-outline-danger rounded-3 ">
                                KEMBALI
                            </a>                           
                        </div>
                    </div> 
                @else
                    <p>Data transaksi tidak ditemukan.</p>
                @endif                                                                  
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
@endsection
