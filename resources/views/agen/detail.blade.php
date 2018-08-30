@extends('layouts.master')
@section('content')
            
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-user"></i> DAFTAR AGEN</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <!-- <a href="tambah-gallery.html" class="btn btn-sm btn-primary">Tambah Dokumen Foto/Video</a> -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button id="refreshAgen" class="btn btn-sm btn-info"><i class="fa fa-refresh"></i> Refresh Table</button>
                                        <a href="{{ url('/admin/agenjamaah/downloadExcel/xlsx') }}" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download Format Agen</a>
                                    </div>
                                </div>
                                <table id="agent" class="stripe row-border order-column table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No KTP</th>
                                        <th>Alamat</th>
                                        <th>Telp</th>
                                        <th>Status</th>
                                        <th>Koordinator</th>
                                        <th>Foto</th>
                                        <th>Bank</th>
                                        <th>No Rekening</th>
                                        <th>Fee Reguler</th>
                                        <th>Fee Promo</th>
                                        <th>Nama Rek Beda</th>
                                        <th>Website</th>
                                        <th>Tgl Join</th>
                                    </tr>
                                  </thead>
                                  <tfoot></tfoot>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>

            <!-- Page Content Ends -->
            <!-- ================== -->
            @push('otherJavascript')
            <script>

              jQuery(".select2").select2({
                  width: '100%'
              });
                // Mask Input
                $('.rupiah').mask('0.000.000.000', {reverse: true});
                $('#loadAgen').click(function(){
                    $('.rupiah').unmask();
                });
            </script>
            @endpush
        @push('dataTables')
            <!-- Datatable Serverside -->
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
            <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
            <script>
                $(document).ready(function(){
                   var table = $('#agent').DataTable({
                        "scrollX": true,
                        "scrollY": "300",
                        "dom" : 'lBfrtip',
                        "buttons": [
                            'excel'
                        ],
                        "serverSide": true,
                        "ordering": true,
                        "searching": true,
                        "processing": true,
                        "ajax": {
                            url: "{{ route('aiwa.anggota.load') }}"
                            // data: function (d) {
                            //     // d.name = $('input[name=name]').val();
                            //     // d.periode = $('select[name=periode]').val();
                            // }
                        },
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "nama", name: "nama"},
                            { data: "email", name: "email" },
                            { data: "username", name: "username" },
                            { data: "jenis_kelamin", name: "jenis_kelamin" },
                            { data: "no_ktp", name: "no_ktp" },
                            { data: "alamat", name: "alamat" },
                            { data: "no_telp", name: "no_telp" },
                            { data: "status", name: "status" },
                            { data: "koordinator", name: "koordinator" },
                            { data: "foto", name: "foto", orderable: false, searchable: false},
                            { data: "bank", name: "bank" },
                            { data: "no_rekening", name: "no_rekening" },
                            { data: "fee_reguler", name: "fee_reguler" },
                            { data: "fee_promo", name: "fee_promo" },
                            { data: "nama_rek_beda", name: "nama_rek_beda" },
                            { data: "website", name: "website" },
                            { data: "created_at", name: "created_at" }
                        ]
                    });
                   // Refresh Table
                   $('#refreshAgen').on('click', function(){
                            table.ajax.reload( null, false ); // user paging is not reset on reload
                   });
                });
            </script>
            <!-- End Datatable Serverside -->
            @endpush
            <!-- Success notification -->
            @if(session('messageError'))
            <!-- sweet alerts -->
            <link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
            <!-- sweet alerts -->
            <script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
            <script>
                swal("Error!", "{{ session('messageError') }}", "error");
            </script>
            @elseif(session('message'))
            <!-- sweet alerts -->
            <link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
            <!-- sweet alerts -->
            <script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
            <script>
                swal("ID Berhasil di ganti!", "{{ session('message') }}", "success");
            </script>
            @endif

@endsection
