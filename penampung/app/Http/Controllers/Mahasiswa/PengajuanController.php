<?php

namespace App\Http\Controllers\Mahasiswa;
use DB;
use Auth;
use File;
use App\pengajuan;
use App\Dosen;
use App\Prodi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OptionsController;
use App\Mahasiswa as AppMahasiswa;

class PengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:mahasiswa');
    }

    public function index()
    {
    
    $list_dospem = Dosen::pluck('nama', 'nip');
    $list_prodi = Prodi::pluck('nama_prodi', 'id_prodi');

    $data_pengajuan=Pengajuan::select([
        't_pengajuan.id',
        't_pengajuan.nim',
        't_pengajuan.nama',
        't_pengajuan.prodi',
        't_pengajuan.judul',
        't_pengajuan.dospem',
        't_pengajuan.file',
        't_pengajuan.kelengkapan',
        't_pengajuan.keterangan',
        't_pengajuan.status'
    ])
    ->where([
        't_pengajuan.nim' => Auth::guard('mahasiswa')->user()->nim
    ])
    ->get();
    
    return view ('pages/mahasiswa/pengajuan/index',['data_pengajuan'=>$data_pengajuan, 'list_dospem'=>$list_dospem, 'list_prodi'=>$list_prodi]);
    }

    public function save(Request $request){
        $nim= Auth::guard('mahasiswa')->user()->nim;
        $nama= Auth::guard('mahasiswa')->user()->nama;
        $prodi= Auth::guard('mahasiswa')->user()->id_prodi;
        //dd($request);

        $this->validate($request, [
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'kelengkapan' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        // dd($request);
        $file = $request->file('file');
        $kelengkapan = $request->file('kelengkapan');

        $file_pengajuan = $nim."_".time()."_".$file->getClientOriginalName();
        $kelengkapan_pengajuan = $nim."_".time()."_".$kelengkapan->getClientOriginalName();
 
		$tujuan_upload = 'images/pengajuan';
        $file->move($tujuan_upload, $file_pengajuan);
        $kelengkapan->move($tujuan_upload, $kelengkapan_pengajuan);
        
        pengajuan::create([
            'nim'=> $nim,
            'nama'=> $nama,
            'prodi' => $prodi,
            'judul'=> $request->judul,
            'dospem'=> $request->dospem,
            'file'=> $file_pengajuan,
            'kelengkapan'=>$kelengkapan_pengajuan,
            'status'=> 'P'
            ]);
        // dd($request);
        return redirect()->back()->with('sukses','Data berhasil disimpan!');
        
    }

    public function delete($id){
        $pengajuan = Pengajuan::where('id',$id)->first();
        file::delete('images/pengajuan/'.$pengajuan->file);
        file::delete('images/pengajuan/'.$pengajuan->kelengkapan);
        $pengajuan->delete();
    
        return redirect()->back()->with('sukses','Data berhasil dihapus!');
    }

    // print pengajuan start
    public function print_pengajuan(){
        $auth = Auth::guard('mahasiswa')->user()->nim;
        $pengajuan = DB::table('t_pengajuan AS p')
            ->select([
                'p.nim',
                'p.nama',
                'p.judul',
                'p.dospem',
                'p.keterangan',
                'p.status', 
                'pr.nama_prodi',
                'sm.semester_ke',
                'w.nama_waktu_kuliah'
            ])
            ->leftJoin('m_mahasiswa AS m', 'p.nim', '=', 'm.nim')
            ->leftJoin('tbl_prodi AS pr', 'm.id_prodi', '=', 'pr.id_prodi')
            ->leftJoin('tbl_semester AS sm', 'm.id_semester', 'sm.id_semester')
            ->leftJoin('tbl_waktu_kuliah AS w', 'm.id_waktu_kuliah', '=', 'w.id_waktu_kuliah')
            ->leftJoin('t_tahun_akademik AS ta', 'm.tahun_akademik', '=', 'ta.tahun_akademik')
            ->where(['p.nim' => $auth])
            ->orderBy('p.id', 'ASC')
            ->get();

        
        return view('pages/mahasiswa/pengajuan/print', compact('nim','nama','pengajuan'));
    }
    // print pengajuan end


}
?>