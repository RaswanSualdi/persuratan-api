<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;
    protected $fillable = [
        'format',
        'deskripsi',
        'link',
        'tgl_surat',
        'slug',
        'bulan_surat'
    ];

}
