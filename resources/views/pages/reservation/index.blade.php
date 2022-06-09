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
    <div class="table-responsive">
        <div class="text-right">
            <a 
                href="{{ route('reservations.create') }}"
                class="btn btn-outline-success mb-2 p-2"
                data-toggle="tooltip" 
                data-placement="left" 
                title="Add new reservation"
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
                    <th scope="col">Date</th>
                    <th scope="col">Time In</th>
                    <th scope="col">Time out</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        @hasrole('Administrator|Supervisor')
                            <td>
                                <strong>{{ $reservation->user->name }}</strong>
                            </td>
                        @endhasrole
                        <td>
                            {{ \Carbon\Carbon::parse($reservation->date)->format('M d, Y') }}
                        </td>
                        <td>
                            {{ $reservation->start }}
                        </td>
                        <td>
                            {{ $reservation->end }}
                        </td>
                        <td>
                            {{ $reservation->description }}
                        </td>
                        <td>
                            <span 
                                @class([
                                    'badge',
                                    'badge-info' => $reservation->status === 'Processing',
                                    'badge-danger' => $reservation->status === 'Denied',
                                    'badge-success' => $reservation->status === 'Granted'
                                ])
                            >
                                {{ $reservation->status }}
                            </span>
                        </td>
                        <td>
                            <div class="row align-items-center">
                                <div class="col">
                                    <button 
                                        title="Delete" 
                                        type="button" 
                                        class="btn btn-danger" 
                                        data-toggle="modal" 
                                        data-target="#exampleModal{{ $reservation->id }}"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    
                                    <div class="modal fade" id="exampleModal{{ $reservation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $reservation->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete reservation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Once deleted data cannot be retrieved
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-warning">Continue</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <a 
                                        href="{{ route('reservations.edit', $reservation->id) }}"
                                        title="Edit" 
                                        type="button" 
                                        class="btn btn-warning"
                                    >
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
