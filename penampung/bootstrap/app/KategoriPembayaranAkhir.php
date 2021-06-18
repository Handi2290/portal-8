<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriPembayaranAkhir extends model
{

    protected $table = 'tbl_kategori_pembayaran_akhir';
    
    protected $primaryKey = 'id_kategori_akhir';

    protected $fillable = [
        'tahun_akademik',
        'id_tahun_akademik',
        'kode_kategori', 
        'nama_kategori', 
        'biaya', 
        'created_at', 
        'updated_at',
        'created_by', 
        'updated_by', 
        'deleted_at', 
        'deleted_by', 
        'is_delete'
    ];
    
    function pembayaran_akhir()
    {
        return $this->hasMany('App\PendaftaranPembayaranAkhir', 'id_kategori_akhir');
    }

    function tahun_akademik(){
        return $this->belongsTo('App\TahunAkademik','tahun_akademik');
    }
}
