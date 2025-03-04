<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        $data= [
            [
                'kategori_id'=> 1,
                'kategori_kode' => 'M101',
                'kategori_nama' => 'Makanan',

            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'M102',
                'kategori_nama' => 'Alat Kebersihan',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'M103',
                'kategori_nama' => 'Accesories Smartphone',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'M104',
                'kategori_nama' => 'Mainan Anak Anak',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'M105',
                'kategori_nama' => 'Pakaian',
            ],
        ];
        DB::table('m_kategori' )->insert($data);
    }
}
