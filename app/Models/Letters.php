<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letters extends Model
{
    use HasFactory;
    protected $fillable = [
        'letter',
        'description',
        'link',
        'date_letter',
        'slug',
        'month_letter',
        'md_letters_id',
        'year_letter',
        'no_letter'

    ];

    public function md_letters(){
        return $this->belongsTo(Md_letters::class,'md_letters_id','id');
    }

  
}
