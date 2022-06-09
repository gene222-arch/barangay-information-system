<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssistanceRequest as AssistanceRequestClass;
use App\Models\AssistanceRequest;
use App\Models\User;

class AssistanceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestQuery = AssistanceRequest::with('user')
            ->when(auth()->user()->hasRole('Resident'), function ($q) {
                return $q->where('user_id', auth()->id());
            })
            ->latest()->get();

        return view('pages.request.index', [
            'requests' => $requestQuery,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.request.create', [
            'residents' => User::role('Resident')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AssistanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssistanceRequestClass $request)
    {
        AssistanceRequest::create($request->validated());

        return redirect()->route('assistance-requests.index')->with([
            'successMessage' => 'Reserved successfully',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssistanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(AssistanceRequest $assistanceRequest)
    {
        abort_if($assistanceRequest->status !== 'Processing', 403);

        return view('pages.request.edit', [
            'assistanceRequest' => AssistanceRequest::with('user')->find($assistanceRequest->id),
            'residents' => User::role('Resident')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AssistanceRequest  $request
     * @param  \App\Models\AssistanceRequest  $assistanceRequest
     * @return \Illuminate\Http\Response
     */
    public function update(AssistanceRequestClass $request, AssistanceRequest $assistanceRequest)
    {
        $assistanceRequest->update($request->validated());

        return redirect()->route('assistance-requests.index')->with([
            'successMessage' => 'Request updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssistanceRequest  $assistanceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssistanceRequest $assistanceRequest)
    {
        $assistanceRequest->delete();

        return redirect()->route('assistance-requests.index')->with([
            'successMessage' => 'Request deleted successfully',
        ]);
    }
}
