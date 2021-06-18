<style type="text/css">
	@media print {
		body * {
			visibility: hidden;
		}
		#section-to-print, #section-to-print * {
			visibility: visible;
		}
		#section-to-print {
			position: absolute;
			left: 0;
			top: 0;
		}
	}
</style>
<div id="section-to-print">
	<center>
		<table class="table" border="1px" style="border:1px solid #000;width: 100%" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>No</th>
					<th>Hari/Jam</th>
					<th>Kelas</th>
					<th>Matkul</th>
					<th>Ruang</th>
					<th>Dosen</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($list_jadwal as $jadwal)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $jadwal->nama_hari }}<br>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
					<td>{{ $jadwal->kode_kelas }} - {{ $jadwal->nama_kelas }}</td>
					<td>{{ $jadwal->kode_matkul }} - {{ $jadwal->nama_matkul }}</td>
					<td>{{ $jadwal->kode_ruang }} - {{ $jadwal->nama_ruang }}</td>
					<td>{{ $jadwal->nama }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</center>
</div>