@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              @foreach ($totJamaahUmroh as $umroh)                  
                <h3>{{$umroh->tot}}</h3>
              @endforeach

              <p>Jamaah Umroh</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              @foreach ($totJamaahHaji as $haji)                  
                <h3>{{$haji->tot}}</h3>
              @endforeach

              <p>Jamaah Haji</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-light-blue">
            <div class="inner">
              @foreach ($totJamaah as $jamaah)                  
                <h3>{{$jamaah->tot}}</h3>
              @endforeach

              <p>Total Jamaah</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              @foreach ($jamaahUmrohMitra as $umrohMitra)                  
                <h3>{{$umrohMitra->tot}}</h3>
              @endforeach

              <p>Jamaah Umroh Mitra</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              @foreach ($jamaahHajiMitra as $hajiMitra)                  
                <h3>{{$hajiMitra->tot}}</h3>
              @endforeach

              <p>Jamaah Haji Mitra</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              @foreach ($jamaahUmrohUmum as $umrohUmum)                  
                <h3>{{$umrohUmum->tot}}</h3>
              @endforeach

              <p>Jamaah Umroh Umum</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              @foreach ($jamaahHajiUmum as $hajiUmum)                  
                <h3>{{$hajiUmum->tot}}</h3>
              @endforeach

              <p>Jamaah Haji Umum</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <hr>
        </div>
      </div>
      <!-- /.row -->
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              @foreach ($approvePendaftaran as $approval)                  
                <h3>{{$approval->tot}}</h3>
              @endforeach

              <p>Approval Pendaftaran</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-check"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        {{-- <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-light-blue">
            <div class="inner">
              @foreach ($jamaahHajiMitra as $hajiMitra)                  
                <h3>{{$hajiMitra->tot}}</h3>
              @endforeach

              <p>Approval Tabungan</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> --}}
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('css')
@endsection

@section('js')
@endsection

@section('script')
@endsection

@extends('layouts.themplate')