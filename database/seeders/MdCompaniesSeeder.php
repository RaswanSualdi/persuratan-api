<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MdCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $md_companies = [
            [
                'companies'=> 'Upana Studio International',
                'letter'=>'UPAA',
                'slug'=> 'upana-studio-makassar',
                'created_at'=> null,
                'updated_at'=> null,
            ],
            [
            'companies'=> 'Upana Studio International',
            'letter'=>'USI',
            'slug'=> 'upana-studio-makassar',
            'created_at'=> null,
            'updated_at'=> null,
            ]

         
    ];

    DB::table('md_companies')->insert($md_companies);
    }
}
