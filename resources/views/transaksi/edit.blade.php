@extends('sidebar.main_transaksi')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>EDIT</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header pull-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="">Edit Daftung</a></li>
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
                   <strong><i class="fa fa-align-justify"></i><span class="ms-3">Form Daftung</span></strong>             
                </div>                               
            </div>
            <div class="card-body">                          
                <form action="{{ url('Transaksi/'.$transaksi->id) }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-md-3 ms-3">
                            <label class="form-label">TANGGAL PERMOHONAN <span style="color: red">*</span></label>
                            <input type="date" name="Tgl_permohonan" class="form-control bg-light p-3-subtle fw-bold disabled " value="{{ $transaksi->Tgl_permohonan }}" autofocus required>
                        </div> 
                        <div class="form-group mb-3 col-md-3 ms-5">
                            <label class="form-label">TRANSAKSI</label>
                            <select id="inputState" name="transaksi" class="form-select disabled">
                                <option selected>Pasang baru</option>
                                <option>Perubahan daya</option>
                            </select>
                        </div>     
                    </div>

                    <div class="row mt-4">
                        <div class="form-group col-md-6 ms-3">
                            <label class="form-label">IDPEL <span style="color: red">*</span></label>
                            {{-- <input type="text" name="idpel" class="form-control bg-secondary-subtle disabled" value="" autofocus required> --}}
                            <p class="bg-light p-2 rounded">{{ $transaksi->idpel }}</p>
                        </div>
                    </div>   

                    <div class="row mt-3">
                        <div class="form-group col-md-3 mt-5 ms-3">
                            <label class="form-label">NAMA PELANGGAN<span style="color: red">*</span></label>
                           <p class="bg-light p-2 rounded">{{ $transaksi->Nama_Pelanggan }} </p>
                        </div>
                        <div class="form-group col-md-3 mt-5 ms-3">
                            <label class="form-label">Nama Pemohon<span style="color: red">*</span></label>
                           <p class="bg-light p-2 rounded">{{ $transaksi->Nama_Pemohon }} </p>
                        </div>
                        <div class="form-group col-md-4 mt-5 ms-3">
                            <label class="form-label">NO HP<span style="color: red">*</span></label>
                           <p class="bg-light p-2 rounded">{{ $transaksi->No_HP }} </p> 
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="form-group col-md-3 mt-5 ms-3">
                            <label class="form-label">DAYA<span style="color: red">*</span></label>
                           <p class="bg-light p-2 rounded">{{ $transaksi->Daya }} </p>
                        </div>
                        <div class="form-group col-md-3 mt-5 ms-3">
                            <label class="form-label">TARIF <span style="color: red">*</span></label>
                            <p class="bg-light p-2 rounded"> {{ $transaksi->Tarif }}  </p>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="form-group mb-3 col-md-3 ms-3">
                            <label class="form-label">STATUS <span style="color: red">*</span></label>
                            <input type="text" class="form-control bg-secondary-subtle" name="status" value="{{ $transaksi->Status }}" autofocus required>                           
                        </div>   
                    </div>

                    <div class="row mt-3 mb-3">
                        <div class="form-group ms-3 col-md-7">
                            <div class="form-floating">
                                <textarea class="form-control" name="alamat" id="floatingTextarea">{{ $transaksi->Alamat }}</textarea>
                                <label for="alamat" class="form-label">ALAMAT <span style="color: red">*</span></label>
                            </div>
                        </div>  
                    </div>

                    <div class="card-body">
                        <div class="card-title">
                            Validasi <span style="color: red">*</span>
                        </div>
                        <input class="fs-4" type="checkbox" name="is_validated" value="1"> Validasi
                    </div>

                    <hr style="width: 70rem; margin-left: 1.4rem;" class="shadow-lg bg-body-tertiary border border-primary border-3 opacity-25">

                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <a href="{{ url('Transaksi') }}" class="btn btn-outline-danger rounded-3 me-3">Kembali</a>                           
                            <button type="submit" class="btn btn-success text-white rounded-3">Simpan</button>                           
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer py-3 mt-5">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-auto ms-auto">
                    <a href="https://www.smkn-2sbg.sch.id/rpl" class="text-muted">&copy; 2024 rplsmkn2subang</a>
                </div>               
            </div>
        </div>
    </footer>
</div>
@endsection
