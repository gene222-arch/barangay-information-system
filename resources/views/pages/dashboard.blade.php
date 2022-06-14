@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-5">
            <div class="card text-center">
                <div class="card-header bg-dark">
                </div>
                <div class="card-body">
                  <h5 class="card-title">Enter barcode here</h5>
                    <form method="POST" action="{{ route('residents.barcode') }}">
                        @csrf
                        <div class="input-group input-group-sm mb-3 px-5">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa-solid fa-barcode"></i></span>
                            </div>
                            <input 
                                name="barcode" 
                                type="password" 
                                class="form-control @error('barcode') is-invalid @enderror bg-light" 
                                aria-label="Small" 
                                aria-describedby="inputGroup-sizing-sm"
                                autofocus
                            >
                            @error('barcode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <p class="card-text">Please do enter a valid barcode</p>
                        <button type="submit" class="btn btn-primary">Scan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
            <div class="card border-dark mb-3">
                <div class="row align-items-center">
                    <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <div class="card-body text-dark">
                            <h5 class="card-title"><h3><strong>{{ $nonResidentsCount }}</strong></h3></h5>
                            <p class="card-text text-secondary">Non Residents</p>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                        <i class="fas fa-users fa-3x text-dark"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
            <div class="card border-success mb-3">
                <div class="row align-items-center">
                    <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <div class="card-body text-success">
                            <h5 class="card-title"><h3><strong>{{ $residentsCount }}</strong></h3></h5>
                            <p class="card-text text-secondary">Residents</p>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                        <i class="fas fa-users fa-3x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
            <div class="card border-warning mb-3">
                <div class="row align-items-center">
                    <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <div class="card-body text-warning">
                            <h5 class="card-title"><h3><strong>{{ $schedulesCount }}</strong></h3></h5>
                            <p class="card-text text-secondary">Schedules</p>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                        <i class="far fa-calendar fa-3x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
            <div class="card border-danger mb-3">
                <div class="row align-items-center">
                    <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <div class="card-body text-danger">
                            <h5 class="card-title"><h3><strong>{{ $blottersCount }}</strong></h3></h5>
                            <p class="card-text text-secondary">Blotters</p>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                        <i class="fas fa-user-slash fa-3x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
            <div class="card border-info mb-3">
                <div class="row align-items-center">
                    <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <div class="card-body text-info">
                            <h5 class="card-title"><h3><strong>{{ $documentsCount }}</strong></h3></h5>
                            <p class="card-text text-secondary">Documents Requested</p>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                        <i class="fa-solid fa-file-circle-plus text-info fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
