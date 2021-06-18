<?php

namespace App\Http\Controllers\Mahasiswa;
use DB;
use Auth;
use File;
use App\skpi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OptionsController;
use App\Mahasiswa as AppMahasiswa;

class SkpiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:mahasiswa');
    }

    public function index()
    {
    $data_skpi=skpi::select([
        't_skpi.id',
        't_skpi.nim',
        't_skpi.nama',
        't_skpi.judul',
        't_skpi.judul_eng',
        't_skpi.file',
        't_skpi.kelengkapan',
        't_skpi.link',
        't_skpi.keterangan',
        't_skpi.kategori',
        't_skpi.status',
        't_skpi.bobot'
    ])
    ->where([
        't_skpi.nim' => Auth::guard('mahasiswa')->user()->nim
    ])
    ->get();
    
    return view ('pages/mahasiswa/skpi/index',['data_skpi'=>$data_skpi]);
    }

    public function save(Request $request){
        $nim= Auth::guard('mahasiswa')->user()->nim;
        $nama= Auth::guard('mahasiswa')->user()->nama;
        //dd($request);

        $this->validate($request, [
            'file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'kelengkapan' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048'
            ]);
        // dd($request);
        $file = $request->file('file');
        $kelengkapan = $request->file('kelengkapan');

        $nama_sertifikat = $nim."_".time()."_".$file->getClientOriginalName();
        $nama_kelengkapan = $nim."_".time()."_".$kelengkapan->getClientOriginalName();
 
		$tujuan_upload = 'images/skpi';
        $file->move($tujuan_upload, $nama_sertifikat);
        $kelengkapan->move($tujuan_upload, $nama_kelengkapan);
        
        skpi::create([
            'nim'=> $nim,
            'nama'=> $nama,
            'file'=> $nama_sertifikat,
            'kelengkapan'=>$nama_kelengkapan,
            'judul'=> $request->judul,
            'judul_eng'=>$request->judul_eng,
            'kategori'=>$request->kategori,
            'link'=>$request->link,
            'status'=> 'P'
            ]);
        // dd($request);
        return redirect()->back()->with('sukses','Data berhasil disimpan!');
        
    }

    public function delete($id){
        $skpi = skpi::where('id',$id)->first();
        file::delete('images/skpi/'.$skpi->file);
        file::delete('images/skpi/'.$skpi->kelengkapan);
        $skpi->delete();
    
        return redirect()->back()->with('sukses','Data berhasil dihapus!');
    }

    // print skpi start
    public function print_skpi(){
        $auth = Auth::guard('mahasiswa')->user()->nim;
        $skpi = DB::table('t_skpi AS s')
            ->select([
                's.nim',
                's.nama',
                's.judul',
                's.judul_eng',
                's.kategori',
                's.keterangan',
                's.status',
                's.bobot',
                'p.nama_prodi',
                'sm.semester_ke',
                'w.nama_waktu_kuliah'
            ])
            ->leftJoin('m_mahasiswa AS m', 's.nim', '=', 'm.nim')
            ->leftJoin('tbl_prodi AS p', 'm.id_prodi', '=', 'p.id_prodi')
            ->leftJoin('tbl_semester AS sm', 'm.id_semester', 'sm.id_semester')
            ->leftJoin('tbl_waktu_kuliah AS w', 'm.id_waktu_kuliah', '=', 'w.id_waktu_kuliah')
            ->leftJoin('t_tahun_akademik AS ta', 'm.tahun_akademik', '=', 'ta.tahun_akademik')
            ->where(['s.nim' => $auth])
            ->orderBy('s.id', 'ASC')
            ->get();

        
        return view('pages/mahasiswa/skpi/print', compact('nim','nama','skpi'));
    }
    // print skpi end


}
?>