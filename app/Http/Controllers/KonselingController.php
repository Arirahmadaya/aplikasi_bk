<?php

namespace App\Http\Controllers;


use App\Models\Konseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pelanggaran;
use App\Models\User;

class KonselingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if (strlen($katakunci)) {
            $data = Konseling::with("pelanggaran.siswa.kelas")
                ->whereHas('pelanggaran', function ($query) use ($katakunci) {
                    $query->where('tingkat_pelanggaran', 'like', "%$katakunci%")
                          ->orWhere('detail_pelanggaran', 'like', "%$katakunci%");
                        
                })
                ->orWhereHas('pelanggaran.siswa', function ($query) use ($katakunci) {
                    $query->where('nama', 'like', "%$katakunci%")
                          ->orWhere('nis', 'like', "%$katakunci%")
                          ->orWhere('jk', 'like', "%$katakunci%");
                })
                ->orWhereHas('pelanggaran.siswa.kelas', function ($query) use ($katakunci) {
                    $query->where('kelas', 'like', "%$katakunci%");
                })
                ->orWhere('status', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = Konseling::with("pelanggaran.siswa.kelas")
                ->orderBy('id', 'desc')
                ->paginate($jumlahbaris);
        }
        return view('konseling/data_konseling')->with('data', $data);
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create_konseling()
    {
        $pelanggaran = Pelanggaran::with("siswa.kelas.wali_kelas")->get();
        // return $pelanggaran;
            return view('konseling/create',compact('pelanggaran'));

            $user = User::get();
            return $user;
    
            
            
        }
        

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('jadwal_konseling', $request->jadwal_konseling);
        Session::flash('status', $request->status);
        Session::flash('id_pelanggaran', $request->id_pelanggaran);
        Session::flash('id_user', $request->id_user);

        $request->validate([
            'jadwal_konseling' => 'required',
        ],[
            'jadwal_konseling.required' => 'Jadwal wajib diisi',
      
        ]);
        $data = [
            'jadwal_konseling' => $request->jadwal_konseling,
            'status' => $request->status,
            'id_pelanggaran' => $request->id_pelanggaran,
            'id_user' => $request->id_user,
        ];
        Konseling::create($data);
        return redirect()->to('admin/guru_bk/konseling')->with('success', 'Berhasil menambahkan data');
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
    // public function edit(string $id)
    // {
       
    // $data = Konseling::where("id",$id)->firstOrFail();
    // $pelanggaran = Pelanggaran::get();
    //    #
    //    // return $siswa;
    //        return view('konseling/edit',compact('data','pelanggaran'));

    // }
    public function edit(string $id)
    {
        $data = Konseling::find($id);
        $pelanggaran = Pelanggaran::all();

        return view('konseling/edit', compact('data', 'pelanggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jadwal_konseling' => 'required',

        ],[
            'jadwal_konseling.required' => 'Jadwal wajib diisi',
            
        ]);
        $data = [
            'jadwal_konseling' => $request->jadwal_konseling,
            'status' => $request->status,
            'id_pelanggaran' => $request->id_pelanggaran,
            'id_user' => $request->id_user,
        ];
        Konseling::where('id', $id)->update($data);
        return redirect()->to('admin/guru_bk/konseling')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Konseling::where('id', $id)->delete();
        return redirect()->to('admin/guru_bk/konseling')->with('success', 'Berhasil menghapus data');
    }

    public function create($pelanggaranId)
{
    $pelanggaran = Pelanggaran::find($pelanggaranId);
    // Lakukan operasi logika bisnis yang diperlukan, seperti mendapatkan data pelanggaran berdasarkan ID

    return view('konseling.create', compact('pelanggaran'));
}
    

    
}
