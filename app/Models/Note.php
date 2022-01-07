<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'subject',
        'body'
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($note) {
            $note->user_id = Auth::user()->id;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
