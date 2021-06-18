<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PendaftaranPembayaranDetail;

class PembayaranBangunanController extends Controller
{
	public function index(Request $request)
	{

		if($request->ajax()) {
			$counter = $this->datatable([
			    'isCounter' => true,
			    'start' => request()->start,
			    'length' => request()->length,
			]);

			$data = $this->datatable([
			    'isCounter' => false,
			    'start' => request()->start,
			    'length' => request()->length,
			]);

			return response()->json([
			    'iTotalRecords' => $counter,
			    'iTotalDisplayRecords' => $counter,
			    'data' => $data
			]);
		}

		return view('pages.mahasiswa.pembayaran_bangunan.index');
	}

	private function datatable($params)
	{
		$data = PendaftaranPembayaranDetail::select([
			'tbl_daftar_pembayaran_detail.*'
		])->join(
			'tbl_daftar_pembayaran',
			'tbl_daftar_pembayaran_detail.id_daftar_pembayaran','=',
			'tbl_daftar_pembayaran.id_daftar_pembayaran'
		)->where(
			'tbl_daftar_pembayaran.id_daftar', auth()->guard('mahasiswa')->user()->id_daftar
		);

		if($params['isCounter']) {
		    return $data->count();
		}

		return $data->skip($params['start'])->take($params['length'])->get();
	}
}
