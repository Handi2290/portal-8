@extends('template')

@section('main')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Pembayaran Skripsi
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('admin.pembayaran_akhir') }}"><i class="fa fa-file-text-o"></i> Pembayaran Akhir</a></li>
    <li class="active">Bayar Skripsi</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
  	<div class="col-md-12">
      @include('_partials.flash_message')
  		<div class="box box-default">
  			<div class="box-header with-border">
  				<h3 class="box-title">Pembayaran Skripsi
          </h3>
  			</div>
        
  			<div class="box-body">
          <div class="col-md-12 col-xs-12">
            <div class="row">
              <div class="table-responsive">
                @if(session('gagal'))
                  <div class="alert alert-danger" role="alert">
                      {{session('gagal')}}
                  </div><br>
                @endif
                {!! Form::open(['method' => 'POST', 'route' => ['admin.pembayaran_akhir.simpan', $id, $dp]]) !!}
                <table class="table table-striped table-hover">
                  <tr>
                    <th width="200">Tahun Akademik</th>
                    <td width="10">:</td>
                    <td>{{ $tahun_akademik->keterangan }}</td>
                  </tr>

                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->nama }}</td>
                  </tr>

                  <tr>
                    <td>No. Telepon</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->no_telp }}</td>
                  </tr>
                  
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->alamat }}</td>
                  </tr>

                  <tr>
                    <td>Program Studi</td>
                    <td>:</td>
                    <td>{{ $prodi->nama_prodi }}</td>
                  </tr>
                  
                  <tr>
                    <td>Kategori Pembayaran</td>
                    <td>:</td>
                    <td>{{ $kategori->kode_kategori.'-'.$kategori->nama_kategori }}</td>
                  </tr>
                  
                  <tr>
                    <td>Waktu Kuliah</td>
                    <td>:</td>
                    <td>{{ $waktu_kuliah->nama_waktu_kuliah  }}</td>
                  </tr>

                  <tr>
                    <td>Total Biaya</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($kategori->biaya) }}</td>
                  </tr>

                  <tr>
                    <td style="vertical-align: middle">Bayar</td>
                    <td style="vertical-align: middle">:</td>
                    <td>{!! Form::text('bayar', null, ['class' => 'form-control money', 'placeholder' => 'Contoh : 20,000', 'required', 'autocomplete' => 'off', 'style' => 'width: 30%']) !!}</td>
                  </tr>
                  
                  <tr>
                    <td style="vertical-align: middle">Tanggal Bayar</td>
                    <td style="vertical-align: middle">:</td>
                    <td> {!! Form::text('tanggal_bayar', null, ['class' => 'form-control datepicker', 'value' => '{{ @$daftar->tanggal_akan_bayar }}', 'required', 'autocomplete' => 'off', 'style' => 'width: 30%']) !!}</td>
                  </tr>

                  {{-- <tr>
                    <td>Bayar Ke</td>
                    <td>:</td>
                    <td>{{ $ke }} <input type="hidden" id="trigger" name="ke" value="{{ $ke }}"></td>
                  </tr>       --}}

                </table>
                <div class="form-group">
                  <a href="{{ route('admin.pembayaran_akhir') }}" class="btn btn-default btn-sm"> Kembali</a>
                  {!! Form::submit('Bayar', ['class' => 'btn btn-primary btn-sm']) !!}
                </div>
                {!! Form::close() !!}
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