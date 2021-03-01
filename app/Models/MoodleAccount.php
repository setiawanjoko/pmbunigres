<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodleAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'moodle_username', 'moodle_default_password', 'nilai_tpa', 'moodle_user_id', 'moodle_email', 'moodle_firstname', 'moodle_lastname'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
