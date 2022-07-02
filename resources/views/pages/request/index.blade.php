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
        <strong>Requests</strong>
    </h3>
    <div class="table-responsive">
        <div class="text-right">
            <a 
                href="{{ route('assistance-requests.create') }}"
                class="btn btn-outline-success mb-2 p-2"
                data-toggle="tooltip" 
                data-placement="left" 
                title="Add new request"
                data-html="true"
            >
                <i class="fas fa-calendar-plus fa-2x px-1"></i>
            </a>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    @hasrole('Administrator|Supervisor')
                        <th scope="col">Resident</th>
                    @endhasrole
                    <th scope="col">Type</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr>
                        @hasrole('Administrator|Supervisor')
                            <td>
                                <strong>{{ $request->user->name }}</strong>
                            </td>
                        @endhasrole
                        <td>
                            {{ $request->type }}
                        </td>
                        <td>
                            {{ $request->reason }}
                        </td>
                        <td>
                            <span 
                                @class([
                                    'badge',
                                    'badge-info' => $request->status === 'Processing',
                                    'badge-danger' => $request->status === 'Denied',
                                    'badge-success' => $request->status === 'Granted'
                                ])
                            >
                                {{ $request->status }}
                            </span>
                        </td>
                        <td>
                            <div class="action">
                                <a 
                                    href="{{ route('assistance-requests.edit', $request->id) }}"
                                    title="Edit" 
                                    type="button" 
                                    class="btn btn-warning"
                                >
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <button 
                                    title="Delete" 
                                    type="button" 
                                    class="btn btn-danger" 
                                    data-toggle="modal" 
                                    data-target="#exampleModal{{ $request->id }}"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                
                                <div class="modal fade" id="exampleModal{{ $request->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $request->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete request</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Once deleted data cannot be retrieved
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{ route('assistance-requests.destroy', $request->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-warning">Continue</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
