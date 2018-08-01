@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong>Master Itinerary</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <a href="{{ route('master-itinerary.index') }}" class="btn btn-sm btn-danger"><i class="ion-android-system-back"></i> Kembali</a>
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
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Itinerary ID : {{ $itinerary->id }}</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{route('master-itinerary.update', $itinerary->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="form-group">
                                        <label for="jadwal">Jadwal</label>
                                        <select name="detailjadwal_id" id="jadwal" class="form-controle select2" data-placeholder="Pilih Jadwal" style="widows: 100%;" required="">
                                            <?php for ($i=0; $i < $count; $i++) { ?>
                                            @foreach($jadwals['data'][$i]['jadwal'] as $key => $in)
                                                <option value="{{ $in['tgl_berangkat'] }}" {{ $in['tgl_berangkat'] == $itinerary->detailjadwal_id ? 'selected' : '' }} >{{ date('d-M-Y', strtotime($in['tgl_berangkat'])) }}</option>
                                            @endforeach
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" class="form-control" id="judul" placeholder="Judul.." name="judul" value="{{ $itinerary->judul }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_itinerary">Tanggal Itinerary</label>
                                        <input type="text" class="form-control datepicker" id="tanggal_itinerary" placeholder="Tanggal Itinerary.." name="tanggal_itinerary" value="{{ $itinerary->tanggal_itinerary }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jadwal_edit">Link Itinerary (Berdasarkan Jadwal)</label>
                                        <select name="" id="jadwal_edit" class="form-controle select2" data-placeholder="Pilih Jadwal" style="widows: 100%;" required="">
                                            <?php for ($i=0; $i < $count; $i++) { ?>
                                            @foreach($jadwals['data'][$i]['jadwal'] as $key => $in)
                                                <option value="{{ $in['itinerary'] }}" {{ $in['tgl_berangkat'] == $itinerary->detailjadwal_id ? 'selected' : '' }} >{{ date('d-M-Y', strtotime($in['tgl_berangkat'])) }}</option>
                                            @endforeach
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="link_Edit">Link</label>
                                        <input type="link" class="form-control" id="link_Edit" placeholder="Link.." name="link" value="{{ $itinerary->link }}" disabled>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-md">Edit</button>
                                    <a href="{{ route('master-itinerary.index') }}" class="btn btn-danger btn-md"><i class="ion-android-system-back"></i> Batal</a>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus"></i> Tambah Itinerary</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{route('master-itinerary.store')}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="jadwal">Jadwal</label>
                                        <select name="detailjadwal_id" id="jadwal" class="form-controle select2" data-placeholder="Pilih Jadwal" style="widows: 100%;">
                                            <?php for ($i=0; $i < $count; $i++) { ?>
                                            @foreach($jadwals['data'][$i]['jadwal'] as $key => $in)
                                                <option value="{{ $in['tgl_berangkat'] }}">{{ date('d-M-Y', strtotime($in['tgl_berangkat'])) }}</option>
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
                                        <label for="jadwal_tambah">Link Itinerary (Berdasarkan Jadwal)</label>
                                        <select name="" id="jadwal_tambah" class="form-controle select2" data-placeholder="Pilih Jadwal" style="widows: 100%;" required="">
                                            <?php for ($i=0; $i < $count; $i++) { ?>
                                            @foreach($jadwals['data'][$i]['jadwal'] as $key => $in)
                                                <option value="{{ $in['itinerary'] }}">{{ date('d-M-Y', strtotime($in['tgl_berangkat'])) }}</option>
                                            @endforeach
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="link_tambah">Link</label>
                                        <input type="link" class="form-control" id="link_tambah" placeholder="Link.." name="link" hidden>
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
            { data: "link", name: "link", orderable: false},
            { data: "action", name: "action", searchable: false, orderable:false}
        ]
    });
} );
</script>
@endpush
@push('otherJavascript')
<script>

$(function () {
    $('#jadwal_edit').change(function() {
        $('#link_Edit').val($(this,':selected').val())
    })
    $('#jadwal_tambah').change(function() {
        $('#link_tambah').val($(this,':selected').val())
    })
})

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
