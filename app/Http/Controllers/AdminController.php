<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use App\Models\Konseling;
use App\Models\Riwayat;
use App\Models\Hasil;
use App\Models\WaliKelas;
use App\Models\Operator;
use App\Models\GuruBK;

class AdminController extends Controller
{
    function index(){
        return view('dashboard');
    }

    
    function data_user(){
        $data  = User::paginate(5);
        return view('user/data_user',compact('data'));
 
    }

    function data_siswa(){
        $data  = Siswa::paginate(5);
        return view('siswa/data_siswa',compact('data'));
    }

    function data_siswa_wali_kelas(){
        $user = Auth::user();
        $data = Siswa::whereHas('kelas.wali_kelas', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })->paginate(5);
        return view('siswa/data_siswa',compact('data'));
    }

    function data_kelas(){
        $data  = Kelas::paginate(5);
        return view('kelas/data_kelas',compact('data'));
    }

    function data_pelanggaran_siswa(){
        // return Auth::user()->siswa;

        $user = Auth::user();
        $data = Pelanggaran::whereHas('siswa', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })->paginate(5);
        return view('pelanggaran/data_pelanggaran',compact('data'));
    }

    function data_pelanggaran_guru_bk(){
        // return Auth::user()->siswa;

        $user = Auth::user();
        $data = Pelanggaran::paginate(5);
        return view('pelanggaran/data_pelanggaran',compact('data'));
    }

    function data_pelanggaran_wali_kelas(){
        // return Auth::user()->siswa;

        $user = Auth::user();
        $data = Pelanggaran::whereHas('siswa.kelas.wali_kelas', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })->paginate(5);
        
        return view('pelanggaran/data_pelanggaran',compact('data'));
    }

    function data_konseling_siswa(){
        // return Auth::user()->siswa;

        $user = Auth::user();
        $data = Konseling::whereHas('pelanggaran.siswa', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })->paginate(5);
        return view('konseling/data_konseling',compact('data'));
    }

    function data_konseling(){
        $data  = Konseling::get();
        return view('konseling/data_konseling',compact('data'));
    }

    function data_riwayat(){
        $data  = Riwayat::get();
        return view('riwayat/data_riwayat',compact('data'));
    }

    function data_riwayat_wali_kelas(){
        $user = Auth::user();
        $data = Riwayat::whereHas('konseling.pelanggaran.siswa.kelas.wali_kelas', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })->paginate(5);
        return view('riwayat/data_riwayat',compact('data'));
    }

    function data_hasil(){
        $data  = Hasil::get();
        return view('hasil/data_hasil',compact('data'));
    }


    function data_walikelas(){
        $data  = WaliKelas::paginate(5);
        return view('walikelas/data_walikelas',compact('data'));
    }

    function data_operator(){
        $data  = Operator::paginate(5);
        return view('operator/data_operator',compact('data'));
    }

    function data_gurubk(){
        $data  = GuruBK::paginate(5);
        return view('gurubk/data_gurubk',compact('data'));
    }

    


    function guru_bk(){
        return view('dashboard');
    }

    function wali_kelas(){
        return view('dashboard');
    }

    function siswa(){
        return view('dashboard');
    }

    function operator(){
        return view('dashboard');
    }

}
