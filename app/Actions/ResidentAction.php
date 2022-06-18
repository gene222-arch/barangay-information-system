<?php 

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResidentAction 
{
    public function store(
        string $avatarPath,
        string $userType,
        string $name, 
        string $birthedAt, 
        string $email, 
        string $gender, 
        string $address, 
        string $civilStatus, 
        string $phoneNumber,
    ): bool|string
    {
        try {
            DB::transaction(function () use ($avatarPath, $userType, $name, $birthedAt, $email, $gender, $address, $civilStatus, $phoneNumber)
            {
                $resident = User::create([ 
                    'name' => $name, 
                    'email' => $email, 
                    'password' => Hash::make(Str::random(8))
                ]);

                $resident
                    ->details()
                    ->create([
                        'avatar_path' => $avatarPath,
                        'phone_number' => $phoneNumber,
                        'gender' => $gender,
                        'address' => $address,
                        'civil_status' => $civilStatus,
                        'birthed_at' => $birthedAt
                    ]);

                $resident->assignRole($userType);
            });
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return true;
    }

    public function update(
        User $user, 
        string $avatarPath,
        string $name, 
        string $birthedAt, 
        string $email, 
        ?string $gender, 
        string $address, 
        string $civilStatus, 
        string $phoneNumber
    ): bool|string
    {
        try {
            DB::transaction(function () use ($user, $avatarPath, $name, $birthedAt, $email, $gender, $address, $civilStatus, $phoneNumber)
            {
                $user->update([ 
                    'name' => $name, 
                    'email' => $email
                ]);

                $user
                    ->details()
                    ->update([
                        'avatar_path' => $avatarPath,
                        'phone_number' => $phoneNumber,
                        'gender' => $gender ?? $user->details->gender,
                        'address' => $address,
                        'civil_status' => $civilStatus,
                        'birthed_at' => $birthedAt
                    ]);
            });
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return true;
    }
}