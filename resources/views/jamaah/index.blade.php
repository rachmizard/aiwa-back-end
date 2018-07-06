@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong>List Jamaah</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <a href="{{route('aiwa.jamaah.add')}}" class="btn btn-sm btn-primary">Tambah Jamaah</a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table id="jamaah" class="table table-striped table-bordered">
                                  <thead>
                                    <td>No</td>
                                    <td>Agen</td>
                                    <td>Nama</td>
                                    <td>Alamat</td>
                                    <td>Nomor Telepon</td>
                                    <td>Jenis Kelamin</td>
                                    <td>Jml Dewasa</td>
                                    <td>Jml Balita</td>
                                    <td>Jml Infant</td>
                                    <td>Pembayaran</td>
                                    <td>Status</td>
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
                    $('#jamaah').dataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "http://localhost:8000/jamaah/loadTableJamaah", 
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "anggota.nama", name: "anggota_id" },
                            { data: "nama", name: "nama" },
                            { data: "alamat", name: "alamat" },
                            { data: "no_telp", name: "no_telp" },
                            { data: "jenis_kelamin", name: "jenis_kelamin" },
                            { data: "jml_dewasa", name: "jml_dewasa" },
                            { data: "jml_balita", name: "jml_balita" },
                            { data: "jml_infant", name: "jml_infant" },
                            { data: "pembayaran", name: "pembayaran" },
                            { data: "status", name: "status" },
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
        <!--  -->

            <!-- MODAL DETAIL-->
            @foreach($jamaah as $on)
            <div id="modal{{ $on->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content p-0 b-0">
                        <div class="panel panel-color panel-primary">
                            <div class="panel-heading"> 
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                <h3 class="panel-title">Detail Jamaah {{ $on->nama }} {{ $on->id }}</h3> 
                            </div> 
                            <div class="panel-body"> 
                                
                            </div> 
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            @endforeach
            <!-- END MODAL DETAIL -->
            <!-- Page Content Ends -->
            <!-- ================== -->

@endsection
