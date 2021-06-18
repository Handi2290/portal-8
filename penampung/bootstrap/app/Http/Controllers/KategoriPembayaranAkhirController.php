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

use App\KategoriPembayaranAkhir;
use App\TahunAkademik;

class KategoriPembayaranAkhirController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function datatable(Request $req){
        $data = array();
        $no = 1;

        if(!empty($req->segment(6))){
            $kategori = KategoriPembayaranAkhir::where('is_delete', 'Y')->orderBy('id_kategori_akhir', 'DESC')->get();
        } else {
            $kategori = KategoriPembayaranAkhir::where('is_delete', 'N')->orderBy('id_kategori_akhir', 'DESC')->get();
        }
        
        foreach ($kategori as $list){
            $toTrash = "'Anda Yakin Akan Menghapus Pembayaran ".$list->kode_kategori." - ".$list->nama_kategori." '";
            
            $hapus = "'Anda Yakin Akan Menghapus Permanen Pembayaran ".$list->kode_kategori." - ".$list->nama_kategori." '";
            
            $restore = "'Anda Yakin Akan Memulihkan Pembayaran ".$list->kode_kategori." - ".$list->nama_kategori." '";
            
            $row = array();
            $row['no'] = $no;
            $row['kode'] = $list->kode_kategori;
            $row['akademik'] = $list->tahun_akademik;
            $row['kategori'] = $list->nama_kategori;
            $row['biaya'] = number_format($list->biaya);

            if(!empty($req->segment(6))){
                $row['aksi'] =
                '<a href="'.route('admin.pembayaran.akhir.restore', $list->id_kategori_akhir).'" class="btn btn-success btn-sm" title="Restore" onclick="return confirm('.$restore.')"><i class="fa fa-mail-reply"></i></a>
                 <a href="'.route( 'admin.pembayaran.akhir.hapus.permanen', $list->id_kategori_akhir).'" class="btn btn-danger btn-sm" title="Hapus Permanen" onclick="return confirm('.$hapus.')"><i class="fa fa-trash-o"></i></a>';
                
            } else {
                $row['aksi'] =
                    '<a href="'.route('admin.pembayaran.akhir.ubah', $list->id_kategori_akhir).'" class="btn btn-warning btn-sm" title="Ubah"><i class="fa fa-edit"></i></a>
                     <a href="'.route('admin.pembayaran.akhir.hapus', $list->id_kategori_akhir).'" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('.$toTrash.')"><i class="fa fa-trash-o"></i></a>';
            }

            $data[] = $row;
            $no++;
        }
        
