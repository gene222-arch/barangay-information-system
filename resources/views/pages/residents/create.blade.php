@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2 class="jumbotron display-6">Add {{ request()->is('residents/*') ? 'Resident' : 'Non Resident' }}</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('residents.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="my-5">
                                <p class="lead">{{ request()->is('residents/*') ? 'Resident' : 'Non Resident' }} Information</p>
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="col-md-12 d-none">
                                <div class="form-group">
                                    <input type="file" name="image" placeholder="Choose image" id="image">
                                      @error('image')
                                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                      @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-2 text-center mb-2">
                                <label for="image" style="cursor: pointer;">
                                    <img 
                                        id="preview-image-before-upload" 
                                        src="{{ asset('avatar.png') }}"
                                        alt="preview image" 
                                        style="max-height: 250px;"
                                    >
                                    @error('image')
                                        <p class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </label>
                            </div>

                            <input type="hidden" name="user_type" value="{{ request()->is('residents/*') ? 'Resident' : 'Non Resident' }}">
 
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror bg-light" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

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
                                        value="{{ \Carbon\Carbon::parse(old('birthed_at'))->format('Y-d-m') }}"  
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
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror bg-light" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                            
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
                                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror bg-light" name="phone_number" value="{{ old('phone_number') }}"  autocomplete="name" autofocus>
                            
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="stayed_at" class="col-md-4 col-form-label text-md-end">{{ __('Date of stay') }}</label>
                            
                                <div class="col-md-6">
                                    <input 
                                        id="stayed_at" 
                                        type="date" 
                                        class="form-control @error('stayed_at') is-invalid @enderror bg-light" name="stayed_at" 
                                        value="{{ \Carbon\Carbon::parse(old('stayed_at'))->format('Y-d-m') }}"  
                                        autocomplete="stayed_at" autofocus
                                    >
                            
                                    @error('stayed_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror bg-light" name="address" value="{{ old('address') }}"  autocomplete="name" autofocus>
                            
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="born_at" class="col-md-4 col-form-label text-md-end">{{ __('Born in') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="born_at" type="text" class="form-control @error('born_at') is-invalid @enderror bg-light" name="born_at" value="{{ old('born_at') }}"  autocomplete="name" autofocus>
                            
                                    @error('born_at')
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
                                            {{  old('gender', 'Male') === 'Male' ? 'checked' : '' }}
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
                                            {{ old('gender') === 'Female' ? 'checked' : '' }}
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
                                            <option selected>Civil Status...</option>
                                            @foreach(['Single', 'Married', 'Widowed', 'Separated', 'Divorced'] as $userType)
                                                <option value="{{ $userType }}" {{ old('civil_status') === $userType ? 'selected' : '' }}>{{ $userType  }}</option>
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

@section('js')
    <script>
        $(document).ready(function (e) 
        {
            $('#image').change(function()
            {
                let reader = new FileReader();
                
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result); 
                }
                
                reader.readAsDataURL(this.files[0]); 
            });
        });
    </script>
@endsection