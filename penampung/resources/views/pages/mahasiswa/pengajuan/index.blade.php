@extends ('template')


@section ('main')
<section class="content-header">
  <h1>Pengajuan Tugas Akhir</h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengajuan Tugas Akhir</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
      <div id="print-view" class="content">        
        <div class="box content" style="font-size:14px">
            <div class="table-responsive">
              <div class="box-header with-border">
                <h4 class="box-title">Form Pengajuan TA / Skripsi</h4>
              </div>
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Pengajuan</a></li>
                  <a target="_blank" href="{{ route('mahasiswa.pengajuan.print') }}" class="btn btn-warning" style="padding-bottom: 12px;">Cetak pengajuan</a>
                </ul>
                <div class="tab-content">
                  
                <div class="tab-pane active" id="tab_1">
                  <form method="POST" enctype="multipart/form-data" action="{{ route('mahasiswa.pengajuan.simpan') }}">
                  {{ csrf_field() }}
                  <input type="hidden" value="A" name="kategori">
                    <h4><strong>Form Isian Pengajuan</strong></h4>
                    <table>
                          <tr>
                              <td width=100>Judul</td>
                              <td><input type="text"  name="judul" size=100></td>
                          </tr>
                          
                          <tr>
                            <td>
                                &nbsp;
                            </td>
                          </tr>

                          <tr>
                            <td width=150>Dosen Pembimbing</td>
                            <td>
                              <select name="dospem" id="dospem" class="form-control">
                                <option value="">== Pilih Dosen Pembimbing ==</option>
                                @foreach ($list_dospem as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                              </select>
                            </td>
                          </tr>

                          <tr>
                            <td>
                                &nbsp;
                            </td>
                          </tr>

                          <tr>
                              <td>Bukti Pembayaran</td>
                              <td>
                                <br/>
                                <input type="file"  name="file">

                                <font style="font-size: 12px; color: red;">
                                    &nbsp;(Maksimal 1MB)
                                </font>
                              </td> 
                          </tr>
                          <tr>
                            <td>Kelengkapan</td>
                            <td>
                              <br/>
                              <input type="file"  name="kelengkapan">

                              <font style="font-size: 12px; color: red;">
                                  &nbsp;(Maksimal 1MB)
                              </font>
                            </td> 
                          </tr>
                          <tr>
                            <td>
                                &nbsp;
                            </td>
                          </tr>
                        </table>
                        <input type="submit" name="submit" value="Simpan" class="btn btn-success"/>
                        </br><br/>
                        </form>
                        <ul>
                            <li>Referensi : Cara mengecilkan file berbentuk JPEG , PNG , dan PDF => <a target="_blank" href="https://compresspng.com/id/"><font style="color: red;">Silahkan klik disini</font></a></li>
                            <li>Upload file kelengkapan dengan hasil cetak SKPI yang telah di sah-kan dengan stempel dan ditanda-tangani oleh Ketua STIE PPI.</b></li>
                            <li>Wajib submit foto kwitansi pembayaran yang dikeluarkan resmi oleh bagian keuangan STIE PPI.</b></li>
                        </ul>
                        </br>
                     <table class="table table-striped" align="center" id="list_pengajuan">
                      <thead>
                        <tr>
                          <th><center>No.</center></th>
                          <th><center>Judul</center></th>
                          <th><center>Dospem</center></th>
                          <th><center>File</center></th>
                          <th><center>Bukti</center></th>
                          <th><center>Status</center></th>
                          <th><center>Aksi</center></th>
                        </tr>
                      </thead>
                      <tbody>
                          @php
                          $counter=0;
                          @endphp
                          @foreach($data_pengajuan as $index => $pengajuan)
                            <tr>
                                <td class="text-center" width="20">{{$counter+1}}</td>
                                <td class="text-center">{{$pengajuan->judul}}</td>
                                <td class="text-center">{{$pengajuan->dospem}}</td>
                                <td class="text-center" width="30"><a target="_blank" href="/images/pengajuan/{{$pengajuan->file}}">Lihat</a></td>
                                <td class="text-center" width="30"><a target="_blank" href="/images/pengajuan/{{$pengajuan->kelengkapan}}">Lihat</a></td>
                                <td class="text-center" width="50">
                                    @if($pengajuan->status=='Y')
                                    <span class="badge bg-green">Diterima</span>
                                    @elseif($pengajuan->status=='N')
                                    <span class="badge bg-red">Ditolak</span>
                                    @else
                                    <span class="badge bg-yellow">Pengajuan</span>
                                    @endif
                                </td>
                                <td class="text-center" width="20"><a href="{{route('mahasiswa.pengajuan.hapus',['pengajuan'=>$pengajuan])}}" class="btn btn-hapus btn-xs btn-trash bg-red" title="Batalkan"><i class="fa fa-trash">Batalkan</i></a></td>
                            </tr>
                          @endforeach
                      </tbody>
                     </table>                  
                  </div>

              </div>
            </div>
          </div>
        </div>
    </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
    $(document).ready(function (b) {
    $('.btn-hapus').click(function (e){
        console.log(e)
        e.preventDefault()
        var c=confirm('Yakin akan menghapus data pengajuan Tugas Akhir anda?')
        if(c){
            window.location.href=$(e.delegateTarget).attr('href')
        }
    })
    });

    </script>
    @stop