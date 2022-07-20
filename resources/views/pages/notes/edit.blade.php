@extends('layouts.dashboard')

@section('content')
    <form action="{{ route('notes.update', $note->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">Update Note</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Title</span>
                                    </div>
                                    <input value="{{ $note->title }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror bg-light" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Subject</span>
                                    </div>
                                    <input value="{{ $note->subject }}" name="subject" type="text" class="form-control @error('subject') is-invalid @enderror bg-light" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    @error('subject')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Message</span>
                                    </div>
                                    <textarea name="body" class="form-control bg-light" aria-label="With textarea">{{ $note->body }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-5 text-right">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection