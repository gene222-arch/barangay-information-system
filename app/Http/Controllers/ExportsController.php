<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;

class ExportsController extends Controller
{
    public function barangayClearance(User $resident)
    {
        $pdf = PDF::loadView('exports.barangay-clearance', [
            'resident' => $resident
        ]);

        return $pdf->stream('barangay-clearance.pdf');
    }

    public function certificateOfIndigency(User $resident)
    {
        $pdf = PDF::loadView('exports.certificate-of-indigency', [
            'resident' => $resident
        ]);

        return $pdf->stream('certificate-of-indigency.pdf');
    }
}
