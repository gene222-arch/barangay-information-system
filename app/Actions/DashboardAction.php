<?php 

namespace App\Actions;

use App\Models\Schedule;
use App\Models\User;
use App\Models\UserComplaint;

class DashboardAction 
{
    public function generalAnalytics(): array
    {
        $residentsCount = User::whereHas('role', fn ($q) => $q->where('role_id', 2))->count();
        $schedulesCount = Schedule::count();
        $blottersCount = UserComplaint::where('type', 'blotter')->count();

        return [
            'residentsCount' => $residentsCount,
            'schedulesCount' => $schedulesCount,
            'blottersCount' => $blottersCount
        ];
    }
}