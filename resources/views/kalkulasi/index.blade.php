@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->
            <style>
                .dataTables_empty{
                    text-align: center;
                }
            </style>
            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-calculator"></i> Master Kalkulasi</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-dollar"></i> Kalkulasi</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="master-kalkulasi/{{ $kalkulasi->id }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="harga_default">Harga Perlengkapan Dewasa (Default)</label>
                                        <input type="text" name="harga_default" id="harga_default" class="form-control" required="" data-placeholder="Rp. 1200000" required="" value="{{ $kalkulasi->harga_default }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_promo">Perlengkapan Dewasa (Promo)</label>
                                        <input type="text" class="form-control" id="harga_promo" name="harga_promo" required="" value="{{ $kalkulasi->harga_promo }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_infant">Harga Infant</label>
                                        <input type="text" class="form-control" id="harga_infant" name="harga_infant" required="" value="{{ $kalkulasi->harga_infant }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_full">Harga Full</label>
                                        <input type="text" name="harga_full" class="form-control" required="" value="{{ $kalkulasi->harga_full }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_lite">Harga Lite</label>
                                        <input type="text" class="form-control" name="harga_lite" required="" value="{{ $kalkulasi->harga_lite }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="diskon_balita_uhud">Diskon Balita Uhud</label>
                                        <input type="text" class="form-control" name="diskon_balita_uhud" required="" value="{{ $kalkulasi->diskon_balita_uhud }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="diskon_balita_nur">Diskon Balita Nur</label>
                                        <input type="text" class="form-control" name="diskon_balita_nur" required="" value="{{ $kalkulasi->diskon_balita_nur }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="diskon_balita_rhm">Diskon Balita Rahmah</label>
                                        <input type="text" class="form-control" name="diskon_balita_rhm" required="" value="{{ $kalkulasi->diskon_balita_rhm }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="diskon_balita_rhm">Diskon Balita Standar</label>
                                        <input type="text" class="form-control" name="diskon_balita_standar" required="" value="{{ $kalkulasi->diskon_balita_standar }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="diskon_balita_uhud">Harga Visa</label>
                                        <input type="text" class="form-control" name="harga_visa" required="" value="{{ $kalkulasi->harga_visa }}">
                                    </div>
                                    <div class="form-group">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-purple col-md-12">Sinkronkan</button>
                                    </div>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>
@push('otherJavascript')
<script>
jQuery('.datepicker').datepicker();
// Select2
jQuery(".select2").select2({
    width: '100%'
});

function confirmBtn() {
      if(!confirm("Are You Sure to delete this?"))
      event.preventDefault();
}
</script>
@endpush

        <!-- Success notification -->
        @if(session('message'))
        <!-- sweet alerts -->
        <link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
        <!-- sweet alerts -->
        <script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
        <script>
            swal("Good Job!", "{{ session('message') }}", "success");
        </script>
        @elseif(session('messageError'))
        <!-- sweet alerts -->
        <link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
        <!-- sweet alerts -->
        <script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
        <script>
            swal("Oppps!", "{{ session('messageError') }}", "danger");
        </script>
        @endif

@endsection
