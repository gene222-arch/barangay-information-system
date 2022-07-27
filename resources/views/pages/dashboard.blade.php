@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-5">
            <div class="card text-center">
                <div class="card-header bg-dark">
                </div>
                @hasanyrole('Administrator|Supervisor')
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
                @endhasanyrole
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
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
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
            <div class="card border-dark mb-3">
                <div class="row align-items-center">
                    <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <div class="card-body text-info">
                            <h5 class="card-title"><h3><strong>{{ $residentsCount }}</strong></h3></h5>
                            <p class="card-text text-secondary">Residents</p>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                        <i class="fas fa-users fa-3x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
            <div class="card border-dark mb-3">
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
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
            <div class="card border-dark mb-3">
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
        <div class="divider mt-4"></div>
        <h3><strong>Documents</strong></h3>
        <div id="container"></div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        const monthlyRevenue = {!! json_encode($monthlyRevenue) !!};
        
        console.log(monthlyRevenue);

        Highcharts.chart('container', 
        {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Individual Document Revenue'
            },
            subtitle: {
                text: 'A more detailed revenue of every document'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Revenue (PHP)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>₱{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: 
            [
                {
                    name: 'Certificate of Residency',
                    data: monthlyRevenue.certificate_of_residency.map(val => parseFloat(val)),
                }, 
                {
                    name: 'Barangay ID',
                    data: monthlyRevenue.barangay_i_d.map(val => parseFloat(val)),
                }, 
                {
                    name: 'Barangay Clearance',
                    data: monthlyRevenue.barangay_clearance.map(val => parseFloat(val)),
                }, 
                {
                    name: 'Certificate of Registration',
                    data: monthlyRevenue.certificate_of_registration.map(val => parseFloat(val)),
                },
                {
                    name: 'Certificate of Indigency',
                    data: monthlyRevenue.certificate_of_indigency.map(val => parseFloat(val)),
                },
            ]
        });
             
    </script>
@endsection
