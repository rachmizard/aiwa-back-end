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
                    <a href="{{ route('aiwa.master-hotel') }}" class="btn btn-sm btn-success">Kembali</a>
                    <a href="{{ route('aiwa.master-gallery.index.hotel') }}" class="btn btn-sm btn-primary"><i class="fa fa-file-image-o"></i> Lihat Gallery Hotel</a>
                    <!-- <a href="#" class="btn btn-sm btn-danger"><i class="ion-android-archive"></i> Arsip Hotel</a> -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table id="hotel" class="table table-striped table-bordered">
                                  <thead>
                                    <tr>    
                                        <td>No</td>
                                        <td>Nama Hotel</td>
                                        <td>Kota</td>
                                        <td>Koordinat Map</td>
                                        <td>Link Map</td>
                                        <td>Skor</td>
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
                    $.fn.dataTable.ext.errMode = 'none';
                    $('#hotel').dataTable({
                        "stateSave": true,
                        serverSide: true,
                        ordering: true,
                        searching: true,
                        processing: false,
                        "ajax": "{{route('aiwa.master-hotel.load.arsip')}}", 
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "nama_hotel", name: "nama_hotel" },
                            { data: "kota", name: "kota" },
                            { data: "link_map", name: "link_map" },
                            { data: "link", name: "link" },
                            { data: "skor", name: "skor" },
                            { data: "action", name: "action", orderable:false, searchable: false}
                        ]
                    }).on('error.dt', function ( e, settings, techNote, message ) {
                     console.log( 'An error has been reported by DataTables: ', message );
                    });
                });
            </script>
            <!-- End Datatable Serverside -->
            @endpush
        @push('otherJavascript')
        <script>
          jQuery(".select2").select2({
              width: '100%'
          });
          // $('#link').keyup(function() {
          //     document.getElementById('link_map').value = '';
          // });
          // $('#link_map').keyup(function() {
          //     document.getElementById('link').value = '';
          // });
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
