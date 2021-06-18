@extends('template');

@section('main')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>  Pembayaran Kelulusan </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Mahasiswa Akhir</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
          @include('_partials.flash_message')
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">List Mahasiswa Akhir </h3>
            </div>
            <div class="box-body">
              <div class="col-md-12 col-xs-12">
                <div class="row">
                  <div class="table-responsive">
                    <table class="table table-striped" id="pendaftar">
                        <thead align="center">
                            <tr>
                              <td>No.</td>
                              <td>NIM</td>
                              <td width="35">Nama</td>
                              <td>Kategori</td>
                              <td>Biaya</td>
                              <td>Aksi</td>
                            </tr>
                        </thead>
                        <?php $no=0; $no++; ?>
                        @foreach($data as $d)
                        <tbody align="center">
                            <tr>
                                <td> {{ $no++ }} </td>
                                <td> {{ $d->nim }} </td>
                                <td> {{ $d->nama }} </td>
                                <td> {{ $d->nama_kategori }} </td>
                                <td> {{ $d->biaya }} </td>
                                <td></td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>
<!-- /.content -->
@stop