@extends('template')

@section('main')

	{{-- content-header --}}
	<section class="content-header">
		<h1>Upload Bukti Pembayaran SPP</h1>
	</section>
	{{-- ./ content-header --}}

	{{-- content --}}
	<section class="content">
		{{-- box box-default --}}
		<div class="box box-default">

			{{-- box-body --}}
			<div class="box-body">
				<form class="row" enctype='multipart/form-data' action="{{ route('mahasiswa.pembayaran_spp.uploadFile') }}" method="POST">

					{{ csrf_field() }}

					<input type="hidden" name="id" value="{{ request()->id }}">
					<input type="hidden" name="id_tahun_akademik" value="{{ request()->id_tahun_akademik }}">

					<div class="col-md-6 col-md-offset-3">

						@if(isset($errors))
							@foreach($errors->all() as $e)
								<div class="alert alert-danger">
									{{ $e }}
								</div>
							@endforeach
						@endif

						<br>

						{{-- form-group --}}
						<div class="form-group">
							<input type="file" name="file">
						</div>
						{{-- ./ form-group --}}

						{{-- form-group --}}
						<div class="form-group">
							<input type="number" name="bayar" class="form-control" placeholder="Total Transfer / Bayar">
						</div>
						{{-- ./ form-group --}}

						{{-- form-group --}}
						<div class="form-group">
							<input type="date" name="tanggal_pembayaran" class="form-control" placeholder="Tanggal Pembayaran">
						</div>
						{{-- ./ form-group --}}

						{{-- form-group --}}
						<div class="form-group">
							<button class="btn btn-primary" type="submit">
								Upload File
							</button>
							<a href="{{ route('mahasiswa.pembayaran_spp') }}" class="btn btn-warning">
								Kembali
							</a>
						</div>
						{{-- ./ form-group --}}

					</div>
				</form>
			</div>
			{{-- ./ box-body --}}

		</div>
		{{-- ./ box box-default --}}
	</section>
	{{-- ./ content --}}

@endsection