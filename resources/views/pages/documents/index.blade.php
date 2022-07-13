@extends('layouts.dashboard')

@section('content')
    @if (Session::has('successMessage'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successMessage') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <h3>
        <strong class="headerTitle">Documents</strong>
    </h3>
    <div class="text-right mb-4">
        <form action="{{ route('documents.index') }}" method="get">
            @csrf
            <select name="document_type" class="doctype" onchange="this.form.submit()">
                <option value="">Filter Type</option>
                @foreach (['Barangay Clearance', 'Barangay ID', 'Certificate of Indigency', 'Barangay Certification'] as $documentType)
                    <option {{ $documentType === $docType ? 'selected' : '' }} value="{{ $documentType }}">{{ $documentType }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <table class="table" id="documentsTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Resident</th>
                <th scope="col">Type</th>
                <th scope="col">Name</th>
                <th scope="col">Requested at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                <tr>
                    <td>
                        {{ $document?->user?->name ?? 'Unknown' }}
                    </td>
                    <td >
                        {{ $document->type }}
                    </td>
                    <td>{{ $document->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($document->created_at)->format('M d, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
<script>
    $('form .doctype').on('change', function(){
        $(this).closest('form').submit();
    });
</script>
@endsection