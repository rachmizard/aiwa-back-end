@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-send-o"></i> Master Sapaan</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <a href="#" class="btn btn-sm btn-info" data-target="#sapaanModal" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Sapaan</a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table class="table table-hovered table-bordered" id="sapaanTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Text Sapaan</th>
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


    <div id="sapaanModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Sapaan</h4> 
                </div> 
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                    <div class="modal-body"> 
                        <div class="row"> 
                            <div class="col-md-6 col-md-offset-2"> 
                                <div class="form-group"> 
                                    <label for="">Sapaan Baru</label>
                                    <textarea name="text_sapaan" class="form-control" id="" cols="30" rows="10" required></textarea>
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

@foreach($sapaans as $sapaan)
    <div id="sapaanModal{{ $sapaan->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Sapaan</h4> 
                </div> 
                    <form action="{{ route('aiwa.master-sapaan.update', $sapaan->id) }}" method="POST">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                        <input type="hidden" value="PUT" name="_method">
                        <div class="modal-body"> 
                            <div class="row"> 
                                <div class="col-md-6 col-md-offset-2"> 
                                    <div class="form-group"> 
                                        <label for="">Edit Sapaan</label>
                                        <textarea name="text_sapaan" class="form-control" id="" cols="30" rows="10" required>
                                            {{ $sapaan->text_sapaan }}
                                        </textarea>
                                    </div> 
                                </div> 
                            </div>
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button> 
                            <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-info">Simpan</button> 
                        </div>
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
        var table = $('#sapaanTable').DataTable({
        "stateSave": true,
        "searching": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "{{ route('aiwa.master-sapaan.load') }}"
        },
        "columns": [
            { data: "id", name: "id" },
            { data: "text_sapaan", name: "text_sapaan" },
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
            var text_sapaan = $('textarea[name=text_sapaan]').val();
            var token = $('#token').val();
            $.ajax({
              dataType: 'json',
              url: "{!! route('aiwa.master-sapaan.store') !!}",
              method: 'post',
              data: "text_sapaan="+ text_sapaan +"&_token="+ token,
              success: function(response){
                 console.log(response);
                 $('#sapaanModal').modal('hide');
                 $('textarea[name=text_sapaan]').val('');
                 table.ajax.reload( null, false ); // user paging is not reset on reload
                 table.draw();
                location.reload();
                 swal("Berhasil!", "Sapaan di tambahkan", "success");
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
