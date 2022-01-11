<?php 

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResidentAction 
{
    public function store(string $name, string $birthedAt, string $email, string $gender, string $address, string $civilStatus, string $phoneNumber, string $avatarPath): bool|string
    {
        try {
            DB::transaction(function () use ($name, $birthedAt, $email, $gender, $address, $civilStatus, $phoneNumber, $avatarPath)
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
            });
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return true;
    }

    public function update(User $user, string $name, string $birthedAt, string $email, string $gender, string $address, string $civilStatus, string $phoneNumber, string $avatarPath): bool|string
    {
        try {
            DB::transaction(function () use ($user, $name, $birthedAt, $email, $gender, $address, $civilStatus, $phoneNumber, $avatarPath)
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
                        'gender' => $gender,
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

    public function uploadAvatar($request, string $currentFileName = ''): string
    {
        $newFileName = $currentFileName;

        if ($request->hasFile('avatar')) 
        {
            $file = $request->file('avatar');

            $original = $file->getClientOriginalName();
            $fileName = pathinfo($original, PATHINFO_FILENAME);
            $ext = $file->extension();

            $newFileName = time() . '_' . "$fileName.$ext";
            $file->storePubliclyAs('public/avatars', $newFileName);
        }

        return $newFileName;
    }
}