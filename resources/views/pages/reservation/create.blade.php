@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('reservations.store') }}">
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
                                <label for="start" class="col-md-4 col-form-label text-md-end">{{ __('Start time') }}</label>
                            
                                <div class="col-md-6">
                                    <input 
                                        id="start" 
                                        type="time"     
                                        class="form-control @error('start') is-invalid @enderror bg-light" name="start" 
                                        value="{{ old('start') }}"  
                                        autocomplete="start" 
                                        required
                                    >
                            
                                    @error('start')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="end" class="col-md-4 col-form-label text-md-end">{{ __('End time') }}</label>
                            
                                <div class="col-md-6">
                                    <input 
                                        id="end" 
                                        type="time" 
                                        class="form-control @error('end') is-invalid @enderror bg-light" 
                                        name="end" 
                                        value="{{ old('end') }}"  
                                        autocomplete="end" 
                                        required
                                    >
                            
                                    @error('end')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea 
                                        id="description"
                                        class="form-control @error('description') is-invalid @enderror bg-light" 
                                        name="description"
                                        autocomplete="description"
                                        required
                                        rows="3"
                                    >{{ old('description') }}</textarea>
                                    @error('description')
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
                                    <a href="{{ route('residents.index') }}" class="btn btn-outline-primary">
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
