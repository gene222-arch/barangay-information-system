<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserComplaint\StoreRequest;
use App\Http\Requests\UserComplaint\UpdateRequest;
use App\Models\User;
use App\Models\UserComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserComplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resident = User::with('details')
            ->findOrFail(request()->input('id'));

        return view('pages.user-complaints.create', [
            'resident' => $resident
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserComplaint\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $resident = User::findOrFail($request->input('id'));

        $resident->complaints()->create($request->validated());

        return Redirect::route('residents.index')
            ->with([
                'successMessage' => 'Complaint to ' . $resident->name . ' filed successfully'
            ]);
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
        $complaint = UserComplaint::find($id);

        $resident = User::with('details')
            ->findOrFail(request()->input('id'));
            
        return view('pages.user-complaints.edit', [
            'resident' => $resident,
            'userComplaint' => $complaint
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserComplaint\UpdateRequest  $request
     * @param  \App\Models\UserComplaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, UserComplaint $complaint)
    {
        $complaint->update($request->validated());

        return Redirect::route('residents.index')
            ->with([
                'successMessage' => 'File complaint updated successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
