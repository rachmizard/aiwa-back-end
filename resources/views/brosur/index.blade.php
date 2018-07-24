@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->
            <style>
                .dataTables_empty{
                    text-align: center;
                }
            </style>
            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><i class="fa fa-building-o"></i><strong> MASTER HOTEL</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <a href="{{ route('aiwa.master-hotel.add') }}" class="btn btn-sm btn-primary">Tambah Hotel</a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table id="brosurs" class="table table-striped table-bordered">
                                  <thead>
                                    <tr>    
                                        <td>No</td>
                                        <td>File</td>
                                        <td>Deskripsi</td>
                                        <td>Aksi</td>
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

         @push('dataTables')
            <!-- Datatable Serverside -->
            <script>
                $(document).ready(function(){
                    $('#brosurs').dataTable({
                        serverSide: true,
                        ordering: true,
                        searching: true,
                        processing: true,
                        "ajax": "{{ route('aiwa.master-brosur.load') }}", 
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "file", name: "file" },
                            { data: "description", name: "description" },
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
