@extends('template')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css">
    <style>
        .content-title {
            margin-top: 0;
            margin-bottom: 15px;
        }
    </style>
@stop

@section('main')
    <section class="content-header">
        <h1>Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box" style="background-color:#98FB98;">
                    <div class="inner">
                        <p><h4>Profil Studi</h4></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i></div>
                        <a href="#" class="small-box-footer">Rekam Jejak Mahasiswa
                        <i class="fa fa-arrow-circle-right"></a></i>
                    </div></div>
            
        <div class="col-lg-3 col-xs-6">
                <div class="small-box" style="background-color: #D8BFD8;">
                    <div class="inner">
                        <p><h4>Meet PPI</h4></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-btc"></i></div>
                        <a href="{{ route('mahasiswa.absen') }}" class="small-box-footer">Absen & Blended Learning
                        <i class="fa fa-arrow-circle-right"></a></i>
                    </div></div>
        

        <div class="col-lg-3 col-xs-6">
                <div class="small-box" style="background-color:#FFFACD;">
                    <div class="inner">
                        <p><h4>Kal. Akademik</h4></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i></div>
                        <a href="{{ route('mahasiswa.jadwal') }}" class="small-box-footer">Cek Kegiatan
                        <i class="fa fa-arrow-circle-right"></a></i>
                    </div></div>

        <div class="col-lg-3 col-xs-6">
                <div class="small-box" style="background-color:#B2FFFF;">
                    <div class="inner">
                        <p><h4>Tiket Bantuan</h4></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-info"></i></div>
                        <a href="https://stieppi.ac.id/support" class="small-box-footer">Buat Tiket Bantuan
                        <i class="fa fa-arrow-circle-right"></i>
                    </div></div>

        </div>
                    
        <div class="row">
            <div class="col-md-12">
                @include('pages.mahasiswa.dashboard.components.semester')
            </div>
        </div>
    </section>
@stop

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var events = [
                @foreach ($list_agenda as $agenda)
                    {
                        title: "{{ $agenda['title'] }}",
                        start: "{{ $agenda['start'] }}",
                        end: "{{ $agenda['end'] }}"
                    },
                @endforeach
            ];
            $("#calendar").fullCalendar({
                defaultView: "month",
                defaultDate: "{{ date('Y-m-d') }}",
                eventColor: "#2196F3",
                events: events
            });
        });
    </script>
@stop