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

         @push('dataTables')
            <!-- Datatable Serverside -->
            <script>
                $(document).ready(function(){
                    $('#prospek').dataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "{{route('aiwa.prospek.load')}}", 
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "anggota.nama", name: "anggota.nama" },
                            { data: "nama", name: "nama" },
                            { data: "no_telp", name: "no_telp" },
                            { data: "tgl_keberangkatan", name: "tgl_keberangkatan" },
                            { data: "qty", name: "qty" },
                            { data: "tanggal_followup", name: "tanggal_followup" },
                            { data: "action", name: "action"}
                        ]
                    });
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
