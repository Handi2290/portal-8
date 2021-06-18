<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables, Validator, Session, Auth, DB;

use App\ {
    Mahasiswa,
    TahunAkademik,
    Pembayaran_spp
};

class PembayaranSPPController extends Controller
{

    public function index()
    {

        $mahasiswa = auth()->guard('mahasiswa')->user();
        $data['list_tahun_akademik'] = [];

        if(!empty($mahasiswa->tahun_akademik)) {
            $data['list_tahun_akademik'] = TahunAkademik::select('id_tahun_akademik', 'keterangan')->where('tahun_akademik', '>=', $mahasiswa->tahun_akademik)->orderBy('tahun_akademik', 'DESC')->get();
        }

        $data['tahun_akademik'] = TahunAkademik::where('tahun_akademik', $mahasiswa->tahun_akademik)->first();

        return view('pages.mahasiswa.pembayaran_spp.index', $data);
    }

    public function cek()
    {

        $mahasiswa = auth()->guard('mahasiswa')->user();
        $data['list_tahun_akademik'] = [];

        if(!empty($mahasiswa->tahun_akademik)) {
            $data['list_tahun_akademik'] = TahunAkademik::select('id_tahun_akademik', 'keterangan')->where('tahun_akademik', '>=', $mahasiswa->tahun_akademik)->orderBy('tahun_akademik', 'DESC')->get();
        }

        $data['tahun_akademik'] = TahunAkademik::where('tahun_akademik', $mahasiswa->tahun_akademik)->first();

        return view('pages.mahasiswa.pembayaran_spp.cek', $data);
    }

    public function bayar()
    {

        $mahasiswa = auth()->guard('mahasiswa')->user();
        $data['list_tahun_akademik'] = [];

        if(!empty($mahasiswa->tahun_akademik)) {
            $data['list_tahun_akademik'] = TahunAkademik::select('id_tahun_akademik', 'keterangan')->where('tahun_akademik', '>=', $mahasiswa->tahun_akademik)->orderBy('tahun_akademik', 'DESC')->get();
        }

        $data['tahun_akademik'] = TahunAkademik::where('tahun_akademik', $mahasiswa->tahun_akademik)->first();

        return view('pages.mahasiswa.pembayaran_spp.bayar', $data);
    }

    public function get_pembayaran_spp($id_tahun_akademik)
    {

        $nim = Auth::guard('mahasiswa')->user()->nim;
        $tahun_akademik = TahunAkademik::select('semester')->where('id_tahun_akademik', $id_tahun_akademik)->first();

        if ($tahun_akademik->semester == 'Ganjil') {
            $list_bulan = array(
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
                1 => 'Januari'
            );
        } else {
            $list_bulan = array(
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
            );
        }

        $response = array();
        
        $response['status'] = 'success';
        $no = 1;

        foreach ($list_bulan as $key => $val) {
            $pembayaran_spp = Pembayaran_spp::where([
                    't_pembayaran_spp.nim' => $nim,
                    't_pembayaran_spp.id_tahun_akademik' => $id_tahun_akademik,
                    't_pembayaran_spp.bulan' => $key
                ])
                ->leftJoin('tbl_dispensasi', 't_pembayaran_spp.id_dispensasi', 'tbl_dispensasi.id_dispensasi')
                ->first();
            $count_spp = Pembayaran_spp::where([
                    't_pembayaran_spp.nim' => $nim,
                    't_pembayaran_spp.id_tahun_akademik' => $id_tahun_akademik,
                    't_pembayaran_spp.bulan' => $key
                ])
                ->leftJoin('tbl_dispensasi', 't_pembayaran_spp.id_dispensasi', 'tbl_dispensasi.id_dispensasi')
                ->count();

            if ($count_spp == 0) {
                $status = "<span class='text-danger'>Belum Bayar</span>";
            } else {
                $status = "<span class='text-success'>Sudah Bayar</span>";

                if (! empty($pembayaran_spp->id_dispensasi)) {
                    if (strtolower($pembayaran_spp->status) == 'belum bayar') {
                        $status = "<span class='text-success'>Dispensasi [Belum Bayar]</span>";
                    } else {
                        $status = "<span class='text-success'>Dispensasi [Sudah Bayar]</span>";
                    }
                }
            }
            
            $response['pembayaran_spp'][] = array(
                'no' => $no++,
                'key_bulan' => $key,
                'bulan' => $val,
                'status' => $status,
                'bayar' => ! empty($pembayaran_spp->bayar) ? "Rp. ".number_format($pembayaran_spp->bayar, 0, ",", ".") : '-',
                'tanggal' => ! empty($pembayaran_spp->tanggal_pembayaran) ? date('d M Y', strtotime($pembayaran_spp->tanggal_pembayaran)) : '-',
                'keterangan' => ! empty($pembayaran_spp->keterangan) ? $pembayaran_spp->keterangan : '-',
                // 'upload' => ! empty($pembayaran_spp->verifikasi) ? $pembayaran_spp->verifikasi : 
                //     '<a href="#" class="btn btn-warning btn-sm" title="Upload Bukti Pembayaran" enable><i class="fa fa-edit"> Upload</i></a>',
                //     //'.route('mahasiswa.PembayaranSPPController.upload').'
                // 'view' => ! empty($pembayaran_spp->verifikasi) ? $pembayaran_spp->verifikasi : 
                //     '<a href="#" class="btn btn-info btn-sm" title="Upload Bukti Pembayaran" enable><i class="fa fa-eye"> View</i></a>'
            );
        }
        
        return $response;

        return response()->json($response, 200);
    }

