<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\Kodesurat;
use App\Models\Format;
use App\Models\KodeSuratLembaga;
use App\Http\Requests\FormatSuratRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FormatSuratController extends Controller
{
    
    public function letter(FormatSuratRequest $request, $idletter){
         
        $year = Carbon::now()->format('y');
        // $thisMonth = Carbon::now()->format('m'); => berdasarkan tanggal sekarang
        // $thisMonth = '11';  //=> untuk testing bulan bukan sekarang
        $requestMonth = Carbon::parse($request->tgl_surat)->format('m');
        //untuk mengambil key id dan key bulan_surat yang ada pada model Format/ tabel format
        $getId=Format::all('id','bulan_surat');
        // mengambil array yang mempunyai id terbesar pada table format
        if(!$getId->isEmpty()){
                        $getId=Format::all('id','bulan_surat')->toArray();
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
                   
                    $PresentMonthCount =Format::where('bulan_surat','=', $requestMonth)->pluck('id')->count()+1;
                    
                    
                    //mengambil id dari table kode_surat dan table kode_surat_lembaga agar dapat mengakses kode dari masing masing table
                    $idkodelembaga = $request->company;
                    $kodesurat = Kodesurat::find($idletter);
                    $kodelembaga = KodeSuratLembaga::find($idkodelembaga);
    
                    //menghitung digit untuk business logic dari kode surat
                    $digit = strlen($PresentMonthCount);
                    
                    
                
                //business logic kode surat upana
                    if($digit ===1 ){
                        
                        if($getMaxId['bulan_surat']==$requestMonth){
                            $format = Format::create([
                                'bulan_surat'=> $requestMonth,
                                'kodesurat_id'=>$idletter,
                                'format'=>'No.00'.$PresentMonthCount  .'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
                                'deskripsi'=>$request->deskripsi,
                                'link'=> $request->link,
                                'tgl_surat'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            ]);

                        } elseif($getMaxId['bulan_surat']!=$requestMonth){
                            $format = Format::create([
                                'bulan_surat'=> $requestMonth,
                                'kodesurat_id'=>$idletter,
                                'format'=>'No.00'. $PresentMonthCount . '/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
                                'deskripsi'=>$request->deskripsi,
                                'link'=> $request->link,
                                'tgl_surat'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            ]);
                        }
                
                    
                    }elseif($digit===2){
                        
                        if($getMaxId['bulan_surat']==$requestMonth){
                            $format = Format::create([
                                'format'=>'No.0'.$PresentMonthCount  .'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
                                'deskripsi'=>$request->deskripsi,
                                'kodesurat_id'=>$idletter,
                                'link'=> $request->link,
                                'tgl_surat'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                'bulan_surat'=> $requestMonth
                            ]);
                        }

                        elseif($getMaxId['bulan_surat']!=$requestMonth){
                            $format = Format::create([
                                'bulan_surat'=> $requestMonth,
                                'format'=>'No.0'. $PresentMonthCount .'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
                                'deskripsi'=>$request->deskripsi,
                                'kodesurat_id'=>$idletter,
                                'link'=> $request->link,
                                'tgl_surat'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            ]);
                        }
                    
                    }else{
                        
                        if($getMaxId['bulan_surat']==$requestMonth){
                            $format = Format::create([
                                'format'=>'No.'.$PresentMonthCount  .'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
                                'deskripsi'=>$request->deskripsi,
                                'kodesurat_id'=>$idletter,
                                'tgl_surat'=>$tgl_surat,
                                'link'=> $request->link,
                                'slug'=> $strToSlug,
                                'bulan_surat'=> $requestMonth
                            ]);
                        }

                        elseif($getMaxId['bulan_surat']!=$requestMonth){
                            $format = Format::create([
                                'bulan_surat'=> $requestMonth,
                                'format'=>'No.'. $PresentMonthCount .'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
                                'deskripsi'=>$request->deskripsi,
                                'kodesurat_id'=>$idletter,
                                'link'=> $request->link,
                                'tgl_surat'=>$tgl_surat,
                                'slug'=> $strToSlug,
                                
                            ]);
                        }
            
        }
        return ResponseFormatter::success($format);
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
                            $PresentMonthCount =Format::where('bulan_surat','=', $requestMonth)->pluck('id')->count()+1;
                            
                            $idkodelembaga = $request->company;
                            //mengambil id dari table kode_surat dan table kode_surat_lembaga agar dapat mengakses kode dari masing masing table
                            $kodesurat = Kodesurat::find($idletter);
                            $kodelembaga = KodeSuratLembaga::find($idkodelembaga);
                        
                            //menghitung digit untuk business logic dari kode surat
                            $digit = strlen($PresentMonthCount);
                            
                            
                        
                        
                        $format = Format::create([
                            'bulan_surat'=> $requestMonth,
                            'format'=>'No.00'.$PresentMonthCount  .'/'.$kodelembaga->kode.'/'.$kodesurat->kode.'/'.$geekmonth.'/20'.$year,
                            'deskripsi'=>$request->deskripsi,
                            'kodesurat_id'=>$idletter,
                            'link'=> $request->link,
                            'tgl_surat'=>$tgl_surat,
                            'slug'=> $strToSlug,
                            
                        ]);
                        return ResponseFormatter::success($format);
    }

}

   

    public function all(Request $request){

                    $id = $request->input('id');
                    $format = $request->input('format');
                    $slug = $request->input('slug');

                    if($id){
                        $formatsurat = Format::find($id);
                        if($formatsurat){
                            return ResponseFormatter::success($formatsurat, 'data berhasil diambil');
                        }else{
                            return ResponseFormatter::error(null, 'data tidak berhasil di ambil', 404);
                        }
                    }
                    if($format){
                        $formatsurat = Format::where('format','like','%'.$format.'%')->get();
                        return ResponseFormatter::success($formatsurat, 'data berhasil diambil');
                    }

                    if($slug){
                        $formatsurat = Format::where('slug','like','%'.$slug.'%')->get();
                        return ResponseFormatter::success($formatsurat, 'data berhasil diambil');
                    }
                    $formatsurat = Format::paginate(8);
                    return ResponseFormatter::success($formatsurat, 'data berhasil diambil',200);


    }


    public function updateFormat(FormatSuratRequest $request, $idformat){
                    $format = Format::find($idformat);
                    if(!$format){
                        return ResponseFormatter::error(null, 'data tidak ditemukan',404);
                    }

                    $data = $request->all();
                    $format->fill($data);
                    $format->save();

                    return ResponseFormatter::success($format, 'data berhasil diupdate');
                }

    public function getFormat($idletter, $letter){
         Kodesurat::find($idletter);
        $formatsurat = Format::where('format','like','%'.$letter.'%')->get();
        return ResponseFormatter::success($formatsurat, 'data berhasil diambil',200);
    }

}
