<?php

namespace App\Models;

use App\Models\AssistanceRequest;
use App\Models\Schedule;
use App\Models\UserDetail;
use App\Models\Reservation;
use App\Models\UserComplaint;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

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

    public function complaints(): HasMany
    {
        return $this->hasMany(UserComplaint::class);
    }

    public function activeComplaint()
    {
        return $this->complaints()->firstWhere('is_solved', 'No');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function reservations(): HasMany 
    {
        return $this->hasMany(Reservation::class);
    }

    public function assistanceRequests(): HasMany 
    {
        return $this->hasMany(AssistanceRequest::class);
    }
}
