@extends('layouts.master')
@section('content')

<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title">Welcome !</h3>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="widget-panel widget-style-2 bg-pink">
                            <i class="ion-eye"></i>
                            <h2 class="m-0 counter">{{ $totalAgen->count() }}</h2>
                            <div>Total Agent</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-panel widget-style-2 bg-purple">
                            <i class="ion-paper-airplane"></i>
                            <h2 class="m-0 counter">{{ $totalJamaah->count() }}</h2>
                            <div>Total Jamaah</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-panel widget-style-2 bg-info">
                            <i class="ion-ios7-pricetag"></i>
                            <h2 class="m-0 counter">{{ $totalProspek->count() }}</h2>
                            <div>Total Prospek</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="widget-panel widget-style-2 bg-warning">
                            <i class="ion-cash"></i>
                            <h2 class="m-0 counter">Rp. {{ number_format($sumofPotensi,2,',','.') }}</h2>
                            <div>Total Potensi</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="widget-panel widget-style-2 bg-success">
                            <i class="ion-cash"></i>
                            <h2 class="m-0 counter">Rp. {{ number_format($sumofKomisi,2,',','.') }}</h2>
                            <div>Total Komisi</div>
                        </div>
                    </div>
                </div> <!-- end row -->



                <div class="row">
                    <div class="col-lg-8">
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Total Perbulan Jamaah Berdasarkan Periode
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet1"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet1" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="total-jamaah-chart"  style="height: 320px;"></div>

                                    <div class="row text-center m-t-30 m-b-30">
                                        <div class="col-sm-3 col-xs-6 col-md-offset-4">
                                            <i class="fa fa-user"></i> 
                                            <h4>{{ $totalJamaahChart }} Jamaah</h4>
                                            <small class="text-muted">Total Jamaah Tahun Ini</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /Portlet -->

                    </div> <!-- end col -->

                    <div class="col-lg-4">
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Grafik Prospek
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="total-prospek-chart" style="height: 200px;"></div>
                                    <div class="row text-center m-t-30">
                                        <div class="col-sm-4">
                                            <h4><i class="fa fa-user"></i> Prospek</h4>
                                            <small class="text-muted"> Total Prospek Tahun Ini </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /Portlet -->
                    </div>
                </div> <!-- End row -->



            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->
@push('otherJavascript')
<script>
    var data = JSON.parse('{!! $totalJamaahChart !!}');
 $(function() {
  // Create a function that will handle AJAX requests
  function requestData(days, chart){
    $.ajax({
      type: "GET",
      url: "{{url('api/jamaah/totalByPeriode')}}", // This is the URL to the API
      data: { days: days }
    })
    .done(function( data ) {
      // When the response to the AJAX request comes back render the chart with new data
      chart.setData(JSON.parse(data));
    })
    .fail(function() {
      // If there is no communication between the server, show an error
      alert( "error occured" );
    });
  }
  var chart = Morris.Bar({
    // ID of the element in which to draw the chart.
    element: 'total-jamaah-chart',
    // Set initial data (ideally you would provide an array of default data)
    data: [0,0],
    xkey: 'month',
    ykeys: ['value'],
    labels: ['Jamaah'],
    barColors: ['#d32f2f']
  });
  // Request initial data for the past 7 days:
  requestData(12, chart);
  $('ul.ranges a').click(function(e){
    e.preventDefault();
    // Get the number of days from the data attribute
    var el = $(this);
    days = el.attr('data-range');
    // Request the data and render the chart using our handy function
    requestData(days, chart);
    // Make things pretty to show which button/tab the user clicked
    el.parent().addClass('active');
    el.parent().siblings().removeClass('active');
  })
});


// Chart Prospek
var data = JSON.parse('{!! $stats !!}');
    
    Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'total-prospek-chart',
        data: data,
        xkey: 'month',
        ykeys: ['value'],
        labels: ['Prospek'],
        resize: true,
        barColors: ['#1a2942']
    });

// Chart Jamaah

// var dataJamaah = JSON.parse();
    
//     Morris.Bar({
//         // ID of the element in which to draw the chart.
//         element: 'total-jamaah-periode-chart',
//         data: dataJamaah,
//         xkey: 'month',
//         ykeys: ['value'],
//         labels: ['Jamaah'],
//         resize: true,
//         barColors: ['#00b0ff']
//     });

</script>
@endpush
@endsection
