<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use App\User;
use App\pendaftaran; //untuk grafik
use App\tes;

class adminController extends Controller
{
    public function view(){
        $hasil = [];
        $pilih = pendaftaran::get();
        foreach ($pilih as $key => $plh) {
            $id_daftar = $plh->id_daftar;
            $id_tes = $plh->id_tes;
            $total = pendaftaran::where('id_tes',$id_daftar)->count();
            // $a['name'] = tes::where('namaTes')->get();
            // $a['y'] = $total;
        array_push($hasil/*,$a*/);
        }
    return view('Layout.layout',compact('hasil',/*'a'*/));
    }

    public function viewAdmin(){
        $data_admin = admin::all();//menampilkan semua atribut yang sudah di seleksi di model
        return view('Layout.index',compact('data_admin'));
    }

    public function viewInputAdmin(){
        return view('Layout.tambahAdmin');
    }

    public function tambahAdmin(Request $request){
        \App\admin :: create($request->all());
        return redirect('listAdmin')->with('sukses','Data Admin berhasil ditambahkan !');
    }

    public function findEdit($id_admin){
        $data_admin = admin::find($id_admin);
        $data = [
            'tittle'=> 'admin',
            'data_admin'=>$data_admin
        ];
        return view('Layout.editAdmin',$data);
    }
    public function editAdmin($id_admin, Request $request){
        $this->validate($request,[
            'nik'=> 'required',
            'nama'=>'required',
            'jk' => 'required',
            'hp' => 'required'
        ]);

        $data_admin = admin::find($id_admin);
        $data_admin->nik = $request->nik;
        $data_admin->nama = $request->nama;
        $data_admin->jk = $request->jk;
        $data_admin->hp=$request->hp;
        $data_admin->save();
        return redirect('listAdmin')->with('sukses','Data Admin berhasil diubah !');
    }

    public function deleteAdmin($id_admin){
        $data_admin = admin::find($id_admin);
        $data_admin->delete();
        return redirect('listAdmin')->with('sukses', 'Data Admin berhasil dihapus !');
    }

    public function daftarUser(){
        $data_user = user::where('role',0)->get();
        //dd($data_user);
        return view('Layout.daftarUser',compact('data_user'));
    }
}
