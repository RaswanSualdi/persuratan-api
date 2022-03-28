<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Kodesurat;

class KodeSuratController extends Controller
{

    public function indexKodeSurat(){
        $kode = Kodesurat::all();
        return ResponseFormatter::success($kode);
    }
    //mengakses data kodesurat/jenis surat menggunakan query param
    public function getDataById(Request $request){
        $id = $request->input('id');
        
        if($id){
            $kodesurat = Kodesurat::find($id);
            if($kodesurat){
                return ResponseFormatter::success($kodesurat, 'data berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
            }
        }

        
            



    }
}
