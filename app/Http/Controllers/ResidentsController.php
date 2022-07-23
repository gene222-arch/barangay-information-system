<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use App\Actions\ResidentAction;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Resident\StoreRequest;
use App\Http\Requests\Resident\UpdateRequest;
use App\Http\Requests\ResidentShowViaBarcodeRequest;

class ResidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $residents = User::role('Resident')
            ->with(['details', 'complaints'])
            ->where('id', '!=', 1)
            ->latest()
            ->get();
        
        return view('pages.residents.index', [
            'residents' => $residents
        ]);
    }

    public function nonResidents()
    {
        $residents = User::role('Non Resident')
            ->with(['details', 'complaints'])
            ->where('id', '!=', 1)
            ->latest()
            ->get();
        
        return view('pages.residents.index', [
            'residents' => $residents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.residents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Resident\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, ResidentAction $action)
    {
        $path = '';

        if ($request->hasFile('image'))
        {
            $file = $request->file('image');

            $originalFilename = $file->getClientOriginalName();
            
            $ext = $file->getClientOriginalExtension();
            $filename = pathinfo($originalFilename, PATHINFO_FILENAME);
            $newFilename = "${filename}-" . time() . ".${ext}";

            $path = $file->storeAs('public/residents/avatars', $newFilename);
            $path = Str::of($path)->replace('public/', '');
        }

        $action->store(
            $path,
            $request->user_type,
            $request->name,
            $request->birthed_at,
            $request->stayed_at,
            $request->email,
            $request->gender,
            $request->address,
            $request->born_at,
            $request->civil_status,
            $request->phone_number,
        );


        $route = $request->user_type !== 'Non Resident' ? 'residents.index' : 'residents.none';

        return Redirect::route($route)
            ->with([
                'successMessage' => 'Created successfully'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $resident
     * @return \Illuminate\Http\Response
     */
    public function show(User $resident)
    {
        return view('pages.residents.show', [
            'resident' => $resident
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Http\Requests\ResidentShowViaBarcodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function showViaBarcode(ResidentShowViaBarcodeRequest $request)
    {
        $userDetails = UserDetail::firstWhere('barcode', $request->barcode);

        return view('pages.residents.show', [
            'resident' => User::find($userDetails->user_id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resident = User::with('details')->find($id);

        return view('pages.residents.edit', [
            'resident' => $resident
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Resident\UpdateRequest  $request
     * @param  \App\Models\User  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $resident, ResidentAction $action)
    {
        $path = $resident->details->avatar_path;

        if ($request->hasFile('image'))
        {
            $file = $request->file('image');

            $originalFilename = $file->getClientOriginalName();
            
            $ext = $file->getClientOriginalExtension();
            $filename = pathinfo($originalFilename, PATHINFO_FILENAME);
            $newFilename = "${filename}-" . time() . ".${ext}";

            $path = $file->storeAs('public/residents/avatars', $newFilename);
            $path = Str::of($path)->replace('public/', '');
        }

        $action->update(
            $resident,
            $path,
            $request->name,
            $request->birthed_at,
            $request->stayed_at,
            $request->email,
            $request->gender,
            $request->address,
            $request->born_at,
            $request->civil_status,
            $request->phone_number,
        );

        $route = $request->user_type !== 'Non Resident' ? 'residents.index' : 'residents.none';

        return Redirect::route($route)
            ->with([
                'successMessage' => 'Updated successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $resident)
    {
        $name = $resident->name;
        $resident->delete();

        if ($resident->hasRole('Resident')) {
            return Redirect::route('residents.index')
            ->with([
                'successMessage' => "Resident named $name removed successfully."
            ]);
        }

        return Redirect::route('residents.none')
            ->with([
                'successMessage' => "Non Resident named $name removed successfully."
            ]);
    }
}
