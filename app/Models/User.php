<?php

namespace App\Models;

use App\Models\UserRole;
use App\Models\UserDetail;
use App\Models\UserHistory;
use App\Actions\HasRoleAction;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoleAction;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function details(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(UserHistory::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function role(): HasOne
    {
        return $this->hasOne(UserRole::class);
    }
}
