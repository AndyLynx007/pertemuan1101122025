<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    //
    public function index(){
        $datanya = Pegawai::getAllData();
        return view('pegawai', compact('datanya'));
    }

    public function update(Request $r, $id){
        $data = $r->only(['nama','jabatan','jenis_kelamin','tanggal_lahir']);
        if($r->hasFile('foto')){
            $data['foto'] = $r->file('foto')->store('foto_pegawai','public');
        }
        Pegawai::updateData($id,$data);
        return back()->with('success','Data berhasil diupdate');
    }

    public function store(Request $r){
        $data = $r->only(['nama','jabatan','jenis_kelamin','tanggal_lahir']);
        if($r->hasFile('foto')){
            $data['foto'] = $r->file('foto')->store('foto_pegawai','public');
            Pegawai::insertData($data);
             return back()->with('success','Data berhasil disimpan');
        }
    }

    public function delete($id){
        //echo($id);
        Pegawai::deleteData($id);
        return back()->with('success','Data berhasil dihapus');
    }

}
