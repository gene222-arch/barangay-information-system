@extends('layouts.dashboard')

@section('content')
    @if (Session::has('successMessage'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successMessage') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <h3>
        <strong class="headerTitle">Monthly Revenues</strong>
    </h3>
    <table class="table" id="docsTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Revenue</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 0;
            @endphp
            @foreach ($documents as $doc)
                <tr>
                    <td>
                        {{ $id += 1 }}
                    </td>
                    <td>
                        P{{ $doc->revenue }}
                    </td>
                    <td >
                        {{ $doc->date_ }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
<script>
    $('form .doctype').on('change', function(){
        $(this).closest('form').submit();
    });
</script>
@endsection