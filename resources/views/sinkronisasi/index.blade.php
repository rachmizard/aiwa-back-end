@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-calendar"></i> Master Tahun Sinkronisasi</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <a href="#" class="btn btn-sm btn-info" data-target="#sinkronisasiModal" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Tahun Sinkronisasi</a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table class="table table-striped" id="sinkronisasi">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Sinkronisasi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>

    <div id="sinkronisasiModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Tahun Sinkronisasi</h4> 
                    </div> 
                        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                        <div class="modal-body"> 
                            <div class="row"> 
                                <div class="col-md-6 col-md-offset-2"> 
                                    <div class="form-group"> 
                                        <label for="">Tahun</label>
                                        <input type="text" name="tahun" class="form-control" id="" placeholder="Tahun Hijriah Contoh: 1440" required=""> 
                                    </div>
                                </div> 
                            </div>
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button> 
                            <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-info">Simpan</button> 
                        </div>
                    <!-- </form> -->
                </div> 
            </div>
        </div><!-- /.modal -->
        @foreach($sinkronisasis as $in)
        <div id="editModal{{ $in->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Edit Tahun Sinkronisasi</h4>
                    </div> 
                        <form action="{{ route('aiwa.master-sinkronisasi.update', $in->id) }}" method="POST">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="modal-body"> 
                                <div class="row"> 
                                    <div class="col-md-6 col-md-offset-2"> 
                                        <div class="form-group"> 
                                            <label for="">Tahun</label>
                                            <input type="text" name="tahun" class="form-control" id="" placeholder="Tahun Hijriah Contoh: 1440" required="" value="{{ $in->tahun }}"> 
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-info">Simpan</button> 
                            </div>
                        </form>
                        <form action="{{ route('aiwa.master-sinkronisasi.selected', $in->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-warning"><i class="fa fa-refresh fa-spin"></i> Sinkron Tahun Ini</button> 
                            <span class="help-block"><small>Perlu di perhatikan untuk sinkronisasi yang sudah di pilih tahunnya akan otomatis terupdate berdasarkan data terbaru kantor.</small></span>
                        </form>
                    <!-- </form> -->
                </div> 
            </div>
        </div><!-- /.modal -->
        @endforeach
@push('otherJavascript')
<!-- sweet alerts -->
<link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
<!-- sweet alerts -->
<script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $.fn.dataTable.ext.errMode = 'none';
        var table = $('#sinkronisasi').DataTable({
        "stateSave": true,
        "searching": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "/admin/master-sinkronisasi/loadDataSinkronisasi"
        },
        "columns": [
            { data: "id", name: "id" },
            { data: "tahun", name: "tahun" },
            { data: "status", name: "status" },
            { data: "action", name: "action", orderable: false, searchable: false}
        ]
    }).on('error.dt', function ( e, settings, techNote, message ) {
         console.log( 'An error has been reported by DataTables: ', message );
        });
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
          }
        });

        // Post
        $('#load').click(function() {
            var tahun = $('input[name=tahun]').val();
            var token = $('#token').val();
            // var toggle = 
            $.ajax({
              dataType: 'json',
              url: "{!! route('aiwa.master-sinkronisasi.store') !!}",
              method: 'post',
              data: "tahun="+ tahun +"&_token="+ token,
              success: function(response){
                 console.log(response);
                 $('#sinkronisasiModal').modal('hide');
                 $('input[name=tahun]').val('');
                 table.ajax.reload( null, false ); // user paging is not reset on reload
                 table.draw();
                 swal("Berhasil!", "Tahun sinkronisasi di tambahkan", "success");
              }});
        });

        // $('.deleteatuh').click(function(){   
        //     var token = $(this).data("token");
        //     var id = $(this).data("id");
        //     $.ajax({
        //       dataType: 'json',
        //       url: "/admin/master-periode/"+ id +"/delete",
        //       method: 'post',
        //       data: "_token="+ $('input[name=_token]').val(),
        //       success: function(response){
        //          console.log(response);
        //          table.ajax.reload( null, false ); // user paging is not reset on reload
        //          table.draw();
        //          swal("Deleted!", "Periode di berhasil di hapus!", "success"); 
        //       }});
        // }); // DEPRECIATED
    });
</script>

<script>


$(function () {
    $('#jadwal_edit').change(function() {
        $('#link_Edit').val($(this,':selected').val())
    })
    $('#jadwal_tambah').change(function() {
        $('#link_tambah').val($(this,':selected').val())
    })
})

jQuery('.datepicker').datepicker({
   todayBtn: "linked",
   language: "it",
   autoclose: true,
   todayHighlight: true,
   format: 'yyyy-mm-d' 
});
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
        @elseif(session('messageError'))
        <!-- Error Notification -->
        <!-- sweet alerts -->
        <link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
        <!-- sweet alerts -->
        <script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
        <script>
            swal("Warning!", "{{ session('messageError') }}", "error");
        </script>
        @endif

@endsection
