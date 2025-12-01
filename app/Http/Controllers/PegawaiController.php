<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;


class PegawaiController extends Controller
{
    public function index(){
        $datanya = Pegawai::getAllData();
        return view('pegawai', compact('datanya'));
    }

    public function update(Request $r, $id){
        $pegawai = Pegawai::find($id);

        $data = $r->only(['nama','jabatan','jenis_kelamin','tanggal_lahir']);

        if($r->hasFile('foto')){
            // Hapus file lama
            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            // Simpan foto baru
            $data['foto'] = $r->file('foto')->store('foto_pegawai','public');
        }

        Pegawai::updateData($id,$data);
        return back()->with('success','Data berhasil diupdate');
    }

    public function store(Request $r){
        $data = $r->only(['nama','jabatan','jenis_kelamin','tanggal_lahir']);

        if($r->hasFile('foto')){
            $data['foto'] = $r->file('foto')->store('foto_pegawai','public');
        }

        Pegawai::insertData($data);

        return back()->with('success','Data berhasil disimpan');
    }

    public function delete($id){
        $pegawai = Pegawai::find($id);

        // Hapus foto lebih dulu
        if ($pegawai && $pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        // Hapus record database
        Pegawai::deleteData($id);

        return back()->with('success','Data berhasil dihapus');
    }
    public function generate_pdf(){
        $data = [
            'data' => Pegawai::GetAllData()
        ];

        $pdf = Pdf::LoadView("pdf_pegawai", $data);
        
        return $pdf->stream("Pegawai.pdf");
    }

    public function generate_excel(){
        return Excel::download(new UsersExport, 'Pegawai.xlsx');
    }
}
