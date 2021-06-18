<?php



namespace App;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Illuminate\Support\Facades\DB;

//use Illuminate\Response\JsonResponse;

//Mahasiswa::limit(60)->offset(60)->get();


class Mahasiswa extends \Eloquent implements Authenticatable


{

    use AuthenticableTrait;

    

    protected $table = 'm_mahasiswa';

    

    protected $primaryKey = 'id_mahasiswa';



    protected $fillable = [

        'nim', 'password', 'no_ktp', 'nama', 'email', 'tmp_lahir', 'tgl_lahir', 'agama', 'jenkel', 'warga_negara', 'nip', 'tahun_akademik', 'status', 'kelurahan', 'kode_pos', 'kecamatan', 'alamat', 'jalan', 'rt', 'rw', 'id_prov', 'kota', 'provinsi', 'no_telp', 'sumber_biaya', 'foto_profil', 'id_status', 'tahun_masuk', 'id_waktu_kuliah', 'id_prodi', 'id_jenjang', 'id_semester', 'id_daftar', 'isFirstLogin', 'is_disable_spp', 'is_updated_information', 'remember_token', 'created_at', 'updated_at', 'is_delete', 'auth'

    ];

    public function index()
    {
   	     // mengambil data dari table pegawai
		$mahasiswa = DB::table('m_mahasiswa')->paginate(10);
 
    	     // mengirim data pegawai ke view index
		return view('index',['m_mahasiswa' => $mahasiswa]);
		
		/* verifikasi pembayaran mahasiswa agar bisa login
		$pembayaran_spp = DB::table('t_pembayaran_spp')
            ->where([
                'nim' => Auth::guard('mahasiswa')->user()->nim,
                'id_tahun_akademik' => $tahun_akademik->id_tahun_akademik
            ])
            ->whereIn('bulan', array_keys($list_bulan))
            ->count();

        $sudah_bayar = ($count_pembayaran == $pembayaran_spp);*/

        return view('pages.mahasiswa.index');
 
    }
    
    /*public function index()
    {
    $mahasiswa = App\Mahasiswa::simplePaginate(10);
    return view('index',['m_mahasiswa' => $mahasiswa]);
    }*/


    function statusMahasiswa()

    {

    	return $this->belongsTo('App\MahasiswaStatus', 'id_status');

    }



    function prodi()

    {

        return $this->belongsTo('App\Prodi', 'id_prodi');

    }



    function provinsi()

    {

        return $this->belongsTo('App\Provinsi', 'id_provinsi');

    }



    function sekolah()

    {

        return $this->hasOne('App\MahasiswaSekolah', 'nim');

    }



    function pekerjaan()

    {

        return $this->hasOne('App\MahasiswaPekerjaan', 'nim');

    }



    function ortu()

    {

        return $this->hasOne('App\MahasiswaOrtu', 'nim');

    }



    function semester()

    {

        return $this->belongsTo('App\Semester', 'id_semester');

    }



    function waktu_kuliah()

    {

        return $this->belongsTo('App\WaktuKuliah', 'id_waktu_kuliah');

    }

    

    function jenjang()

    {

        return $this->belongsTo('App\Jenjang', 'id_jenjang');

    }

    

    function khs()

    {

        return $this->hasMany('App\KHS', 'nim');

    }



    public function kelas_detail()

    {

        return $this->hasMany('App\Kelas_detail', 'nim');

    }
    
    /* Ubah data menjadi JSON
    
    public function index(): Illuminate\Response\JsonResponse
    {
        $mahasiswa = App\Mahasiswa::paginate();

        return response()->json($mahasiswa);
    }*/
    
    /*
     * Alias to set the "offset" value of the query.
     *
     * @param  int  $value
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function skip($value)
    {
        return $this->offset($value);
    }

    /**
     * Set the "offset" value of the query.
     *
     * @param  int  $value
     * @return $this
     */
    public function offset($value)
    {
        $property = $this->unions ? 'unionOffset' : 'offset';

        $this->$property = max(0, $value);

        return $this;
    }

    /**
     * Alias to set the "limit" value of the query.
     *
     * @param  int  $value
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function take($value)
    {
        return $this->limit($value);
    }

    /**
     * Set the "limit" value of the query.
     *
     * @param  int  $value
     * @return $this
     */
    public function limit($value)
    {
        $property = $this->unions ? 'unionLimit' : 'limit';

        if ($value >= 0) {
            $this->$property = $value;
        }

        return $this;
    }

    /**
     * Set the limit and offset for a given page.
     *
     * @param  int  $page
     * @param  int  $perPage
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function forPage($page, $perPage = 10)
    {
        return $this->skip(($page - 1) * $perPage)->take($perPage);
    }

    /**
     * Constrain the query to the next "page" of results after a given ID.
     *
     * @param  int  $perPage
     * @param  int|null  $lastId
     * @param  string  $column
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function forPageAfterId($perPage = 10, $lastId = 0, $column = 'id')
    {
        $this->orders = $this->removeExistingOrdersFor($column);

        if (! is_null($lastId)) {
            $this->where($column, '>', $lastId);
        }

        return $this->orderBy($column, 'asc')
                    ->take($perPage);
    }

    /**
     * Get an array with all orders with a given column removed.
     *
     * @param  string  $column
     * @return array
     */
    protected function removeExistingOrdersFor($column)
    {
        return Collection::make($this->orders)
                    ->reject(function ($order) use ($column) {
                        return isset($order['column'])
                               ? $order['column'] === $column : false;
                    })->values()->all();
    }

}

//Mahasiswa::limit(30)->offset(30)->get();
