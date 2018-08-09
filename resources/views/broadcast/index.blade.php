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
                    <h3 class="title"><strong><i class="ion-speakerphone"></i> Broadcast</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <a href="{{ route('aiwa.master-broadcast.toagen') }}" class="btn btn-info btn-sm"><i class="fa fa-send"></i> Broadcast ke agen</a>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="ion-speakerphone"></i> Form Broadcast</h3></div>
                            <div class="panel-body">
                                <form role="form" method="GET" action="{{ route('master-broadcast.store.sendtoagen') }}">
                                    {{ csrf_field() }}
                                    <!-- <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" class="form-control" name="judul" required="" placeholder="Judul broadcast...">
                                    </div> -->
                                    <div class="form-group">
                                        <textarea name="pesan" class="form-control" id="" cols="30" rows="10"></textarea>
                                    </div>
                                    <
                                    <div class="form-group">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-purple col-md-12"><i class="fa fa-send"></i> Kirim Broadcast</button>
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
