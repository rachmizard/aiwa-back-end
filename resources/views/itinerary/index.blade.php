@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong>Master Itinerary</strong></h3>
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
                                            <th>Jadwal</th>
                                            <th>Judul</th>
                                            <th>Tanggal Itinerary</th>
                                            <th>Link</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus"></i> Tambah Itinerary</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="master-itinerary">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="jadwal">Jadwal</label>
                                        <select name="detailjadwal_id" id="jadwal" class="form-controle select2" data-placeholder="Pilih Jadwal" style="widows: 100%;">
                                            <?php for ($i=0; $i < $count; $i++) { ?>
                                            @foreach($jadwals['data'][$i]['jadwal'] as $key => $in)
                                                <option value="{{ $in['tgl_berangkat'] }}">{{ $in['tgl_berangkat'] }}</option>
                                            @endforeach
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" class="form-control" id="judul" placeholder="Judul.." name="judul">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_itinerary">Tanggal Itinerary</label>
                                        <input type="text" class="form-control datepicker" id="tanggal_itinerary" placeholder="Tanggal Itinerary.." name="tanggal_itinerary">
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Link</label>
                                        <input type="link" class="form-control" id="link" placeholder="Link.." name="link">
                                    </div>
                                    <button type="submit" class="btn btn-purple">Submit</button>
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
        "ajax": "{{route('aiwa.master-itinerary.load')}}", 
        "columns": [
            { data: "id", name: "id" },
            { data: "detailjadwal_id", name: "detailjadwal_id" },
            { data: "judul", name: "judul" },
            { data: "tanggal_itinerary", name: "tanggal_itinerary" },
            { data: "link", name: "link",
                render: function( data, type, full, meta ) {
                    return "<a target=\"_blank\" href=\""+ data +"\" height=\"50\"/>"+ data +"</a>";
                } 
             },
            { data: "action", name: "action", searchable: false}
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
