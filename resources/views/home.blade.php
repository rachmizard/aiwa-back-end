@extends('layouts.master')
@section('content')

<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title">Dashboard</h3>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mini-stat clearfix bg-inverse">
                            <span class="mini-stat-icon bg-danger"><i class="ion-man"></i></span>
                            <div class="mini-stat-info text-right">
                                <span class="counter">{{ $totalAgen->count() }}</span>
                                Total Agent
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-stat clearfix bg-inverse">
                            <span class="mini-stat-icon bg-inverse"><i class="ion-ios7-pricetag"></i></span>
                            <div class="mini-stat-info text-right">
                                <span class="counter">{{ $totalProspek->count() }}</span>
                                Total Prospek
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    PERIODE HIJRIAH
                                </h3>
                                <div class="portlet-widgets">
                                    <!-- <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a> -->
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet1"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <!-- <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a> -->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet1" class="panel-collapse collapse in ">
                                <div class="portlet-body">
                                    <form action="" method="GET" id="filter" class="form-inline">
                                        {{ csrf_field() }}
                                        <div class="form-group  m-l-10">
                                            <!-- <label for="">Periode Grafik</label> -->
                                            <select name="periode" id="" class="select2 col-md-4" style="width: 100%;" onchange="document.getElementById('filter').submit();">
                                                @foreach($periodes as $periode)
                                                <!-- Ini sengaja di kasih kondisi biar si ALL nya ga kedetek -->
                                                    @if($periode->id != 7)
                                                         <option value="{{ $periode->judul }}" {{ $periode->judul == $varJay->judul ? 'selected' : '' }}>{{ $periode->judul }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group  m-l-10">
                                            <!-- <label for="">Agen</label> -->
                                            <select name="agen" id="" class="select2 col-md-4" onchange="document.getElementById('filter').submit();" style="width: 100%;">
                                                <option disabled selected>Periode</option>
                                                @foreach($totalAgen as $in)
                                                    <option value="{{ $in->id }}" {{ $in->id == $selectRequest ? 'selected' : '' }}>{{ $in->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- /Portlet -->
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    TOP TOTAL CLOSING
                                </h3>
                                <div class="portlet-widgets">
                                    <!-- <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a> -->
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#top-total-accordion"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <!-- <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a> -->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="top-total-accordion" class="panel-collapse collapse in ">
                                <div class="portlet-body">
                                    <form class="form-inline" role="form">
                                        <div class="form-group m-l-10">
                                            <label class="sr-only" for="edan2"></label>
                                            <select name="start" id="edan2" class="col-md-4 form-control" style="width: 100%;">
                                                <option selected disabled>Awal Tanggal Berangkat</option>
                                                @foreach($jadwals as $jadwal)
                                                    <option value="{{ $jadwal->tgl_berangkat }}">{{ Carbon\Carbon::parse($jadwal->tgl_berangkat)->format('d M Y') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group m-l-10">
                                            <label >sampai</label>
                                        </div>
                                        <div class="form-group m-l-10">
                                            <label class="sr-only" for="edan2"></label>
                                            <select name="end" id="edan2" class="col-md-4 form-control" style="width: 100%;">
                                                <option selected disabled>Akhir Tanggal Berangkat</option>
                                                @foreach($jadwals as $jadwal)
                                                    <option value="{{ $jadwal->tgl_berangkat }}">{{ Carbon\Carbon::parse($jadwal->tgl_berangkat)->format('d M Y') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- <div class="form-group m-l-10">
                                            <label class="sr-only" for="edan2">Search</label>
                                            <input type="text" class="form-control" name="search">
                                        </div> -->
                                        <div class="form-group m-l-10 col-md-offset-4" style="margin-bottom: 10px; margin-top: 10px;">
                                            <button class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <td>Kode</td>
                                                    <td>Nama Marketing</td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /Portlet -->
                    </div> <!-- end col -->
                    <div class="col-md-4">
                        <div class="mini-stat clearfix bg-inverse">
                            <span class="mini-stat-icon bg-info"><i class="fa fa-user"></i></span>
                            <div class="mini-stat-info text-right">
                                <span class="counter">{{ $totalJamaah->count() }}</span>
                                Total Jamaah
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mini-stat clearfix bg-inverse">
                            <span class="mini-stat-icon bg-warning"><i class="ion-cash"></i></span>
                            <div class="mini-stat-info text-right">
                                <span class="counter">{{ number_format($sumofPotensi,2,'.',',') }}</span>
                                Total Potensi
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mini-stat clearfix bg-inverse">
                            <span class="mini-stat-icon bg-success"><i class="ion-cash"></i></span>
                            <div class="mini-stat-info text-right">
                                <span class="counter">{{ number_format($sumofKomisi,2,'.',',') }}</span>
                                Total Komisi
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->



                <div class="row">
                    <div class="col-lg-8">
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Total Perbulan Jamaah Berdasarkan Periode {{ $varJay->judul }} Hijriah
                                </h3>
                                <div class="portlet-widgets">
                                    <!-- <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a> -->
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <!-- <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a> -->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="total-jamaah-chart" style="height: 320px;"></div>

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
                                    Grafik Prospek {{ $varJay->judul }} Hijriah
                                </h3>
                                <div class="portlet-widgets">
                                    <!-- <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a> -->
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet3"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <!-- <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a> -->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet3" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="total-prospek-chart" style="height: 200px;"></div>
                                    <div class="row text-center m-t-30">
                                        <div class="col-sm-4 col-md-offset-4">
                                            <i class="fa fa-user"></i>
                                            <h4>{{ $totalProspekChart }} Prospek</h4>
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
     /* Counter Up */
    $('.counter').counterUp({
        delay: 100,
        time: 1200
    });

    // Select2   
      jQuery(".select2").select2({
          width: '100%'
      });
</script>
<script>
  
      var chart = Morris.Bar({
            element: 'total-jamaah-chart',
            data: [
                { y: 'January', a: "{{ $statsJamaahJanuary }}"},
                { y: 'February', a: "{{ $statsJamaahFebruary }}"},
                { y: 'March', a: "{{ $statsJamaahMarch }}"},
                { y: 'April', a: "{{ $statsJamaahApril }}"},
                { y: 'Mei', a: "{{ $statsJamaahMei }}"},
                { y: 'June', a: "{{ $statsJamaahJune }}"},
                { y: 'July', a: "{{ $statsJamaahJuly }}"},
                { y: 'August', a: "{{ $statsJamaahAugust }}"},
                { y: 'September', a: "{{ $statsJamaahSeptember }}"},
                { y: 'October', a: "{{ $statsJamaahOctober }}"},
                { y: 'November', a: "{{ $statsJamaahNovember }}"},
                { y: 'December', a: "{{ $statsJamaahDesember }}"}
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Jamaah'],
            barColors: ['#d32f2f']
        });

        var chartProspek = Morris.Bar({
            element: 'total-prospek-chart',
            data: [
                { y: 'January', a: "{{ $statsProspekJanuary }}"},
                { y: 'February', a: "{{ $statsProspekFebruary }}"},
                { y: 'March', a: "{{ $statsProspekMarch }}"},
                { y: 'April', a: "{{ $statsProspekApril }}"},
                { y: 'Mei', a: "{{ $statsProspekMei }}"},
                { y: 'June', a: "{{ $statsProspekJune }}",},
                { y: 'July', a: "{{ $statsProspekJuly }}"},
                { y: 'August', a: "{{ $statsProspekAugust }}"},
                { y: 'September', a: "{{ $statsProspekSeptember }}"},
                { y: 'October', a: "{{ $statsProspekOctober }}"},
                { y: 'November', a: "{{ $statsProspekNovember }}"},
                { y: 'December', a: "{{ $statsProspekDesember }}"}
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Prospek'],
            resize: true,
            barColors: ['#1a2942']
        });
// Chart Prospek
// var data = JSON.parse('{!! $stats !!}');
    
    // Morris.Bar({
    //     // ID of the element in which to draw the chart.
    //     element: 'total-prospek-chart',
    //     data: data,
    //     xkey: 'month',
    //     ykeys: ['value'],
    //     labels: ['Prospek'],
    //     resize: true,
    //     barColors: ['#1a2942']
    // });

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
