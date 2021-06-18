@extends('template')

@section('main')
	<section class="content-header">
		<h1>Input KRS</h1>
	</section>

	<section class="content">
		@include('_partials.flash_message')
		<div class="box box-default">
			<div class="box-header with-border">
				<a href="{{ route('admin.krs.input.tambah') }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Input KRS</a>
			</div>
			<div class="box-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="30">No.</th>
							<th nowrap>Mahasiswa</th>
							<th nowrap>Dosen PA</th>
							<th nowrap>Tahun Akademik</th>
							<th width="150">Aksi</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</section>
@stop

@section('script')
	<script type="text/javascript">		
		$(document).ready(function () {
			$(".table").DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('admin.krs.input.datatable') }}",
				columns: [
					{'data': 'no'},
					{'data': 'nim_nama'},
					{'data': 'nip_nama'},
					{'data': 'tahun_akademik'},
					{'data': 'aksi'},
				]
			});
		});
	</script>
@stop