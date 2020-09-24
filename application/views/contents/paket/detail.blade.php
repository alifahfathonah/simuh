@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div style="width: 110%; padding: .5em 1.2em; background-color: #ffffff; display: flex; margin: -1em -1em 1em -1em">
            <a href="{{base_url()}}paket" class="btn btn-default"><i class="fa fa-angle-left"></i>&nbsp;&nbsp; Kembali</a>
        </div>
        @if (isset($_SESSION['success']))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Your data has been saved.
            </div>
        @endif
        @if (isset($_SESSION['gagal']))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Gagal</h4>
                Data gagal di inputkan!.
            </div>
        @endif
        <h2 class="page-header">Form Pendaftaran Jamaah</h2>
        <div class="row">
            <div class="col-lg-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" id="form_paket" action="{{base_url()}}tambahpaket">
                        @foreach ($dataPaket as $paket)
                            <div class="box-body">
                                <div class="form-group form-group-sm">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="nama">Nama Paket</label>
                                            <input type="text" class="form-control" name="nama" value="{{$paket->nama}}" id="nama" placeholder="Nama Paket" disabled>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="bintang">Level Bintang</label>
                                            <input type="number" min="0" class="form-control" name="bintang" value="{{$paket->lama}}" id="bintang" placeholder="Level Bintang" disabled>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="lama">Lama Hari</label>
                                            <input type="number" min="0" class="form-control" name="lama" value="{{$paket->bintang}}" id="lama" placeholder="Lama Hari" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="harga">Harga Mitra</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">IDR</span>
                                                <input type="number" min="0" class="form-control" name="harga_mitra" value="{{$paket->harga_mitra}}" id="harga_mitra" placeholder="Harga" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="harga">Harga Umum</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">IDR</span>
                                                <input type="number" min="0" class="form-control" name="harga_umum" value="{{$paket->harga_umum}}" id="harga_umum" placeholder="Harga" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        @endforeach
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <div class="row" id="next_input">
            <div class="col-lg-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" id="form_detail_paket">
                        <div class="box-body">
                            <div class="form-group form-group-sm">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h3><i class="fa fa-building-o"></i> Hotel Makkah</h3>
                                        <label for="hotel_makkah">Nama Hotel</label>
                                        <div class="input-group input-group-sm">
                                            @foreach ($dataPaket as $paket)
                                                <input type="hidden" name="id_paket" id="id_paket" value="{{$paket->id_paket}}">
                                            @endforeach
                                            <select class="form-control" name="hotel_makkah" id="hotel_makkah">
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-makkah">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <h3><i class="fa fa-building-o"></i> Hotel Madina</h3>
                                        <label for="hotel_madina">Nama Hotel</label>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" name="hotel_madina" id="hotel_madina">
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-madina">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <h3><i class="fa fa-hotel"></i> Kamar</h3>
                                        <label for="tipe_kamar">Tipe Kamar</label>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" name="tipe_kamar" id="tipe_kamar">
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-kamar">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <h3><i class="fa fa-plane"></i> Maskapai</h3>
                                        <label for="maskapai">Maskapai</label>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" name="maskapai" id="maskapai">
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-maskapai">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->                    

                        <div class="box-footer">
                            <span class="pull-right">
                                <button type="reset" class="btn btn-danger">Reset Form</button>
                                <button type="button" id="simpanDetailPaket" class="btn btn-primary">Simpan Data</button>
                            </span>
                        </div>                    
                    </form>

                    <div class="box-footer">
                        <table id="example1" class="table table-bordered table-condensed table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>
                                        <i class="fa fa-map-marker"></i> Lokasi
                                    </th>
                                    <th width="400">
                                        <i class="fa fa-building-o"></i> Hotel
                                    </th>
                                    <th>
                                        <i class="fa fa-hotel"></i> Tipe Kamar
                                    </th>
                                    <th width="200">
                                        <i class="fa fa-plane"></i> Maskapai
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="dataDetailPaket">
                            </tbody>
                        </table>
                    </div>
                    <div id="loadDetailPaket" class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-footer">
                        <span class="pull-right">
                            @foreach ($dataPaket as $paket)
                                <button type="reset" class="btn btn-danger" id="deleteDataDetailPaket" data-id="{{$paket->id_paket}}"><i class="fa fa-trash-o"></i> Delete</button>
                            @endforeach
                        </span>
                    </div> 
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="modal-makkah">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="tambah_hotel_makkah">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">
              Tambah Data Hotel di Makkah
            </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Nama Hotel</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building-o"></i>
                    </span>
                    <input type="text" class="form-control" name="nama" id="nama_hotel_makkah" required>
                </div>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <input type="text" class="form-control" name="lokasi" id="lokasi" value="Makkah" readonly>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" id="tambahHotelMakkah" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-madina">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="tambah_hotel_madina">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">
              Tambah Data Hotel di Madina
            </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Nama Hotel</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building-o"></i>
                    </span>
                    <input type="text" class="form-control" name="nama" id="nama_hotel_madina" required>
                </div>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <input type="text" class="form-control" name="lokasi" id="lokasi" value="Madina" readonly>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" id="tambahHotelMadina" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-kamar">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="tambah_kamar">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">
              Tambah Data Tipe Kamar
            </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Tipe Kamar</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-hotel"></i>
                    </span>
                    <input type="text" class="form-control" name="tipe_kamar" id="tipe_kamar_input" required>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" id="tambahKamar" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  
  <div class="modal fade" id="modal-maskapai">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="tambah_maskapai">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">
              Tambah Data Maskapai
            </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Nama Maskapai</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-plane"></i>
                    </span>
                    <input type="text" class="form-control" name="nama" id="nama_maskapai" required>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" id="tambahMaskapai" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{base_url()}}bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('js')
<!-- DataTables -->
<script src="{{base_url()}}bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{base_url()}}bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{base_url()}}assets/paket/paket.js"></script>
<script src="{{base_url()}}assets/paket/hotel_makkah.js"></script>
<script src="{{base_url()}}assets/paket/hotel_madina.js"></script>
<script src="{{base_url()}}assets/paket/tipe_kamar.js"></script>
<script src="{{base_url()}}assets/paket/maskapai.js"></script>
<script src="{{base_url()}}assets/paket/detail_paket.js"></script>
@endsection

@section('script')
@endsection

@extends('layouts.themplate')