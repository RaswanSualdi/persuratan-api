<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\FormatSuratRequest;
use App\Http\Requests\EditLettersRequest;

use App\Models\Letters;
use App\Models\Md_companies;
use App\Models\Md_letters;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class LettersController extends Controller
{

    protected $geekmonths = [
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

    public function addLetter(FormatSuratRequest $request, $id){
        
        $year = Carbon::parse($request->tgl_surat)->format('Y');
    
        $requestMonth = Carbon::parse($request->tgl_surat)->format('m');

        //untuk mengambil key id dan key bulan_surat yang ada pada model Format/ tabel format
        $getId=Letters::all('id','month_letter');
        // mengambil array yang mempunyai id terbesar pada table format
        if(!$getId->isEmpty()){
                        $getId=Letters::all('id','month_letter')->toArray();
                        $getMaxId=max($getId);  
                    $tgl_surat = Carbon::parse($request->tgl_surat);
                    $geekmonth = $this->geekmonths[$requestMonth];
                    $strToSlug = Str::slug($request->deskripsi);
                    //mengambil id dari table kode_surat dan table kode_surat_lembaga agar dapat mengakses kode dari masing masing table
                    $idkodelembaga = $request->company;
                    $kodesurat = Md_letters::find($id);
                    $kodelembaga = Md_companies::find($idkodelembaga);

                      //untuk menghitung jumlah data yang ada sebelum bulan ini, bulan ini, dan total bulan lalu dan bulan ini
                
                      $PresentMonthCount = Letters::where('month_letter','=', $requestMonth)->where('year_letter','=',$year)->where('md_letters_id','=',$id)->where('md_companies_id', '=', $idkodelembaga)->pluck('id')->count()+1;

    
                    //menghitung digit untuk business logic dari kode surat
                    $digit = strlen($PresentMonthCount);
                    
                //business logic kode surat upana
                    if($digit ===1 ){
                        
                        if($getMaxId['month_letter']==$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'year_letter'=> $year,
                                'md_letters_id'=>$id,
                                'md_companies_id'=>$idkodelembaga,
                                'no_letter'=>'No.00'.$PresentMonthCount,
                                'letter'=>'No.00'.$PresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            ]);

                        } elseif($getMaxId['month_letter']!=$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'year_letter'=> $year,
                                'md_letters_id'=>$id,
                                'md_companies_id'=>$idkodelembaga,
                                'no_letter'=>'No.00'.$PresentMonthCount,
                                'letter'=>'No.00'.$PresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
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
                                'year_letter'=> $year,
                                'md_letters_id'=>$id,
                                'md_companies_id'=>$idkodelembaga,
                                'no_letter'=>'No.0'.$PresentMonthCount,
                                'letter'=>'No.0'.$PresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                            ]);
                        }

                        elseif($getMaxId['month_letter']!=$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'year_letter'=> $year,
                                'md_letters_id'=>$id,
                                'md_companies_id'=>$idkodelembaga,
                                'no_letter'=>'No.0'.$PresentMonthCount ,
                                'letter'=>'No.0'.$PresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
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
                                'year_letter'=> $year,
                                'md_letters_id'=>$id,
                                'md_companies_id'=>$idkodelembaga,
                                'no_letter'=>'No.'.$PresentMonthCount ,
                                'letter'=>'No.'.$PresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                            ]);
                        }

                        elseif($getMaxId['month_letter']!=$requestMonth){
                            $format = Letters::create([
                                'month_letter'=> $requestMonth,
                                'year_letter'=> $year,
                                'md_letters_id'=>$id,
                                'md_companies_id'=>$idkodelembaga,
                                'no_letter'=>'No.'.$PresentMonthCount ,
                                'letter'=>'No.'.$PresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
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
                            $geekmonth = $this->geekmonths[$requestMonth];
                            $strToSlug = Str::slug($request->deskripsi);
                            //untuk menghitung jumlah data yang ada sebelum bulan ini, bulan ini, dan total bulan lalu dan bulan ini
                            $idkodelembaga = $request->company;
                            //mengambil id dari table kode_surat dan table kode_surat_lembaga agar dapat mengakses kode dari masing masing table
                            $kodesurat = Md_letters::find($id);
                            $kodelembaga = Md_companies::find($idkodelembaga);

                      $PresentMonthCount = Letters::where('month_letter','=', $requestMonth)->where('year_letter','=',$year)->where('md_letters_id','=',$id)->where('md_companies_id', '=', $idkodelembaga)->pluck('id')->count()+1;

                            //menghitung digit untuk business logic dari kode surat
                            $digit = strlen($PresentMonthCount);
                                 
                        $format = Letters::create([
                            'month_letter'=> $requestMonth,
                            'year_letter'=> $year,
                                'md_letters_id'=>$id,
                                'md_companies_id'=>$idkodelembaga,
                                'no_letter'=>'No.00'.$PresentMonthCount,
                                'letter'=>'No.00'.$PresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
                                'description'=>$request->deskripsi,
                                'link'=> $request->link,
                                'date_letter'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                        
                        ]);
                        return ResponseFormatter::success($format,'data berhasil dibuat', Response::HTTP_CREATED);
    }



}

    public function updateLetter(EditLettersRequest $request, $idformat, $id){
                    $format = Letters::find($idformat);
                    // $kodelembaga = Md_companies::find($idkodelembaga);
                    if(!$format){
                        return ResponseFormatter::error(null, 'data tidak ditemukan',404);
                    }
                    $format->description = $request->deskripsi;
                    $format->date_letter = $request->tgl_surat;
                    $format->link = $request->link;
                    $year = Carbon::parse($request->tgl_surat)->format('y');
        
        
                    $requestMonth = Carbon::parse($request->tgl_surat)->format('m');
            
                    //untuk mengambil key id dan key bulan_surat yang ada pada model Format/ tabel format
                    $getId=Letters::all('id','month_letter');
                    // mengambil array yang mempunyai id terbesar pada table format
                    if(!$getId->isEmpty()){
                                    $getId=Letters::all('id','month_letter')->toArray();
                                    $getMaxId=max($getId);
                                //tanggal surat yang akan dimasukkan kedalam field tgl surat pada table format
                                
                                $tgl_surat = Carbon::parse($request->tgl_surat);
                                $geekmonth = $this->geekmonths[$requestMonth];
                                $strToSlug = Str::slug($request->deskripsi);
            
                                //mengambil id dari table kode_surat dan table kode_surat_lembaga agar dapat mengakses kode dari masing masing table
                                $idkodelembaga = $request->company;
                                $kodesurat = Md_letters::find($id);
                                $kodelembaga = Md_companies::find($idkodelembaga);

                    //   $PresentMonthCount = Letters::where('month_letter','=', $requestMonth)->where('year_letter','=',$year)->where('md_letters_id','=',$id)->where('md_companies_id', '=', $idkodelembaga)->pluck('id')->count()+1;
                      $editPresentMonthCount = $request->editNoLetter;

                                //menghitung digit untuk business logic dari kode surat
                                $digit = strlen($editPresentMonthCount);
                            //business logic kode surat upana
                                if($digit ===1 ){
                                    
                                    if($getMaxId['month_letter']==$requestMonth){
                                        $format->update([
                                            'month_letter'=> $requestMonth,
                                            'year_letter'=> $year,
                                            'md_letters_id'=>$id,
                                            'md_companies_id'=>$idkodelembaga,
                                            'no_letter'=>'No.00'.$editPresentMonthCount,
                                            'letter'=>'No.00'.$editPresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
                                            'description'=>$request->deskripsi,
                                            'link'=> $request->link,
                                            'date_letter'=>$tgl_surat,
                                            'slug'=> $strToSlug,
                                        ]);
            
                                    } elseif($getMaxId['month_letter']!=$requestMonth){
                                        $format->update([
                                            'month_letter'=> $requestMonth,
                                            'year_letter'=> $year,
                                            'md_letters_id'=>$id,
                                            'md_companies_id'=>$idkodelembaga,
                                            'no_letter'=>'No.00'.$editPresentMonthCount,
                                            'letter'=>'No.00'.$editPresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
                                            'description'=>$request->deskripsi,
                                            'link'=> $request->link,
                                            'date_letter'=>$tgl_surat,
                                            'slug'=> $strToSlug,
                                        ]);
                                    }
                            
                                
                                }elseif($digit===2){
                                    
                                    if($getMaxId['month_letter']==$requestMonth){
                                        $format->update([
                                            'month_letter'=> $requestMonth,
                                            'year_letter'=> $year,
                                            'md_letters_id'=>$id,
                                            'md_companies_id'=>$idkodelembaga,
                                            'no_letter'=>'No.0'.$editPresentMonthCount,
                                            'letter'=>'No.0'.$editPresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
                                            'description'=>$request->deskripsi,
                                            'link'=> $request->link,
                                            'date_letter'=>$tgl_surat,
                                            'slug'=> $strToSlug,
                                        ]);
                                    }
            
                                    elseif($getMaxId['month_letter']!=$requestMonth){
                                        $format->update([
                                            'month_letter'=> $requestMonth,
                                            'year_letter'=> $year,
                                            'md_letters_id'=>$id,
                                            'md_companies_id'=>$idkodelembaga,
                                            'no_letter'=>'No.0'.$editPresentMonthCount,
                                            'letter'=>'No.0'.$editPresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
                                            'description'=>$request->deskripsi,
                                            'link'=> $request->link,
                                            'date_letter'=>$tgl_surat,
                                            'slug'=> $strToSlug,
                                        ]);
                                    }
                                
                                }else{
                                    
                                    if($getMaxId['month_letter']==$requestMonth){
                                        $format->update([
                                            'month_letter'=> $requestMonth,
                                            'year_letter'=> $year,
                                            'md_letters_id'=>$id,
                                            'md_companies_id'=>$idkodelembaga,
                                            'no_letter'=>'No.'.$editPresentMonthCount,
                                            'letter'=>'No.'.$editPresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
                                            'description'=>$request->deskripsi,
                                            'link'=> $request->link,
                                            'date_letter'=>$tgl_surat,
                                            'slug'=> $strToSlug,
                                        ]);
                                    }
            
                                    elseif($getMaxId['month_letter']!=$requestMonth){
                                        $format->update([
                                            'month_letter'=> $requestMonth,
                                            'year_letter'=> $year,
                                            'md_letters_id'=>$id,
                                            'md_companies_id'=>$idkodelembaga,
                                            'no_letter'=>'No.'.$editPresentMonthCount,
                                            'letter'=>'No.'.$editPresentMonthCount.'/'.$kodesurat->letter.'/'.$kodelembaga->letter.'/'.$geekmonth.'/'.$year,
                                            'description'=>$request->deskripsi,
                                            'link'=> $request->link,
                                            'date_letter'=>$tgl_surat,
                                            'slug'=> $strToSlug,
                                        ]);
                                    }
                        
                    }
                    
            
                    return ResponseFormatter::success($format,'data berhasil diupdate', Response::HTTP_OK);
                }
     }

     public function deleteLetter($idletter,$id){
         $letter = Letters::where('md_letters_id', '=', $idletter)->find($id);
         if(!$letter){
             return response()->json(['message'=>'data tidak ditemukan', 'code status'=>404]);
         }

         $letter->delete();
         return ResponseFormatter::success($letter, 'data berhasil dihapus', 204);

       
        
     
     }

    public function all(Request $request, $id){

                    $letters = Letters::orderBy('created_at','DESC')->NewQuery();
                     $paginate = $request->input('data');
                    $dateFrom =  Carbon::parse($request->input('date_from'))->format('Y-m-d');
                    $dateTo = Carbon::parse($request->input('date_to'))->format('Y-m-d');
                   
                    //search detail surat berdasarkan deskripsi 
                    if ($request->has('search')){
                        $letters->whereHas('md_letters',function($query) use($id){
                            $query->where('id', '=', $id);
                        })->where('description','like','%'. $request->input('search').'%');
                        return $letters->paginate($paginate);
                    }      
                    //filter data berdasarkan date range
                        if($request->has('date_from')&& $request->has('date_to')){
                            return $letters->whereBetween('date_letter',[$dateFrom, $dateTo])->where('md_letters_id', $id)->paginate($paginate);
                        }

                    //jika user hanya memilih date_from
                        if($request->has('date_from')){
                            return $letters->where('date_letter','=',$dateFrom)->get();
                        }

                    //jika user hanya memilih date_to 
                        if($request->has('date_to')){
                            return $letters->where('date_letter','=',$dateTo)->get();
                        }
                    //filter berdasarkan surat lembaga
                        if($request->has('company')){
                            return $letters->where('letter','like','%'. $request->input('company').'%')->paginate($paginate);
                        }
                    //user menentukan jumlah data yang ingin didisplay
                        if($request->has('data')){
                            return $letters->paginate($paginate);
                        }
                  // ketika user tidak menentukan jumlah data yang ingin di display, maka secara default data yang akan ditampilkan adala 10 data  
                return $letters->whereHas('md_letters',function($query) use($id){
                    $query->where('id', '=',$id);
                })->paginate(10);

   }
}
