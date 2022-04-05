<?php

// namespace App\Http\Controllers\API;
// use App\Http\Controllers\Controller;

// use App\Models\KodeSuratLembaga;
// use Illuminate\Http\Request;

// class MdCompaniesController extends Controller
// {
//     public function all(Request $request){
//         $id = $request->input('id');
        
//         if($id){
//             $kodelembaga = KodeSuratLembaga::find($id);
//             if($kodelembaga){
//                 return ResponseFormatter::success($kodelembaga, 'data berhasil diambil');
//             }else{
//                 return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
//             }
//         } 

//         $kodelembaga = KodeSuratLembaga::paginate(8);
//         return ResponseFormatter::success($kodelembaga, 'data berhasil diambil',200);
        

//     }
// }
