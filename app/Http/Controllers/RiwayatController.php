<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Konseling;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if(strlen($katakunci)){
            $data = Riwayat::with("konseling.pelanggaran.siswa")
            ->whereHas('konseling', function ($query) use ($katakunci) {
                $query->where('status', 'like', "%$katakunci%")
                      ->orWhere('jadwal_konseling', 'like', "%$katakunci%");
                    
            })
            ->orwhereHas('konseling.pelanggaran', function ($query) use ($katakunci) {
                $query->where('tingkat_pelanggaran', 'like', "%$katakunci%")
                      ->orWhere('detail_pelanggaran', 'like', "%$katakunci%");
            })
            ->orWhereHas('konseling.pelanggaran.siswa', function ($query) use ($katakunci) {
                $query->where('nama', 'like', "%$katakunci%")
                      ->orWhere('nis', 'like', "%$katakunci%")
                      ->orWhere('jk', 'like', "%$katakunci%");
            })
            ->orWhereHas('konseling.pelanggaran.siswa.kelas', function ($query) use ($katakunci) {
                $query->where('kelas', 'like', "%$katakunci%");
                })
                ->paginate($jumlahbaris);
        }else{
            $data = Riwayat::with("konseling.pelanggaran.siswa")->orderBy('id', 'desc')->paginate($jumlahbaris);
        }
        return view('riwayat/data_riwayat')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_riwayat()
    {
        $konseling = Konseling::with("pelanggaran.siswa.kelas.wali_kelas")->get();
        //return $konseling;
            return view('riwayat/create',compact('konseling'));
              
            
            
        }
        

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Session::flash('id_konseling', $request->id_konseling);


  
        $data = [
            'id_konseling' => $request->id_konseling,
        ];
        Riwayat::create($data);
        return redirect()->to('admin/guru_bk/riwayat')->with('success', 'Berhasil menambahkan data');
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
       
    $data = Riwayat::where("id",$id)->firstOrFail();
    $konseling = Konseling::get();
       #
       // return $siswa;
           return view('riwayat/edit',compact('data','konseling'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
   

        ],);
        $data = [
            'id_konseling' => $request->id_konseling,
        ];
        Riwayat::where('id', $id)->update($data);
        return redirect()->to('admin/guru_bk/riwayat')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Riwayat::where('id', $id)->delete();
        return redirect()->to('admin/guru_bk/riwayat')->with('success', 'Berhasil menghapus data');
    }
    

    
}
