<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Session;

use App\Absensi;
use App\Jadwal;
use App\KRS;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $krs = array();
        $absensi = array();
        $jadwal = array();

        // Mengambil tahun akademik dari siswa tersebut
        $list_tahun_akademik = DB::table('t_krs AS krs')
            ->select([
                'krs.tahun_akademik',
                'ta.keterangan'
            ])
            ->join('t_tahun_akademik AS ta', 'krs.tahun_akademik', '=', 'ta.tahun_akademik')
            ->where([
                'krs.nim' => Auth::guard('mahasiswa')->user()->nim
            ])
            ->groupBy('krs.tahun_akademik')
            ->pluck('ta.keterangan', 'krs.tahun_akademik');

        if ($request->tahun_akademik) {
            if (Auth::guard('mahasiswa')->check()) {
                $krs = KRS::where(['tahun_akademik' => $request->tahun_akademik, 'nim' => Auth::guard('mahasiswa')->user()->nim])->first();
            } elseif (Auth::guard('wali')->check()) {
                $krs = KRS::where(['tahun_akademik' =>$request->tahun_akademikt, 'nim' => Auth::guard('wali')->user()->nim])->first();            
            }

            $jadwal = Jadwal::where(['tahun_akademik' => $request->tahun_akademik, 'id_semester' => ! empty($krs->id_semester) ? $krs->id_semester : '-'])->get();
        }

        return view('pages.mahasiswa.absensi.index', compact('list_tahun_akademik', 'krs', 'jadwal'));
    }

    public function get_now_tahun_akademik()
    {
        $user = Auth::guard('mahasiswa')->user();

        $krs = KRS::select([
            't_tahun_akademik.*'
        ])
        ->leftJoin('t_tahun_akademik', 't_krs.tahun_akademik', 't_tahun_akademik.tahun_akademik')
        ->where([
            't_krs.nim' => $user->nim,
            't_krs.is_delete' => 'N',
            't_krs.status' => 'Y',
        ])
        ->orderBy('t_krs.tahun_akademik', 'DESC')
        ->first();

        return $krs;
    }

    public function get_day_name($n)
    {
        $day_name = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jum\'at',
            6 => 'Sabtu',
            7 => 'Minggu'
        ];

        return $day_name[$n];
    }

    public function get_jadwal($tahun_akademik)
    {
        $user = Auth::guard('mahasiswa')->user();

        $day_name = $this->get_day_name(date('N'));

        $krs = KRS::where([
            'tahun_akademik' => $tahun_akademik,
            'nim' => $user->nim,
            'status' => 'Y'
        ])
        ->first();

        $krs_item = (! empty($krs) && $krs->krs_item()->count() > 0) ? $krs->krs_item()->pluck('id_matkul') : [];

        $list_jadwal = DB::table('t_jadwal AS j')
        ->select([
            'j.id_jadwal',
            'h.nama_hari',
            'j.jam_mulai',
            'j.jam_selesai',
            'r.kode_ruang',
            'r.nama_ruang',
            'k.kode_kelas',
            'k.nama_kelas',
            'm.kode_matkul',
            'm.nama_matkul',
            'm.sks',
            'k.id_prodi',
            'k.kode_kelas',
            'd.nama',
            'd.nip',
            'a.keterangan',
            'ad.buka_absen',
            'ad.link',
            'k.id_kelas',
            'm.id_matkul',
            'a.nim',
            'ad.link',
            DB::raw('date(now()) as "tanggal"'),
            DB::raw('(CASE 
                        WHEN ad.buka_absen = "Y" AND time(now()) >= j.jam_mulai AND time(now()) <= j.jam_selesai AND a.keterangan = "Hadir" THEN "false" 
                        WHEN ad.buka_absen = "Y" AND time(now()) >= j.jam_mulai AND time(now()) <= j.jam_selesai AND a.keterangan = "Alpha" THEN "true" 
                        WHEN ad.buka_absen = "N" AND time(now()) >= j.jam_mulai AND time(now()) <= j.jam_selesai THEN "false" 
                        WHEN ad.buka_absen = "T" THEN "false" 
                        ELSE "false" 
                        END) AS button_absen'),
            DB::raw('(CASE 
                        WHEN ad.buka_absen = "Y" AND time(now()) >= j.jam_mulai AND time(now()) <= j.jam_selesai AND a.keterangan = "Hadir" THEN "Sudah Absen (Hadir)" 
                        WHEN ad.buka_absen = "Y" AND time(now()) >= j.jam_mulai AND time(now()) <= j.jam_selesai AND a.keterangan = "Alpha" THEN "Belum Absen" 
                        WHEN ad.buka_absen = "N" AND time(now()) >= j.jam_mulai AND time(now()) <= j.jam_selesai THEN "Absen Tidak dibuka" 
                        WHEN ad.buka_absen = "T" AND a.keterangan = "Hadir" THEN "Hadir - Absen Sudah Ditutup!" 
                        WHEN ad.buka_absen = "T" AND a.keterangan = "Alpha" THEN "Alpha - Absen Sudah Ditutup!" 
                        ELSE "Jadwal belum dimulai / Absen belum dibuka oleh dosen" 
                        END) AS status')
        ])
        ->leftJoin('t_tahun_akademik AS ta', 'j.tahun_akademik', '=', 'ta.tahun_akademik')
        ->leftJoin('m_hari AS h', 'j.hari', '=', 'h.nama_hari')
        ->leftJoin('tbl_semester AS s', 'j.id_semester', 's.id_semester')
        ->leftJoin('m_kelas AS k', 'j.id_kelas', '=', 'k.id_kelas')
        ->leftJoin('m_matkul AS m', 'j.id_matkul', '=', 'm.id_matkul')
        ->leftJoin('m_ruang AS r', 'j.id_ruang', '=', 'r.id_ruang')
        ->leftJoin('m_dosen AS d', 'j.id_dosen', '=', 'd.id_dosen')
        ->leftJoin('t_absensi_detail AS ad', function($join) {
            $join->on('ad.id_matkul', '=', 'm.id_matkul');
            $join->on('ad.id_kelas', '=', 'k.id_kelas');
            $join->on('ad.tanggal', '=', DB::raw("date(now())"));
        })
        ->leftJoin('t_absensi AS a', function($join) use ($user) {
            $join->on('a.id_matkul', '=', 'm.id_matkul');
            $join->on('a.id_kelas', '=', 'k.id_kelas');
            $join->on('a.tanggal', '=', DB::raw("date(now())"));
            $join->where('a.nim', '=', $user->nim);
        })
        ->rightJoin('m_kelas_detail AS kd', 'k.id_kelas', '=', 'kd.id_kelas')
        ->where([
            'j.tahun_akademik' => $tahun_akademik,
            'kd.nim' => $user->nim,
            'j.id_waktu_kuliah' => @$krs->id_waktu_kuliah,
            'h.nama_hari' => $day_name
        ])
        ->whereIn('m.id_matkul', $krs_item)
        ->orderBy('h.id_hari', 'ASC')
        ->orderBy('j.jam_mulai', 'ASC')
        ->groupBy('m.kode_matkul')
        ->groupBy('j.jam_mulai')
        ->get();

        $list_jadwal_remedial = DB::table('m_kelas_detail_remedial AS kd')
        ->select([
            'h.nama_hari',
            'j.jam_mulai',
            'j.jam_selesai',
            'r.kode_ruang',
            'r.nama_ruang',
            'k.kode_kelas',
            'k.nama_kelas',
            'm.kode_matkul',
            'm.nama_matkul',
            'm.sks',
            'k.id_prodi',
            'k.kode_kelas',
            'd.nama',
            'd.nip'
        ])
        ->leftJoin('m_kelas AS k', 'kd.id_kelas', 'k.id_kelas')
        ->leftJoin('t_jadwal AS j', function ($join) {
            $join->on('j.id_kelas', 'kd.id_kelas');
            $join->on('j.id_matkul', 'kd.id_matkul');
        })
        ->leftJoin('t_tahun_akademik AS ta', 'j.tahun_akademik', '=', 'ta.tahun_akademik')
        ->leftJoin('m_hari AS h', 'j.hari', '=', 'h.nama_hari')
        ->leftJoin('tbl_semester AS s', 'j.id_semester', 's.id_semester')
        ->leftJoin('m_matkul AS m', 'j.id_matkul', '=', 'm.id_matkul')
        ->leftJoin('m_ruang AS r', 'j.id_ruang', '=', 'r.id_ruang')
        ->leftJoin('m_dosen AS d', 'j.id_dosen', '=', 'd.id_dosen')
        ->where([
            'j.tahun_akademik' => $tahun_akademik,
            'kd.nim' => $user->nim,
            'j.id_waktu_kuliah' => @$krs->id_waktu_kuliah,
            'h.nama_hari' => $day_name
        ])
        ->whereIn('kd.id_matkul', $krs_item)
        ->orderBy('h.id_hari', 'ASC')
        ->orderBy('j.jam_mulai', 'ASC')
        ->groupBy('kode_matkul')
        ->get();

        $list_jadwal = array_merge($list_jadwal->toArray(), $list_jadwal_remedial->toArray());
        $list_jadwal = json_decode(json_encode($list_jadwal), FALSE);

        return $list_jadwal;
    }

    public function absen(Request $request)
    {
        $tahun_akademik = $this->get_now_tahun_akademik();
        if (! empty($tahun_akademik))
            $list_jadwal = $this->get_jadwal($tahun_akademik->tahun_akademik);
        else
            $list_jadwal = [];

        return view('pages.mahasiswa.absensi.absen', compact('list_jadwal'));
    }

    public function save($id_kelas, $id_matkul, $nim, $tanggal,  Request $request)
    {
        $data_absen = Absensi::where([
            'id_kelas' => $id_kelas,
            'id_matkul' => $id_matkul,
            'nim' => $nim,
            'tanggal' => $tanggal
        ])->first();

        if (!empty($data_absen)) {
            $data_absen->update([
            'keterangan' => 'Hadir'
            ]);
        }
        Session::flash('success', 'Berhasil Absen');
        //echo "<script>window.open('".$request->link."', '_blank')</script>";
	return redirect()->to($request->link);
        //return redirect()->back();


        //return redirect()->route('mahasiswa.absen', ['id' =>$id, 'id_matkul' => $id_matkul, 'id_jadwal' => $id_jadwal]);
    }
}