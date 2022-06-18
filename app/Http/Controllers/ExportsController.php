<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\PDF;

class ExportsController extends Controller
{
    public function barangayClearance(User $resident)
    {
        $pdf = PDF::loadView('exports.barangay-clearance', [
            'resident' => $resident
        ]);

        $filename = 'barangay-clearance.pdf';

        $resident->documents()->create([
            'type' => 'Barangay Clearance',
            'name' => $filename,
        ]);

        return $pdf->stream($filename);
    }

    public function barangayCertification(User $resident)
    {
        $pdf = PDF::loadView('exports.barangay-certification', [
            'resident' => $resident
        ]);

        $filename = 'barangay-certification.pdf';

        $resident->documents()->create([
            'type' => 'Barangay Certification',
            'name' => $filename,
        ]);

        return $pdf->stream($filename);
    }

    public function certificateOfIndigency(User $resident)
    {
        $pdf = PDF::loadView('exports.certificate-of-indigency', [
            'resident' => $resident
        ]);

        $filename = 'certificate-of-indigency.pdf';

        $resident->documents()->create([
            'type' => 'Certificate of Indigency',
            'name' => $filename,
        ]);

        return $pdf->stream($filename);
    }

    public function certificateOfRegistration(User $resident)
    {
        $pdf = PDF::loadView('exports.certificate-of-registration', [
            'resident' => $resident
        ]);

        $filename = 'certificate-of-registration.pdf';

        $resident->documents()->create([
            'type' => 'Certificate of Registration',
            'name' => $filename,
        ]);

        return $pdf->stream($filename);
    }

    public function id(User $resident)
    {
        $pdf = PDF::loadView('exports.id', [
            'resident' => $resident
        ]);

        $filename = Str::slug($resident->name) . '-ID.pdf';

        $resident->documents()->create([
            'type' => 'Barangay ID',
            'name' => $filename,
        ]);

        return $pdf->stream($filename);
    }
}
