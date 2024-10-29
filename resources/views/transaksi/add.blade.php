@extends('sidebar.main_transaksi')

@section('title', 'Transaksi')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>FORM</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header pull-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="">Form Daftung</a></li>
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
                <div class="pull-left nav ">
                   <strong><i class="fa fa-align-justify "></i><span class="ms-3">Form Daftung</span></strong>             
                </div>                               
            </div>
            <div class="card-body ">                          
                    <form action="{{ url('Transaksi') }}" method="POST" >
                        @csrf
                        <div class="row">
                            <div class="form-group mb-3 col-md-3 ms-3">
                                <label class="form-label">TANGGAL PERMOHONAN <span style="color: red">*</span> </label>
                                <input type="date" name="Tgl_permohonan" class="form-control" autofocus required><span>
                            </div>
                            <div class="form-group mb-3 col-md-3 ms-3 ">
                                <label class="form-label">TRANSAKSI <span style="color: red">*</span></label>
                                <select id="inputState" name="transaksi" class="form-select">
                                <option selected>Pasang baru</option>
                                <option>Perubahan daya</option>
                                </select>

                            </div>     
                        </div>

                        <div class="row mt-4">
                            <div class="form-group col-md-6 ms-3">
                                <label class="form-label">IDPEL <span style="color: red">*</span></label>
                                <input type="text" name="idpel" class="form-control" placeholder="53425xxxxxxx" pattern="\d*" autofocus required>
                            </div>                            
                        </div>   

                        <div class="row mt-3">
                            <div class="form-group col-md-4  mt-5  ms-3">
                                <label class="form-label">NAMA PELANGGAN <span style="color: red">*</span></label>
                                <input type="text" name="nama_pelanggan" class="form-control" placeholder="jond dhoe" autofocus required>
                            </div>
                            <div class="form-group col-md-4  mt-5  ms-3">
                                <label class="form-label">NAMA PEMOHON <span style="color: red">*</span></label>
                                <input type="text" name="nama_pemohon" class="form-control" placeholder="jond dhoe" autofocus required>
                            </div>
                            <div class="form-group col-md-4  mt-5  ms-3">
                                <label class="form-label">NO HP <span style="color: red">*</span></label>
                                <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxx" pattern="\d*" autofocus required> {{-- pattern="\d*" fungsinya agar hanya angka saja yang dapat mengisi data ini  --}}
                            </div>
                        </div>
                       <div class="row mt-3">
                            <div class="form-group col-md-3  mt-5  ms-3">
                                <label class="form-label">DAYA <span style="color: red">*</span></label>
                                <input type="text" name="daya" class="form-control" placeholder="66xxx" autofocus required>
                            </div>
                            <div class="form-group col-md-3  mt-5  ms-3">
                                <label class="form-label">TARIF <span style="color: red">*</span></label>
                                <input type="text" name="tarif" class="form-control " autofocus required>
                            </div>
                       </div>
                       <div class="row mt-5">
                        <div class="form-group mb-3 col-md-3 ms-3 ">
                            <label class="form-label">STATUS <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="status" placeholder="PERMOHONAN/BAYAR" autofocus required>                           
                        </div>   
                        <div class="row mt-3 mb-3 ">
                            <div class="form-group ms-3 col-md-7">
                                <div class="form-floating ">       
                                    <textarea class="form-control" name="alamat" placeholder="Leave a comment here"  id="floatingTextarea" required></textarea>                                    
                                    <label for="alamat" class="form-label">ALAMAT <span style="color: red">*</span></label>
                                </div>
                            </div>  
                       </div>
                     
                       <hr style="width: 70rem;" class="justify-content-center ms-4 shadow-lg bg-body-tertiary border border-primary border-3 opacity-25">                           
                       <div class="row mt-3">
                            <div class="col d-flex justify-content-end">
                                <a href="{{ url('Transaksi') }}" class="btn btn-outline-danger rounded-3 me-3">
                                    KEMBALI
                                </a>
                                <button type="submit" class="btn btn-success text-white rounded-3" onclick="Save()">SIMPAN</button> <!-- Changed to submit -->
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
    </div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->

    
@endsection
<script>
    function Save() {
        swal({
            title: "Konfirmasi",
            text: "Apakah Anda yakin untuk menyimpannya?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, simpan!",
            cancelButtonText: "Batal",
            closeOnConfirm: false
        }, function() {
            // Jika pengguna mengonfirmasi, submit form
            document.querySelector('form').submit();
        });
    }
    </script> 