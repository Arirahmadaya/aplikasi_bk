<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class WaliKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if (strlen($katakunci)) {
            $data = WaliKelas::with("user")
                ->where(function ($query) use ($katakunci) {
                    $query->where('nama', 'like', "%$katakunci%");

                })
               
                ->paginate($jumlahbaris);
        } else {
            $data = WaliKelas::with("user")->orderBy('id', 'desc')->paginate($jumlahbaris);
        }
        return view('walikelas/data_walikelas')->with('data', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create_walikelas()
    {
        $user = User::get();
        // return $user;
            return view('walikelas/create',compact('user'));
        }
    
        

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Session::flash('nama', $request->nama);
        Session::flash('id_user', $request->id_user);


        $request->validate([
            'nama' => 'required',


        ],[
            'nama.required' => 'nama wajib diisi',
      
        ]);
        
        $data2 = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'wali_kelas',
        ];
        $user = User::create($data2);
        
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'id_user' => $user->id,
        ];
        WaliKelas::create($data);


            return redirect()->to('admin/operator/walikelas')->with('success', 'Berhasil menambahkan data');

 
        
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


       
    $data = WaliKelas::where("id",$id)->firstOrFail();
    $user = User::get();
    return view('walikelas/edit',compact('data','user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',


        ],[
            'nama.required' => 'nama wajib diisi',
      
        ]);
        
        
        $data = [
            'nama' => $request->nama,
            // 'email' => $request->email,
        ];
        WaliKelas::where('id', $id)->update($data);
            return redirect()->to('admin/operator/walikelas')->with('success', 'Update data berhasil');

       
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        WaliKelas::where('id', $id)->delete();

            return redirect()->to('admin/operator/walikelas')->with('success', 'Data telah di hapus');


    }
    

    
}
