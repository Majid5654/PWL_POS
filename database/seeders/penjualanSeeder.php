<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class penjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=
        [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'Andi Setiawan',
                'penjualan_kode' => 'TRX2025030201',
                'penjualan_tanggal' => '2025-03-02 11:00:00',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 2,
                'pembeli' => 'Budi Santoso',
                'penjualan_kode' => 'TRX2025030202',
                'penjualan_tanggal' => '2025-03-02 11:05:00',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Citra Lestari',
                'penjualan_kode' => 'TRX2025030203',
                'penjualan_tanggal' => '2025-03-02 11:10:00',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 1,
                'pembeli' => 'Dewi Anggraini',
                'penjualan_kode' => 'TRX2025030204',
                'penjualan_tanggal' => '2025-03-02 11:15:00',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => 'Eka Prasetyo',
                'penjualan_kode' => 'TRX2025030205',
                'penjualan_tanggal' => '2025-03-02 11:20:00',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Fajar Hidayat',
                'penjualan_kode' => 'TRX2025030206',
                'penjualan_tanggal' => '2025-03-02 11:25:00',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 1,
                'pembeli' => 'Gita Permata',
                'penjualan_kode' => 'TRX2025030207',
                'penjualan_tanggal' => '2025-03-02 11:30:00',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 2,
                'pembeli' => 'Hendri Susanto',
                'penjualan_kode' => 'TRX2025030208',
                'penjualan_tanggal' => '2025-03-02 11:35:00',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Indah Rahayu',
                'penjualan_kode' => 'TRX2025030209',
                'penjualan_tanggal' => '2025-03-02 11:40:00',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 1,
                'pembeli' => 'Joko Widodo',
                'penjualan_kode' => 'TRX2025030210',
                'penjualan_tanggal' => '2025-03-02 11:45:00',
            ],
        ];
        DB::table('t_penjualan')->insert($data);
        
    }
}
