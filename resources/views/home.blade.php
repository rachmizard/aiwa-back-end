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
                        <div class="widget-panel widget-style-2 bg-success">
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
                                    Weekly Sales Report
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
                                    <div id="morris-bar-example"  style="height: 320px;"></div>

                                    <div class="row text-center m-t-30 m-b-30">
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 126</h4>
                                            <small class="text-muted"> Today's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 967</h4>
                                            <small class="text-muted">This Week's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 4500</h4>
                                            <small class="text-muted">This Month's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 87,000</h4>
                                            <small class="text-muted">This Year's Sales</small>
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
                                    Grafik Prospek & Jamaah
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
                                    <div id="morris-line-example" style="height: 200px;"></div>
                                    <div class="row text-center m-t-30">
                                <div class="col-sm-4">
                                    <h4>$ 86,956</h4>
                                    <small class="text-muted"> This Year's Report</small>
                                </div>
                                <div class="col-sm-4">
                                    <h4>$ 86,69</h4>
                                    <small class="text-muted">Weekly Sales Report</small>
                                </div>
                                <div class="col-sm-4">
                                    <h4>$ 948,16</h4>
                                    <small class="text-muted">Yearly Sales Report</small>
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
@endsection
