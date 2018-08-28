@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong>Laporan Prospek</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                </div>
                <!-- Inline Form -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title">Filter <i class="fa fa-filter"></i></h3></div>
                            <div class="panel-body">

                                <form class="form-inline" role="form">
                                    <div class="form-group m-l-10">
                                        <label class="sr-only" for="edan1">Periode</label>
                                        <select name="periode" id="edan1" class="col-md-4 form-control" style="width: 100%;">
                                            @foreach($periodes as $periode)
                                                <option value="{{ $periode->id }}">{{ $periode->judul }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-l-10">
                                        <label class="sr-only" for="edan">Filter Agen</label>
                                        <select name="anggota_id" id="" class="col-md-4 select2" style="width: 100%;">
                                                <option selected value="semua">Semua</option>
                                            @foreach($agents as $agent)
                                                <option value="{{ $agent->id }}">{{ $agent->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="pembayaran">
                                        <label class="sr-only" for="exampleInputEmail2">Pembayaran</label>
                                        <select name="pembayaran" class="form-control" id="">
                                            <option value="1">SUDAH DP</option>
                                            <option value="BELUM" selected>BELUM DP</option>
                                        </select>
                                    </div>

                                    <div class="form-group m-l-10">
                                        <label class="sr-only" for="edan">Nama PIC</label>
                                        <input type="text" name="pic" class="form-control" id="edan" placeholder="Filter Nama PIC...">
                                    </div>
                                    <button id="search-form" " class="btn btn-success m-l-10"><i class="fa fa-search"></i> Filter</button>
                                </form>


                                <!-- <form class="form-inline" role="form">
                                    <button id="search-form-agen" " class="btn btn-success m-l-10">Filter</button>
                                </form> -->
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->

                </div> <!-- End row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-table"></i> Tabel Prospek </h3></div>
                            <div class="panel-body p-t-10">
                                <table id="prospek" class="table table-hover table-bordered">
                                  <thead>
                                    <!-- <th>No</th> -->
                                    <tr>
                                        <th>Nama Agent</th>
                                        <th>Nama Caljam (PIC)</th>
                                        <th>No telepon</th>
                                        <th>Tanggal Keberangkatan</th>
                                        <th>PAX</th>
                                        <th>Tanggal Follow Up</th>
                                        <th>Dibuat Tanggal</th>
                                        <th>Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
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
                        "searching": false,
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: "{{ route('aiwa.prospek.load') }}",
                            data: function (d) {
                                // d.name = $('input[name=name]').val();
                                d.periode = $('select[name=periode]').val();
                                d.pembayaran = $('select[name=pembayaran]').val();
                                d.pic = $('input[name=pic]').val();
                                d.anggota_id = $('select[name=anggota_id]').val();
                            }
                        },
                        order: [ [6, 'desc'] ],
                        "columns": [
                            { data: "anggota.nama", name: "anggota_id" },
                            { data: "pic", name: "pic" },
                            { data: "no_telp", name: "no_telp" },
                            { data: "tgl_keberangkatan", name: "tgl_keberangkatan" },
                            { data: "qty", name: "qty" },
                            { data: "tanggal_followup", name: "tanggal_followup" },
                            { data: "created_at", name: "created_at" },
                            { data: "pembayaran", name: "pembayaran", searchable: false, orderable: false },
                            { data: "action", name: "action", orderable: false, searchable: false}
                        ]
                    })
                    // setInterval( function () {
                    //     table.ajax.reload( null, false ); // user paging is not reset on reload
                    // }, 3500 );

                    $('#search-form').on('click', function(e) {
                        table.draw();
                        e.preventDefault();
                    });

                    $(function() {
                        $("input[name='pic']").hide(); 
                        $("select[name='anggota_id']").change(function(){
                            if($("select[name='anggota_id']").val() == 'semua') {
                                $("input[name='pic']").hide(); 
                            } else {
                                $("input[name='pic']").show(); 
                            } 
                        });
                    });
                });
            </script>
            <!-- End Datatable Serverside -->
        @endpush
        @push('otherJavascript')
       <script type="text/javascript">
          jQuery(".select2").select2({
              width: '100%'
          });
           $('.datepickeranjay').datepicker({
               todayBtn: "linked",
               language: "it",
               autoclose: true,
               todayHighlight: true,
               format: 'd/m/yyyy' 
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
        @endif
            <!-- Page Content Ends -->
            <!-- ================== -->

@endsection
