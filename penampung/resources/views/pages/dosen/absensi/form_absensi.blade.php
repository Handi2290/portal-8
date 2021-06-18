<script type="text/javascript">
	function tutup_absensi_manual() {
		var checkBox = document.getElementById("buka_absen");
		var text = document.getElementById("t_mahasiswa");
		if (checkBox.checked == true){
			text.style.display = "none";
		} else {
			text.style.display = "block";
		}
	}
</script>
@if (empty($is_edit))
{!! Form::open(['method' => 'PATCH', 'route' => ['dosen.absensi.absensi', $kelas->id_kelas, $matkul->id_matkul, $jadwal->id_jadwal]]) !!}
@else
{!! Form::open(['method' => 'PATCH', 'route' => ['dosen.absensi.absensi_edit', $kelas->id_kelas, $matkul->id_matkul, $jadwal->id_jadwal, $tanggal, $pertemuan_ke]]) !!}
@endif
<div class="box box-default">
	<div class="box-header with-border">
		{!! Form::label('tanggal', 'Tanggal Pertemuan', ['claass' => 'control-label']) !!}
		{!! Form::date('tanggal', empty($is_edit) ? date('Y-m-d') : $tanggal, ['class' => 'form-control']) !!}
	</div>
	<div class="box-body">
		<div class="table-responsive" id="t_mahasiswa" style="display:none">
			<table class="table table-bordered table-absensi">
				<thead>
					<tr>
						<th class="text-center">NPM</th>
						<th class="text-center">Nama Mahasiswa</th>
						<th colspan="2" class="text-center">Kehadiran</th>
						<th class="text-center">Keterangan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($list_mahasiswa as $mahasiswa)
					<tr>
						<td>{{ @$mahasiswa->nim }}</td>
						<td>{{ @$mahasiswa->nama }}</td>
						<td>
							<div class="radio-inline">
								<label>{!! Form::radio('keterangan['.@$mahasiswa->nim.']', 'Hadir', empty($is_edit) ? TRUE : @$mahasiswa->keterangan == 'Hadir') !!} Hadir</label>
							</div>
						</td>
						<td>
							<div class="radio-inline">
								<label>{!! Form::radio('keterangan['.@$mahasiswa->nim.']', 'Alpha', empty($is_edit) ? FALSE : @$mahasiswa->keterangan == 'Alpha') !!} Tidak Hadir</label>
							</div>
						</td>
						<td>{!! Form::text('notes['.@$mahasiswa->nim.']', null, ['class' => 'form-control']) !!}</td>
						<td></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<br>
		<div class="form-group">
			{!! Form::label('catatan_dosen', 'Materi yang diajarkan', ['class' => 'control-label']) !!}
			@if (empty($is_edit))
			{!! Form::textarea('catatan_dosen', null, ['rows' => 3, 'class' => 'form-control']) !!}
			@else
			{!! Form::textarea('catatan_dosen', @$absensi_detail[$pertemuan[$tanggal.'.'.$pertemuan_ke]]->catatan_dosen, ['rows' => 3, 'class' => 'form-control']) !!}
			@endif
		</div>
		<br>
		<div class="form-group">
			{!! Form::label('link_absen', 'Link PPI Meet', ['class' => 'control-label']) !!}
			{!! Form::text('link', @$absensi_detail[$pertemuan[$tanggal.'.'.$pertemuan_ke]]->link, ['class' => 'form-control']) !!}
		</div>
		<br>
		<div class="form-group">
			Buka Absen : {!! Form::radio('buka_absen', 'true', 'checked', ['checked' => 'checked', 'onclick' => 'tutup_absensi_manual()', 'id' => 'buka_absen']) !!}
			<br>
			Tutup Absen : {!! Form::radio('buka_absen', 'false', false, ['onclick' => 'tutup_absensi_manual()', 'id' => 'buka_absen']) !!}
		</div>
		{!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
	</div>
</div>
{!! Form::close() !!}