        return DataTables::of($data)->escapeColumns([])->make(true);
        
    }
    
    public function trash(){
        return view('pages.admin.pembayaran.kategori_akhir.trash');
        
    }

    public function tambah(){
        $akademik = TahunAkademik::where('status', 1)->pluck('keterangan', 'tahun_akademik','id_tahun_akademik');
        // $prodi = Prodi::pluck('nama_prodi', 'id_prodi');
        // $waktu = WaktuKuliah::pluck('nama_waktu_kuliah', 'id_waktu_kuliah');

        return view('pages.admin.pembayaran.kategori_akhir.tambah', compact('akademik'));
        
    }
    
    public function simpan(Request $req){
        
        $input = $req->all();
        
        if(!empty($req->biaya)){
            $input['biaya'] = str_replace(',', '', $req->biaya);
        } else {
            $input['biaya'] = 0;
        }
        
        // if(!empty($req->minimal_biaya)){
        //     $input['minimal_biaya'] = str_replace(',', '', $req->minimal_biaya);
        // } else {
        //     $input['minimal_biaya'] = 0;
        // }
        
        $input['created_by'] = Auth::guard('admin')->user()->nama;
        
        // if($req->nama_kategori == 'Diterima'){
        //     $kd = 'T';
        // } else {
        //     $kd = 'G';
        // }

        if($req->jenis_kategori == 'Skripsi'){
            $jk = 'SK';
        } elseif ($req->jenis_kategori == 'Sidang'){
            $jk = 'SD';
        } else {
            $jk = 'WS';
        }
        
        if(KategoriPembayaranAkhir::where(['tahun_akademik' => $req->tahun_akademik])->where('kode_kategori', 'LIKE', $jk.'%')->count() > 0){
            $kategori = KategoriPembayaranAkhir::where(['tahun_akademik' => $req->tahun_akademik])->where('kode_kategori', 'LIKE', $jk.'%')->orderBy('id_kategori_akhir', 'DESC')->first();
            $jumlah = intval(substr($kategori->kode_kategori, 2)) + 1;
            $kode_kategori = $jk.$jumlah;
            
        } else {
            $kode_kategori =  $jk.intval(1);
        }

        $akademik = TahunAkademik::where('tahun_akademik',$req->tahun_akademik)->first();

        $input['id_tahun_akademik'] = $akademik->id_tahun_akademik;
        $input['kode_kategori'] = $kode_kategori;
        $input['nama_kategori'] = $req->nama_pembayaran;
        $input['is_delete'] = 'N';

        // if(trim($req->potongan) == ''){
        //     $input['potongan'] = 0;
        // } else {
        //     $input['potongan'] = str_replace(',', '', $req->potongan);
        // }
        
        KategoriPembayaranAkhir::create($input);
        
        Session::flash('success', 'Kategori Pembayaran Behasil Ditambahkan');
        
        return redirect()->route('admin.pembayaran.akhir');
        
    }
    
    public function ubah($id){
        $pembayaran = KategoriPembayaranAkhir::find($id);
        $akademik = TahunAkademik::where('status', 1)->pluck('keterangan', 'tahun_akademik');
        // $prodi = Prodi::pluck('nama_prodi', 'id_prodi');        
        // $waktu = WaktuKuliah::pluck('nama_waktu_kuliah', 'id_waktu_kuliah');
        
        return view('pages.admin.pembayaran.kategori_akhir.ubah', compact('akademik', 'prodi', 'waktu', 'pembayaran', 'id'));
    }

    public function perbarui($id, Request $req)
    {
        $pembayaran = KategoriPembayaranAkhir::find($id);
        $input = $req->all();

        if(!empty($req->biaya)){
            $input['biaya'] = str_replace(',', '', $req->biaya);
        } else {
            $input['biaya'] = 0;
        }

        $input['updated_by'] = Auth::guard('admin')->user()->nama;

        if($req->jenis_kategori == 'Skripsi'){
            $jk = 'SK';
        } elseif ($req->jenis_kategori == 'Sidang'){
            $jk = 'SD';
        } else {
            $jk = 'WS';
        }

        // if($req->id_prodi == $pembayaran->id_prodi && $req->id_waktu_kuliah == $pembayaran->id_waktu_kuliah && $req->nama_kategori == $pembayaran->nama_kategori)
        if ($req->nama_kategori == $pembayaran->nama_kategori && $req->tahun_akademik == $pembayaran->tahun_akademik)
        {
            $kode_kategori = $pembayaran->kode_kategori;
        } else {
            if(KategoriPembayaranAkhir::where(['tahun_akademik' => $req->tahun_akademik])->where('kode_kategori', 'LIKE', $jk.'%')->whereNotIn('id_kategori_akhir', [$pembayaran->id_kategori_akhir])->count() > 0)
            {
                $kategori = KategoriPembayaranAkhir::where(['tahun_akademik' => $req->tahun_akademik])->where('kode_kategori', 'LIKE', $jk.'%')->orderBy('id_kategori_akhir', 'DESC')->whereNotIn('id_kategori_akhir', [$pembayaran->id_kategori_akhir])->first();
                $jumlah = intval(substr($kategori->kode_kategori, 2)) + 1;
                $kode_kategori = $jk.$jumlah;
            } else {
                $kode_kategori =  $jk.intval(1);
            }   
        }

        $akademik = TahunAkademik::where('tahun_akademik',$req->tahun_akademik)->first();

        $input['id_tahun_akademik'] = $akademik->id_tahun_akademik;
        $input['kode_kategori'] = $kode_kategori;
        $input['nama_kategori'] = $req->nama_pembayaran;

        $pembayaran->update($input);

        Session::flash('success', 'Kategori Pembayaran Behasil Diperbarui');

        return redirect()->route('admin.pembayaran.akhir');
    }

    public function toTrash($id)
    {
        KategoriPembayaranAkhir::find($id)->update(['deleted_at' => date('Y-m-d H:i:s'), 'deleted_by' => Auth::guard('admin')->user()->nama, 'is_delete' => 'Y']);
        Session::flash('success', 'Kategori Pembayaran Berhasil Dihapus');

        return redirect()->route('admin.pembayaran.akhir');
    }

    public function restore($id)
    {
        KategoriPembayaranAkhir::find($id)->update(['is_delete' => 'N']);

        Session::flash('success', 'Kategori Pembayaran Berhasil Dipulihkan');

        return redirect()->route('admin.pembayaran.akhir.trash');
    }

    public function hapus($id)
    {
        KategoriPembayaranAkhir::find($id)->delete();

        Session::flash('success', 'Kategori Pembayaran Berhasil Dihapus Permanen');

        return redirect()->route('admin.pembayaran.akhir.trash');

    }
}



