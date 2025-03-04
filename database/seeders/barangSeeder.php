<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class barangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'barang_id' => 1,
        'kategori_id' => 1, // Makanan
        'barang_kode' => 'B001',
        'barang_nama' => 'Nasi Goreng Instan',
        'harga_beli' => 10000,
        'harga_jual' => 15000,
    ],
    [
        'barang_id' => 2,
        'kategori_id' => 1, // Makanan
        'barang_kode' => 'B002',
        'barang_nama' => 'Mie Instan',
        'harga_beli' => 2500,
        'harga_jual' => 4000,
    ],
    [
        'barang_id' => 3,
        'kategori_id' => 2, // Alat Kebersihan
        'barang_kode' => 'B003',
        'barang_nama' => 'Sabun Cuci Piring',
        'harga_beli' => 5000,
        'harga_jual' => 8000,
    ],
    [
        'barang_id' => 4,
        'kategori_id' => 2, // Alat Kebersihan
        'barang_kode' => 'B004',
        'barang_nama' => 'Sapu Lantai',
        'harga_beli' => 12000,
        'harga_jual' => 18000,
    ],
    [
        'barang_id' => 5,
        'kategori_id' => 3, // Accessories Smartphone
        'barang_kode' => 'B005',
        'barang_nama' => 'Casing HP',
        'harga_beli' => 20000,
        'harga_jual' => 30000,
    ],
    [
        'barang_id' => 6,
        'kategori_id' => 3, // Accessories Smartphone
        'barang_kode' => 'B006',
        'barang_nama' => 'Charger Fast Charging',
        'harga_beli' => 50000,
        'harga_jual' => 75000,
    ],
    [
        'barang_id' => 7,
        'kategori_id' => 4, // Mainan Anak Anak
        'barang_kode' => 'B007',
        'barang_nama' => 'Mobil Remote Control',
        'harga_beli' => 75000,
        'harga_jual' => 100000,
    ],
    [
        'barang_id' => 8,
        'kategori_id' => 4, // Mainan Anak Anak
        'barang_kode' => 'B008',
        'barang_nama' => 'Boneka Teddy Bear',
        'harga_beli' => 45000,
        'harga_jual' => 70000,
    ],
    [
        'barang_id' => 9,
        'kategori_id' => 5, // Pakaian
        'barang_kode' => 'B009',
        'barang_nama' => 'Kaos Polos',
        'harga_beli' => 25000,
        'harga_jual' => 40000,
    ],
    [
        'barang_id' => 10,
        'kategori_id' => 5, // Pakaian
        'barang_kode' => 'B010',
        'barang_nama' => 'Celana Jeans',
        'harga_beli' => 75000,
        'harga_jual' => 120000,
    ],
        ];
    DB::table('m_barang')->insert($data);
    }
}
