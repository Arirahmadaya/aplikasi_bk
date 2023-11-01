<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
      return view('login');
    }

    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],
        [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Passsword wajib diisi', 
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
           if(Auth::user()->role == 'operator'){
            return redirect('admin/operator');
           }elseif(Auth::user()->role == 'wali_kelas'){
            return redirect('admin/wali_kelas');
           }elseif(Auth::user()->role == 'guru_bk'){
            return redirect('admin/guru_bk');
           }elseif(Auth::user()->role == 'siswa'){
            return redirect('admin/siswa');
           }
        }else{
            return redirect('')->withErrors('Email atau Password yang di masukkan tidak sesuai')->withInput();
        }
    }
    

    
    function logout()   
    {
     Auth::logout();  
     return redirect('');
 }
}
