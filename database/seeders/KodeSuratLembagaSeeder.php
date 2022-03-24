<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KodeSuratLembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kodeSuratLembaga = [
            [
            'nama_lembaga'=> 'Upana Studio International',
            'kode'=>'USI',
            'slug'=> 'upana-studio-makassar',
            'created_at'=> null,
            'updated_at'=> null,
            ],

            [
            'nama_lembaga'=> 'Upana Studio International',
            'kode'=>'UPAA',
            'slug'=> 'upana-studio-makassar',
            'created_at'=> null,
            'updated_at'=> null,
            ]
    ];

    DB::table('kode_surat_lembagas')->insert($kodeSuratLembaga);
    }
}
