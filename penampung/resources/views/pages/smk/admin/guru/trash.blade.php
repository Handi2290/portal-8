@extends('template')



@section('main')

<!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Trash Informasi

      </h1>

      <ol class="breadcrumb">

        <li>Home</li>

        <li>Foto Guru</li>

        <li class="active">Trash Informasi</li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="row">

      	<div class="col-xs-12">

          @include('_partials.flash_message')

      		<div class="box box-default">

      			<div class="box-header with-border">

      				<h3 class="box-title"><a href="{{ route('smk.admin.guru') }}" class="text-primary">Data Foto Guru </a>| Trash

              </h3>

      			</div>



      			<div class="box-body">

      				<div class="row">

                <div class="col-xs-12 table-responsive">

                    <table class="table table-striped informasi">

                      <thead>

                        <tr>

                          <th>No</th>

                          <th>Id Informasi</th>

                          <th>Judul Informasi</th>

                          <th>Waktu Informasi</th>

                          <th>Sumber Informasi</th>

                          <th>Aksi</th>

                        </tr>

                      </thead>



                      <tbody>



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

      $(document).ready(function(){

        $(".informasi").DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('smk.admin.guru.trash.datatable') }}",

            columns: [

                {'data': 'no'},

                {'data': 'id_info'},

                {'data': 'judul_info'},

                {'data': 'waktu_info'},

                {'data': 'sumber_info'},

                {'data': 'aksi'},


            ]

        });

      });

    </script>

@stop

