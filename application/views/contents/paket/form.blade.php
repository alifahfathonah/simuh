@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div style="width: 110%; padding: .5em 1.2em; background-color: #ffffff; display: flex; margin: -1em -1em 1em -1em">
            <button type="button" onclick="goBack()" class="btn btn-default"><i class="fa fa-angle-left"></i>&nbsp;&nbsp; Kembali</button>
        </div>
        <h2 class="page-header">Form Pendaftaran Jamaah</h2>
        <div class="row">
            <div class="col-lg-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" id="form_paket" action="{{base_url()}}tambahpaket" method="POST">
                        <div class="box-body">
                            <div class="form-group form-group-sm">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="nama">Nama Paket</label>
                                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Paket" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="bintang">Level Bintang</label>
                                        <input type="number" min="0" class="form-control" name="bintang" id="bintang" placeholder="Level Bintang" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="lama">Lama Hari</label>
                                        <input type="number" min="0" class="form-control" name="lama" id="lama" placeholder="Lama Hari" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="harga">Harga Mitra</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">IDR</span>
                                            <input type="number" min="0" class="form-control" name="harga_mitra" id="harga_mitra" placeholder="Harga" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="harga">Harga Umum</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">IDR</span>
                                            <input type="number" min="0" class="form-control" name="harga_umum" id="harga_umum" placeholder="Harga" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <span class="pull-right">
                                <button type="reset" id="reset" class="btn btn-danger">Reset Form</button>
                                <button type="submit" id="simpanDataPaket" class="btn btn-primary">Simpan Data</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('css')
@endsection

@section('js')
@endsection

@section('script')
<script>
    function goBack() {
      window.history.back();
    }
</script>
@endsection

@extends('layouts.themplate')