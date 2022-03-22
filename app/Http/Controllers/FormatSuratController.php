<?php

namespace App\Http\Controllers;

use App\Models\Kodesurat;
use App\Models\Format;
use App\Models\KodeSuratLembaga;
use App\Http\Requests\FormatSuratRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FormatSuratController extends Controller
{
    
    
    public function format(FormatSuratRequest $request, $idkodesurat, $idkodelembaga){
       
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        $tgl_surat = Carbon::now();
       
        // $realMonth = Carbon::now()->addRealMinute()->isNextMinute(); //kode ini salah karena dia tidak akan pernah mencapai bulan ini
        // dd($realMonth);
        $geekmonths = [
         '01'=>'I',
         '02'=>'II',
         '03'=>'III',
         '04'=>'IV',
         '05'=>'V',
         '06'=>'VI',
         '07'=>'VII',
         '08' =>'VIII',
         '09'=>'IX',
         '10'=>'X',
         '11'=> 'XI',
         '12'=> 'XII'
        ];
        $geekmonth = $geekmonths[$month];
        // dd($geekmonth);

        $kodesurat = Kodesurat::find($idkodesurat);
        $kodelembaga = KodeSuratLembaga::find($idkodelembaga);
        $countbyId = Format::all()->count();
        $formatId = $countbyId + 1;
        $digit = strlen($formatId);
        $strToSlug = Str::slug($request->deskripsi);
         if($digit ===1 ){
            //  if($realMonth){
            //     $format = Format::create([
            //         'format'=>'No.00'.strval($formatId-$countbyId).'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
            //         'deskripsi'=>$request->deskripsi,
            //     ]);
            //  }
             $format = Format::create([
                'format'=>'No.00'.$formatId.'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
                'deskripsi'=>$request->deskripsi,
                'tgl_surat'=>$tgl_surat,
                'slug'=> $strToSlug
            ]);
           
        }elseif($digit===2){
            // if($realMonth){
            //     $format = Format::create([
            //         'format'=>'No.00'.strval($formatId-$countbyId).'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth. '/20'.$year,
            //         'deskripsi'=>$request->deskripsi,
            //     ]);
            // }
            $format = Format::create([
                'format'=>'No.0'.$formatId.'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
                'deskripsi'=>$request->deskripsi,
                'tgl_surat'=>$tgl_surat,
                'slug'=> $strToSlug
            ]);
        }else{
            // if($realMonth){
            //     $format = Format::create([
            //         'format'=>'No.00'.strval($formatId-$countbyId).'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
            //         'deskripsi'=>$request->deskripsi,
            //     ]);
            // }
            $format = Format::create([
                'format'=>'No.'.$formatId.'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
                'deskripsi'=>$request->deskripsi,
                'tgl_surat'=>$tgl_surat,
                'slug'=> $strToSlug
            ]);
        }
        

        return ResponseFormatter::success($format);

    }

    public function getAll(Request $request){
        $id = $request->input('id');
        $slug = $request->input('slug');  //slug hanya bisa diakses url menggunakan garis penghubung
        if($id){
            $formatsurat = Format::find($id);
            if($formatsurat){
                return ResponseFormatter::success($formatsurat, 'data berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
            }
        }

        if($slug){
            $formatsurat = Format::where('slug', $slug)->find($id);
            if($formatsurat){
                return ResponseFormatter::success($formatsurat, 'data berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
            }

        }
    }
}
