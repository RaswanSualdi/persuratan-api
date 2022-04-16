<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Md_letters extends Model
{
    use HasFactory;
    public function letters(){
        return $this->hasMany(Letters::class, 'md_letters_id');
    }

    
}
