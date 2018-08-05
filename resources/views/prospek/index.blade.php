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
                                    <td>No</td>
                                    <td>Nama Agent</td>
                                    <td>Nama Caljam (PIC)</td>
                                    <td>No telepon</td>
                                    <td>Tanggal Keberangkatan</td>
                                    <td>QTY</td>
                                    <td>Tanggal Follow Up</td>
                                    <td>Aksi</td>
                                  </thead>
                                </table>
                                <tbody>
                                </tbody>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>
        <!-- Detail of Prospek's Modal -->
        @foreach($prospeks as $prospek)
        <div class="modal fade detailQtyProspek{{ $prospek->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">Jumlah Prospek </h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Jumlah Dewasa</th>
                                <td>{{ $prospek->jml_dewasa == 0 ? 'Kosong' : $prospek->jml_dewasa  }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Infant</th>
                                <td>{{ $prospek->jml_infant == 0 ? 'Kosong' : $prospek->jml_infant }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Balita</th>
                                <td>{{ $prospek->jml_balita == 0 ? 'Kosong' : $prospek->jml_balita }}</td>
                            </tr>
                        </table>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        @endforeach
        <!-- End Modal -->
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
