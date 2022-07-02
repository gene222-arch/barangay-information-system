@extends('layouts.dashboard')

@section('content')
<table class="table table-hover" id="notesTable">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Hotline</th>
            <th scope="col">Number</th>
        </tr>
    </thead>
    <tbody>
        @foreach ([
            'Emergency Hotline Calamba City Hall' => '545-6789',
            'BFP' => '545-1695',
            'PNP' => '545-1694',
            'POSO' => '0998-8490-343',
            'PAMANA Hospital' => '545-6858',
            'JP Hospital' => '545-1885',
            'CMC' => '545-1740',
            'CDH' => '545-7371',
            'MERALCO' => '16211',
            'LDRRMO/MO' => '545-6789',
        ] as $hotline => $number)
            <tr>
                <td>
                    {{ $hotline }}
                </td>
                <td>
                    {{ $number }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection