@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-calendar"></i> Master Periode</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <a href="#" class="btn btn-sm btn-info" data-target="#periodeModal" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Perioda</a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table class="table table-hovered table-bordered" id="periodeTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun/Hijriah</th>
                                            <th>Start</th>
                                            <th>End</th>
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

    <div id="periodeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Periode</h4> 
                    </div> 
                        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                        <div class="modal-body"> 
                            <div class="row"> 
                                <div class="col-md-6 col-md-offset-2"> 
                                    <div class="form-group"> 
                                        <label for="">Tahun/Hijirah</label>
                                        <input type="text" name="judul" class="form-control" id="" placeholder="Tahun Hijriah Contoh: 1440" required=""> 
                                    </div> 
                                    <div class="form-group"> 
                                        <label for="" class="control-label">Tanggal Mulai</label>
                                        <input type="text" name="start" class="form-control datepicker" id="" placeholder="Tanggal Mulai..."> 
                                    </div> 
                                    <div class="form-group"> 
                                        <label for="" class="control-label">Tanggal Akhir</label>
                                        <input type="text" name="end" class="form-control datepicker" id="" placeholder="Tanggal Akhir..."> 
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
@push('otherJavascript')
<!-- sweet alerts -->
<link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
<!-- sweet alerts -->
<script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
<script>
    $(document).ready(function(){
        var table = $('#periodeTable').DataTable({
        "searching": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "{{ route('aiwa.master-periode.load') }}"
        },
        "columns": [
            { data: "id", name: "id" },
            { data: "judul", name: "judul" },
            { data: "start", name: "start" },
            { data: "end", name: "end" },
            { data: "action", name: "action", orderable: false, searchable: false}
        ]
    });
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
          }
        });

        // Post
        $('#load').click(function() {
            var judul = $('input[name=judul]').val();
            var start = $('input[name=start]').val();
            var end = $('input[name=end]').val();
            var token = $('#token').val();
            // var toggle = 
            $.ajax({
              dataType: 'json',
              url: "{!! route('aiwa.master-periode.store') !!}",
              method: 'post',
              data: "judul="+ judul +"&start="+ start +"&end="+ end +"&_token="+ token,
              success: function(response){
                 console.log(response);
                 $('#periodeModal').modal('hide');
                 $('input[name=judul]').val('');
                 $('input[name=start]').val('');
                 $('input[name=end]').val('');
                 table.ajax.reload( null, false ); // user paging is not reset on reload
                 table.draw();
                 swal("Berhasil!", "Periode di tambahkan", "success");
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
        @endif

@endsection
