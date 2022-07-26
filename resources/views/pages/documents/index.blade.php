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
    <table class="table" id="documentsTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Resident</th>
                <th scope="col">Type</th>
                <th scope="col">Name</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Requested at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                @php
                    $cost = (float) $document->cost;
                @endphp
                <tr>
                    <td>
                        {{ $document?->user?->name ?? 'Unknown' }}
                    </td>
                    <td >
                        {{ $document->type }}
                    </td>
                    <td>{{ $document->name }}</td>
                    <td>
                        @if (!$document->is_senior && $document->type !== 'Certificate of Indigency')
                            <span class="badge badge-pill badge-{{ !$cost ? 'danger' : 'success' }}">
                                @if($document)
                                    {{ Str::lower(!$cost ? 'Not Paid' : 'Paid') }}
                                @else
                                    clear
                                @endif
                            </span>
                        @else
                            <span class="badge badge-pill badge-secondary">
                                free
                            </span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($document->created_at)->format('M d, Y') }}</td>
                    <td>
                        @if (!$document->is_senior && $document->type !== 'Certificate of Indigency' && !$cost)
                            <div>
                                <button 
                                    title="Pay" 
                                    type="button" 
                                    class="btn btn-info" 
                                    data-toggle="modal" 
                                    data-target="#payBtn{{ $document->id }}"
                                >
                                    Pay
                                </button>
                                
                                <div 
                                    class="modal fade" 
                                    id="payBtn{{ $document->id }}" 
                                    tabindex="-1" 
                                    role="dialog" 
                                    aria-labelledby="payBtnLabel{{ $document->id }}" 
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="payBtnLabel">Pay</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Confirm payment?
                                            </div>
                                            <div class="modal-footer">
                                                <button 
                                                    type="button" 
                                                    class="btn btn-outline-secondary" 
                                                    data-dismiss="modal"
                                                >
                                                    Close
                                                </button>
                                                <form 
                                                    action="{{ route('documents.pay', $document->id) }}" 
                                                    method="post"
                                                >
                                                    @csrf
                                                    @method('PUT')

                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-secondary"
                                                    >
                                                        Confirm
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-secondary">No Action</p>
                        @endif
                    </td>
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