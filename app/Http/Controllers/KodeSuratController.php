<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kodesurat;

class KodeSuratController extends Controller
{
    public function getAll(Request $request){
        $id = $request->input('id');
        $slug = $request->input('slug');  //slug hanya bisa diakses url menggunakan garis penghubung
        if($id){
            $kodesurat = Kodesurat::find($id);
            if($kodesurat){
                return ResponseFormatter::success($kodesurat, 'data berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
            }
        }

        if($slug){
            $kodesurat = Kodesurat::where('slug', $slug)->find($id);
            if($kodesurat){
                return ResponseFormatter::success($kodesurat, 'data berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
            }

        }
            



    }
}
