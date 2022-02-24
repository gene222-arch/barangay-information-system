<?php

namespace App\Http\Controllers;

use App\Actions\ResidentAction;
use App\Http\Requests\Resident\StoreRequest;
use App\Http\Requests\Resident\UpdateRequest;
use App\Http\Requests\ResidentShowViaBarcodeRequest;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ResidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $residents = User::with(['details', 'complaints'])
            ->where('id', '!=', 1)
            ->paginate(3);
        
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
        $avatarPath = $action->uploadAvatar($request);

        $action->store(
            $request->name,
            $request->birthed_at,
            $request->email,
            $request->gender,
            $request->address,
            $request->civil_status,
            $request->phone_number,
            $avatarPath
        );

        return Redirect::route('residents.index')
            ->with([
                'successMessage' => 'Resident registered successfully'
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id, ResidentAction $action)
    {
        $resident = User::find($id);

        $avatarPath = $action->uploadAvatar($request, $resident->details->avatar_path);

        $action->update(
            $resident,
            $request->name,
            $request->birthed_at,
            $request->email,
            $request->gender,
            $request->address,
            $request->civil_status,
            $request->phone_number,
            $avatarPath
        );

        return Redirect::route('residents.index')
            ->with([
                'successMessage' => 'Resident updated successfully'
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
        $user = User::find($id);
        $name = $user->name;

        $user->details()?->delete();
        $user->role()?->delete();
        $user->complaints()?->delete();
        $user->delete();

        return Redirect::route('residents.index')
            ->with([
                'successMessage' => "Resident named $name removed successfully."
            ]);
    }
}
