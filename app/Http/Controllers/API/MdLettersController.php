<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Md_letters;


class MdLettersController extends Controller
{
 
public function all(Request $request){
    $mdletters = (new Md_letters)->query();

    if($request->has('data')){
        $data =Md_letters::paginate($request->input('data'));
        return ResponseFormatter::success($data, 'data berhasil diambil',Response::HTTP_OK);
        }

        if($request->has('search')){
            return $mdletters->where('kind_letter','like','%'.$request->input('search').'%')->paginate(5);
        }

    
    return Md_letters::paginate(10);

    }
}
