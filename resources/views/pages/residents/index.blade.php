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
        <strong>
            @if(request()->is('residents'))
                Residents
            @else 
                Non Residents
            @endif
        </strong>
    </h3>
    <div class="table-responsive">
        <div class="text-right">
            <a 
                href="{{ request()->is('residents') ? route('residents.create') : route('residents.none.create') }}"
                class="btn btn-success mb-2 px-2"
                data-toggle="tooltip" 
                data-placement="left" 
                title="Add new resident"
                data-html="true"
            >
                <i class="fas fa-user-plus"></i>
            </a>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($residents as $resident)
                    <tr>
                        <td><strong>{{ $resident->name }}</strong></td>
                        <td>
                            {{ $resident->details->phone_number }}
                        </td>
                        <td>
                            {{ $resident->details->address }}
                        </td>
                        <td>
                            <span class="badge badge-pill badge-{{ $resident->activeComplaint() ? 'danger' : 'success' }}">
                                @if($resident->activeComplaint())
                                    {{ Str::lower($resident->activeComplaint()->type) }}
                                @else
                                    clear
                                @endif 
                            </span>
                        </td>
                        <td>
                            <div class="actions-container">
                                <a 
                                    href="{{ route('residents.show', $resident->id) }}" 
                                    class="btn btn-info" 
                                    title="View More Details"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @if (request()->is('residents'))
                                    <a 
                                        href="{{ route('residents.edit', $resident->id) }}" 
                                        class="btn btn-warning" 
                                        title="Edit"
                                    >
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                @else
                                    <a 
                                        href="{{ route('residents.none.edit', $resident->id) }}" 
                                        class="btn btn-warning" 
                                        title="Edit"
                                    >
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                @endif
                                <button 
                                    title="Delete" 
                                    type="button" 
                                    class="btn btn-danger" 
                                    data-toggle="modal" 
                                    data-target="#exampleModal{{ $resident->id }}"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                
                                <div class="modal fade" id="exampleModal{{ $resident->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $resident->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete resident</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Once deleted data cannot be retrieved
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{ route('residents.destroy', $resident->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-warning">Continue</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($resident->activeComplaint())
                                    <a 
                                        href="{{ route('user-complaints.edit', $resident->complaints->first()->id) }}?id={{ $resident->id }}" 
                                        class="btn btn-dark" 
                                        title="Update complaint filed"
                                    >
                                        <i class="fas fa-file-signature"></i>
                                    </a>
                                @else 
                                    <a 
                                        href="{{ route('user-complaints.create') }}?id={{ $resident->id }}" 
                                        class="btn btn-dark" 
                                        title="File a complaint"
                                    >
                                        <i class="fas fa-file-signature"></i>
                                    </a>
                                @endif 
                                @if($resident->activeComplaint())
                                    <form 
                                        action="{{ route('user-complaints.clear', $resident->activeComplaint()->id) }}" method="POST"
                                    >
                                        @csrf 
                                        @method('PUT')
                                        <button type="submit" class="btn btn-outline-danger" title="Clear complaint">
                                            <i class="fas fa-eraser"></i>
                                        </button>
                                    </form>
                                @endif 
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
