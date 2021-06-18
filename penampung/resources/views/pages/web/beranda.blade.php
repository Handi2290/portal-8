<!DOCTYPE html>
<html lang="en">
{{-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal STIE PPI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    body{
        background-color: powderblue;
    }
    .tombol{
        margin-top: 300px;
    }
    </style>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5faa575d791a210013366667&product=inline-follow-buttons' async='async'></script>
</head>
<body>
    <div class="container">
        <div class="tombol row text-center">
            <div class="col-md-12">
                <h1>SELAMAT DATANG DI PORTAL AKADEMIK STIE PPI</h1><br>
                <a href="/mahasiswa"><button type="button" class="btn btn-info btn-lg">Login Mahasiswa</button></a>
                <a href="/admin"><button type="button" class="btn btn-outline-info btn-lg">Login Admin</button></a>
                <a href="/admin"><button type="button" class="btn btn-outline-info btn-lg">Login Dosen</button></a>
            </div>
        </div>
    </div>
</body> --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal STIE PPI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    body{
        background-color: skyblue;
    }
    .tombol{
        margin-top: 300px;
    }
    #blink {
            font-weight: bold;
            color: #2d38be;
            transition: 0.5s;
    }
    </style>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5faa575d791a210013366667&product=inline-follow-buttons' async='async'></script>
</head>

<body>
    <div class="container">
        <div class="tombol row text-center">
            <div class="col-md-12">
                <h1 id="blink"> SELAMAT DATANG DI PORTAL AKADEMIK STIE PPI </h1><br>
                <a href="/admin"><button type="button" class="btn btn-outline-primary btn-lg"> Admin</button></a>
                <a href="/dosen"><button type="button" class="btn btn-outline-primary btn-lg"> Dosen</button></a><br><br>
                <a href="/mahasiswa"><button type="button" class="btn btn-info btn-lg"> Mahasiswa</button></a>
                <script type="text/javascript">
                    var blink = document.getElementById('blink');
                    setInterval(function() {
                        blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
                    }, 1500);
                </script>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>