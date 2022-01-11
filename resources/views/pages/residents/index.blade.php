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
                href="{{ route('residents.create') }}"
                class="btn btn-outline-success mb-2 p-2"
                data-toggle="tooltip" 
                data-placement="left" 
                title="Add new resident"
                data-html="true"
            >
                <i class="fas fa-user-plus fa-2x"></i>
            </a>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Avatar</th>
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
                        <td>
                            <a href="{{ route('residents.edit', $resident->id) }}">
                                <img 
                                    src="{{ asset("storage/avatars/" . $resident->details->avatar_path) }}"
                                    width="100"
                                    height="100"
                                    class="img-responsive rounded"
                                >
                        </a>
                        </td>
                        <td><strong>{{ $resident->name }}</strong></td>
                        <td>
                            {{ $resident->details->phone_number }}
                        </td>
                        <td>
                            {{ $resident->details->address }}
                        </td>
                        <td>
                            <span class="badge badge-{{ $resident->complaints->count() ? 'danger' : 'success' }}">
                                {{ Str::lower($resident?->complaints?->first()?->type ?? 'clear') }}
                            </span>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('residents.destroy', $resident->id) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Remove resident">
                                            <i class="fas fa-user-minus"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col">
                                    @if($resident->complaints()->exists())
                                        <a href="{{ route('user-complaints.edit', $resident->complaints->first()->id) }}?id={{ $resident->id }}" class="btn btn-warning" title="File a complaint">
                                            <i class="fas fa-file-signature"></i>
                                        </a>
                                    @else 
                                        <a href="{{ route('user-complaints.create') }}?id={{ $resident->id }}" class="btn btn-warning" title="File a complaint">
                                            <i class="fas fa-file-signature"></i>
                                        </a>
                                    @endif 
                                </div>
                                @if($resident->activeComplaint())
                                    <div class="col">
                                        <form action="{{ route('user-complaints.clear', $resident->activeComplaint()->id) }}" method="POST">
                                            @csrf 
                                            @method('PUT')
                                            <button type="submit" class="btn btn-outline-danger" title="Clear complaint">
                                                <i class="fas fa-eraser"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="col"></div>
                                @endif 
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $residents->links() }}
    </div>
@endsection
