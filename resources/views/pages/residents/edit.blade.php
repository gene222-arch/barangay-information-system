@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2 class="jumbotron display-6">Edit {{ request()->is('/residents/*') ? 'Resident' : 'Non Resident' }}</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('residents.update', $resident->id) }}?residentId={{ $resident->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="my-5">
                                <p class="lead">{{ request()->is('/residents/*') ? 'Resident' : 'Non Resident' }} Information</p>
                                <div class="dropdown-divider"></div>
                            </div>

                            <input type="hidden" name="user_type" value="{{ request()->is('/residents/*') ? 'Resident' : 'Non Resident' }}">

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror bg-light" name="name" value="{{ $resident->name }}"  autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="birthed_at" class="col-md-4 col-form-label text-md-end">{{ __('Birthday') }}</label>
                            
                                <div class="col-md-6">
                                    <input 
                                        id="birthed_at" 
                                        type="date" 
                                        class="form-control @error('birthed_at') is-invalid @enderror bg-light" name="birthed_at" 
                                        value="{{ $resident->details->birthed_at }}"  
                                        autocomplete="birthed_at" autofocus
                                    >
                            
                                    @error('birthed_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror bg-light" name="email" value="{{ $resident->email }}"  autocomplete="email" autofocus>
                            
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror bg-light" name="phone_number" value="{{ $resident->details->phone_number }}"  autocomplete="name" autofocus>
                            
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror bg-light" name="address" value="{{ $resident->details->address }}"  autocomplete="name" autofocus>
                            
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                                
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input @error('gender') is-invalid @enderror" 
                                            type="radio" 
                                            name="gender" 
                                            id="flexRadioDefault1" 
                                            value="Male"
                                            {{  $resident->details->gender === 'Male' ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label" for="flexRadioDefault1">
                                          Male
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input 
                                            class="form-check-input @error('gender') is-invalid @enderror" 
                                            type="radio" 
                                            name="gender" 
                                            value="Female"
                                            id="flexRadioDefault2"
                                            {{ $resident->details->gender === 'Female' ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label" for="flexRadioDefault2">
                                          Female
                                        </label>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                      </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8 mx-auto">
                                    <div class="input-group mb-3">
                                        <select class="custom-select @error('civil_status') is-invalid @enderror" id="inputGroupSelect01" name="civil_status">
                                            @foreach(['Single', 'Married', 'Widowed', 'Separated', 'Divorced'] as $civilStatus)
                                                <option value="{{ $civilStatus }}" {{ $resident->details->civil_status === $civilStatus ? 'selected' : '' }}>{{ $civilStatus  }}</option>
                                            @endforeach
                                        </select>
                                        @error('civil_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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
