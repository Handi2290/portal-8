<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use File;
use Auth;
use Session;
use DB;
use DataTables;
use App\PendaftaranNilai;
use App\Pendaftaran;
use App\KategoriPembayaran;
use App\PendaftaranPembayaran;
use App\PendaftaranPembayaranDetail;
use App\Dispensasi;
use App\Mahasiswa;
use App\MahasiswaOrtu;
use App\MahasiswaPekerjaan;
use App\MahasiswaSekolah;
use App\Promo;
use App\Prodi;
use App\TahunAkademik;
use App\Kuesioner_kategori;
use App\PembayaranAkhir;
use App\KategoriPembayaranAkhir;
use Carbon\Carbon;

class PembayaranAkhirController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth:admin');
    }

    public function datatable(Request $req){
        $no = 1;
        $data = array();

        $pembayaran = PembayaranAkhir::get();

        $kategori = KategoriPembayaranAkhir::get();

        foreach( DB::select(DB::raw("select * from m_mahasiswa a, tbl_kategori_pembayaran_akhir b
        where b.kode_kategori like 'SK%' order by b.kode_kategori DESC")) as $list){
            if((empty($pembayaran)) && ($list->nim == $pembayaran->nim)){
                $status = '<strong class="text-danger">Lunas</strong>';
                $aksi = '
                <a href="#" class="btn btn-success btn-sm" title="Bayar" disabled><i class="fa fa-money"></i></a>
                <a href="'.route('admin.pembayaran_akhir.print',[ $list->nim, $list->kode_kategori ] ).'" target="_blank" class="btn btn-default btn-sm" title="Print"><i class="fa fa-print"> Print </i></a>';
            } else {
                $status = '<strong class="text-danger">Belum Lunas</strong>';
                $aksi = ' <a href="'.route('admin.pembayaran_akhir.bayar',[ $list->nim, $list->kode_kategori]).'" class="btn btn-success btn-sm" title="Bayar"><i class="fa fa-money"> Bayar </i></a>';
            }

            $row = array();
            $row['no'] = $no;
            $row['nim'] = $list->nim;
            $row['nama'] = $list->nama;
            $row['status'] = $status;
            $row['biaya'] = number_format($list->biaya);
            $row['aksi'] = $aksi;
            $data[] = $row;
            $no++;
        }
            return DataTables::of($data)->escapeColumns([])->make(true);
    }
    
    public function bayar($id, $dp){
        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        $kategori = KategoriPembayaranAkhir::where('kode_kategori', $dp)->orderBy('kode_kategori', 'DESC')->first();
        $prodi = Prodi::select('nama_prodi')->where('id_prodi', $mahasiswa->id_prodi)->first();
        $tahun_akademik = TahunAkademik::where('id_tahun_akademik', $kategori->id_tahun_akademik)->first();
        $waktu_kuliah = DB::table('tbl_waktu_kuliah')->where('id_waktu_kuliah', $mahasiswa->id_waktu_kuliah)->first();
        
        return view('pages.admin.pembayaran_akhir.bayar',compact('id', 'dp', 'mahasiswa', 'kategori', 'prodi', 'waktu_kuliah', 'tahun_akademik'));
    }


    public function simpan($id, $dp, Request $req){

        $input = $req->all();
        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        $kategori = KategoriPembayaranAkhir::where('kode_kategori', $dp)->orderBy('kode_kategori', 'DESC')->first();
        $prodi = Prodi::select('nama_prodi')->where('id_prodi', $mahasiswa->id_prodi)->first();
        $tahun_akademik = TahunAkademik::where('id_tahun_akademik', $kategori->id_tahun_akademik)->first();
        $admin = Auth::guard('admin')->user();
        $system = New SystemController();

        // if(str_replace(',', '', $req->bayar) < str_replace(',','', $req->biaya)){
        //     // Session::flash('fail', 'Pembayaran Kurang Dari Biaya Seharusnya');
        //     return redirect()->back()->withInput($req->all())->with('gagal','Pembayaran Kurang Dari Biaya Seharusnya');
        // } elseif (str_replace(',', '', $req->bayar) > str_replace(',', '', $req->biaya)) {
        //     // Session::flash('fail', 'Pembayaran Lebih Dari Biaya Seharusnya');
        //     return redirect()->back()->withInput($req->all())->with('gagal','Pembayaran Lebih Dari Biaya Seharusnya');
        // } else {
        
        if(str_replace(',','',$req->bayar) <> $kategori->biaya){
            return redirect()->back()->withInput($req->all())->with('gagal','Pembayaran tidak sesuai');
        } else {

        $status = 'Lunas';

        $input['id_admin'] = $admin->id_admin;
        $input['nim'] = $mahasiswa->nim;
        $input['id_tahun_akademik'] = $tahun_akademik->id_tahun_akademik;
        $input['id_kategori_akhir'] = $kategori->id_kategori_akhir;
        $input['kode_kategori'] = $kategori->kode_kategori;
        $input['nama_kategori'] = $kategori->nama_kategori;
        $input['tanggal_pembayaran'] = date('Y-m-d', strtotime($req->tanggal_bayar));
        $input['status'] = $status;
        $input['id_admin'] = Auth::guard('admin')->user()->id_admin;
        $input['bayar'] = str_replace(',','',$req->bayar);
        $input['created_at'] = Carbon::now();

        PembayaranAkhir::create($input);
        Session::flash('success', 'Berhasil Melakukan Pembayaran');
        return redirect()->route('admin.pembayaran_akhir');
        }
    }
}