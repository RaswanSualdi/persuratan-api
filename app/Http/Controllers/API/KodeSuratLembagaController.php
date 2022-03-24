<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\KodeSuratLembaga;
use Illuminate\Http\Request;

class KodeSuratLembagaController extends Controller
{

    public function indexKodeSuratLembaga(){
        $kode = KodeSuratLembaga::all();
        return ResponseFormatter::success($kode);
    }


    //mengakses data kodesuratlembaga menggunakan query param
    public function getAll(Request $request){
        $id = $request->input('id');
        
        if($id){
            $kodesurat = KodeSuratLembaga::find($id);
            if($kodesurat){
                return ResponseFormatter::success($kodesurat, 'data berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
            }
        }

        
            



    }
}
