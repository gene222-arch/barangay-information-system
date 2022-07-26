<?php 

namespace App\Actions;

use App\Models\User;
use App\Models\Document;
use App\Models\Schedule;
use Illuminate\Support\Str;
use App\Models\UserComplaint;

class DashboardAction 
{
    public function generalAnalytics(): array
    {
        $documentsRevenue = Document::sum('cost');

        $data = [];
        $monthly = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $docs = Document::selectRaw(
            'type,
            MONTH(created_at) - 1 as month,
            SUM(cost) as revenue'
        )
            ->groupBy('month', 'type')
            ->get();

        foreach ($docs as $doc) {
            $monthly[$doc->month] = $doc->revenue;
            $data[Str::snake($doc->type)] = $monthly;
        }
        
        $users = User::query()
            ->with('roles')
            ->role(['Resident', 'Non Resident'])
            ->get()
            ->groupBy(fn ($user) => $user->roles->first()->name)
            ->mapWithKeys(fn ($role, $key) => [$key => $role->count()]);

        $schedulesCount = Schedule::count();
        $blottersCount = UserComplaint::where([
            [ 'type', 'blotter' ],
            [ 'is_solved', 'No' ],
        ])->count();

        return [
            // 
            'monthlyRevenue' => $data,
            //
            'documentsRevenue' => $documentsRevenue,
            'nonResidentsCount' => $users['Non Resident'],
            'residentsCount' => $users['Resident'],
            'schedulesCount' => $schedulesCount,
            'blottersCount' => $blottersCount
        ];
    }
}