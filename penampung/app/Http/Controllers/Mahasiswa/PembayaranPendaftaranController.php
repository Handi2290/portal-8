<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pendaftaran;

class PembayaranPendaftaranController extends Controller
{
	public function index()
	{
		$user = auth()->guard('mahasiswa')->user();
		$data['pendaftaran'] = Pendaftaran::where('id_daftar', $user->id_daftar)->first();
		return view('pages.mahasiswa.pembayaran_pendaftaran.index', $data);
	}
}
