<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\Md_companies;
use Illuminate\Http\Request;

class MdCompaniesController extends Controller
{
    public function all(){
     
        $company = Md_companies::all();
        return $company;

    }
}
