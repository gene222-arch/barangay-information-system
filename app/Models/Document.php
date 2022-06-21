<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'name',
        'is_senior',
        'cost',
    ];

    protected $casts = [
        'is_senior' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
