<?php 

namespace App\Actions;

use App\Models\Schedule;
use App\Models\User;
use App\Models\UserComplaint;

class DashboardAction 
{
    public function generalAnalytics(): array
    {
        $residentsCount = User::with([
            'role' => fn ($q) => $q->where('name', 'Resident')
        ])->count();
        $schedulesCount = Schedule::count();
        $blottersCount = UserComplaint::where([
            [
                'type', 'blotter'
            ],
            [
                'is_solved', 'No'
            ]
        ])->count();

        return [
            'residentsCount' => $residentsCount,
            'schedulesCount' => $schedulesCount,
            'blottersCount' => $blottersCount
        ];
    }
}