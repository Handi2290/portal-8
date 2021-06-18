<html>
	<head>
		<title>KRS (Kartu Rencana Studi)</title>
		<link rel="stylesheet" href="{{ asset('plugins/assets/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/model.css') }}">
	</head>
	<body>
		<div>
			<div class="row">
				<div class="col-md-4 col-xs-2"></div>
			 	<div class="konten col-md-4 col-xs-8" style="padding:0px 0px; ">
	                <span><img src="{{asset('images/logo/ppi.png')}}"  alt="Logo STIE PPI" class="img-responsive"  title="Logo STIE PPI" style="width: 20%; margin: 0px;"></span>
	                <div class="bisa">
	                    <h4 style="color: black; text-align: center; margin-top: 5px; ">Sekolah Tinggi Ilmu Ekonomi Putra Perdana Indonesia</h4>
	                    <h4 style="color: black; text-align: center;">Kartu Rencana Studi</h4>
	                    <p style="text-align: center; color: black; padding-top: 10px;">Jl. Citra Raya Utama Barat, Griya Harsa II Blok i 10 no. 29, <br> Cikupa 15710 - Tangerang.</p>
	                </div> 
	            </div>
           		<div class="col-md-4 col-xs-2"></div>
	        </div>
	        <div class="row">
           		<div class="col-md-12" style="border-bottom: 1px solid black; margin: 15px 0px;"></div>
           		<h4 style="text-align: center; margin: 5px;">Kartu Rencana Studi(Tanggal Cetak : <?php echo date("d-M-Y ")  ?>	)</h4>
           		<div class="col-md-5 col-xs-4" ></div>
           		<div class="col-md-2 col-xs-4" style="border-top: 1px solid black; text-align: center;"></div>
           		<div class="col-md-5 col-xs-4" ></div>
           	</div><br>
           	@foreach( $mahasiswa as $siswa )
				<table class="kolom" width="100%" cellspacing="0">
					<tr>
						<th>NIM</th>
						<td>: {{@$siswa->nim}} </td>
						<td></td>
						<th>Waktu Kuliah</th>
						<td>: {{ @$siswa->nama_waktu_kuliah }}</td>
					</tr>
					<tr>
						<th>Nama</th>
						<td>: {{@$siswa->nama}}</td>
						<td></td>
						<th>Semester</th>
						<td>: {{@$siswa->semester_ke}}</td>
					</tr>
					<tr>
						<th>PTS</th>
						<td>: STIE Putra Perdana Indonesia </td>
						<td></td>
						<th>Tahun Ajaran</th>
						<td>:</td>
					</tr>
					<tr>
						<th>Program Studi</th>
						<td>: {{@$siswa->Prodi->nama_prodi}} </td>
						<td></td>
						<th>Kelas</th>
						<td>:</td>
					</tr>
				</table><br>
			<div class="table-responsive">
				<table id="tabel-data" class="table table-striped table-bordered" align="center" width="100%" cellspacing="0">
					<thead>
						<tr align="center">
							<th width="5%" >No</th>
							<th width="15%">Kode MK</th>	
							<th width="40%">Mata Kuliah</th>
							<th width="5%" >SKS</th>
							<th>Catatan</th>
						</tr>
					</thead>
					  <?php $no=1; ?>
                      @if(count($krs_item))
                      <tbody>
                        @foreach($krs_item as $item)
                        <tr align="center">
                          <td >{{$no++}}</td>
                          <td>{{$item->matkul->kode_matkul}}</td>
                          <td align="left">{{$item->matkul->nama_matkul}}</td>
                          <td >{{$item->matkul->sks}}</td>
                          <td></td>
                        </tr>
                     	@endforeach
                      </tbody>
                      <tfoot>
                      	 <tr >
                        	<td colspan="3" align="right">Jumlah SKS</td>
                        	<td align="center">{{$item->total_sks}}</td>
                        	<td></td>
                        </tr>
                    </tfoot>
                      @else
                      <tbody>
                        <tr>
                          <td colspan="5">Tidak Ada Data</td>
                        </tr>
                      </tbody>
                      @endif
				</table>
			</div>
    @endforeach
	
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
