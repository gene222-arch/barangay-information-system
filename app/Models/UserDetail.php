<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar_path',
        'phone_number',
        'gender',
        'address',
        'civil_status',
        'birthed_at'
    ];

    public function getBirthedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
