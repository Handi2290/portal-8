@extends('template')

@section('main')
    <section class="content-header">
        <h1>Approve Pengajuan TA</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin TA</li>
        </ol><br>

            @if(session('hapus'))
            <div class="alert alert-danger" role="alert">
                {{session('hapus')}}
            </div>
            @endif

            @if(session('approved'))
            <div class="alert alert-success" role="alert">
                {{session('approved')}}
            </div>
            @endif
    </section>

    <section class="content">
        <div class="box box-default">
                <div class="box-header with-border">
                    <h4 class="box-title">Form Approval Pengajuan TA</h4>
                </div><br>
        <div class="container">
        <div class="col-xs-15 table-responsive">            
        <form action="{{route('admin.pengajuan.cari')}}" method="GET">
            <input type="text" name="cari" placeholder="Cari data TA" value="{{ old('cari') }}">
            <input type="submit" value="Cari">
        </form>
        <br><p>
        <table class="table table-responsive">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nim</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Judul</th>
                <th class="text-center">Dospem</th>
                <th class="text-center">Prodi</th>
                <th class="text-center">File</th>
                <th class="text-center">Bukti Bayar</th>
                <th class="text-center">Status</th>
                {{-- <th class="text-center">Keterangan</th> --}}
                <th class="text-center">Aksi</th>
            </tr>
            @php
            $counter=1
            @endphp
            @foreach($data_pengajuan as $data)
            <form method="post" action="{{route('admin.pengajuan.confirm',['$id'=>$data->id])}}">
            <form method="post" action="{{route('admin.pengajuan.tolak',['$id'=>$data->id])}}">
            {{ csrf_field() }}
            <tr>
                <td class="text-center" width="20">{{$counter++}}</td>
                <td class="text-center" width="50">{{ $data->nim }}</td>
                <td class="text-center">{{ $data->nama }}</td>
                <td class="text-center">{{ $data->judul }}</td>
                <td class="text-center">{{ $data->dospem }}</td>
                {{-- <td class="text-center">{{ $data->prodi }}</td> --}}
                <td class="text-center" width="50">
                    @if($data->prodi=='622')
                    <span>Akuntansi</span>
                    @else
                    <span>Manajemen</span>
                    @endif
                </td>
                <td class="text-center" width="30"><a target="_blank" href="/images/pengajuan/{{$data->file}}">Lihat</a></td>
                <td class="text-center" width="30"><a target="_blank" href="/images/pengajuan/{{$data->kelengkapan}}">Lihat</a></td>
                <td class="text-center" width="50">
                @if($data->status=='Y')
                <span class="badge bg-green">Diterima</span>
                @elseif($data->status=='N')
                <span class="badge bg-red">Ditolak</span>
                @else
                <span class="badge bg-yellow">Pengajuan</span>
                @endif
                </td>
                {{-- <td class="text-center">
                    @if($data->status=='P')
                    <input class="input-xs input-bobot" type="text" name="keterangan">
                    @else
                    {{ $data->keterangan }}
                    @endif
                </td> --}}
                <td class="text-center">
                    @if($data->status=='P')
                    <a href="{{route('admin.pengajuan.confirm',['$id'=>$data->id])}}" class="fa fa-check"></a>
                        <a href="{{route('admin.pengajuan.tolak',['$id'=>$data->id])}}" class="fa fa-close"></a>
                    @else
                    <a href="{{route('admin.pengajuan.cancel',['$id'=>$data->id])}}" class="fa fa-close"> Batalkan</a>
                    @endif
                </td>                
            </tr>
            </form>
            @endforeach</div></div></div>
        </table>
        <br/>
        Halaman : {{ $data_pengajuan->currentPage() }} <br/>
        Jumlah Data : {{ $data_pengajuan->total() }} <br/>
        Data Per Halaman : {{ $data_pengajuan->perPage() }} <br/>
       
        {{ $data_pengajuan->links() }}     
  </section>
  <script type="text/javascript">
    $(document).ready(function (b) {
    $('.btn-hapus').click(function (e){
        console.log(e)
        e.preventDefault()
        var c=confirm('Yakin akan menghapus data Pengajuan TA mahasiswa ini?')
        if(c){
            window.location.href=$(e.delegateTarget).attr('href')
        }
    })
    });
    </script>
@stop
