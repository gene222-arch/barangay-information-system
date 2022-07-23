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
        $documentsRevenue = Document::sum('cost');

        $docs = Document::selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->get()
            ->mapWithKeys(fn ($doc) => [$doc['type'] => $doc['count']]);
        
        $users = User::query()
            ->with('roles')
            ->role(['Resident', 'Non Resident'])
            ->get()
            ->groupBy(fn ($user) => $user->roles->first()->name)
            ->mapWithKeys(fn ($role, $key) => [$key => $role->count()]);

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
            'brgyCert' => $docs["Certificate of Residency"],
            'brgyClearance' => $docs["Barangay Clearance"],
            'brgyId' => $docs["Barangay ID"],
            'certOfIndigency' => $docs["Certificate of Indigency"],
            'certOfReg' => $docs["Certificate of Registration"],
            'documentsRevenue' => $documentsRevenue,
            'nonResidentsCount' => $users['Non Resident'],
            'residentsCount' => $users['Resident'],
            'schedulesCount' => $schedulesCount,
            'blottersCount' => $blottersCount
        ];
    }
}