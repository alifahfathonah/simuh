@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <!-- general form elements -->
                 <!-- form start -->
                <form role="form" enctype="multipart/form-data" action="{{base_url()}}simpanpendaftaranjamaah" method="POST">
                    <div class="box box-success box-solid">                   
                        <div class="box-header with-border">
                            <h3 class="box-title">Form Pendaftaran Jamaah</h3>
                        </div>
                        <div class="box-body">                            
                            <div class="form-group form-group-sm">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="jenis">Jenis Pendaftaran</label>
                                        <select class="form-control" name="jenis" id="jenis" required>
                                            <option value="">-- Jenis Pendaftaran</option>
                                            <option value="haji">Haji</option>
                                            <option value="umroh">Umroh</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="status">Status Calon Jamaah</label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="">-- Status</option>
                                            <option value="umum" id="paket_umum">Umum</option>
                                            <option value="mitra" id="paket_mitra">Mitra</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" id="id_mitra_input">
                                        <label for="id_mitra">ID Mitra</label>
                                        <select name="id_mitra" id="id_mitra" class="form-control select2"></select>
                                    </div>  
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="hidden" name="id_head_user" value="{{$_SESSION['id_admin']}}">
                                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="ktp">No.KTP</label>
                                        <input type="text" class="form-control" name="ktp" id="ktp" placeholder="No.KTP" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk" required>
                                            <option value="">-- Jenis Kelamin</option>
                                            <option value="laki-laki">Laki-Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="no_tlp">No.Telp/HP</label>
                                        <input type="text" class="form-control" name="no_tlp" id="no_tlp" placeholder="No.Telp/HP" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="paket">Paket Pilihan</label>
                                        <select class="form-control" name="paket" id="paket" required>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="harga">Harga Paket</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">IDR</span>
                                            <input type="text" class="form-control text-right" name="harga" id="harga" placeholder="Harga Paket" readonly>
                                        </div>
                                    </div>   
                                    <div class="col-sm-3">
                                        <label for="tipe_kamar">Tipe Kamar</label>
                                        <input type="text" class="form-control" name="tipe_kamar" id="tipe_kamar" placeholder="Tipe Kamar" readonly>
                                    </div> 
                                    <div class="col-sm-3">
                                        <label for="maskapai">Maskapai</label>
                                        <input type="text" class="form-control" name="maskapai" id="maskapai" placeholder="Maskapai" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                    </div> 
                                    <div class="col-sm-3" id="input_foto">
                                        <label for="foto">Upload Foto</label>
                                        <input type="file" class="form-control" name="foto" id="foto" accept="image/jpg, image/jpeg" placeholder="Upload Foto" required>
                                    </div>
                                    <div class="col-sm-3" id="input_ktp">
                                        <label for="foto_ktp">Upload KTP</label>
                                        <input type="file" class="form-control" name="foto_ktp" id="foto_ktp" accept="image/jpg, image/jpeg" placeholder="Upload KTP" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="bukti">Upload Bukti Transfer</label>
                                        <input type="file" class="form-control" name="bukti" id="bukti" accept="image/jpg, image/jpeg" placeholder="Upload Bukti Transfer" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="row">
                                    <div class="col-sm-12 text-red">
                                        * Maksimal file upload adalah 1Mb dan format file jpg.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <span class="pull-right">
                                <button type="button" class="btn btn-default">Kembali</button>
                                <button type="reset" class="btn btn-danger">Reset Form</button>
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </span>
                        </div>
                    
                    </div>                
                    <!-- /.box -->
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{base_url()}}bower_components/select2/dist/css/select2.min.css">
@endsection

@section('js')
<!-- Select2 -->
<script src="{{base_url()}}bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{base_url()}}assets/pendaftaran_jamaah/form_pendaftaran.js"></script>
@endsection

@section('script')
@endsection

@extends('layouts.themplate')