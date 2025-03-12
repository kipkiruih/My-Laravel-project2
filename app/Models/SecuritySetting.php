<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecuritySetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'allow_user_registration',
        'require_strong_passwords',
        'enable_2fa',
        'session_timeout',
        'login_alerts',
    ];
}

