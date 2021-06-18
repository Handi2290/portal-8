<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akademik Portal</title>
    <link rel="shortcut icon" href="../images/logo/ppi.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}" integrity="sha384-OHBBOqpYHNsIqQy8hL1U+8OXf9hH6QRxi0+EODezv82DfnZoV7qoHAZDwMwEJvSw"
  crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <link href="{{ url('https://fonts.googleapis.com/css?family=Raleway:100,600')}}" rel="stylesheet" type="text/css">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/akademik.js') }}"></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5faa575d791a210013366667&product=inline-follow-buttons' async='async'></script>
</head>

<!-- Modal
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Pemberitahuan</p>
	            <p>Dihimbau kepada seluruh Dosen, 
	            <p>Staff Kampus serta Mahasiswa/i STIE Putra Perdana Indonesia.</p> 
	            <p>Bahwasanya agar selalu menjaga kesehatan diri sendiri serta</p>
	            <p>melakukan cara pencegahan terhadap penularan Covid-19,</p>
	            <p>karena Covid-19 ini sudah sangat dekat dengan lingkungan sekitar kita.</p>
	            <p>Jangan panik dan tetap waspada serta jangan lupa untuk selalu berdoa</p> 
	            <p>dan meminta perlindungan yang maha kuasa.</p>
	            <p>Terima Kasih.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
<!-- Modal -->

<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
     <div class="navbar-header">
         <style>
            /* Firefox old*/
            @-moz-keyframes blink {
                0% {
                    opacity:1;
                }
                50% {
                    opacity:0;
                }
                100% {
                    opacity:1;
                }
            } 
            
            @-webkit-keyframes blink {
                0% {
                    opacity:1;
                }
                50% {
                    opacity:0;
                }
                100% {
                    opacity:1;
                }
            }
            /* IE */
            @-ms-keyframes blink {
                0% {
                    opacity:1;
                }
                50% {
                    opacity:0;
                }
                100% {
                    opacity:1;
                }
            } 
            /* Opera and prob css3 final iteration */
            @keyframes blink {
                0% {
                    opacity:1;
                }
                50% {
                    opacity:0;
                }
                100% {
                    opacity:1;
                }
            } 
            .blink-image {
                -moz-animation: blink normal 2s infinite ease-in-out; /* Firefox */
                -webkit-animation: blink normal 2s infinite ease-in-out; /* Webkit */
                -ms-animation: blink normal 2s infinite ease-in-out; /* IE */
                animation: blink normal 2s infinite ease-in-out; /* Opera and prob css3 final iteration */
            }
            </style>
      @if(Request::segment(1) == 'mahasiswa')
        <a class="navbar-brand blink-image" href="#" style="margin: 0px; padding: 0px;">
            <img src="{{ asset('images/logo/logo.png') }}" style="width: 60%;">
        </a>
      @elseif(Request::segment(1) == 'dosen')
        <a class="navbar-brand blink-image" href="#" style="margin: 0px; padding: 0px;">
            <img src="{{ asset('images/logo/logo.png') }}" style="width: 60%;">
        </a>
      @elseif(Request::segment(1) == 'admin')
        <a class="navbar-brand blink-image" href="#" style="margin: 0px; padding: 0px;">
            <img src="{{ asset('images/logo/logo.png') }}" style="width: 60%;">
        </a>
      @elseif(Request::segment(1) == 'admin_smk')
        <a class="navbar-brand blink-image" href="#" style="margin: 0px; padding: 0px;">
            <img src="{{ asset('images/logo/smk.png') }}" style="width: 60%;">
        </a>
      @elseif(Request::segment(1) == 'admin_smp')
        <a class="navbar-brand blink-image" href="#" style="margin: 0px; padding: 0px;">
            <img src="{{ asset('images/logo/smp.png') }}" style="width: 60%;">
        </a>  
      @endif  
    </div>
  </div><!-- /.container-fluid -->
</nav>

