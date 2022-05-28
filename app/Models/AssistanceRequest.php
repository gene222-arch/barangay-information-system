<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssistanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'reason',
        'status',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
