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
    <h3 class="mb-5">
        <strong>Documents</strong>
    </h3>
    <table class="table" id="documentsTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">User Type</th>
                <th scope="col">User</th>
                <th scope="col">Type</th>
                <th scope="col">Name</th>
                <th scope="col">Requested at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                <tr>
                    <td>
                        {{ Auth::user()->roles->first()->name }}
                    </td>
                    <td>
                        {{ $document->user->name }}
                    </td>
                    <td >
                        {{ $document->type }}
                    </td>
                    <td>{{ $document->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($document->created_at)->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection