@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Peserta Jamaah
            <small>Umroh dan Haji</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <a href="{{base_url()}}formpendaftaranjamaah" style="margin-bottom: 1em;" class="btn btn-primary">Pendaftaran Jamaah</a>
        @if (isset($_SESSION['sukses']))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Data Berhasil diproses !
            </div>
        @endif
        @if (isset($_SESSION['gagal']))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Gagal</h4>
                Data gagal di proses!.
            </div>
        @endif
        <div class="row" style="margin-top: 1em;">
            <div class="col-lg-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped table-condensed table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>No.KTP</th>
                                    <th>Nama</th>
                                    <th>JK</th>
                                    <th>No.HP</th>
                                    <th class="text-center">Status Approval</th>
                                    <th width="100" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach ($jamaah as $pendaftar)
                                    <tr>
                                        <td class="text-center">{{$no++}}</td>
                                        <td>{{$pendaftar->no_ktp}}</td>
                                        <td>
                                            {{$pendaftar->nama}} <br>
                                            <span class="text-blue">{{$pendaftar->mitra_status}}</span>
                                        </td>
                                        <td>{{$pendaftar->jk}}</td>
                                        <td>{{$pendaftar->no_tlp}}</td>
                                        <td class="text-center">
                                            <?php 
                                                if($pendaftar->approval == 'menunggu'){
                                            ?>
                                                <span class="text-info">{{$pendaftar->approval}}</span>
                                            <?php
                                                }elseif ($pendaftar->approval == 'ditolak') {
                                            ?>
                                                <span class="text-danger">{{$pendaftar->approval}}</span>
                                            <?php                                                     
                                                }else{
                                            ?>
                                                <span class="text-success">{{$pendaftar->approval}}</span>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            @if ($pendaftar->approval == 'disetujui')                                                
                                                <span id="dataDetail">
                                                    <a href="" class="btn btn-xs btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a> || 
                                                </span>
                                            @endif
                                            <a href="{{base_url()}}deletependaftaranjamaah/{{$pendaftar->id_user}}" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{base_url()}}bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('js')
<!-- DataTables -->
<script src="{{base_url()}}bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{base_url()}}bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{base_url()}}assets/pendaftaran_jamaah/pendaftaran_jamaah.js"></script>
@endsection

@section('script')
@endsection

@extends('layouts.themplate')