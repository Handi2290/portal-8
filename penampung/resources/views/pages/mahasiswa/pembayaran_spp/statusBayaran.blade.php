@extends ('locked')

@section ('main')
	<section class="content">
		<div class="box abox-primary">
			<div class="box-body">
		<br><br><br><br>
                <h2 class="text-center" > Anda belum melunasi Pembayaran. </h2>
		<h2 class="text-center" > Silahkan melunasi pembayaran agar tetap dapat mengakses Portal Mahasiswa. </h2>
		<br><br>
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<a href="{{route('mahasiswa.cek_bayar')}}" class="btn btn-info">Cek Pembayaran SPP</a>
					<br><br>
					<a href="https://stieppi.ac.id/support" target="_blank"><i class="fa fa-desktop"></i> <span>Buat Tiket Bantuan</span></a>
				</div>
			</div>
		</div>
		<br><br>
		<h5 class="text-center">Note:</h5>
		<h5 class="text-center">- Mohon lakukan pembayaran SPP sebelum tanggal 28 setiap bulan agar tetap dapat mengakses Portal Mahasiswa.</h5>
		<h5 class="text-center">- Untuk cek informasi kegiatan perkuliahan mahasiswa silahkan klik icon lonceng di pojok kanan atas.</h5>
		<h5 class="text-center">- Pengajuan dispensasi pembayaran maksimal 3 (tiga) kali dispensasi, silahkan lunasi dispensasi sebelumnya apabila ingin mengajukkan lagi.</h5>
		<h5 class="text-center">- Jika sudah melakukan pembayaran tetapi masih tidak dapat masuk portal silahkan klik tombol "Buat Tiket Bantuan" untuk konfirmasi.</h5>
		{{-- <iframe width='100%' src="{{route('mahasiswa.cek_bayar')}}">Cek Pembayaran SPP</iframe> --}}
		<br><br><br><br>
			</div>
		</div>
	</section>
@stop