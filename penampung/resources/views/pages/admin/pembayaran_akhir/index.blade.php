@extends('template')



@section('main')

<!-- Content Header (Page header) -->

<section class="content-header">

  <h1>

    Pembayaran Kelulusan

  </h1>

  <ol class="breadcrumb">

    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

    <li class="active">Mahasiswa Akhir</li>

  </ol>

</section>



<!-- Main content -->

<section class="content">
  <div class="row">

    <div class="col-md-12">

      @include('_partials.flash_message')

      <div class="box box-default">

        <div class="box-header with-border">

          <h3 class="box-title">List Mahasiswa Akhir

          </h3>

        </div>

        

        <div class="box-body">

          <div class="col-md-12 col-xs-12">

            <div class="row">

              <div class="table-responsive">
                {{ csrf_field() }}
                <div class="box-header with-border">
                  <div class="form-inline">
                    <?php $kategori = App\KategoriPembayaranAkhir::get(); ?>
                    <select class="form-control select-custom" id="katpembayaran">
                      <option> - Pilih Jenis Pembayaran - </option>
                      @foreach ($kategori as $k)
                      <option value="{id}">{{ $k->nama_kategori }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                  
                <table class="table table-striped pakhir">
                <thead>
                        <tr>
                          <td  width="5%">No.</td>
                          <td width="15%">NIM</td>
                          <td width="20%">Nama</td>
                          <td width="15%">Status</td>
                          <td width="15%">Biaya</td>
                          <td width="15%">Aksi</td>
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

      </div>

    </section>

    <!-- /.content -->

    <script type="text/javascript">
      $(document).ready(function(){
        $(".pakhir").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.pembayaran_akhir.datatable') }}",
            columns: [
                {'data': 'no'},
                {'data': 'nim'},
                {'data': 'nama'},
                {'data': 'status'},
                {'data': 'biaya'},
                {'data': 'aksi'},
            ]
        });
      });
    </script>
@stop