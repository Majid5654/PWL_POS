<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksiModel extends Model
{
    use HasFactory;
    protected $table = 't_penjualan';
    protected $primaryKey = 'penjualan_id';
    public $timestamps = false;

    protected $fillable = [
        'level_id',
        'username',
        'nama',
        'password',
    ];

    public function level()
    {
        return $this->belongsTo(Levelmodel::class, 'level_id');
    }

 

    public function stok()
    {
        return $this->hasMany(Stock::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

