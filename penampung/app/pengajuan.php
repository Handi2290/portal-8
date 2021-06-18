<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table ='t_pengajuan';
    protected $fillable = ['id','nim','nama','judul','prodi','dospem','link','kelengkapan','keterangan','file','status'];
}
