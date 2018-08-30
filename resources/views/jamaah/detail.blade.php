@extends('layouts.master')
@section('content')
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-user"></i> DETAIL JAMAAH UMRAH & EXPORT DATA</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <!-- <a href="jamaah/download/csv" class="btn btn-sm btn-info"><i class="fa fa-file-excel-o"></i> Download CSV</a> -->
                    <a href="{{ route('aiwa.jamaah') }}" class="btn btn-sm btn-danger"><i class="fa fa-user"></i> Kembali Ke Halaman Utama</a>
                    <div class="btn-group">
                        <button id="refreshJamaah" class="btn btn-sm btn-info"><i class="fa fa-refresh"></i> Refresh Table</button>
                        <a href="{{ url('/admin/jamaah/download/xlsx') }}" class="btn btn-sm btn-success"><i class="fa fa-download"></i"></i> Download Format Jamaah</a>
                        <button data-target="#import" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i> Import</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table id="jamaah" class="table table-hover table-bordered">
                                  <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Daftar</th>
                                        <th>ID Umrah</th>
                                        <th>ID Jamaah</th>
                                        <th>Nama</th>
                                        <th>Tanggal Keberangkatan</th>
                                        <th>Tanggal Kepulangan</th>
                                        <th>Marketing</th>
                                        <th>Staff</th>
                                        <th>No Telp</th>
                                        <th>Marketing Fee</th>
                                        <th>Diskon Marketing</th>
                                        <th>Koordinator</th>
                                        <th>Koordinator Fee</th>
                                        <th>Top</th>
                                        <th>Top Fee</th>
                                        <th>Status</th>
                                        <th>Tgl Transfer</th>
                                    </tr>
                                  </thead>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
            <div class="divider" style="margin-bottom: 10px;">
            </div>
            </div>
            <div id="import" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Import Jamaah</h4> 
                    </div> 
                        <div class="modal-body"> 
                            <div class="row"> 
                                <div class="col-md-12 col-md-offset-2"> 
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('aiwa.jamaah.store.import') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-file-excel-o"></i></span>
                                                    <input type="file" id="import_file_jamaah" name="import_file_jamaah" class="form-control" placeholder="File excel.xlsx" required>
                                                </div>
                                            </div>
                                        </div> <!-- form-group -->
                                        <div class="form-group text-center">
                                            <button class="btn btn-md btn-success" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" title="Pastikan anda sudah mendownload format jamaah untuk di upload.">Upload & Simpan</button>
                                            <!-- <a href="jamaah/download/format/csv" class="btn btn-md btn-info"><i class="fa fa-download"></i> Download Format</a> -->
                                        </div> <!-- form-group -->
                                    </form>
                                </div> 
                            </div>
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button> 
                        </div>
                    <!-- </form> -->
                </div> 
            </div>
        </div><!-- /.modal -->

         @push('dataTables')
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
            <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
            <!-- Datatable Serverside -->
            <script>
                $(document).ready(function(){
                    var table = $('#jamaah').DataTable({
                        "scrollX": true,
                        "dom" : 'lBfrtip',
                        "buttons": [
                            'excel', 'pdf'
                        ],
                        "responsive": true,
                        "processing": false,
                        "serverSide": true,
                        "ajax": "{{ route('aiwa.jamaah.load') }}", 
                        order: [ [0, 'desc'] ],
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "tgl_daftar", name: "tgl_daftar" },
                            { data: "id_umrah", name: "id_umrah" },
                            { data: "id_jamaah", name: "id_jamaah" },
                            { data: "nama", name: "nama" },
                            { data: "tgl_berangkat", name: "tgl_berangkat" },
                            { data: "tgl_pulang", name: "tgl_pulang" },
                            { data: "anggota.nama", name: "anggota.nama" },
                            { data: "staff", name: "staff" },
                            { data: "no_telp", name: "no_telp" },
                            { data: "marketing_fee", name: "marketing_fee" },
                            { data: "diskon_marketing", name: "diskon_marketing" },
                            { data: "koordinator", name: "koordinator" },
                            { data: "koordinator_fee", name: "koordinator_fee" },
                            { data: "top", name: "top" },
                            { data: "top_fee", name: "top_fee" },
                            { data: "status", name: "status" },
                            { data: "tgl_transfer", name: "tgl_transfer" }
                        ]
                    });
                   // Refresh Table
                   $('#refreshJamaah').on('click', function(){
                        table.ajax.url("{{ route('aiwa.jamaah.load') }}").load();
                   });
                });
            </script>
            <!-- End Datatable Serverside -->
            @endpush
            @push('otherJavascript')
            <script>
               
                // Select2
                jQuery(".select2").select2({
                    width: '100%'
                });
                // DatePicker
                jQuery('.datepicker').datepicker();
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
        <!--  -->

            <!-- MODAL DETAIL-->
            <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content p-0 b-0">
                        <div class="panel panel-color panel-primary">
                            <div class="panel-heading"> 
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                <h3 class="panel-title">Detail Jamaah </h3> 
                            </div> 
                            <div class="panel-body"> 
                                
                            </div> 
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- END MODAL DETAIL -->
            <!-- Page Content Ends -->
            <!-- ================== -->

@endsection
