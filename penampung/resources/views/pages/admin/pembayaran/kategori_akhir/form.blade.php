<div class="form-group row">
    {{-- <div class="col-md-6">
        {!! Form::label('id_prodi', 'Program Studi', ['class' => 'control-label']) !!}
        {!! Form::select('id_prodi', $prodi, null, ['placeholder' => '- Pilih Program Studi -', 'class' => 'form-control', 'required']) !!}
    </div> --}}

    <div class="col-md-6">
        {!! Form::label('tahun_akademik', 'Tahun Akademik', ['class' => 'control-label']) !!}
        {!! Form::select('tahun_akademik', $akademik, null, ['placeholder' => '- Pilih Tahun Akademik -', 'class' => 'form-control', 'required']) !!}
    </div>

    <div class="col-md-6">
        {!! Form::label('jenis_kategori', 'Jenis Kategori', ['class' => 'control-label']) !!}
        {!! Form::select('jenis_kategori', ['Skripsi' => 'Skripsi', 'Sidang' => 'Sidang', 'Wisuda' => 'Wisuda'], null, ['placeholder' => '- Pilih Jenis Pembayaran -','class' => 'form-control','required']) !!}
    </div>
    
</div>

<div class="form-group">
    {!! Form::label('nama_pembayaran', 'Nama Pembayaran', ['class' => 'control-label']) !!}
    {!! Form::select('nama_pembayaran', ['Pembayaran Skripsi' => 'Pembayaran Skripsi', 'Pembayaran Sidang' => 'Pembayaran Sidang', 'Pembayaran Wisuda' => 'Pembayaran Wisuda'], null, ['placeholder' => '- Pilih Nama Pembayaran -','class' => 'form-control', 'require']) !!}
</div>

{{-- <div class="form-group">
    {!! Form::label('id_waktu_kuliah', 'Waktu Kuliah', ['class' => 'control-label']) !!}
    {!! Form::select('id_waktu_kuliah', $waktu, null, ['class' => 'form-control']) !!}
</div> --}}

<div class="form-group">
    {!! Form::label('biaya', 'Biaya', ['class' => 'control-label']) !!}
    {!! Form::text('biaya', null, ['class' => 'form-control money', 'placeholder' => 'Contoh : 200,000', 'autocomplete' => 'off']) !!}
</div>

<div class="form-group">
    <a href="{{ route('admin.pembayaran.akhir') }}" class="btn btn-default btn-sm"> Kembali</a>
    {!! Form::submit($btnSubmit, ['class' => 'btn btn-primary btn-sm']) !!}
</div>

<script type="text/javascript">
  $('.nilai').keyup(function(){
        var current = $(this).val();
        if($(this).val().length == 3)
        {
            if(current.substr(2, 3) == '.')
            {
                $(this).val(current.replace('.', ''));
            }
            else
            {
                $(this).val(current.substr(0, 2)+'.'+current.substr(2, 6));
            }

        }
        else if($(this).val().length == 6)
        {
            $(this).val(current.replace('.', ''));
            var max = parseInt(100);
            if($(this).val() < max.toFixed(2))
            {
                $(this).val($(this).val().substr(0, 3)+'.'+$(this).val().substr(3, 6));
            }
            else
            {
                $(this).val(max.toFixed(2));
            }
        }
        else if($(this).val().length < 3)
        {
            $(this).val(current.replace('.', ''));
        }
  });
</script>
