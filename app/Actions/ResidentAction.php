<?php 

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResidentAction 
{
    public function store(
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
            DB::transaction(function () use ($name, $birthedAt, $email, $gender, $address, $civilStatus, $phoneNumber)
            {
                $resident = User::create([ 
                    'name' => $name, 
                    'email' => $email, 
                    'password' => Hash::make(Str::random(8))
                ]);

                $resident
                    ->details()
                    ->create([
                        'phone_number' => $phoneNumber,
                        'gender' => $gender,
                        'address' => $address,
                        'civil_status' => $civilStatus,
                        'birthed_at' => $birthedAt
                    ]);

                $resident->assignRole('Resident');
            });
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return true;
    }

    public function update(
        User $user, 
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
            DB::transaction(function () use ($user, $name, $birthedAt, $email, $gender, $address, $civilStatus, $phoneNumber)
            {
                $user->update([ 
                    'name' => $name, 
                    'email' => $email
                ]);

                $user
                    ->details()
                    ->update([
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