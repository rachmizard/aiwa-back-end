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
                    <h3 class="title"><strong><i class="fa fa-image"></i> Master Gallery Hotel</strong></h3>
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
                                            <th>File/Gambar/Thumbnail Video Hotel</th>
                                            <th>Tanggal</th>
                                            <th>Nama Hotel</th>
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
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus"></i> Tambah Gallery Hotel</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{route('aiwa.master-gallery.store')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="file">File Thumbnail/Gambar Hotel</label>
                                        <input type="file" name="file" id="file" class="form-control" required="" data-placeholder="File.." required="">
                                    </div>
                                    <div class="form-group">

                                        <label class="control-label" for="judul">Nama Hotel</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <select id="judul" name="judul" class="select2" data-placeholder="Nama Hotel..." style="width: 100%;">
                                              <option value=""></option>
                                              @foreach($hotels as $hotel)
                                              <option value="{{ $hotel->id }}">{{ $hotel->nama_hotel }}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control" id="deskripsi"></textarea>
                                    </div>
                                    <input type="hidden" value="foto_hotel" name="tipe">
                                    <div class="form-group">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-info col-md-12">Simpan</button>
                                    </div>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus"></i> Tambah Video Gallery Hotel</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{route('aiwa.master-gallery.store')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="file">File Thumbnail/Gambar</label>
                                        <input type="file" name="file" id="file" class="form-control" required="" data-placeholder="File.." required="">
                                    </div>
                                    
                                    <div class="form-group">

                                        <label class="control-label" for="judul">Nama Hotel</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <select id="judul" name="judul" class="select2" data-placeholder="Nama Hotel..." style="width: 100%;">
                                              <option value=""></option>
                                              @foreach($hotels as $hotel)
                                              <option value="{{ $hotel->id }}">{{ $hotel->nama_hotel }}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="text" class="form-control datepicker" id="tanggal" placeholder="Tanggal.." name="tanggal" required="">
                                    </div> -->
                                    <div class="form-group">
                                        <label for="deskripsi">Link Url Video (Youtube)</label>
                                        <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control" required="" id="deskripsi"></textarea>
                                    </div>
                                    <input type="hidden" value="video_hotel" name="tipe">
                                    <div class="form-group">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-success col-md-12">Simpan</button>
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
    $.fn.dataTable.ext.errMode = 'none';
    $('#itinerary').DataTable({
        "stateSave": true,
        "scroll": true,
        "processing": false,
        "deferRender": true,
        "serverSide": true,
        "ajax": "{{route('aiwa.master-gallery.load.hotel')}}", 
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
            { data: "hotel.nama_hotel", name: "hotel.nama_hotel" },
            { data: "deskripsi", name: "deskripsi" },
            { data: "tipe", name: "tipe" },
            { data: "action", name: "action", searchable: false, orderable: false}
        ]
    }).on('error.dt', function ( e, settings, techNote, message ) {
     console.log( 'An error has been reported by DataTables: ', message );
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
