<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\User;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservationQuery = Reservation::with('user')
            ->when(auth()->user()->hasRole('Resident'), function ($q) {
                return $q->where('user_id', auth()->id());
            })
            ->latest()->get();

        return view('pages.reservation.index', [
            'reservations' => $reservationQuery,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.reservation.create', [
            'residents' => User::role('Resident')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        Reservation::create($request->validated());

        return redirect()->route('reservations.index')->with([
            'successMessage' => 'Reserved successfully',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        abort_if($reservation->status !== 'Processing', 403);

        return view('pages.reservation.edit', [
            'reservation' => Reservation::with('user')->find($reservation->id),
            'residents' => User::role('Resident')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->validated());

        return redirect()->route('reservations.index')->with([
            'successMessage' => 'Reservation updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with([
            'successMessage' => 'Reservation deleted successfully',
        ]);
    }
}
