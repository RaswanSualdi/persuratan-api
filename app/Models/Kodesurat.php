<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kodesurat extends Model
{
    use HasFactory;

    public function format(){
        return $this->hasMany(Format::class,'kodesurat_id');
    }
    
}
