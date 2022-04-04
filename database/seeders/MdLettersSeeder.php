<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Kodesurat;
use DateTime;

class MdLettersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
           $md_letters = [[
                'letter'=> 'SPK-01',
                'kind_letter'=>'Surat Perjanjian Kerja ke Client',
                'slug' => 'surat-perjanjian-kerja-ke-client',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SPK-02',
                'kind_letter'=>'Surat Perjanjian Kerja ke Freelance',
                'slug' => 'surat-perjanjian-kerja-ke-freelance',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SPKK',
                'kind_letter'=>'Surat Perjanjian Kerja Karyawan',
                'slug' => 'surat-perjanjian-kerja-karyawan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SPKWT',
                'kind_letter'=>'Surat Perjanjian Kerja Waktu Tertentu (trial/kontrak/part time)',
                'slug' => 'surat-perjanjian-kerja-waktu-tertentu',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SKep',
                'kind_letter'=>'Surat Keputusan',
                'slug' => 'surat-keputusan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SK',
                'kind_letter'=>'Surat Kuasa',
                'slug' => 'surat-kuasa',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SU',
                'kind_letter'=>'Surat Undangan',
                'slug' => 'surat-undangan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SPM',
                'kind_letter'=>'Surat Permohonan',
                'slug' => 'surat-permohonan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SPb',
                'kind_letter'=>'Surat Pemberitahuan',
                'slug' => 'surat-pemberitahuan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SPn',
                'kind_letter'=>'Surat Pernyataan',
                'slug' => 'surat-pernyataan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SM',
                'kind_letter'=>'Surat Mandat',
                'slug' => 'surat-mandat',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'ST',
                'kind_letter'=>'Surat Tugas',
                'slug' => 'surat-tugas',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SPer',
                'kind_letter'=>'Surat Perintah',
                'slug' => 'surat-perintah',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SP',
                'kind_letter'=>'Surat Peringatan',
                'slug' => 'surat-peringatan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SKet',
                'kind_letter'=>'Surat Keterangan',
                'slug' => 'surat-keterangan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'SR',
                'kind_letter'=>'Surat Rekomendasi',
                'slug' => 'surat-rekomendasi',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'letter'=> 'BST',
                'kind_letter'=>'Surat Berita Acara Serah Terima',
                'slug' => 'surat-berita-acara-serah-terima',
                'created_at'=> null,
                'updated_at'=> null
            ],

            
        ];

        DB::table('md_letters')->insert($md_letters);
    }
}
