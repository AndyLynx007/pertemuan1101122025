<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pegawai extends Model
{
    //properti 
    protected $table = 'pegawais';
    protected $primaryKey = 'id';
    protected $fillable = ['nama','jabatan','jenis_kelamin','tanggal_lahir','foto'];

    public static function getAllData(){
        return self::all();
    }

    public static function insertData($data){
        return self::create($data);
    }

    public static function updateData($id_target, $data){
        return self::where('id',$id_target)->update($data);
    }

    public static function deleteData($id_target){
        return self::where('id',$id_target)->delete();
    }


}
