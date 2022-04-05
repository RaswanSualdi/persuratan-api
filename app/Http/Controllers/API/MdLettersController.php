<?php

// namespace App\Http\Controllers\API;
// use App\Http\Controllers\Controller;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Http\Request;
// use App\Models\Kodesurat;
// use App\Models\Format;

// class KodeSuratController extends Controller
// {
 
//     public function all(Request $request){
//         $id = $request->input('id');
//         // $letter = $request->input('letter');
        
//         if($id){
//             $kodesurat = Kodesurat::find($id);
//             if($kodesurat){
//                 return ResponseFormatter::success($kodesurat, 'data berhasil diambil',Response::HTTP_OK);
//             }else{
//                 return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
//             }
//         } 

//         $kodesurat = Kodesurat::with('format')->paginate(8);
//         return ResponseFormatter::success($kodesurat, 'data berhasil diambil', 200);
        

//     }

//     public function searchKodeSurat(Request $request){

//         $searchkode = $request->input('kode');
//         $searchslug = $request->input('slug');
//         if($searchkode){
//             $data = Kodesurat::where('kode', 'like','%'.$searchkode.'%')->first();
//             if($data){
//                 return ResponseFormatter::success($data,'data berhasil diambil',200);
//             }
            
//         }

//         if($searchslug){
//             $data = Kodesurat::where('slug', 'like','%'.$searchslug.'%')->first();
//             if($data){
//                 return ResponseFormatter::success($data,'data berhasil diambil',200);
//             }
           
//         }
       
//     }
// }
