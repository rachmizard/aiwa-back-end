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
                        <!-- <button id="refreshJamaah" class="btn btn-sm btn-info"><i class="fa fa-refresh"></i> Refresh Table</button> -->
                        <a href="{{ url('/admin/jamaah/download/xlsx') }}" class="btn btn-sm btn-success"><i class="fa fa-download" title="Mendownload semua jamaah tidak berdasarkan periode"></i> Download Semua Jamaah</a>
                        <button data-target="#import" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i> Import</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <i class="fa fa-filter"></i> Periode Jamaah
                            </div>
                            <div class="panel-body panel-primary">
                                <div class="col-md-6">
                                    <form action="" method="GET" id="filter">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="">Periode Grafik</label>
                                            <select name="periode" id="" class="form-control" onchange="document.getElementById('filter').submit();">
                                                <option disabled selected>Periode</option>
                                                @foreach($periodes as $periode)
                                                <!-- Ini sengaja di kasih kondisi biar si ALL nya ga kedetek -->
                                                    @if($periode->id != 7)
                                                         <option value="{{ $periode->judul }}" {{ $periode->judul == $varJay->judul ? 'selected' : '' }}>{{ $periode->judul }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-file-excel-o"></i> Format Jamaah</div>
                            <div class="panel-body">
                                <span class="help-block">Anda butuh format upload? Klik disini untuk mengunduh format <i class="fa fa-file-excel-o"></i></span>
                                <a href="{{ url('/download/format/jamaah/format_jamaah_official.xlsx') }}" class="btn btn-sm btn-success">Unduh Format <i class="fa fa-download"></i></a>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <i class="fa fa-user-circle"></i> Hasil Jamaah Periode {{ $varJay->judul }}
                            </div>
                            <div class="panel-body p-t-10">
                                <table id="jamaah" class="table table-striped">
                                  <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>tgl_daftar</th>
                                        <th>id_umrah</th>
                                        <th>id_jamaah</th>
                                        <th>nama</th>
                                        <th>tgl_berangkat</th>
                                        <th>tgl_pulang</th>
                                        <th>marketing</th>
                                        <th>staff</th>
                                        <th>no_telp</th>
                                        <th>marketing_fee</th>
                                        <th>diskon_marketing</th>
                                        <th>koordinator</th>
                                        <th>koordinator_fee</th>
                                        <th>top</th>
                                        <th>top_fee</th>
                                        <th>status</th>
                                        <th>tgl_transfer</th>
                                        <th>periode</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($jamaahs as $jamaah)
                                      <tr>
                                        <td>{{ $jamaah->id }}</td>
                                        <td>{{ $jamaah->tgl_daftar }}</td>
                                        <td>{{ $jamaah->id_umrah }}</td>
                                        <td>{{ $jamaah->id_jamaah }}</td>
                                        <td>{{ $jamaah->nama }}</td>
                                        <td>{{ $jamaah->tgl_berangkat }}</td>
                                        <td>{{ $jamaah->tgl_pulang }}</td>
                                        <td>{{ $jamaah->marketing }}</td>
                                        <td>{{ $jamaah->staff }}</td>
                                        <td>{{ $jamaah->no_telp }}</td>
                                        <td>{{ $jamaah->marketing_fee }}</td>
                                        <td>{{ $jamaah->diskon_marketing }}</td>
                                        <td>{{ $jamaah->koordinator }}</td>
                                        <td>{{ $jamaah->koordinator_fee }}</td>
                                        <td>{{ $jamaah->top }}</td>
                                        <td>{{ $jamaah->top_fee }}</td>
                                        <td>{{ $jamaah->status }}</td>
                                        <td>{{ $jamaah->tgl_transfer }}</td>                                    
                                        <td>{{ $jamaah->periode }}</td>                                       
                                      </tr>
                                      @endforeach
                                  </tbody>
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
                    $.fn.dataTable.ext.errMode = 'none';
                    var table = $('#jamaah').DataTable({
                        "stateSave": true,
                        "scrollX": true,
                        "scrollY": 500,
                        "dom" : 'lBfrtip',
                        "buttons": [
                            {
                                extend: 'excel',
                                text: '<i class="fa fa-file-excel-o"></i> Download Jamaah {{ $varJay->judul }}',
                                title: 'data_jamaah_{{ $varJay->judul }}',
                                customize: function(xlsx) {
                                      var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                      $('row:first c', sheet).attr('s', '7');
                                      //color the background of the cells if found the value
                                      $('row c[r^="C"]',sheet).each(function(){
                                        if($('is t', this).text() == null){
                                            $(this).attr('s', '15');
                                        }
                                        else if ($('is t', this).text() == null){
                                            $(this).attr('s', '12');
                                        }
                                        else {
                                            $(this).attr('s', '34');
                                        }
                                    });
                                }
                            }
                        ],
                        "responsive": true,
                        // "processing": false,
                        // "serverSide": true,
                        // "ajax": "{{ route('aiwa.jamaah.load') }}", 
                        // order: [ [0, 'desc'] ],
                        // "columns": [
                        //     { data: "id", name: "id" },
                        //     { data: "tgl_daftar", name: "tgl_daftar" },
                        //     { data: "id_umrah", name: "id_umrah" },
                        //     { data: "id_jamaah", name: "id_jamaah" },
                        //     { data: "nama", name: "nama" },
                        //     { data: "tgl_berangkat", name: "tgl_berangkat" },
                        //     { data: "tgl_pulang", name: "tgl_pulang" },
                        //     { data: "marketing", name: "marketing" },
                        //     { data: "staff", name: "staff" },
                        //     { data: "no_telp", name: "no_telp" },
                        //     { data: "marketing_fee", name: "marketing_fee" },
                        //     { data: "diskon_marketing", name: "diskon_marketing" },
                        //     { data: "koordinator", name: "koordinator" },
                        //     { data: "koordinator_fee", name: "koordinator_fee" },
                        //     { data: "top", name: "top" },
                        //     { data: "top_fee", name: "top_fee" },
                        //     { data: "status", name: "status" },
                        //     { data: "tgl_transfer", name: "tgl_transfer" }
                        // ]
                    }).on('error.dt', function ( e, settings, techNote, message ) {
                         console.log( 'An error has been reported by DataTables: ', message );
                        });;
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
