@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
        <h1>
            Approval
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
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
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-file-text-o"></i>&nbsp; Approval Pendaftaran</a></li>
                        <li><a href="#tab_2"><i class="fa fa-money"></i>&nbsp; Approval Pembayaran</a></li>
                        <li><a href="#tab_3"><i class="fa fa-refresh"></i>&nbsp; Approval Penukaran Bonus</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="example1" class="table table-bordered table-striped table-condensed table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>No.KTP</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>No.HP</th>
                                        <th class="text-center">Status Approval</th>
                                        <th class="text-center">Tgl. Daftar</th>
                                        <th width="100" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; ?>
                                    @foreach ($approval as $pendaftar)
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
                                            <td class="text-center">{{$pendaftar->tgl_daftar}}</td>
                                            <td class="text-center">
                                                @if ($pendaftar->approval == 'disetujui')                                                
                                                    <span id="dataDetail">
                                                        <a href="" class="btn btn-xs btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a> || 
                                                    </span>
                                                @endif
                                                <a href="{{base_url()}}formapproval/{{$pendaftar->id_jamaah}}" class="btn btn-xs btn-primary">
                                                    <i class="fa fa-file-text-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            tab 2
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            tab 3
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
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
<script src="{{base_url()}}assets/approval/approval.js"></script>
@endsection

@section('script')
@endsection

@extends('layouts.themplate')