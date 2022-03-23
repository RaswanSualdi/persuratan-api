<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Kodesurat;
use DateTime;

class KodeSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
           $kodesurats = [[
                'kode'=> 'SPK-01',
                'jenis_surat'=>'Surat Perjanjian Kerja ke Client',
                'slug' => 'surat-perjanjian-kerja-ke-client',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SPK-02',
                'jenis_surat'=>'Surat Perjanjian Kerja ke Freelance',
                'slug' => 'surat-perjanjian-kerja-ke-freelance',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SPKK',
                'jenis_surat'=>'Surat Perjanjian Kerja Karyawan',
                'slug' => 'surat-perjanjian-kerja-karyawan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SPKWT',
                'jenis_surat'=>'Surat Perjanjian Kerja Waktu Tertentu (trial/kontrak/part time)',
                'slug' => 'surat-perjanjian-kerja-waktu-tertentu',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SKep',
                'jenis_surat'=>'Surat Keputusan',
                'slug' => 'surat-keputusan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SK',
                'jenis_surat'=>'Surat Kuasa',
                'slug' => 'surat-kuasa',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SU',
                'jenis_surat'=>'Surat Undangan',
                'slug' => 'surat-undangan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SPM',
                'jenis_surat'=>'Surat Permohonan',
                'slug' => 'surat-permohonan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SPb',
                'jenis_surat'=>'Surat Pemberitahuan',
                'slug' => 'surat-pemberitahuan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SPn',
                'jenis_surat'=>'Surat Pernyataan',
                'slug' => 'surat-pernyataan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SM',
                'jenis_surat'=>'Surat Mandat',
                'slug' => 'surat-mandat',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'ST',
                'jenis_surat'=>'Surat Tugas',
                'slug' => 'surat-tugas',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SPer',
                'jenis_surat'=>'Surat Perintah',
                'slug' => 'surat-perintah',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SP',
                'jenis_surat'=>'Surat Peringatan',
                'slug' => 'surat-peringatan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SKet',
                'jenis_surat'=>'Surat Keterangan',
                'slug' => 'surat-keterangan',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'SR',
                'jenis_surat'=>'Surat Rekomendasi',
                'slug' => 'surat-rekomendasi',
                'created_at'=> null,
                'updated_at'=> null
            ],

            [
                'kode'=> 'BST',
                'jenis_surat'=>'Surat Berita Acara Serah Terima',
                'slug' => 'surat-berita-acara-serah-terima',
                'created_at'=> null,
                'updated_at'=> null
            ],

            
        ];

        DB::table('kodesurats')->insert($kodesurats);
    }
}
