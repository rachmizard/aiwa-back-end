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
                    <h3 class="title"><strong><i class="fa fa-question-circle"></i> Edit Master Catatan</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
					<a href="{{ route('faq.index') }}" class="btn btn-info">Kembali</a>
                </div>
                <div class="row"> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus"></i> Edit Catatan Judul: <strong>{{ $faq->judul }}</strong></h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{route('faq.update', $faq->id)}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" name="judul" id="judul" class="form-control" required="" data-placeholder="File.." required="" value="{{ $faq->judul }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jawaban">Jawaban</label>
                                        <textarea name="jawaban" class="form-control" id="" cols="30" rows="10">{{ $faq->jawaban }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-purple col-md-12">Edit</button>
                                    </div>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>

@push('dataTables')

<script>    
$(document).ready(function() {
    $('#ggwp').dataTable();
} );
</script>
@endpush
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
            swal("Berhasil!", "{{ session('message') }}", "success");
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
