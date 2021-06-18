<?php

namespace App\Http\Controllers\Admin;
use Auth;
use DB;
use File;
use App\pengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OptionsController;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PengajuanController extends Controller
{
    public function index()
    {
    $data_pengajuan=Pengajuan::select([
        't_pengajuan.id',
        't_pengajuan.nim',
        't_pengajuan.nama',
        't_pengajuan.judul',
        't_pengajuan.dospem',
	't_pengajuan.file',
	't_pengajuan.kelengkapan',
	't_pengajuan.keterangan',
	't_pengajuan.status'
    ])
    ->paginate(10);
    return view ('pages/admin/pengajuan/index',['data_pengajuan'=>$data_pengajuan]);
	}
 
	public function cari(Request $request)
	{
	$admin = Auth::guard('admin')->user()->id_admin;
	//dd($admin);
	$data = DB::table('t_pengajuan')->select('t_pengajuan.*','m_mahasiswa.*')
	->leftjoin('m_mahasiswa','m_mahasiswa.nim', '=', 't_pengajuan.nim');
	//->where('tbl_detail_penasihat_akademik.nip','=', $admin);

	$cari = $request->cari;

    $data_pengajuan = $data
    ->orWhere('t_pengajuan.nim','like',"%".$cari."%")
    ->orWhere('t_pengajuan.nama','like',"%".$cari."%")
	->paginate(10);
    //dd($data_skpi);
    	return view ('pages.admin.pengajuan.index',['data_pengajuan'=>$data_pengajuan]);
	} 

	public function confirm(Request $request,$id)
	{
		Pengajuan::find($id)->update(['status'=>'Y']);
		return redirect()->back()->with('approved','Data Berhasil disetujui!');
	}

	public function tolak(Request $request,$id)
	{
		Pengajuan::find($id)->update(['keterangan'=>$request->keterangan, 'status'=>'N']);

		return redirect()->back()->with('warning','Data Berhasil ditolak!');
	}

	public function cancel(Request $request,$id)
	{
		Pengajuan::find($id)->update(['status'=>'P']);

		return redirect()->back()->with('hapus','Data Berhasil dibatalkan!');
	}

	public function hapus($id){
		$gambar = Pengajuan::where('id',$id)->first();
		file::delete('images/pengajuan/'.$gambar->file);
		$gambar->delete();

		return redirect()->back()->with('hapus','Data Berhasil Dihapus!!!');
	}
}
?>