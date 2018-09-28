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
                    <h3 class="title"><strong><i class="fa fa-question-circle"></i> Master Catatan</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table class="table table-striped" id="ggwp">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Jawaban</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($faqs as $faq)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $faq->judul }}</td>
                                                <td>{{ $faq->jawaban }}</td>
                                                <td>
                                                    <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <a onclick="confirmBtn();" href="#" class="btn btn-sm btn-danger">Hapus</a>
                                                    <form id="delete-form{{ $faq->id }}" action="{{ route('faq.destroy', $faq->id) }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus"></i> Tambah Master Catatan</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{route('faq.store')}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" name="judul" id="judul" class="form-control" required="" data-placeholder="File.." required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="jawaban">Jawaban</label>
                                        <textarea name="jawaban" class="form-control" id="" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-purple col-md-12">Simpan</button>
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

@foreach($faqs as $faq)
function confirmBtn() {
      if(confirm("Are You Sure to delete this?")){
         event.preventDefault();
         document.getElementById('delete-form{{ $faq->id }}').submit();
      }
}
@endforeach
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
