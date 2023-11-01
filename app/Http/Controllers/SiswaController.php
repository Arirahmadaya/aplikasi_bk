<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kelas;
use App\Models\User;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if (strlen($katakunci)) {
            $data = Siswa::with("kelas", "user")
                ->where(function ($query) use ($katakunci) {
                    $query->where('nama', 'like', "%$katakunci%")
                          ->orWhere('nis', 'like', "%$katakunci%");
                })
                ->orWhereHas('kelas', function ($query) use ($katakunci) {
                    $query->where('kelas', 'like', "%$katakunci%");
                })
                ->paginate($jumlahbaris);
        } else {
            $data = Siswa::with("kelas")->orderBy('id', 'desc')->paginate($jumlahbaris);
        }
        return view('siswa/data_siswa')->with('data', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create_siswa()
    {
        $kelas = Kelas::get();
        $user = User::get();
        // return $siswa;
            return view('siswa/create',compact('kelas', 'user'));
        }
    
        

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nis', $request->nis);
        Session::flash('nama', $request->nama);
        Session::flash('tmp_lahir', $request->tmp_lahir);
        Session::flash('tgl_lahir', $request->tgl_lahir);
        Session::flash('jk', $request->jk);
        Session::flash('nohp', $request->nohp);
        Session::flash('nohp_ortu', $request->nohp_ortu);
        Session::flash('alamat', $request->alamat);
        Session::flash('id_kelas', $request->id_kelas);
        Session::flash('id_user', $request->id_user);


        $request->validate([
            'nis' => 'required|numeric',


        ],[
            'nis.required' => 'nis wajib diisi',
            'nis.numeric' => 'nis wajib berisi angka',
      
        ]);
        
        $data2 = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'siswa',
        ];
        $user = User::create($data2);
        
        $data = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'nohp_ortu' => $request->nohp_ortu,
            'alamat' => $request->alamat,
            'id_kelas' => $request->id_kelas,
            'id_user' => $user->id,
        ];
        Siswa::create($data);

        if (Auth::user()->role == 'operator') {
            return redirect()->to('admin/operator/siswa')->with('success', 'Berhasil menambahkan data');

        }
        if (Auth::user()->role == 'guru_bk') {
            return redirect()->to('admin/guru_bk/siswa')->with('success', 'Berhasil menambahkan data');

        }
        if (Auth::user()->role == 'wali_kelas') {
            return redirect()->to('admin/wali_kelas/siswa')->with('success', 'Berhasil menambahkan data');

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

       
    $data = Siswa::where("id",$id)->firstOrFail();
    $kelas = Kelas::get();
    return view('siswa/edit',compact('data','kelas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nis' => 'required|numeric',


        ],[
            'nis.required' => 'nis wajib diisi',
            'nis.numeric' => 'nis wajib berisi angka',
      
        ]);
        
        
        
        $data = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            // 'email' => $request->email,
            'nohp' => $request->nohp,
            'nohp_ortu' => $request->nohp_ortu,
            'alamat' => $request->alamat,
            'id_kelas' => $request->id_kelas,
        
        ];
        Siswa::where('id', $id)->update($data);
        if (Auth::user()->role == 'operator') {
            return redirect()->to('admin/operator/siswa')->with('success', 'Update data berhasil');

        }
        if (Auth::user()->role == 'guru_bk') {
            return redirect()->to('admin/guru_bk/siswa')->with('success', 'Update data berhasil');

        }

        if (Auth::user()->role == 'wali_kelas') {
            return redirect()->to('admin/wali_kelas/siswa')->with('success', 'Update data berhasil');

        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Siswa::where('id', $id)->delete();
        if (Auth::user()->role == 'operator') {
            return redirect()->to('admin/operator/siswa')->with('success', 'Data telah di hapus');

        }
        if (Auth::user()->role == 'guru_bk') {
            return redirect()->to('admin/guru_bk/siswa')->with('success', 'Data telah di hapus');

        }

        if (Auth::user()->role == 'wali_kelas') {
            return redirect()->to('admin/wali_kelas/siswa')->with('success', 'Data telah di hapus');

        }
    }
    

    
}
