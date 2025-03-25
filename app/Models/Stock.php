<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Stock extends Model
{
    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';
    protected $fillable = [
        'stok_id',
        'barang_id',
        'user_id',
        'stok_jumlah',
    ];

    public function barang() {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }

    // Relasi ke User (Many to One)
    public function user() {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}