<div class="col-md-12 bg-login">
    <div class="container">
        <div class="row">
            <div class="col-md-12 login">
                <div class="col-md-offset-2 col-md-8 box-login">
                    <marquee style="color:darkblue; font-weight:bold; padding-top:20px;"> Like, Share & Subscribe Official YT Channel STIE PPI </marquee>
                    <hr>
                    <div class="row">
                        <!--<div class="col-md-6 hidden-sm hidden-xs side-login">
                            <h3 class="text-center">Pengumuman</h3>
                            <hr>

                            <h4 class="text-center" style="margin-top: 100px; margin-bottom:-20px;"></h4>
                            
                            <a href="{{ asset('stieppi-alpha.apk') }}"><img src="{{ asset('images/get_mobile.png') }}" class="img-responsive"/></a>
                        </div>-->
                        <!--<div class="col-md-6 hidden-sm hidden-xs side-login">
                            <h3 class="text-center">Pengumuman</h3>
                            <hr>
                            <h4 class="text-center" style="margin-top: 5px; margin-bottom:10px;"></h4>
                            <a href="{{ asset('stieppi-alpha.apk') }}"><img src="http://stieppi.ac.id/wp-content/uploads/2020/03/corona-01-scaled.jpg" class="img-responsive"/></a>
                        </div>-->
                        <div class="col-md-6 hidden-sm hidden-xs side-login">
                            <img src="http://portal.stieppi.ac.id/images/yt-logo.png" height="20">
                            <br>
                            <br>
                            <iframe width="325" height="200" src="https://www.youtube.com/embed/QTJYbrKzCFA?autoplay=1" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <hr>
                            <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                            <!--<img src="http://portal.stieppi.ac.id/images/logokampus.png" class="img-responsive">-->
                        </div>
                        <div class=" col-md-6 form-login ">
                            {!! Form::open(['method' => 'POST', 'route' => $route]) !!}
                                <h3 style="font-size:20px; margin-top:0px; "><b>Silahkan Login</b></h3>
                                @include('_partials.flash_message')
                                @if(Request::segment(1) == 'mahasiswa')
                                    <div class="form-group">
                                        {!! Form::text('nim', null, ['class' => 'form-control', 'placeholder' => 'NIM', 'autocomplete' => 'off']) !!}
                                    </div>
                                @elseif(Request::segment(1) == 'dosen')
                                    <div class="form-group">
                                        {!! Form::text('nip', null, ['class' => 'form-control', 'placeholder' => 'NIP', 'autocomplete' => 'off']) !!}
                                    </div>
                                @elseif(Request::segment(1) == 'admin')
                                    <div class="form-group">
                                        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'autocomplete' => 'off']) !!}
                                    </div>
                                @elseif(Request::segment(1) == 'wali')
                                    <div class="form-group">
                                        {!! Form::text('nim', null, ['class' => 'form-control', 'placeholder' => 'NIM', 'autocomplete' => 'off']) !!}
                                    </div>
                                 @elseif(Request::segment(1) == 'admin_smk')
                                    <div class="form-group">
                                        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'autocomplete' => 'off']) !!}
                                    </div>
                                @elseif(Request::segment(1) == 'admin_smp')
                                    <div class="form-group">
                                        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'autocomplete' => 'off']) !!}
                                    </div>
                                @endif

                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} input-group">
                                    {!! Form::password('password', ['class' => 'form-control showPassword', 'placeholder' => 'Password', 'id' => 'getShow']) !!}
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-show" type="button" id="hideshow"><i class="fa fa-eye" id="icon_show"></i></button>
                                    </span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <!--<div class="form-group">
                                    {!! Form::submit('Log In', ['class' => 'btn btn-primary btn-login btn-block']) !!}
                                </div>-->
                                
                                <div class="form-group">
                                    {!! Form::submit('Log In', ['class' => 'btn btn-success btn-login btn-block', 'data-toggle' => 'modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-target' => '#myModalHorizontal']) !!}
                                </div>
                                <!-- Modal -->
                                <div class="modal fade right" id="myModalHorizontal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-notify modal-danger modal-side modal-top-right" role="document">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header" style="background: orange">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                </button>
                                            </div>            
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <img src="http://portal.stieppi.ac.id/images/bayar.jpg" style="width: 100%;"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--
                                <div class="form-group">
                                <a href="{{ asset('stieppi-alpha.apk') }}" class="btn btn-primary btn-login btn-block">Reset password</a>
                                </div
                                <a href="#" style="display:block; text-align: center; color:#666;">Reset Password</a>
                                -->
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#hideshow').click(function(){
                            if ($('#getShow').attr('class') == 'form-control showPassword') {

                                $('#getShow').attr('type', 'text');
                                $('#icon_show').prop('class', 'fa fa-eye-slash');
                                $('#getShow').attr('class', 'form-control hidePassword');

                            }else if($('#getShow').attr('class') == 'form-control hidePassword'){

                                $('#getShow').attr('type', 'password');
                                $('#icon_show').prop('class', 'fa fa-eye');
                                $('#getShow').attr('class', 'form-control showPassword');

                            }
                        })
                    })
                </script>
            </div>
        </div>
        <br>
        <!--<center><a href="{{ asset('stieppi-alpha.apk') }}" style="color: #fff; text-shadow: 0 0 10px #000; font-size: 20px;">GET APPS</a></center>-->
    </div>
</div>
</body>
</html>
