<?php 

namespace App\Actions;

use App\Models\Document;
use App\Models\Schedule;
use App\Models\User;
use App\Models\UserComplaint;

class DashboardAction 
{
    public function generalAnalytics(): array
    {
        $residentsCount = User::role('Resident')->count();
        $nonResidentsCount = User::role('Non Resident')->count();
        $documentsCount = Document::count();

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
            'documentsCount' => $documentsCount,
            'nonResidentsCount' => $nonResidentsCount,
            'residentsCount' => $residentsCount,
            'schedulesCount' => $schedulesCount,
            'blottersCount' => $blottersCount
        ];
    }
}