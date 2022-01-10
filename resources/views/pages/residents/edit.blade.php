@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('residents.update', $resident->id) }}?residentId={{ $resident->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3 justify-content-center">
                                <div class="col-12 col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                    <img 
                                        id="img"
                                        class="img img-responsive mb-3 w-100 rounded" 
                                        src="{{ asset("storage/avatars/" . $resident->details->avatar_path) }}"
                                        style="width: 30%;"
                                    >
                                </div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="custom-file">
                                        <input 
                                            type="file" 
                                            name="avatar" 
                                            class="form-control @error('avatar') is-invalid @enderror w-100" 
                                            id="chooseFile"
                                            oninput="img.src=window.URL.createObjectURL(this.files[0])"
                                            value="{{ old('avatar') }}"
                                        >
                                        <label class="custom-file-label" for="chooseFile">Select Avatar</label>
                                        @error('avatar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="my-5">
                                <p class="lead">Resident Information</p>
                                <div class="dropdown-divider"></div>
                            </div>

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
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-light {{ $resident->details->gender === 'Male' ? 'active' : '' }}">
                                            <input 
                                                type="radio" 
                                                name="gender" 
                                                id="male" 
                                                value="Male"
                                            > Male
                                        </label>
                                        <label class="btn btn-light {{ $resident->details->gender === 'Female' ? 'active' : '' }}">
                                            <input 
                                                type="radio" 
                                                name="gender" 
                                                id="female"
                                                value="Female"
                                            > Female
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
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">  Civil Status </label>
                                        </div>
                                        <select class="custom-select @error('civil_status') is-invalid @enderror" id="inputGroupSelect01" name="civil_status">
                                            <option selected>Choose...</option>
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
