@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?= base_url() ?>dist/img/logo.jpeg" style="max-height: 1.5em;" class="img-reponsive"> ibs Tour and Travel
                    <small class="pull-right">Tanggal : {{date('Y-m-d')}}</small>
                </h2>
                </div>
                <!-- /.col -->
            </div>
            @foreach ($approval as $detail)
            @endforeach
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                <address>
                    <b>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$detail->nama}}<br>
                    <b>No. KTP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$detail->no_ktp}}<br>
                    <b>Jenis Kelamin &nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$detail->jk}}<br>
                    <b>No. Telp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$detail->no_tlp}}<br>
                    <b>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$detail->email}}
                </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                <b>ID User &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$detail->id_user}}<br>
                <b>ID Jamaah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$detail->id_jamaah}}<br>
                <b>Status Pendaftar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$detail->mitra_status}}<br>
                <b>Tanggal Pengajuan &nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$detail->tgl_daftar}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Paket Pilihan</th>
                            <th>Jenis Pendaftaran</th>
                            <th>Hotel</th>
                            <th>Tipe Kamar</th>
                            <th>Maskapai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$detail->nama_paket}}</td>
                            <td>{{$detail->jenis_pendaftaran}}</td>
                            <td>{{$detail->nama_hotel}}</td>
                            <td>{{$detail->tipe_kamar}}</td>
                            <td>{{$detail->nama_maskapai}}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                <p class="lead">Foto Terlampir</p>
                <img src="{{base_url()}}upload/foto_profil/{{$detail->foto}}" style="max-height: 11em;" alt="Foto Profil" data-toggle="modal" data-target="#modal-foto">
                <img src="{{base_url()}}upload/ktp/{{$detail->ktp}}" style="max-height: 11em;" alt="Foto KTP" data-toggle="modal" data-target="#modal-ktp">
                <img src="{{base_url()}}upload/bukti_transfer/{{$detail->bukti_transfer}}" style="max-height: 11em;" alt="Bukti Transfer" id="bukti_transfer" data-value="{{$detail->bukti_transfer}}" data-toggle="modal" data-target="#modal-bukti">
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <th style="width:50%">Harga (IDR):</th>
                        <td class="text-right">
                            @if ($detail->mitra_status == 'nonmitra')
                                <span id="harga" data-id="{{$detail->harga_umum}}">
                                    {{$detail->harga_umum}}
                                </span>
                            @endif
                            @if ($detail->mitra_status == 'mitra')
                                <span id="harga" data-id="{{$detail->harga_mitra}}">
                                    {{$detail->harga_mitra}}
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="width:50%">Bayar (IDR):</th>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">IDR</span>
                                <input type="number" min="0" class="form-control text-right" name="bayar" id="bayar" placeholder="Bayar">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Bonus Potongan:</th>
                        <td>
                            @if ($detail->approval == 'menunggu')
                                @if ($detail->mitra_status == 'nonmitra')
                                    <div class="input-group">
                                        <span class="input-group-addon">IDR</span>
                                        <input type="number" min="0" value="4000000" class="form-control text-right" name="bonus" id="bonus" placeholder="Bonus">
                                    </div>
                                @endif
                                @if ($detail->mitra_status == 'mitra')
                                    <div class="input-group">
                                        <span class="input-group-addon">IDR</span>
                                        <input type="number" min="0" value="0" class="form-control text-right" name="bonus" id="bonus" placeholder="Bonus" readonly>
                                    </div>
                                @endif
                            @endif
                            @if ($detail->approval != 'menunggu')
                                <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="number" min="0" value="" class="form-control text-right" name="bonus" id="bonus" placeholder="Bonus" readonly>
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Bonus Diberikan Ke: <br>
                          <small>
                            <i>* Bonus diberikan setelah <br>pembayaran lunas.</i>
                          </small>
                        </th>
                        <td><span id="id_head_user" data-id="{{$detail->id_head_user}}">{{$detail->id_head_user}}</span></td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td id="total"></td>
                    </tr>
                    </table>
                </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    @if ($detail->approval != 'menunggu')
                        <a href="{{base_url()}}printapproval/{{$detail->id_jamaah}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print Preview</a>
                    @endif
                    <button type="button" id="btnApprove" data-id="{{$detail->id_jamaah}}" class="btn btn-success pull-right">
                        <i class="fa fa-check"></i> Approve
                    </button>
                    <button type="button" id="btnTolak" data-id="{{$detail->id_jamaah}}" class="btn btn-danger pull-right" style="margin-right: 5px;">
                        <i class="fa fa-close"></i> Tolak
                    </button>
                    <button type="button" onclick="goBack()" class="btn btn-default pull-right" style="margin-right: 5px;">
                        Kembali
                    </button>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </section>
    <!-- /.content -->
  </div>

   <div class="modal fade" id="modal-foto">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="tambah_maskapai">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">
              Foto Profil
            </h4>
          </div>
          <div class="modal-body text-center">
            <img src="{{base_url()}}upload/foto_profil/{{$detail->foto}}" class="img-responsive" alt="Foto Profil">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-ktp">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="tambah_maskapai">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">
              Foto KTP
            </h4>
          </div>
          <div class="modal-body text-center">
              <img src="{{base_url()}}upload/ktp/{{$detail->ktp}}" class="img-responsive" alt="Foto KTP">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-bukti">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="tambah_maskapai">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">
              Foto Bukti Pembayaran
            </h4>
          </div>
          <div class="modal-body text-center">
            <img src="{{base_url()}}upload/bukti_transfer/{{$detail->bukti_transfer}}" class="img-responsive" alt="Bukti Transfer">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
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
@endsection

@section('js')
<script src="{{base_url()}}assets/approval/form.js"></script>
@endsection

@section('script')
<script>
    function goBack() {
      window.history.back();
    }
</script>
@endsection

@extends('layouts.themplate')