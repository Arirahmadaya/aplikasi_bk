<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Siswa;


class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
     {

         $katakunci = $request->katakunci;
         $jumlahbaris = 5;
         if (strlen($katakunci)) {
             $data = Pelanggaran::with("siswa.kelas")
                 ->whereHas('siswa', function ($query) use ($katakunci) {
                     $query->where('nama', 'like', "%$katakunci%");
                 })
                 ->orWhereHas('siswa.kelas', function ($query) use ($katakunci) {
                     $query->where('kelas', 'like', "%$katakunci%");
                 })
                 ->paginate($jumlahbaris);
         } else {
             $data = Pelanggaran::with("siswa.kelas")
                 ->orderBy('id', 'desc')
                 ->paginate($jumlahbaris);
         }
         return view('pelanggaran/data_pelanggaran')->with('data', $data);
     }
     

    /**
     * Show the form for creating a new resource.
     */
    public function create_pelanggaran()
    {
        $siswa = Siswa::get();
        
        // return $siswa;
            return view('pelanggaran/create',compact('siswa'));
        }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('tingkat_pelanggaran', $request->tingkat_pelanggaran);
        Session::flash('detail_pelanggaran', $request->detail_pelanggaran);
        Session::flash('tgl_pelanggaran', $request->tgl_pelanggaran);
        Session::flash('id_siswa', $request->id_siswa);
        $request->validate([

        ],[
            'tgl_pelanggaran' => 'required',
            
        ]);
        $data = [

            'tgl_pelanggaran' => $request->tgl_pelanggaran,
            'tingkat_pelanggaran' => $request->tingkat_pelanggaran,
            'detail_pelanggaran' => $request->detail_pelanggaran,
            'id_siswa' => $request->id_siswa,
        ];
        Pelanggaran::create($data);
        
        if (Auth::user()->role == 'operator') {
            return redirect()->to('admin/operator/pelanggaran')->with('success', 'Berhasil menambahkan data');

        }
        if (Auth::user()->role == 'guru_bk') {
            return redirect()->to('admin/guru_bk/pelanggaran')->with('success', 'Berhasil menambahkan data');

        }
        if (Auth::user()->role == 'wali_kelas') {
            return redirect()->to('admin/wali_kelas/pelanggaran')->with('success', 'Berhasil menambahkan data');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


       
    $data = Pelanggaran::where("id",$id)->firstOrFail();
    $siswa = Siswa::get();

           return view('pelanggaran/edit',compact('data','siswa'));

    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tgl_pelanggaran' => 'required',

        ],[
            
        ]);
        $data = [
            'tgl_pelanggaran' => $request->tgl_pelanggaran,
            'tingkat_pelanggaran' => $request->tingkat_pelanggaran,
            'detail_pelanggaran' => $request->detail_pelanggaran,
            'id_siswa' => $request->id_siswa,
        ];
        Pelanggaran::where('id', $id)->update($data);
        
        if (Auth::user()->role == 'operator') {
            return redirect()->to('admin/operator/pelanggaran')->with('success', 'Update data berhasil');

        }
        if (Auth::user()->role == 'guru_bk') {
            return redirect()->to('admin/guru_bk/pelanggaran')->with('success', 'Update data berhasil');

        }
        if (Auth::user()->role == 'wali_kelas') {
            return redirect()->to('admin/wali_kelas/pelanggaran')->with('success', 'Update data berhasil');

        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pelanggaran::where('id', $id)->delete();
        if (Auth::user()->role == 'operator') {
            return redirect()->to('admin/operator/pelanggaran')->with('success', 'Data telah di hapus');

        }
        if (Auth::user()->role == 'guru_bk') {
            return redirect()->to('admin/guru_bk/pelanggaran')->with('success', 'Data telah di hapus');

        }

        if (Auth::user()->role == 'wali_kelas') {
            return redirect()->to('admin/wali_kelas/pelanggaran')->with('success', 'Data telah di hapus');

        }
    }
    
    

    
    

    
}
