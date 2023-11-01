<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if (strlen($katakunci)) {
            $data = User::select('nama', 'role')
                ->where('nama', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = User::select('nama', 'role')
                ->orderBy('id', 'desc')
                ->paginate($jumlahbaris);
        }
        return view('user/data_user')->with('data', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create_user()
    {
        $data = User::get();

            return view('user/create',compact('data'));
        }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama', $request->nama);
        Session::flash('email', $request->email);
        Session::flash('password', $request->password);
        Session::flash('role', $request->role);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email',


        ],[
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',

       
        ]);
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ];
        User::create($data);
        return redirect()->to('admin/operator/user')->with('success', 'Berhasil menambahkan data');
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
       $data = User::where('id', $id)->first();
       return view('user/edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',



        ],[
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
 
        ]);
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ];
        User::where('id', $id)->update($data);
        return redirect()->to('admin/operator/user')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->to('admin/operator/user')->with('success', 'Berhasil menghapus data');
    }

    public function profile()
{
    $user = auth()->user();
    return view('profile')->with('user', $user);
}
    
}
