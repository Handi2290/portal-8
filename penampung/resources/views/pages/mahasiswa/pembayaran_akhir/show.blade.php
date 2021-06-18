@extends('template')

@section('main')

	{{-- content-header --}}
	<section class="content-header">
		<h1>File Bukti Pembayaran Akhir</h1>
	</section>
	{{-- ./ content-header --}}

	{{-- content --}}
	<section class="content">
		{{-- box box-default --}}
		<div class="box box-default">

			{{-- box-body --}}
			<div class="box-body">
				<div class="col-md-3">
					<img src="{{ url('images/pembayaran_akhir/'.$data->file) }}" class="img-responsive">
					<br>
					<a href="{{ route('mahasiswa.pembayaran_akhir', request()->segment(5)) }}" class="btn btn-warning">Kembali</a>
				</div>
			</div>
			{{-- ./ box-body --}}

		</div>
		{{-- ./ box box-default --}}
	</section>
	{{-- ./ content --}}

@endsection