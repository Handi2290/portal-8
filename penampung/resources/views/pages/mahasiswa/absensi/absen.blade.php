@extends ('template')

@section ('main')
<section class="content-header">
	<h1>Absensi Mahasiswa</h1>

	<ol class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li class="active">Absensi</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h5 class="box-title">Jadwal Kuliah Hari Ini</h5>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th class="text-center">Jam</th>
					<th class="text-center">Mata Kuliah</th>
					<th class="text-center">Ruang</th>
					<th class="text-center">Status Absensi</th>
					<th class="text-center" width="100">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($list_jadwal as $jadwal)
				<tr>
					<td class="text-center">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
					<td class="text-center">{{ $jadwal->kode_matkul }} - {{ $jadwal->nama_matkul }}</td>
					<td class="text-center">{{ $jadwal->kode_ruang }} - {{ $jadwal->nama_ruang }}</td>
					<td class="text-center" style="color:#A9A9A9">{{ $jadwal->status }}</td>
					<td class="text-center">
						@if ($jadwal->button_absen == "true")
							//{!! Form::open(['method' => 'PATCH', 'route' => ['mahasiswa.absensi.absen', $jadwal->id_kelas, $jadwal->id_matkul, $jadwal->nim, $jadwal->tanggal, $jadwal->link]]) !!}
							//{!! Form::hidden('link', $jadwal->link, ['class' => 'form-control']) !!}
							//{!! Form::submit('Masuk!', ['class' => 'btn btn-success']) !!}	
							//{!! Form::close() !!}
							{!! Form::open(['method' => 'PATCH', 'route' => ['mahasiswa.absensi.absen', $jadwal->id_kelas, $jadwal->id_matkul, $jadwal->nim, $jadwal->tanggal]]) !!}
							{!! Form::submit('Absen!', ['class' => 'btn btn-primary']) !!}	
							{!! Form::close() !!}
						@else
							<button>Masuk</button>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</section>
@stop