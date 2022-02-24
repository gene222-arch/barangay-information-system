@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header bg-transparent">
            <h3>City Directory</h3>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="emergency-list" data-toggle="list" href="#emergency" role="tab" aria-controls="home">Emergency Hotline Calamba City Hall</a>
                        <a class="list-group-item list-group-item-action" id="bfp-list" data-toggle="list" href="#bfp" role="tab" aria-controls="profile">BFP</a>
                        <a class="list-group-item list-group-item-action" id="pnp-list" data-toggle="list" href="#pnp" role="tab" aria-controls="messages">PNP</a>
                        <a class="list-group-item list-group-item-action" id="poso-list" data-toggle="list" href="#poso" role="tab" aria-controls="settings">POSO</a>
                        <a class="list-group-item list-group-item-action" id="poso-list" data-toggle="list" href="#pamana" role="tab" aria-controls="settings">PAMANA Hospital</a>
                        <a class="list-group-item list-group-item-action" id="poso-list" data-toggle="list" href="#jp" role="tab" aria-controls="settings">JP Hospital</a>
                        <a class="list-group-item list-group-item-action" id="poso-list" data-toggle="list" href="#cmc" role="tab" aria-controls="settings">CMC</a>
                        <a class="list-group-item list-group-item-action" id="poso-list" data-toggle="list" href="#cdh" role="tab" aria-controls="settings">CDH</a>
                        <a class="list-group-item list-group-item-action" id="poso-list" data-toggle="list" href="#meralco" role="tab" aria-controls="settings">MERALCO</a>
                        <a class="list-group-item list-group-item-action" id="poso-list" data-toggle="list" href="#ldrrmo" role="tab" aria-controls="settings">LDRRMO/MO</a>
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="emergency" role="tabpanel" aria-labelledby="emergency-list">
                            <h3>545-6789</h3>
                        </div>
                        <div class="tab-pane fade" id="bfp" role="tabpanel" aria-labelledby="bfp-list">
                            <h3>545-1695</h3>
                            <h3>Local (8600-701)</h3>
                        </div>
                        <div class="tab-pane fade" id="pnp" role="tabpanel" aria-labelledby="pnp-list">
                            <h3>545-1694</h3>
                            <h3>Local (8700-01)</h3>
                        </div>
                        <div class="tab-pane fade" id="poso" role="tabpanel" aria-labelledby="poso-list">
                            <h3>0998-8490-343</h3>
                        </div>
                        <div class="tab-pane fade" id="pamana" role="tabpanel" aria-labelledby="poso-list">
                            <h3>545-6858</h3>
                        </div>
                        <div class="tab-pane fade" id="jp" role="tabpanel" aria-labelledby="poso-list">
                            <h3>545-1885</h3>
                        </div>
                        <div class="tab-pane fade" id="cmc" role="tabpanel" aria-labelledby="poso-list">
                            <h3>545-1740</h3>
                        </div>
                        <div class="tab-pane fade" id="cdh" role="tabpanel" aria-labelledby="poso-list">
                            <h3>545-7371</h3>
                        </div>
                        <div class="tab-pane fade" id="meralco" role="tabpanel" aria-labelledby="poso-list">
                            <h3>16211</h3>
                        </div>
                        <div class="tab-pane fade" id="ldrrmo" role="tabpanel" aria-labelledby="poso-list">
                            <h3>545-6789</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection