<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Kodesurat;

class KodeSuratController extends Controller
{
 
    public function all(Request $request){
        $id = $request->input('id');
        
        if($id){
            $kodesurat = Kodesurat::find($id);
            if($kodesurat){
                return ResponseFormatter::success($kodesurat, 'data berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
            }
        }

        $kodesurat = Kodesurat::paginate(8);
        return ResponseFormatter::success($kodesurat, 'data berhasil diambil', 200);
        

    }
}
