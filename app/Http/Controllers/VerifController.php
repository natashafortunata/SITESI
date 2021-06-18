<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jadwal;
use App\pendaftaran;
use App\detailTransaksi;
use App\transaksi;
use App\User;
use DB;
use Auth;

class VerifController extends Controller
{
    public function verJadwal(){
        $verif = pendaftaran::all();
        //$verif= DB::table('jadwal')->join('pendaftaran','jadwal.id_jadwal','=','pendaftaran.id_daftar')->get();
        return view('verifikasi.verJadwal',compact('verif'));
    }

    public function verifikasiTenan(Request $req){
        pendaftaran::where('id_daftar', $req->get('id_daftar'))->update(['status' => $req->get('status')]);
        return redirect('/verJadwal');
    }





    public function verBayar(){
        // $data_user = User::where('role',0)->get();
        $ver = transaksi::all();
        // $auth = Auth::user()->id;
        // $ver = transaksi::where([
        //     ['id_trx', '=',$auth],
        // ])->get();
        return view('verifikasi.verBayar', compact('ver', ));
    }

    public function verifBayarTenan(Request $req){
        transaksi::where('id_trx', $req->get('id_trx'))->update([
            'status' => $req->get('status'),
            'link_tes' => $req->get('link_tes'),
    ]);
        return redirect('/verBayar');
    }
}
