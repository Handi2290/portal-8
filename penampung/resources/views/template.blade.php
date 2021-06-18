<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Akademik | Dashboard</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="shortcut icon" href="../images/logo/ppi.png">
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/font-awesome/font-awesome.min.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
  {{-- gallery show --}}
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/gallery/css/lightgallery.css')}}">
  <!-- Time picker -->
  <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
  <!-- Data Table -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- Animate.Css -->
  <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('css/skin/skin-blue.min.css') }}">
	@yield('style')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<style>
    .sidebar-menu ul li a {
        white-space: normal;
    }
    
    
    
    @media screen and (min-width: 720px) {
        .main-sidebar,
        .main-header .logo {
          width: 250px;
        }
    
        .main-header .navbar,
        .content-wrapper, .main-footer {
          margin-left: 250px;
        }
    
        .sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .sidebar-menu>li:hover>a>span:not(.pull-right), .sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .sidebar-menu>li:hover>.treeview-menu {
          display: block !important;
          position: absolute;
          /* width: 180px; */
          width: 250px;
          left: 50px;
        }
    
        .sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .sidebar-menu>li:hover>a>.pull-right-container {
          position: relative !important;
          float: right;
          width: auto !important;
          /* left: 180px !important; */
          left: 250px !important;
          top: -22px !important;
          z-index: 900;
        }
    }
    
    .skin-blue .main-header .navbar {
    background-color: #32b4ff;
}

.skin-blue .main-header .logo:hover {
    background-color: #32b4ff;
}
.skin-blue .main-header .logo {
    background-color: #32b4ff;
    color: #fff;
    border-bottom: 0 solid transparent;
}

.skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a, .skin-blue .sidebar-menu>li.menu-open>a {
    color: #fff;
    background: #32b4ff;
}
.circleimages {
  width: 200px;
  height: 200px;
  line-height: 200px;
  border-radius: 50%; /* the magic */
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  text-align: center;
  color: white;
  font-size: 16px;
  text-transform: uppercase;
  font-weight: 700;
  margin: 0 auto 40px;
  object-fit:cover;
}

.skin-blue .main-header li.user-header {
    background-color: #32b4ff;
}

.responsive {
  width: 100%;
  max-width: 40px;
  height: auto;
}

.user-panel > .image > img {
    max-width: 45px;
    width: auto;
    margin: auto;
}
.img-circle {
    border-radius: 50%;
    margin: auto;
    object-fit:cover;
}
img {
    vertical-align: middle;
}
img {
    border: 0;
}
* {
    box-sizing: border-box;
}

.user-panel>.info {
    padding: 5px 5px 5px 15px;
    line-height: 1;
    position: absolute;
    left: 0;
}

</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('navbar')

    @include('sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('main')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> B.0.21
    </div>
    <strong>Copyright &copy; STIEPPI 2021</strong>
  </footer>
</div>

<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<!-- Time Picker -->
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<!-- Data Table -->
<script type="text/javascript" src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('js/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/demo.js') }}"></script>
<script src="{{ asset('js/number.min.js') }}"></script>
<script type="text/javascript" src="{{asset('plugins/gallery/js/lightgallery.js')}}"></script>
<!-- ./wrapper -->
<script type="text/javascript">
  $(document).ready(function(){
    //$('.alert-slide').delay(3000).slideUp(500);

    $('.select-custom').select2();
    
    $('.money').number(true, 0);

    $(".datatable").DataTable();

    $('.datepicker').datepicker({
      format: 'dd-M-yyyy'
    });
    
     $('#lightgallery').lightGallery({
          thumbnail : true,
          selector : '.img'
      });

	$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

  });

  function bulan(number) {
    var bulan = [
      'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember',
    ];

    return bulan[number];
  }

  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split       = number_string.split(','),
    sisa        = split[0].length % 3,
    rupiah        = split[0].substr(0, sisa),
    ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
    if(ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
</script>
@yield('script')
</body>
</html>
