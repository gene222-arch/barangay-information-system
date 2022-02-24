@extends('layouts.dashboard')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-8 col-lg-6">
            <div class="card">
                <img 
                    class="card-img-top" 
                    src="{{ asset("storage/avatars/" . $resident->details->avatar_path) }}" 
                    height="400" 
                    width="300" 
                    alt="{{ $resident->name }}"
                >
                <div class="card-header bg-transparent">
                    <div class="row justify-content-between">
                        <div class="col-10">
                            <strong>{{ $resident->name }}</strong>
                        </div>
                        <div class="col">
                            <span class="badge badge-danger">Blotter</span>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <strong>Gender</strong>
                        </div>
                        <div class="col-6">
                            {{ $resident->details->gender }}
                        </div>
                        <div class="col-6">
                            <strong>Birthday</strong>
                        </div>
                        <div class="col-6">
                            {{ $resident->details->birthed_at }}
                        </div>
                        <div class="col-6">
                            <strong>Address</strong>
                        </div>
                        <div class="col-6">
                            {{ $resident->details->address }}
                        </div>
                        <div class="col-6">
                            <strong>Civil Status</strong>
                        </div>
                        <div class="col-6">
                            {{ $resident->details->civil_status }}
                        </div>
                        <div class="col-6">
                            <strong>Phone Number</strong>
                        </div>
                        <div class="col-6">
                            {{ $resident->details->phone_number }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <p>
                        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Complaint history
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resident->complaints as $complaint)
                                    <tr>
                                        <td>{{ $complaint->type }}</td>
                                        <td>{{ $complaint->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($complaint->created_at)->diffForHumans() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection