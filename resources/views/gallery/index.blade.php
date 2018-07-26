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
                    <h3 class="title"><strong><i class="fa fa-image"></i> Master Gallery</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table class="table table-hovered table-bordered" id="itinerary">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>File/Gambar/Video</th>
                                            <th>Tanggal</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Tipe</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus"></i> Tambah Gallery</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="master-gallery" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="file">File/Gambar/Video</label>
                                        <input type="file" name="file" id="file" class="form-control" required="" data-placeholder="File.." required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="Judul">Judul</label>
                                        <input type="text" class="form-control" id="Judul" placeholder="Judul.." name="judul" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="text" class="form-control datepicker" id="tanggal" placeholder="Tanggal.." name="tanggal" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Gallery</label>
                                        <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control" required="" id="deskripsi"></textarea>
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
    $('#itinerary').DataTable({
        "scroll": true,
        "processing": true,
        "serverSide": true,
        "ajax": "{{route('aiwa.master-gallery.load')}}", 
        "columns": [
            { data: "id", name: "id" },
            { data: "file", name: "file",
                render: function( data, type, full, meta ) {
                    return "<img src=\"/storage/gallery/" + data + "\" height=\"50\" class=\"text-center\"/>";
                }, 
                searchable: false,
                orderable: false
            },
            { data: "tanggal", name: "tanggal" },
            { data: "judul", name: "judul" },
            { data: "deskripsi", name: "deskripsi" },
            { data: "tipe", name: "tipe" },
            { data: "action", name: "action", searchable: false, orderable: false}
        ]
    });
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
        @endif

@endsection
