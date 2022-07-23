<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\StoreRequest;
use App\Http\Requests\Schedule\UpdateRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
       
            $schedules = Schedule::query()
                ->whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            
            return response()->json($schedules);
       }

        return view('pages.schedules.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Schedule\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($request->ajax()) 
        {
            $schedule = Schedule::create($request->validated());

            return response()->json($schedule);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Schedule\UpdateRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Schedule $schedule)
    {
        if ($request->ajax()) 
        {
            $schedule->update($request->validated());

            return response()->json([
                'message' => 'Rescheduled successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        if (in_array(Auth::user()->roles->first()->name, ['Resident', 'Non Resident'])) {
            abort(403, 'User does not have the right roles');
        }

        if (request()->ajax()) 
        {
            $schedule->delete();

            return response()->json([
                'message' => 'Deleted successfully'
            ]);
        }
    }
}
