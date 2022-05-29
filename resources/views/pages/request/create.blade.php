@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2 class="jumbotron display-6">Add Assistance Request</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('assistance-requests.store') }}">
                            @csrf

                            @hasrole('Administrator|Supervisor')
                                <div class="row mb-3">
                                    <div class="col-md-8 mx-auto">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text bg-light" for="inputGroupSelect01">Residents</label>
                                            </div>
                                            <select 
                                                class="custom-select @error('user_id') is-invalid @enderror" 
                                                id="inputGroupSelect01" 
                                                name="user_id"
                                            >
                                                <option selected>Choose...</option>
                                                @forelse ($residents as $resident)
                                                    <option 
                                                        value="{{ $resident->id }}" {{ old('user_id') === $resident->id ? 'selected' : '' }}
                                                    >
                                                        {{ $resident->name  }}
                                                    </option>
                                                @empty
                                                    <div class="alert alert-warning" role="alert">
                                                        No residents yet....
                                                    </div>
                                                @endforelse
                                            </select>
                                            @error('user_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endhasrole

                            @hasrole('Resident')
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            @endhasrole

                            <div class="row mb-3">
                                <div class="col-md-8 mx-auto">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text bg-light" for="inputGroupSelect01">Type</label>
                                        </div>
                                        <select 
                                            class="custom-select @error('type') is-invalid @enderror" 
                                            id="inputGroupSelect01" 
                                            name="type"
                                        >
                                            <option selected>Choose...</option>
                                            @forelse ([
                                                'Barangay Clearance',
                                                'Barangay ID',
                                            ] as $type)
                                                <option 
                                                    value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}
                                                >
                                                    {{ $type  }}
                                                </option>
                                            @empty
                                                <div class="alert alert-warning" role="alert">
                                                    No assistance request type yet....
                                                </div>
                                            @endforelse
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="reason" class="col-md-4 col-form-label text-md-end">{{ __('Reason') }}</label>

                                <div class="col-md-6">
                                    <textarea 
                                        id="reason"
                                        class="form-control @error('reason') is-invalid @enderror bg-light" 
                                        name="reason"
                                        autocomplete="reason"
                                        required
                                        rows="3"
                                    >{{ old('reason') }}</textarea>
                                    @error('reason')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0 justify-content-end">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{ route('assistance-requests.index') }}" class="btn btn-outline-primary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
