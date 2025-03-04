<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class stokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data= [ 
            [
                'stok_id' => 1,
                'barang_id' => 1, // Nasi Goreng Instan
                'user_id' => 1,
                'stok_tanggal' => '2025-03-02 10:00:00',
                'stok_jumlah' => 50,
            ],
            [
                'stok_id' => 2,
                'barang_id' => 2, // Mie Instan
                'user_id' => 1,
                'stok_tanggal' => '2025-03-02 10:05:00',
                'stok_jumlah' => 100,
            ],
            [
                'stok_id' => 3,
                'barang_id' => 3, // Sabun Cuci Piring
                'user_id' => 2,
                'stok_tanggal' => '2025-03-02 10:10:00',
                'stok_jumlah' => 30,
            ],
            [
                'stok_id' => 4,
                'barang_id' => 4, // Sapu Lantai
                'user_id' => 2,
                'stok_tanggal' => '2025-03-02 10:15:00',
                'stok_jumlah' => 20,
            ],
            [
                'stok_id' => 5,
                'barang_id' => 5, // Casing HP
                'user_id' => 3,
                'stok_tanggal' => '2025-03-02 10:20:00',
                'stok_jumlah' => 40,
            ],
            [
                'stok_id' => 6,
                'barang_id' => 6, // Charger Fast Charging
                'user_id' => 3,
                'stok_tanggal' => '2025-03-02 10:25:00',
                'stok_jumlah' => 25,
            ],
            [
                'stok_id' => 7,
                'barang_id' => 7, // Mobil Remote Control
                'user_id' => 1,
                'stok_tanggal' => '2025-03-02 10:30:00',
                'stok_jumlah' => 15,
            ],
            [
                'stok_id' => 8,
                'barang_id' => 8, // Boneka Teddy Bear
                'user_id' => 2,
                'stok_tanggal' => '2025-03-02 10:35:00',
                'stok_jumlah' => 20,
            ],
            [
                'stok_id' => 9,
                'barang_id' => 9, // Kaos Polos
                'user_id' => 3,
                'stok_tanggal' => '2025-03-02 10:40:00',
                'stok_jumlah' => 60,
            ],
            [
                'stok_id' => 10,
                'barang_id' => 10, // Celana Jeans
                'user_id' => 1,
                'stok_tanggal' => '2025-03-02 10:45:00',
                'stok_jumlah' => 30,
            ],
        ];

        DB::table('t_stok')->insert($data);
        
    }
}
