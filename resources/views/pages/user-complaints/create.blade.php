@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        File a complaint to <strong class="text-danger">{{ $resident->name }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-left">
                                <div class="mt-5 row column">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col">
                                                <strong>Name</strong>
                                            </div>
                                            <div class="col">
                                                {{ $resident->name }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col">
                                                <strong>Gender</strong>
                                            </div>
                                            <div class="col">
                                                {{ $resident->details->gender }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col">
                                                <strong>Address</strong>
                                            </div>
                                            <div class="col">
                                                {{ $resident->details->address }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user-complaints.store') }}?id={{ $resident->id }}">
                            @csrf

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-8 mx-auto">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Type</label>
                                        </div>
                                        <select class="custom-select @error('type') is-invalid @enderror" id="inputGroupSelect01" name="type">
                                            <option selected>Choose...</option>
                                            @foreach(['Blotter'] as $type)
                                                <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
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
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea 
                                        class="form-control 
                                        @error('description') is-invalid @enderror bg-light" 
                                        id="description" 
                                        name="description" 
                                        rows="3" 
                                        autocomplete="description" 
                                        autofocus>{{ old('description') }}</textarea>
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
