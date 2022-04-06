<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;


use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\FormatSuratRequest;
use App\Http\Resources\FormatSuratResource;
use App\Models\Letters;
use App\Models\Md_companies;
use App\Models\Md_letters;
use DateTime;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\QueryBuilder;
// use Spatie\QueryBuilder\AllowedFilter;

class LettersController extends Controller
{

    public function addLetter(Request $req, FormatSuratRequest $request){
        $id = $req->input('id');
         if($id){

         
        $year = Carbon::parse($request->tgl_surat)->format('y');
        
        $requestMonth = Carbon::parse($request->tgl_surat)->format('m');

        //untuk mengambil key id dan key bulan_surat yang ada pada model Format/ tabel format
        $getId=Letters::all('id','month_letter');
        // mengambil array yang mempunyai id terbesar pada table format
        if(!$getId->isEmpty()){
                        $getId=Letters::all('id','month_letter')->toArray();
                        $getMaxId=max($getId);
                    //tanggal surat yang akan dimasukkan kedalam field tgl surat pada table format
                    // $tgl_surat = Carbon::now();  
                    $tgl_surat = Carbon::parse($request->tgl_surat);
                    //array asosiatif untuk mengubah bulan ke angka romawi
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
                    $geekmonth = $geekmonths[$requestMonth];
                    $strToSlug = Str::slug($request->deskripsi);

                    //untuk menghitung jumlah data yang ada sebelum bulan ini, bulan ini, dan total bulan lalu dan bulan ini
                   
                    $PresentMonthCount =Letters::where('month_letter','=', $requestMonth)->pluck('id')->count()+1;
                    
                    
                    //mengambil id dari table kode_surat dan table kode_surat_lembaga agar dapat mengakses kode dari masing masing table
                    $idkodelembaga = $request->company;
                    $kodesurat = Md_letters::find($id);
                    $kodelembaga = Md_companies::find($idkodelembaga);
    
                    //menghitung digit untuk business logic dari kode surat
                    $digit = strlen($PresentMonthCount);
                    
                    
                
                //business logic kode surat upana
                    if($digit ===1 ){
                        
                        if($getMaxId['month_letter']==$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'md_letters_id'=>$id,
                                'letter'=>'No.00'.$PresentMonthCount  .'/'.$kodelembaga->letter.'/'.$kodesurat->letter.'/'.$geekmonth.'/20'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            ]);

                        } elseif($getMaxId['month_letter']!=$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'md_letters_id'=>$id,
                                'letter'=>'No.00'.$PresentMonthCount  .'/'.$kodelembaga->letter.'/'.$kodesurat->letter.'/'.$geekmonth.'/20'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            ]);
                        }
                
                    
                    }elseif($digit===2){
                        
                        if($getMaxId['month_letter']==$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'md_letters_id'=>$id,
                                'letter'=>'No.0'.$PresentMonthCount  .'/'.$kodelembaga->letter.'/'.$kodesurat->letter.'/'.$geekmonth.'/20'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                            ]);
                        }

                        elseif($getMaxId['month_letter']!=$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'md_letters_id'=>$id,
                                'letter'=>'No.0'.$PresentMonthCount  .'/'.$kodelembaga->letter.'/'.$kodesurat->letter.'/'.$geekmonth.'/20'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            ]);
                        }
                    
                    }else{
                        
                        if($getMaxId['month_letter']==$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'md_letters_id'=>$id,
                                'letter'=>'No.'.$PresentMonthCount  .'/'.$kodelembaga->letter.'/'.$kodesurat->letter.'/'.$geekmonth.'/20'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                            ]);
                        }

                        elseif($getMaxId['month_letter']!=$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'md_letters_id'=>$id,
                                'letter'=>'No.'.$PresentMonthCount  .'/'.$kodelembaga->letter.'/'.$kodesurat->letter.'/'.$geekmonth.'/20'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            ]);
                        }
            
        }
        

        return ResponseFormatter::success($format,'data berhasil dibuat', Response::HTTP_CREATED);
    }elseif($getId->isEmpty()){
                            //tanggal surat yang akan dimasukkan kedalam field tgl surat pada table format
                            $tgl_surat = Carbon::parse($request->tgl_surat);  
                            //array asosiatif untuk mengubah bulan ke angka romawi
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
                            $geekmonth = $geekmonths[$requestMonth];
                            $strToSlug = Str::slug($request->deskripsi);

                            //untuk menghitung jumlah data yang ada sebelum bulan ini, bulan ini, dan total bulan lalu dan bulan ini
                            //  $PassedMonthCount=Format::where('bulan_surat','<', $thisMonth)->pluck('id')->count();
                            $PresentMonthCount =Letters::where('month_letter','=', $requestMonth)->pluck('id')->count()+1;
                            
                            $idkodelembaga = $request->company;
                            //mengambil id dari table kode_surat dan table kode_surat_lembaga agar dapat mengakses kode dari masing masing table
                            $kodesurat = Md_letters::find($id);
                            $kodelembaga = Md_companies::find($idkodelembaga);
                        
                            //menghitung digit untuk business logic dari kode surat
                            $digit = strlen($PresentMonthCount);
                            
                            
                        
                        
                        $format = Letters::create([
                            'month_letter'=> $requestMonth,
                                'md_letters_id'=>$id,
                                'letter'=>'No.00'.$PresentMonthCount  .'/'.$kodelembaga->letter.'/'.$kodesurat->letter.'/'.$geekmonth.'/20'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                        
                        ]);
                        return ResponseFormatter::success($format,'data berhasil dibuat', Response::HTTP_CREATED);
    }

}

}

    public function updateFormat(FormatSuratRequest $request, $idformat){
                    $format = Letters::find($idformat);
                    if(!$format){
                        return ResponseFormatter::error(null, 'data tidak ditemukan',404);
                    }

                    $data = $request->all();
                    $format->fill($data);
                    $format->save();

                    return ResponseFormatter::success($format, 'data berhasil diupdate',Response::HTTP_OK);
                }

    // public function getFormat($req->input('id')){
    //             $formatsurat= Kodesurat::with('format')->find($idletter);
    //             return ResponseFormatter::success($formatsurat, 'data berhasil diambil',200);
    // }

    public function all(Request $request){

        $letters = (new Letters)->NewQuery();
        $mdletters = (new Md_letters)->query();

        if($request->has('search')){
            return $mdletters->where('kind_letter','like','%'.$request->input('search').'%')->get();
        }

        if ($request->has('id')&&$request->has('query')){
            $letters->whereHas('md_letters',function($query) use($request){
                $query->where('id', $request->input('id'));
            })->where('description','like','%'. $request->input('query').'%');
            return $letters->get();
        }


       
        if($request->has('id')){
            $letters->whereHas('md_letters', function($query) use($request){
                $query->where('id',$request->input('id'));
            });
            return $letters->get();
        }

        

        return Md_letters::paginate(10);
                
                
                
               
    }



}
