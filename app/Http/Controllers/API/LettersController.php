<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;


use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\FormatSuratRequest;

use App\Models\Letters;
use App\Models\Md_companies;
use App\Models\Md_letters;
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
    
    public function letter(FormatSuratRequest $request, $idletter){
         
        $year = Carbon::now()->format('y');
        // $thisMonth = Carbon::now()->format('m'); => berdasarkan tanggal sekarang
        // $thisMonth = '11';  //=> untuk testing bulan bukan sekarang
        // $requestMonth = Carbon::parse($request->tgl_surat)->format('m');
        $requestMonth = Carbon::parse($request->tgl_surat)->format('m');
        //untuk mengambil key id dan key bulan_surat yang ada pada model Format/ tabel format
        // $getId=Format::all('id','bulan_surat');
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
                    $kodesurat = Md_letters::find($idletter);
                    $kodelembaga = Md_companies::find($idkodelembaga);
    
                    //menghitung digit untuk business logic dari kode surat
                    $digit = strlen($PresentMonthCount);
                    
                    
                
                //business logic kode surat upana
                    if($digit ===1 ){
                        
                        if($getMaxId['month_letter']==$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'md_letters_id'=>$idletter,
                                'letter'=>'No.00'.$PresentMonthCount  .'/'.$kodelembaga->letter.'/'.$kodesurat->letter.'/'.$geekmonth.'/20'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            ]);

                        } elseif($getMaxId['month_letter']!=$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'md_letters_id'=>$idletter,
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
                                'md_letters_id'=>$idletter,
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
                                'md_letters_id'=>$idletter,
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
                                'md_letters_id'=>$idletter,
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
                                'md_letters_id'=>$idletter,
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
                            $kodesurat = Md_letters::find($idletter);
                            $kodelembaga = Md_companies::find($idkodelembaga);
                        
                            //menghitung digit untuk business logic dari kode surat
                            $digit = strlen($PresentMonthCount);
                            
                            
                        
                        
                        $format = Letters::create([
                            'month_letter'=> $requestMonth,
                                'md_letters_id'=>$idletter,
                                'letter'=>'No.00'.$PresentMonthCount  .'/'.$kodelembaga->letter.'/'.$kodesurat->letter.'/'.$geekmonth.'/20'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            
                        ]);
                        return ResponseFormatter::success($format,'data berhasil dibuat', Response::HTTP_CREATED);
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

    // public function getFormat($idletter){
    //             $formatsurat= Kodesurat::with('format')->find($idletter);
    //             return ResponseFormatter::success($formatsurat, 'data berhasil diambil',200);
    // }

    public function filter(Request $request, Letters $format){
                // $searchid = $request->input('id');
                // $searchkodesurat = $request->input('kodesurat_id');
                // $searchdesk = $request->input('');
                // $searchformat = $request->input('format');
                // $datas = $request->input('datas');
                // $data = Kodesurat::paginate(10);
                //     if($data){
                        
                    
                           
                //             return FormatSuratResource::make($data);
                //             // return ResponseFormatter::success($data2, 'data berhasil diambil');
                        
                //     }else{
                       // $result = QueryBuilder::for(Kodesurat::class)
                        // ->allowedIncludes(['format'],allowedFilters(['id','format','deskripsi','kodesurat_id']))
                        
                            
                        //     ->get();
                        //     return $result;
                        
                   
            
                
                    // }
                    
                        // $data = Kodesurat::with('format')->whereRelation('format', 'deskripsi','like','%'.'coba'.'%')
                        // ->get();
                        // // return FormatSuratResource::make($data);
                        // return $data;

                        // return Kodesurat::whereRelation( 'format','deskripsi','like','%'.'coba'.'%')->get();
                        
                    
                    //  elseif($searchid){
                    //     $data = Kodesurat::with('format')->find($searchid);
                    //     return FormatSuratResource::make($data);

                    // }
                    
                        // $format1 = $format->newQuery();

                        // if($request->has('id')){
                        //     $format1->where('kodesurat_id', $request->input('id'));
                        //     return ResponseFormatter::success($format1->get(), 'data berhasil dibuat',Response::HTTP_OK);
                            
                        // }

                        // if($request->has('desk')){
                        //     $format1->where( 'deskripsi','like','%'.$request->input('desk').'%');
                        //     return ResponseFormatter::success($format1->get(), 'data berhasil dibuat',Response::HTTP_OK);
                        
                        // }

                       

                        // // return $format->get();
                        // return Kodesurat::paginate(10);
                  
                   
                        
                    
                
                // if($searchkodesurat){
                //     $data = Format::where('kodesurat_id',$searchkodesurat)->get();
                //     if($data){
                //         return FormatSuratResource::make($data);

                //         // return ResponseFormatter::success($data, 'data berhasil diambil',Response::HTTP_OK);
                //     }
                // }
                // if($searchdesk){
                //     $data = Format::where('deskripsi', 'like','%'.$searchdesk.'%')->get();
                //     if($data){
                //         return ResponseFormatter::success($data,'data berhasil diambil',Response::HTTP_OK);
                //     }
                    
                // }
                // // if($searchkodesurat && $searchdesk){
                // //     $data = Format::where('slug', 'like','%'.$searchdesk.'%')->where('kodesurat_id', $searchkodesurat);
                // //     return ResponseFormatter::success($data, 'data berhasil diambil',Response::HTTP_OK);
                // // }else{
                // //     return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
                // // }
                    
                     
                // if($searchformat){
                //     $data =  Format::where('format', 'like','%'.$searchformat.'%')->get(); 
                //     return ResponseFormatter::success($data,'data berhasil diambil',Response::HTTP_OK);
                // }
                // if($datas){
                //     $kodesurat =Kodesurat::offset(0)->limit($datas)->get();
                //     return ResponseFormatter::success($kodesurat, 'data berhasil diambil',Response::HTTP_OK);
                // }
                // $all = Kodesurat::paginate(10);
                // return ResponseFormatter::success($all, 'data berhasil diambil',Response::HTTP_OK);

                
                // $addRelationConstraint = false;
                
                    $result = QueryBuilder::for(Md_letters::class)
                    
                    ->allowedFilters(AllowedFilter::exact('letters.id'))
                    // ->allowedIncludes(['letters'], AllowedFilter::exact('description'))
                    ->get();
                    //  return FormatSuratResource::collection($result);
                    return $result;
                
               
                


                // if($request->has('desk')){
                //     $format->where( 'deskripsi','like','%'.$request->input('desk').'%');
                //     if($request->has('kodesurat_id')){
                //         $format->where( 'deskripsi','like','%'.$request->input('desk').'%')->where('kodesurat_id',$request->input('kodesurat_id'));
                //         return $format->get();
                //     }
                //     return $format->get();
                // } 
                
                
               
    }



}
