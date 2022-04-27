<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Md_companies extends Model
{
    use HasFactory;

    // public function mdletters(){
    //     return $this->hasMany(Md_letters::class,'md_companies_id');
    // }

    public function letters(){
        return $this->hasMany(Letters::class,'md_companies_id');
    }
}
