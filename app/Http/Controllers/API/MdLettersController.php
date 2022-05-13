<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Resources\MdLettersResource;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Md_letters;
use App\Models\Letters;


class MdLettersController extends Controller
{
 
public function all(Request $request){
    // $idletters = Letters::pluck('md_letters_id');
    // $countRelation = Md_letters::where('id','=',$idletters)->count();
    // $mdletters =(new Md_letters)->update(['count_letters'=> $countRelation] );
    $mdletters = (new Md_letters)->withCount('letters')->newQuery();
    $paginate = $request->input('data');
    
        if($request->has('data')){
            $data = $mdletters->where('kind_letter','like','%'.$request->input('search').'%')->paginate($paginate);
            return ResponseFormatter::success($data, 'data berhasil diambil',Response::HTTP_OK);
            
            }
       

    
     $data =  Md_letters::withCount('letters')->paginate($paginate);
   
    //  return $data;
    return ResponseFormatter::success($data, 'data berhasil diambil',Response::HTTP_OK);

    // $getData = MdLettersResource::collection($data);
    //  return ResponseFormatter::success($getData, 'data berhasil diambil',Response::HTTP_OK);

    }
}
