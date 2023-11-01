<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Konseling;


class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if(strlen($katakunci)){
            $data = Hasil::with("konseling.pelanggaran.siswa")
                ->whereHas('konseling.pelanggaran.siswa', function ($query) use ($katakunci) {
                    $query->where('nama', 'like', "%$katakunci%");
                })
                ->paginate($jumlahbaris);
        }else{
            $data = Hasil::with("konseling.pelanggaran.siswa")->orderBy('id', 'desc')->paginate($jumlahbaris);
        }
        return view('hasil/data_hasil')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_hasil()
    {
        $konseling = Konseling::with("pelanggaran.siswa.kelas")->get();
        //return $konseling;
            return view('hasil/create',compact('konseling'));
            
        }
        

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Session::flash('id_konseling', $request->id_konseling);
        Session::flash('catatan', $request->catatan);


  
        $data = [
            'id_konseling' => $request->id_konseling,
            'catatan' => $request->catatan,
        ];
        Hasil::create($data);
        return redirect()->to('admin/guru_bk/hasil')->with('success', 'Berhasil menambahkan data');
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
       
    // $data = Hasil::where("id",$id)->firstOrFail();
    // $konseling = Konseling::get();
    //    #
    //    // return $siswa;
    //        return view('hasil/edit',compact('data','konseling'));

    public function edit(string $id)
    {
        $data = Hasil::find($id);
        $konseling = Konseling::all();

        return view('hasil/edit', compact('data', 'konseling'));
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
            'catatan' => $request->catatan,
        ];
        Hasil::where('id', $id)->update($data);
        return redirect()->to('admin/gurubk/hasil')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Hasil::where('id', $id)->delete();
        return redirect()->to('admin/guru_bk/hasil')->with('success', 'Berhasil menghapus data');
    }

    public function cetak_hasil()
    {
      
        $hasil = Hasil::with("konseling.pelanggaran.siswa.kelas")->get();
        //return $konseling;
            return view('hasil/cetak_hasil',compact('hasil'));
            
        }

        
    
}
