<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendaftaranPembayaranAkhir extends model {

    protected $table = 'tbl_daftar_pembayaran_akhir';

    protected $primaryKey = 'id_daftar_pembayaran_akhir';

    public $timestamps = false;

    protected $fillable = [

        'id_daftar', 'id_daftar_kategori', 'status_pembayaran'

    ];

    function pendaftaran(){

        return $this->belongsTo('App\Pendaftaran', 'id_daftar');
    }

    function kategori(){

        return $this->belongsTo('App\KategoriPembayaranAkhir', 'id_kategori_akhir');

    }

     function detail(){

        return $this->belongsTohasMany('App\PendaftaranPembayaranDetail', 'id_daftar_pembayaran');

    }

    function tahun_akademik(){
        return $this->belongsTo('App\TahunAkademik', 'id_tahun_akademik');
    }

}