<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skpi extends Model
{
    protected $table ='t_skpi';
    protected $fillable = ['id','nim','nama','judul','judul_eng','link','kelengkapan','keterangan','kategori','file','status','bobot'];
}
