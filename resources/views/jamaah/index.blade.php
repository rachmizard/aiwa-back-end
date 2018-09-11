@extends('layouts.master')
@section('content')
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-user"></i> LAPORAN JAMAAH UMRAH</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <!-- <a href="jamaah/download/csv" class="btn btn-sm btn-info"><i class="fa fa-file-excel-o"></i> Download CSV</a> -->
                    <button id="refreshJamaah" class="btn btn-sm btn-info"><i class="fa fa-refresh"></i> Refresh Table</button>
                    <a href="{{ route('aiwa.jamaah.detail') }}" class="btn btn-sm btn-info"><i class="fa fa-file-excel-o"></i> Download Jamaah</a>
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
                                                <option value="{{ $periode->judul }}">{{ $periode->judul }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="form-group m-l-10">
                                        <label class="sr-only" for="edan2">Search</label>
                                        <input type="text" class="form-control" name="search">
                                    </div> -->
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
                                        <th>Periode</th>
                                        <th>Aksi</th>
                                    </tr>
                                  </thead>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
            <div class="page-title">
                <h3 class="title text-center"><strong><i class="fa fa-user-plus"></i> TAMBAH JAMAAH</strong></h3>
            </div>
            <div class="divider" style="margin-bottom: 10px;">
            </div>
            <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-file-excel-o"></i> Import Jamaah Via Excel</h3></div>
                            <div class="panel-body">

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

                           </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->
                </div> <!-- End row -->
            </div>

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
                        "responsive": true,
                        "processing": false,
                        "serverSide": true,
                        "ajax": {
                            url : "{{ route('aiwa.jamaah.load') }}",
                            data: function (d) {
                                d.periode = $('select[name=periode]').val();
                                // d.search = $('input[name=search]').val();
                            }
                        }, 
                        order: [ [0, 'desc'] ],
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "tgl_daftar", name: "tgl_daftar" },
                            { data: "id_umrah", name: "id_umrah" },
                            { data: "id_jamaah", name: "id_jamaah" },
                            { data: "nama", name: "nama" },
                            { data: "tgl_berangkat", name: "tgl_berangkat" },
                            { data: "tgl_pulang", name: "tgl_pulang" },
                            { data: "marketing", name: "marketing" },
                            { data: "staff", name: "staff" },
                            { data: "no_telp", name: "no_telp" },
                            { data: "marketing_fee", name: "marketing_fee" },
                            { data: "diskon_marketing", name: "diskon_marketing" },
                            { data: "koordinator", name: "koordinator" },
                            { data: "koordinator_fee", name: "koordinator_fee" },
                            { data: "top", name: "top" },
                            { data: "top_fee", name: "top_fee" },
                            { data: "status", name: "status" },
                            { data: "tgl_transfer", name: "tgl_transfer" },
                            { data: "periode", name: "periode" },
                            { data: "action", name: "action", searchable: false, orderable: false}
                        ]
                    });

                    // trigger filter
                    $('#search-form').on('click', function(e) {
                        table.draw();
                        e.preventDefault();
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
