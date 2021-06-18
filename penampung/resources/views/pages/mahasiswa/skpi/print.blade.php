<html>
	<head>
		<title>Form Validasi SKPI Mahasiswa STIE PPI</title>
		<link rel="stylesheet" href="{{ asset('plugins/assets/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/model.css') }}">
	</head>
	<body>
		<div>
			<!--<div class="row">
				<div class="col-md-4 col-xs-2"></div>
			 	<div class="konten col-md-4 col-xs-8" style="padding:0px 0px; ">
	                <span><img src="{{asset('images/logo/ppi.png')}}"  alt="Logo STIE PPI" class="img-responsive"  title="Logo STIE PPI" style="width: 20%; margin: 0px;"></span>
	                <div class="bisa">
	                    <h4 style="color: black; text-align: center; margin-top: 5px; ">Sekolah Tinggi Ilmu Ekonomi Putra Perdana Indonesia</h4>
	                    <p style="text-align: center; color: black; padding-top: 10px;">Jl. Citra Raya Utama Barat, Griya Harsa II Blok i 10 no. 29, <br> Cikupa 15710 - Tangerang.</p>
	                </div> 
	            </div>
           		<div class="col-md-4 col-xs-2"></div>
	        </div>-->
	        <table width="100%" border="0" cellpadding="3" cellspacing="0">
			<tbody>
				<tr>
					<td width="40%" align="right" valign="top">
						<img src="{{asset('images/logo/ppi.png')}}" width="80px">
					</td>
					<td width="60%" align="left" valign="top">
						<br>
						<h4 style="color: black; margin-top: 5px; ">Sekolah Tinggi Ilmu Ekonomi Putra Perdana Indonesia</h4>
						<p style="text-align: color: black; padding-top: 0px;">Jl. Citra Raya Utama Barat, Griya Harsa II Blok i 10 no. 29, <br> Cikupa 15710 - Tangerang.</p>
					</td>
				</tr>
			</tbody>
		    </table>
	        <div class="row">
           		<div class="col-md-12" style="border-bottom: 1px solid black; margin: 15px 0px;"></div>
           		<h4 style="text-align: center; margin: 5px;">Form Validasi SKPI(Tanggal Cetak : <?php echo date("d-M-Y ")  ?>)</h4>
           		<div class="col-md-5 col-xs-4" ></div>
           		<div class="col-md-2 col-xs-4" style="border-bottom: 1px solid black; text-align: center;"></div>
           		<div class="col-md-5 col-xs-4" ></div>
           	</div><br>
        
       		<div class="table-responsive">
				<table class="kolom" width="100%" cellspacing="0">
					<tr>
						<th>NIM</th>
						<td>: {{ Auth::guard('mahasiswa')->user()->nim }} </td>
						<td></td>
						<th>Waktu Kuliah</th>
						<td>: {{ Auth::guard('mahasiswa')->user()->waktu_kuliah->nama_waktu_kuliah }}</td>
					</tr>
					<tr>
						<th>Nama</th>
						<td>: {{ Auth::guard('mahasiswa')->user()->nama }}</td>
						<td></td>
						<th>Semester</th>
						<td>: {{ Auth::guard('mahasiswa')->user()->Semester->semester_ke }}</td>
					</tr>
					<tr>
						<th>PTS</th>
						<td>: STIE Putra Perdana Indonesia </td>
						<td></td>
						<th>Tahun Ajaran</th>
						<td>: {{ Auth::guard('mahasiswa')->user()->tahun_akademik }} </td>
					</tr>
					<tr>
						<th>Program Studi</th>
						<td>: {{ Auth::guard('mahasiswa')->user()->Prodi->nama_prodi }} </td>
						<td></td>
						<th>Kelas</th>
						<td>: @if(!empty(@$mahasiswa->nama_kelas)) {{ @$mahasiswa->nama_kelas }} @else  Pindahan  @endif</td>
					</tr>
				</table>
			</div><br>
		

		<div class="box-body">
      		<div class="row"> 
                <div class="col-xs-12 table-responsive">
                    <table class="table table-bordered table-striped jadwal">
                      <thead>
                        <tr>
                          <th class="text-center" width=10>No</th>
                          <th class="text-center">Judul</th>
                          <th class="text-center">Judul (Eng)</th>
                          <th class="text-center" width=30>Status</th>
                          <th width=30>Bobot Nilai</th>
                          <th class="text-center">Keterangan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($skpi))
                          <?php $no = 1; ?>
                          @foreach ($skpi as $s)
                            <tr>
                              <td class="text-center">{{ $no++ }}</td>
                              <td class="text-center">{{ $s->judul }}</td>
                              <td class="text-center">{{ $s->judul_eng }}</td>
                              <td class="text-center">
				@if($s->status=='Y')
			        <span class="badge bg-green">Diterima</span>
			        @elseif($s->status=='N')
			        <span class="badge bg-red">Ditolak</span>
			        @else
			        <span class="badge bg-yellow">Pengajuan</span>
			        @endif
			      </td>
			     <td  class="text-center">{{ $s->bobot }}</td>
			     <td class="text-center">{{ $s->keterangan }}</td>
                            </tr>
                          @endforeach
                          
                        @else
                        <tr>
                          <td colspan="6">Tidak ada data</td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                </div>
            </div>
		  </div>
		  
		  <p>Catatan:</p>
		<ol>
			<li>Form SKPI ini dianggap sah setelah di tanda tangan oleh Ketua SKPI.</li>
			<li>Simpan sebagai persyaratan validasi TA/Skripsi.</li>
		</ol>

		<div class="row" style="margin-bottom: 50px;">
			<div class="col-md-8"></div>
			<div class="col-md-4">
				<div >
					Tangerang,<?php echo date("d-M-Y ")  ?>
					<br><br><br><br>
					<p>Ketua SKPI</p>
				</div>
			</div>
		</div>

	</body>
	<style>
		.table>tbody>tr>th {
			padding: 2px;
		}
		
		.table>tbody>tr>td {
			padding: 2px;
		}
	
		.kolom>tbody>tr>th,td {
			padding: 2px; 
			
		}
		
	</style>
</html>
