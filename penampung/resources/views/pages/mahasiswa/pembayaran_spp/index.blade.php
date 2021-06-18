@extends ('template')

@section ('main')

	<style type="text/css">
		.table-spp {
			margin-bottom:0px;
		}
	</style>

	{{-- content-header --}}
	<section class="content-header">
		<h1>Pembayaran SPP</h1>
	</section>
	{{-- ./ content-header --}}

	{{-- content --}}
	<section class="content">
		{{-- box box-default --}}
		<div class="box box-default">
			{{-- box-header with-border --}}
			<div class="box-header with-border">
				{{-- form-inline --}}
				<div class="form-inline">
					{{-- form-group --}}
					<div class="form-group">
						<select class="form-control select-custom" onchange="selectTahunAkademik(this.value);">
							<option value="" selected>
								- Pilih Tahun Akademik -
							</option>
							@foreach($list_tahun_akademik as $row)
								<option value="{{ $row->id_tahun_akademik }}">
									{{ $row->keterangan }}
								</option>
							@endforeach
						</select>
					</div>
					{{-- ./ form-group --}}
				</div>
				{{-- ./ form-inline --}}
			</div>
			{{-- ./ box-header with-border --}}

			{{-- box-body --}}
			<div class="box-body">

				@if(session()->has('success_message'))
				    <div class="alert alert-success">
				        {{ session()->get('success_message') }}
				    </div>
				@endif

				{{-- table-responsive --}}
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-spp" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Bulan</th>
								<th class="text-center">Keterangan</th>
								<th class="text-center">Bayar</th>
								<th class="text-center">Status</th>
								<th class="text-center">Action</th>
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
			jQuery('.table-spp').DataTable({
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
							return data.bulan;
						},
						name : 'bulan',
						className : 'text-center'
					},
					{
						data : function(data) {
							return data.tahun_ajaran;
						},
						name : 'keterangan',
						className : 'text-center'
					},
					{
						data : function(data) {
							return formatRupiah(data.bayar.toString(), 'Rp.');
						},
						name : 'Nominal Bayar',
						className : 'text-center'
					},
					{
						data : function(data) {
							if(data.bayar != null) {
								var status = `
									<span class="label label-success">
										Lunas
									</span>
								`;
							} else {
								var status = `
									<span class="label label-warning">
										Belum Lunas
									</span>
								`;
							}
							return status;
						},
						name : 'status',
						className : 'text-center'
					},
					{
						data : function(data) {

							if(data.file == null) {
								return `
									<a href="{{ route('mahasiswa.pembayaran_spp.upload') }}?id=${data.id_pembayaran_spp}&id_tahun_akademik=${data.id_tahun_akademik}" class="btn btn-xs btn-info">
										<i class="fa fa-upload"></i> Upload
									</a>
								`;
							} else {
								//return `
								//	<a href="{{ route('mahasiswa.pembayaran_spp.upload') }}?id=${data.id_pembayaran_spp}&id_tahun_akademik=${data.id_tahun_akademik}" class="btn btn-xs btn-info">
								//		<i class="fa fa-upload"></i> Upload
								//	</a>
								//`;
								return `
								    <a href="{{ route('mahasiswa.pembayaran_spp.show') }}?id=${data.id_pembayaran_spp}" class="btn btn-xs btn-primary">
								 		<i class="fa fa-eye"></i> View File
								 	</a>
								`;
							}

						},
						name : 'action',
						className : 'text-center'
					},
					// {
					// 	data : function(data) {

					// 		if(data.file == null) {
					// 			return `
					// 				<a href="{{ route('mahasiswa.pembayaran_spp.upload') }}?id=${data.id_pembayaran_spp}&id_tahun_akademik=${data.id_tahun_akademik}" class="btn btn-xs btn-info">
					// 					<i class="fa fa-upload"></i> Upload
					// 				</a>
					// 			`;
					// 		} else {
					// 			return `
					// 				<a href="{{ route('mahasiswa.pembayaran_spp.show') }}?id=${data.id_pembayaran_spp}" class="btn btn-xs btn-primary">
					// 					<i class="fa fa-eye"></i> View File
					// 				</a>
					// 			`;
					// 		}

					// 	},
					// 	name : 'action',
					// 	className : 'text-center'
					// },
				],
				ajax : {
				    url : "{{ route('mahasiswa.pembayaran_spp') }}/" + id_tahun_akademik + "/get_pembayaran_spp"
				}
			});
		}

		view_pembayaran('{{ $tahun_akademik->id_tahun_akademik }}');

		function selectTahunAkademik(val) {
			view_pembayaran(val);
		}

	</script>
@endsection