@extends('template')

@section('main')
    <section class="content-header">
        <h1>Input KRS Mahasiswa</h1>
        <ol class="breadcrumb">
            <li>Home</li>
            <li>KRS</li>
            <li class="active">Input KRS Mahasiswa</li>
          </ol>
    </section><!-- /.content-header -->

    <section class="content">
        @include('_partials.flash_message')
        {!! Form::open(['name' => 'frm_krs', 'method' => 'POST', 'route' => 'mahasiswa.krs.simpan', 'files' => 'true']) !!}
            @include('pages.mahasiswa.krs.form', ['btnSubmit' => 'Simpan'])
        {!! Form::close() !!}
    </section><!-- /.content -->
    
            <div class="box-body with-border">

                <h5>
                <p style="text-align:center"><font color="red">Keterangan waktu kuliah:</font></p>
                <p style="text-align:center"><font color="red">Silahkan pilih waktu kuliah <b>A</b> untuk Kampus Citra Raya dan waktu kuliah <b>B</b> untuk Kampus Balaraja.</font></p>
                </h5>

            </div>

    @include('pages.mahasiswa.krs.form_update')
@stop