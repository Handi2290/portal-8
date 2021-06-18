@extends('template')

@section('main')

	{{-- content-header --}}
	<section class="content-header">
		<h1>Pembayaran Pendafataran</h1>
	</section>
	{{-- ./ content-header --}}

	{{-- content --}}
	<section class="content">
		{{-- box box-default --}}
		<div class="box box-default">
			{{-- box-header with-border --}}
			<div class="box-header with-border">

			</div>
			{{-- ./ box-header with-border --}}

			{{-- box-body --}}
			<div class="box-body">

				@if(session()->has('success_message'))
					{{-- alert alert-success --}}
				    <div class="alert alert-success">
				        {{ session()->get('success_message') }}
				    </div>
				    {{-- ./ alert alert-success --}}
				@endif

				{{-- table-responsive --}}
				<div class="table-responsive">
					<table class="table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Bayar</th>
								<th class="text-center">Status</th>
							</tr>
						</thead>
						<tbody>
							@if($pendaftaran)
								<tr>
									<td class="text-center">
										{{ $pendaftaran->created_at->format('Y-m-d') }}
									</td>
									<td class="text-right">
										{{ number_format($pendaftaran->bayar,2,',','.') }}
									</td>
									<td class="text-center">
										@if($pendaftaran->status_bayar == 'Lunas')
											<span class="label label-success">
												{{ $pendaftaran->status_bayar }}
											</span>
										@else
											<span class="label label-danger">
												{{ $pendaftaran->status_bayar }}
											</span>
										@endif
									</td>
								</tr>
							@else
								<tr>
									<td colspan="4">
										<center>Belum ada tagihan pembayaran.</center>
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
				{{-- ./ table-responsive --}}
			</div>
			{{-- ./ box-body --}}

		</div>
		{{-- ./ box box-default --}}
	</section>
	{{-- ./ content --}}

@endsection

@section('script')
	<script type="text/javascript">
	</script>
@endsection