    public function get_pembayaran_spp_datatable($id_tahun_akademik)
    {

        if(request()->ajax()) {

            $counter = $this->getDataPembayaranSpp([
                'isCounter' => true,
                'id_tahun_akademik' => $id_tahun_akademik,
                'start' => request()->start,
                'length' => request()->length,
            ]);

            $data = $this->getDataPembayaranSpp([
                'isCounter' => false,
                'id_tahun_akademik' => $id_tahun_akademik,
                'start' => request()->start,
                'length' => request()->length,
            ]);

            return response()->json([
                'iTotalRecords' => $counter,
                'iTotalDisplayRecords' => $counter,
                'data' => $data
            ]);
        }
    }

    private function getDataPembayaranSpp($params)
    {

        $nim = auth()->guard('mahasiswa')->user()->nim;

        $data = Pembayaran_spp::select([
            't_pembayaran_spp.*',
            't_tahun_akademik.keterangan as tahun_ajaran'
        ])->where([
            't_pembayaran_spp.nim' => $nim,
            't_pembayaran_spp.id_tahun_akademik' => $params['id_tahun_akademik']
        ])->join(
            't_tahun_akademik',
            't_pembayaran_spp.id_tahun_akademik','=',
            't_tahun_akademik.id_tahun_akademik'
        );

        if($params['isCounter']) {
            return $data->count();
        }

        return $data->skip($params['start'])->take($params['length'])->get();
    }

    public function uploadView()
    {
        $mahasiswa = auth()->guard('mahasiswa')->user();
        $data['list_tahun_akademik'] = [];

        if(!empty($mahasiswa->tahun_akademik)) {
            $data['list_tahun_akademik'] = TahunAkademik::select('id_tahun_akademik', 'keterangan')->where('tahun_akademik', '>=', $mahasiswa->tahun_akademik)->orderBy('tahun_akademik', 'DESC')->get();
        }

        return view('pages.mahasiswa.pembayaran_spp.upload', $data);
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

        $getSpp = Pembayaran_spp::where([
            'id_pembayaran_spp' => $request->id,
            'nim' => auth()->guard('mahasiswa')->user()->nim
        ])->first();

        if(!$getSpp) {
            return redirect()->back()->withErrors('SPP Not Found.');
        }

        $file = $request->file('file');

        $fileName = $file->hashName();

        $getSpp->update([
            'file' => $fileName
        ]);

        $file->move('./images/spp', $fileName);

        return redirect(route('mahasiswa.pembayaran_spp'))->with('success_message', 'File uploaded');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $nim.time().'.'.$request->image->extension();  

        $request->image->move(public_path('images'), $imageName);

        return back()
            ->with('Berhasil','Verifikasi pembayaran segera diproses!')
            ->with('image',$imageName);
   
    }

    public function show()
    {
        $data['data'] = Pembayaran_spp::where([
            'id_pembayaran_spp' => request()->id,
            'nim' => auth()->guard('mahasiswa')->user()->nim
        ])->first();
        return view('pages.mahasiswa.pembayaran_spp.show', $data);
    }

    public function view($id)

    {

        $role = Role::whereNotIn('id_role', ['2'])->pluck('role_name', 'id_role');
        $karyawan = Admin::find($id);
        
        $tgl_lahir = date('d-M-Y', strtotime($karyawan->tgl_lahir));

        return view('pages.mahasiswa.verifikasi.ubah', compact('karyawan','role', 'id', 'tgl_lahir'));

    }

}
