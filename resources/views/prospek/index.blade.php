@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong>Laporan Prospek</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <!-- <a href="" class="btn btn-sm btn-primary">Tambah Jamaah</a> -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table id="prospek" class="table table-striped table-bordered">
                                  <thead>
                                    <th>No</th>
                                    <th>Nama Agent</th>
                                    <th>Nama Caljam (PIC)</th>
                                    <th>No telepon</th>
                                    <th>Tanggal Keberangkatan</th>
                                    <th>PAX</th>
                                    <th>Tanggal Follow Up</th>
                                    <th>Aksi</th>
                                  </thead>
                                </table>
                                <tbody>
                                </tbody>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>
        @foreach($prospeks as $prospek)
        <div id="editProspek{{ $prospek->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title">Edit tanggal follow up PIC : {{ $prospek->pic }}</h4> 
                    </div> 
                    <form action="{{ route('aiwa.prospek.update', $prospek->id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body"> 
                            <div class="row"> 
                                <div class="col-md-6 col-md-offset-2"> 
                                    <div class="form-group"> 
                                        <label for="field-1" class="control-label">Tanggal FollowUp</label>
                                        <input type="text" name="tanggal_followup" class="form-control datepickeranjay" id="field-1" placeholder="Tanggal" value="{{ $prospek->tanggal_followup }}"> 
                                    </div> 
                                </div> 
                            </div>
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button> 
                            <button type="submit" class="btn btn-info">Simpan</button> 
                        </div>
                    </form> 
                </div> 
            </div>
        </div><!-- /.modal -->
        @endforeach
         @push('dataTables')
            <!-- Datatable Serverside -->
            <script>
                $(document).ready(function(){
                    var table = $('#prospek').DataTable({
                        "processing": false,
                        "serverSide": true,
                        "ajax": "{{ route('aiwa.prospek.load') }}", 
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "anggota.nama", name: "anggota.nama" },
                            { data: "pic", name: "pic" },
                            { data: "no_telp", name: "no_telp" },
                            { data: "tgl_keberangkatan", name: "tgl_keberangkatan" },
                            { data: "qty", name: "qty" },
                            { data: "tanggal_followup", name: "tanggal_followup" },
                            { data: "action", name: "action"}
                        ]
                    })
                    setInterval( function () {
                        table.ajax.reload( null, false ); // user paging is not reset on reload
                    }, 3500 );
                });
            </script>
            <!-- End Datatable Serverside -->
        @endpush
        @push('otherJavascript')
       <script type="text/javascript">
       $('.datepickeranjay').datepicker({
           todayBtn: "linked",
           language: "it",
           autoclose: true,
           todayHighlight: true,
           format: 'd/m/yyyy' 
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
            <!-- Page Content Ends -->
            <!-- ================== -->

@endsection
