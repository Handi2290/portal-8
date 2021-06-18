<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranAkhir extends Model
{
    protected $table = 't_pembayaran_akhir';

    protected $primaryKey = 'id_pembayaran_akhir';

    public $timestamps = false;

    protected $fillable = [
        'id_admin', 'nim', 'id_tahun_akademik', 'id_kategori_akhir','kode_kategori', 'nama_kategori', 'tanggal_pembayaran', 'bayar','status', 'created_at','updated_at'
    ];
}
