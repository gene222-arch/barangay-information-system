@extends('layouts.dashboard')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 text-right mb-2">
            <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-warning">Edit</a>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-6">
            <div class="card">
                <div class="imgs text-center">
                    <img
                        height="193" 
                        width="193"
                        src="{{ asset('storage/' . $resident->details->avatar_path) }}" alt="Card image cap"
                    >
                </div>
                <div class="card-header bg-transparent">
                    <div class="row justify-content-between">
                        <div class="col-10">
                            <strong>{{ $resident->name }}</strong>
                        </div>
                        @if ($resident->activeComplaint())
                            <div class="col">
                                <span class="badge badge-danger">{{ $resident->activeComplaint()->type }}</span>
                            </div>
                        @endif
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
                            {{ \Carbon\Carbon::parse($resident->details->birthed_at)->format('M d, Y') }}
                        </div>
                        <div class="col-6">
                            <strong>Address</strong>
                        </div>
                        <div class="col-6">
                            {{ $resident->details->address }}
                        </div>
                        <div class="col-6">
                            <strong>Born in</strong>
                        </div>
                        <div class="col-6">
                            {{ $resident->details->born_at }}
                        </div>
                        <div class="col-6">
                            <strong>Date of stay</strong>
                        </div>
                        <div class="col-6">
                            {{ \Carbon\Carbon::parse($resident->details->stayed_at)->format('M d, Y') }}
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
                        <button class="btn btn-danger btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
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
                    <p>
                        <p>
                            <button class="btn btn-light btn-block" type="button" data-toggle="collapse" data-target="#brgyClearance" aria-expanded="false" aria-controls="collapseExample">
                                Generate Barangay Clearance
                            </button>
                        </p>
                        <div class="collapse" id="brgyClearance">
                            <form action="{{ route('export.barangay-clearance', $resident->id) }}">
                                <input type="hidden" name="is_paid" value="true">
                                <button 
                                    type="submit"
                                    class="btn btn-dark text-light btn-block mb-1"
                                    {{ $resident->activeComplaint() ? 'disabled' : '' }}
                                >
                                    Paid
                                </button>
                            </form>
                            <form action="{{ route('export.barangay-clearance', $resident->id) }}">
                                <input type="hidden" name="is_paid" value="false">
                                <button 
                                    type="submit"
                                    class="btn btn-dark text-light btn-block"
                                    {{ $resident->activeComplaint() ? 'disabled' : '' }}
                                >
                                    Not Paid
                                </button>
                            </form>
                        </div>
                    </p>
                    <p>
                        <p>
                            <button class="btn btn-light btn-block" type="button" data-toggle="collapse" data-target="#brgyCert" aria-expanded="false" aria-controls="collapseExample">
                                Generate Certificate of Residency
                            </button>
                        </p>
                        <div class="collapse" id="brgyCert">
                            <form action="{{ route('export.barangay-certification', $resident->id) }}">
                                <input type="hidden" name="is_paid" value="true">
                                <button 
                                    type="submit"
                                    class="btn btn-dark text-light btn-block mb-2"
                                    {{ $resident->activeComplaint() ? 'disabled' : '' }}
                                >
                                    Paid
                                </button>
                            </form>
                            <form action="{{ route('export.barangay-certification', $resident->id) }}">
                                <input type="hidden" name="is_paid" value="false">
                                <button 
                                    type="submit"
                                    class="btn btn-dark text-light btn-block"
                                    {{ $resident->activeComplaint() ? 'disabled' : '' }}
                                >
                                    Not Paid
                                </button>
                            </form>
                        </div>
                    </p>
                    <p>
                        <form action="{{ route('export.cert.of.indegency', $resident->id) }}">
                            <button 
                                type="submit"
                                class="btn btn-light text-dark btn-block"
                                {{ $resident->activeComplaint() ? 'disabled' : '' }}
                            >
                                Generate Certificate of Indigency
                            </button>
                        </form>
                    </p>
                    <p>
                        <form action="{{ route('export.id', $resident->id) }}">
                            <button 
                                type="submit"
                                class="btn btn-light text-dark btn-block"
                                {{ $resident->activeComplaint() ? 'disabled' : '' }}
                            >
                                Generate ID
                            </button>
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection