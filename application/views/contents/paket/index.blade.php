@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <h2 class="page-header">Paket Umroh / Haji</h2>
        <a href="{{base_url()}}formpaket" class="btn btn-primary">Tambah Paket</a>
        <div class="row" style="margin-top: 1em;">
            @foreach ($dataPaket as $paketdata)
                <div class="col-sm-4">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                {{$paketdata->nama}} &nbsp;&nbsp;
                                <span class="text-orange">
                                    @for ($i = 0; $i < $paketdata->bintang; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                </span>
                            </h3>
                            <div class="box-tools pull-right">
                                <a href="{{base_url()}}formdetailpaket/{{$paketdata->id_paket}}">Edit</a> | 
                                <a href="javascript:;" id="deletePaket" data-id="{{$paketdata->id_paket}}">Delete</a>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row" style="margin-top: .5em">
                                <div class="col-sm-3">
                                    <i class="fa fa-calendar fa-3x"></i>
                                </div>
                                <div class="col-sm-9">
                                    <span style="font-size: 2.5em;">
                                        {{$paketdata->lama}} Hari
                                    </span>
                                </div>
                            </div>
                            <div class="row" style="margin-top: .5em">
                                <div class="col-sm-3">
                                    <i class="fa fa-plane fa-3x"></i>
                                </div>
                                <div class="col-sm-9">
                                    <span style="font-size: 2.5em;">
                                        {{$paketdata->nama_maskapai}}
                                    </span>
                                </div>
                            </div>
                            <div class="row" style="margin-top: .5em">
                                <div class="col-sm-3">
                                    <i class="fa fa-building-o fa-3x"></i>
                                </div>
                                <div class="col-sm-9">
                                    <span style="font-size: 1.3em;">                                            
                                        {{$paketdata->nama_hotel}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <p class="text-left"><i>Umum</i></p>
                            <span style="font-size: 3em;">
                                <b>IDR {{rupiah($paketdata->harga_umum)}}</b>
                            </span>
                        </div>
                        <!-- /.box-footer -->
                        <div class="box-footer text-center">
                            <p class="text-left"><i>Mitra</i></p>
                            <span style="font-size: 3em;">
                                <b>IDR {{rupiah($paketdata->harga_mitra)}}</b>
                            </span>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
            @endforeach
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
<script src="{{base_url()}}assets/paket/paket.js"></script>
@endsection

@section('script')
@endsection

@extends('layouts.themplate')