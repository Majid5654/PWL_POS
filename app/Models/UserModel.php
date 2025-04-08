<?php

namespace App\Models;

use App\Http\Controllers\LevelController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['level_id','username','nama','password'];

    public function level(): BelongsTo{
        return $this->belongsTo(LevelModel::class,'level_id','level_id');
    }
    public function getRoleName()
    {
        return $this->level->level_nama;
    }

    public function hasRole($role) {
        return $this->level->level_kode == $role;
    }
}
