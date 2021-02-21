<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['permission'];

    public function user() {
        return $this->hasMany(User::class, 'permission_id', 'id');
    }
}
