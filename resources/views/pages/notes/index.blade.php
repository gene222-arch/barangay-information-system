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
        <strong>Notes</strong>
    </h3>
    <div class="text-right">
        <a 
            href="{{ route('notes.create') }}"
            class="btn btn-success mb-2"
            data-toggle="tooltip" 
            data-placement="left" 
            title="Add new note"
            data-html="true"
        >
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
    <table class="table" id="notesTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Subject</th>
                <th scope="col">Body</th>
                <th scope="col">Created at</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notes as $note)
                <tr>
                    <td title="Edit Note">
                        <a href="{{ route('notes.edit', $note->id) }}">
                            {{ $note->title }}
                        </a>
                    </td>
                    <td>{{ $note->subject }}</td>
                    <td>{{ $note->body }}</td>
                    <td>{{ \Carbon\Carbon::parse($note->created_at)->diffForHumans() }}</td>
                    <td>
                        <a title='Edit' href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        @hasrole('Super Administrator')
                            <button title="Delete note" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $note->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            
                            <div class="modal fade" id="exampleModal{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $note->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete note</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Once deleted data cannot be retrieved
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning">Continue</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endhasrole
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection