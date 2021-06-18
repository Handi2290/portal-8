<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\ {
    Mahasiswa,
    TahunAkademik,
    PembayaranAkhir
};

class PembayaranAkhirController extends Controller
{
	public function index($kategori)
	{

		$mahasiswa = auth()->guard('mahasiswa')->user();
		$data['list_tahun_akademik'] = [];

		if(!empty($mahasiswa->tahun_akademik)) {
		    $data['list_tahun_akademik'] = TahunAkademik::select('id_tahun_akademik', 'keterangan')->where('tahun_akademik', '>=', $mahasiswa->tahun_akademik)->orderBy('tahun_akademik', 'DESC')->get();
		}

		$data['tahun_akademik'] = TahunAkademik::where('tahun_akademik', $mahasiswa->tahun_akademik)->first();

		return view('pages.mahasiswa.pembayaran_akhir.index', $data);
	}

	public function datatable($kategori)
	{
        if(request()->ajax()) {

            $counter = $this->getDataPembayaranAkhir([
                'isCounter' => true,
                'id_tahun_akademik' => request()->id_tahun_akademik,
                'start' => request()->start,
                'length' => request()->length,
                'kategori' => $kategori,
            ]);

            $data = $this->getDataPembayaranAkhir([
                'isCounter' => false,
                'id_tahun_akademik' => request()->id_tahun_akademik,
                'start' => request()->start,
                'length' => request()->length,
                'kategori' => $kategori,
            ]);

            return response()->json([
                'iTotalRecords' => $counter,
                'iTotalDisplayRecords' => $counter,
                'data' => $data
            ]);
        }
	}

	private function getDataPembayaranAkhir($params)
	{

	    $nim = auth()->guard('mahasiswa')->user()->nim;

	    $data = PembayaranAkhir::select([
	        't_pembayaran_akhir.*',
	        't_tahun_akademik.keterangan as tahun_ajaran'
	    ])->where(
	        't_pembayaran_akhir.nim', $nim
	    )->join(
	        't_tahun_akademik',
	        't_pembayaran_akhir.id_tahun_akademik','=',
	        't_tahun_akademik.id_tahun_akademik'
	    )->where(
	    	't_pembayaran_akhir.nama_kategori','like','%'.$params['kategori'].'%'
	    );

	    if($params['id_tahun_akademik']) {
	        $data->where('t_pembayaran_akhir.id_tahun_akademik', $params['id_tahun_akademik']);
	    }

	    if($params['isCounter']) {
	        return $data->count();
	    }

	    return $data->skip($params['start'])->take($params['length'])->get();
	}

	public function uploadView()
	{
	    return view('pages.mahasiswa.pembayaran_akhir.upload');
	}

	public function uploadFile(Request $request)
	{

	    $validate = Validator::make($request->all(), [
	        'id_tahun_akademik' => 'required|numeric',
	        'bayar' => 'required|numeric',
	        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'tanggal_pembayaran' => 'required'
	    ]);

	    if($validate->fails()) {
	        return redirect()->back()->withErrors($validate->errors()->first());
	    }

	    $getSpp = PembayaranAkhir::where([
	        'id_pembayaran_akhir' => $request->id,
	        'nim' => auth()->guard('mahasiswa')->user()->nim
	    ])->first();

	    if(!$getSpp) {
	        return redirect()->back()->withErrors('Pembayaran Not Found.');
	    }

	    $file = $request->file('file');

	    $fileName = $file->hashName();

	    $getSpp->update([
	        'file' => $fileName
	    ]);

	    $file->move('./images/pembayaran_akhir', $fileName);

	    return redirect(route('mahasiswa.pembayaran_akhir', request()->segment(5)))->with('success_message', 'File uploaded');
	}

	public function show()
	{
        $data['data'] = PembayaranAkhir::where([
            'id_pembayaran_akhir' => request()->id,
            'nim' => auth()->guard('mahasiswa')->user()->nim
        ])->first();
        return view('pages.mahasiswa.pembayaran_akhir.show', $data);
	}

}