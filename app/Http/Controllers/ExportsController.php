<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;

class ExportsController extends Controller
{
    public function barangayClearance(User $resident)
    {
        $resident = User::with('details')->find($resident->id);
        $age = Carbon::parse($resident->details->birthed_at)->age;

        $type = match($resident->details->gender) {
            'Male' => 'binata',
            'Female' => 'dalaga'
        };

        if ($resident->details->civil_status === 'Married') {
            $type = 'may asawa';
        }

        $pdf = PDF::loadView('exports.barangay-clearance', [
            'resident' => $resident,
            'type' => $type,
        ]);

        $filename = 'barangay-clearance.pdf';

        $isSenior = $age >= 60;

        $resident
            ->documents()
            ->create([
                'type' => 'Barangay Clearance',
                'name' => $filename,
                'is_senior' => $isSenior,
                'cost' => $isSenior ? 0 : 30.00,
            ]);

        return $pdf->stream($filename);
    }

    public function barangayCertification(User $resident)
    {
        $resident = User::with('details')->find($resident->id);

        $pdf = PDF::loadView('exports.barangay-certification', [
            'resident' => $resident
        ]);

        $filename = "{$resident->name}.pdf";

        $isSenior = Carbon::parse($resident->details->birthed_at)->age >= 60;

        $resident->documents()->create([
            'type' => 'Barangay Certification',
            'name' => $filename,
            'is_senior' => $isSenior,
            'cost' => $isSenior ? 0 : 30.00,
        ]);

        return $pdf->stream($filename);
    }

    public function certificateOfIndigency(User $resident)
    {
        $resident = User::with('details')->find($resident->id);

        $pdf = PDF::loadView('exports.certificate-of-indigency', [
            'resident' => $resident
        ]);

        $filename = "{$resident->name}.pdf";
        $isSenior = Carbon::parse($resident->details->birthed_at)->age >= 60;

        $resident->documents()->create([
            'type' => 'Certificate of Indigency',
            'name' => $filename,
            'is_senior' => $isSenior,
        ]);

        return $pdf->stream($filename);
    }

    public function certificateOfRegistration(User $resident)
    {
        $resident = User::with('details')->find($resident->id);

        $pdf = PDF::loadView('exports.certificate-of-registration', [
            'resident' => $resident
        ]);

        $filename = "{$resident->name}.pdf";
        $isSenior = Carbon::parse($resident->details->birthed_at)->age >= 60;

        $resident->documents()->create([
            'type' => 'Certificate of Registration',
            'name' => $filename,
            'is_senior' => $isSenior,
            'cost' => $isSenior ? 0 : 30.00,
        ]);

        return $pdf->stream($filename);
    }

    public function id(User $resident)
    {
        $resident = User::with('details')->find($resident->id);

        $pdf = PDF::loadView('exports.id', [
            'resident' => $resident
        ]);

        $filename = "{$resident->name}.pdf";
        $isSenior = Carbon::parse($resident->details->birthed_at)->age >= 60;

        $resident->documents()->create([
            'type' => 'Barangay ID',
            'name' => $filename,
            'is_senior' => $isSenior,
            'cost' => $isSenior ? 0 : 30.00,
        ]);

        return $pdf->stream($filename);
    }

    public function courtReservation()
    {
        $courtReservations = Reservation::with('user')->get();

        $pdf = PDF::loadView('exports.court-reservation', [
            'courtReservations' => $courtReservations
        ]);

        $filename = "court-reservation.pdf";

        return $pdf->stream($filename);
    }
}
