<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\WaliKelas;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if(strlen($katakunci)){
            $data = Kelas::with('wali_kelas')->where('kelas', 'like', "%$katakunci%")
            ->orWhereHas('wali_kelas', function ($query) use ($katakunci) {
                $query->where('nama', 'like', "%$katakunci%");
            })
            ->paginate($jumlahbaris);

        }else{
            $data = Kelas::with("wali_kelas")->orderBy('id', 'desc')->paginate($jumlahbaris);
        }
        return view('kelas/data_kelas')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_kelas()
    {
        $wali_kelas = WaliKelas::get();
        // return $siswa;
            return view('kelas/create',compact('wali_kelas'));
        }
    
        

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('kelas', $request->kelas);
        Session::flash('jumlah_siswa', $request->jumlah_siswa);
        Session::flash('id_wali_kelas', $request->id_wali_kelas);

        $request->validate([
            'kelas' => 'required',


        ],[
            'kelas.required' => 'Kelas wajib diisi',
      
        ]);
        $data = [
            'kelas' => $request->kelas,
            'jumlah_siswa' => $request->jumlah_siswa,
            'id_wali_kelas' => $request->id_wali_kelas,
        ];
        Kelas::create($data);
        if (Auth::user()->role == 'operator') {
            return redirect()->to('admin/operator/kelas')->with('success', 'Berhasil menambahkan data');
        }
        if (Auth::user()->role == 'guru_bk') {
            return redirect()->to('admin/guru_bk/kelas')->with('success', 'Berhasil menambahkan data');
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
    //    $data = Kelas::where('id', $id)->first();
    //    return view('kelas/edit')->with('data', $data);

       
    $data = Kelas::where("id",$id)->firstOrFail();
    $wali_kelas = WaliKelas::get();
       #
       // return $siswa;
           return view('kelas/edit',compact('data','wali_kelas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kelas' => 'required',
            'jumlah_siswa' => 'required|numeric',
            //'id_wali_kelas' => 'required|unique:kelas,id_wali_kelas',

        ],[
            'kelas.required' => 'Kelas wajib diisi',
            'jumlah_siswa.required' => 'Jumlah Siswa wajib diisi',
            'wali_kelas.required' => 'Wali kelas wajib diisi',
            'id_wali_kelas.required' => 'id wali Kelas wajib diisi',
            
        ]);
        $data = [
            'kelas' => $request->kelas,
            'jumlah_siswa' => $request->jumlah_siswa,
            'id_wali_kelas' => $request->id_wali_kelas,
        ];
        Kelas::where('id', $id)->update($data);
        if (Auth::user()->role == 'operator') {
            return redirect()->to('admin/operator/kelas')->with('success', 'Update data berhasil');
        }
        if (Auth::user()->role == 'guru_bk') {
            return redirect()->to('admin/guru_bk/kelas')->with('success', 'Update data berhasil');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kelas::where('id', $id)->delete();
        if (Auth::user()->role == 'operator') {
            return redirect()->to('admin/operator/kelas')->with('success', 'Data telah di hapus');

        }
        if (Auth::user()->role == 'guru_bk') {
            return redirect()->to('admin/guru_bk/kelas')->with('success', 'Data telah di hapus');

        }

    }
    

    
}
