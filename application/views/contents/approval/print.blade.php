
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIMUH</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{base_url()}}bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{base_url()}}bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{base_url()}}bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{base_url()}}dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
    <div class="wrapper">
        <!-- Main content -->
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
                <img src="{{base_url()}}upload/bukti_transfer/{{$detail->bukti_transfer}}" style="max-height: 11em;" alt="Bukti Transfer" data-toggle="modal" data-target="#modal-bukti">
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <th style="width:50%">Harga (IDR):</th>
                        <td>
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
                        <th>Status Pendaftar:</th>
                        <td>{{$detail->mitra_status}}</td>
                    </tr>
                    <tr>
                        <th>Bonus Potongan:</th>
                        <td>
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
                        </td>
                    </tr>
                    <tr>
                        <th>Bonus Diberikan Ke:</th>
                        <td>{{$detail->id_head_user}}</td>
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
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= base_url() ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{base_url()}}assets/approval/form.js"></script>
</body>
</html>
