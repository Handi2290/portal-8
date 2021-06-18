@extends('template')

@section('main')

	{{-- content-header --}}
	<section class="content-header">
		<h1>Pembayaran Bangunan</h1>
	</section>
	{{-- ./ content-header --}}

	{{-- content --}}
	<section class="content">
		{{-- box box-default --}}
		<div class="box box-default">

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
					<table class="table table-striped table-bordered table-pembayaran" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Bayar</th>
								<th class="text-center">Pembayaran Ke -</th>
							</tr>
						</thead>
						<tbody></tbody>
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
		function view_pembayaran(id_tahun_akademik) {
			jQuery('.table-pembayaran').DataTable({
				dom : 'Bfrtip',
				select : false,
				ordering : false,
				processing : false,
				searching : false,
				destroy : true,
				serverSide : true,
				columns : [
					{
						data : function(data) {
							return data.tanggal_pembayaran;
						},
						name : 'tanggal_pembayaran',
						className : 'text-center'
					},
					{
						data : function(data) {
							return formatRupiah(data.bayar_kelulusan.toString(), 'Rp.');
						},
						name : 'bayar_kelulusan',
						className : 'text-right'
					},
					{
						data : function(data) {
							return data.pembayaran_ke;
						},
						name : 'pembayaran_ke',
						className : 'text-center'
					}
				],
				ajax : {
				    url : "{{ route('mahasiswa.pembayaran_bangunan') }}"
				}
			});
		}

		view_pembayaran();

		function selectTahunAkademik() {
			view_pembayaran();
		}
	</script>
@endsection