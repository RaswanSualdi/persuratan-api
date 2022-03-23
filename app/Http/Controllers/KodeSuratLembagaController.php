<?php

namespace App\Http\Controllers;

use App\Models\KodeSuratLembaga;
use Illuminate\Http\Request;

class KodeSuratLembagaController extends Controller
{
    //mengakses data kodesuratlembaga menggunakan query param
    public function getAll(Request $request){
        $id = $request->input('id');
        $slug = $request->input('slug');  //slug hanya bisa diakses url menggunakan garis penghubu
        if($id){
            $kodesurat = KodeSuratLembaga::find($id);
            if($kodesurat){
                return ResponseFormatter::success($kodesurat, 'data berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
            }
        }

        if($slug){
            $kodesurat = KodeSuratLembaga::where('slug', $slug)->find($id);
            if($kodesurat){
                return ResponseFormatter::success($kodesurat, 'data berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
            }

        }
            



    }
}
