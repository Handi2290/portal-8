<?php

namespace App\Http\Controllers\Admin;
use Auth;
use DB;
use File;
use App\skpi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OptionsController;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class SkpiController extends Controller
{
    public function index()
    {
    $data_skpi=skpi::select([
        't_skpi.id',
        't_skpi.nim',
        't_skpi.nama',
        't_skpi.judul',
        't_skpi.judul_eng',
	't_skpi.file',
	't_skpi.link',
	't_skpi.kelengkapan',
	't_skpi.keterangan',
	't_skpi.kategori',
	't_skpi.status',
	't_skpi.bobot'
    ])
    ->paginate(10);
    return view ('pages/admin/skpi/index',['data_skpi'=>$data_skpi]);
	}
 
	public function cari(Request $request)
	{
	$admin = Auth::guard('admin')->user()->id_admin;
	//dd($admin);
	$data = DB::table('t_skpi')->select('t_skpi.*','m_mahasiswa.*')
	->leftjoin('m_mahasiswa','m_mahasiswa.nim', '=', 't_skpi.nim');
	//->where('tbl_detail_penasihat_akademik.nip','=', $admin);

	$cari = $request->cari;

    $data_skpi = $data
    ->orWhere('t_skpi.nim','like',"%".$cari."%")
    ->orWhere('t_skpi.nama','like',"%".$cari."%")
	->paginate(10);
    //dd($data_skpi);
    	return view ('pages.admin.skpi.index',['data_skpi'=>$data_skpi]);
	} 

	public function confirm(Request $request,$id)
	{
		if ($request->status == 'terima')
		{
		$skpi = skpi::find($id)->update(['bobot'=>$request->bobot, 'status'=>'Y']);

		return redirect()->back()->with('approved','Data Berhasil disetujui!');
		}
		else ($request->status == 'tolak');
		{
		$skpi = skpi::find($id)->update(['keterangan'=>$request->keterangan, 'status'=>'N']);
		
		return redirect()->back()->with('warning','Data Berhasil ditolak!');
		}
		
		
	}

	public function tolak(Request $request,$id)
	{
		skpi::find($id)->update(['keterangan'=>$request->keterangan, 'status'=>'N']);

		return redirect()->back()->with('warning','Data Berhasil ditolak!');
	}

	public function cancel(Request $request,$id)
	{
		skpi::find($id)->update(['bobot'=>null, 'status'=>'P']);

		return redirect()->back()->with('hapus','Data Berhasil dibatalkan!');
	}

	public function hapus($id){
		$gambar = skpi::where('id',$id)->first();
		file::delete('images/skpi/'.$gambar->file);
		$gambar->delete();

		return redirect()->back()->with('hapus','Data Berhasil Dihapus!!!');
	}
}
?>