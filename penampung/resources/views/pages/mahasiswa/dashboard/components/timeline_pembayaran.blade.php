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
		<table class="table table-striped" border="1px" style="border:1px solid #000;width: 100%" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>Bulan</th>
					<th>Jumlah Bayar</th>
					<th>Tanggal Bayar</th>
					<th>Keterangan</th>
					<th>Status Bayar</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($list_pembayaran_spp as $pembayaran_spp)
				<tr>
					<td>{{ $pembayaran_spp['bulan'] }}</td>
					<td>{{ $pembayaran_spp['bayar'] }}</td>
					<td>{{ $pembayaran_spp['tanggal'] }}</td>
					<td>{{ $pembayaran_spp['keterangan'] }}</td>
					<td><?php echo $pembayaran_spp['status'] ?></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</center>
</div>