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
        'barcode',
        'phone_number',
        'gender',
        'address',
        'civil_status',
        'birthed_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userDetail) 
        {
            $userDetail->barcode = time();
        });
    }
    
    public function getBirthedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
