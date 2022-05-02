<?php

namespace App\Models;


use App\Models\Md_letters;
use App\Models\Md_companies;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Query\Builder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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
        'md_companies_id',
        'year_letter',
        'no_letter'

    ];

    public function md_letters(){
        return $this->belongsTo(Md_letters::class,'md_letters_id','id');
    }

    public function md_companies(){
        return $this->belongsTo(Md_companies::class,'md_companies_id','id');
    }

  
}
