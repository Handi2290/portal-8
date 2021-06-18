<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class KategoriInfo extends model

{



    protected $table = 'm_kategori_info';

    protected $primaryKey = 'id_kategori_info';

    public $timestamps = false;



    protected $fillable = [

        'id_kategori_info', 'kategori_info', 'create_by', 'create_date', 'update_by', 'update_date', 'delete_by', 'delete_date', 'is_delete'];

    public function info()
    {
    	return $this->hasMany('App\InfoWeb', 'id_info');
    }
}

