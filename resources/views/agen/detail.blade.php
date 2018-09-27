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
                                        <a href="{{ url('/admin/agenjamaah/downloadExcel/xlsx') }}" onclick="confirmBtnDownloadAgen();" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download Semua Agen</a>
                                    </div>
                                </div>
                                <table id="agent" class="table table-striped">
                                  <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>nama</th>
                                        <th>email</th>
                                        <th>username</th>
                                        <th>password</th>
                                        <th>jenis_kelamin</th>
                                        <th>no_ktp</th>
                                        <th>alamat</th>
                                        <th>no_telp</th>
                                        <th>status</th>
                                        <th>koordinator</th>
                                        <th>bank</th>
                                        <th>no_rekening</th>
                                        <th>nama_rek_beda</th>
                                        <th>website</th>
                                        <th>fee_reguler</th>
                                        <th>fee_promo</th>
                                        <th>created_at</th>
                                        <th>updated_at</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($agens as $in)
                                      <tr>
                                          <td>{{ $in->id }}</td>
                                          <td>{{ $in->nama }}</td>
                                          <td>{{ $in->email }}</td>
                                          <td>{{ $in->username }}</td>
                                          <td>{{ $in->password }}</td>
                                          <td>{{ $in->jenis_kelamin }}</td>
                                          <td>{{ $in->no_ktp }}</td>
                                          <td>{{ $in->alamat }}</td>
                                          <td>{{ $in->no_telp }}</td>
                                          <td>{{ $in->status }}</td>
                                          <td>{{ $in->koordinator }}</td>
                                          <td>{{ $in->bank }}</td>
                                          <td>{{ $in->no_rekening }}</td>
                                          <td>{{ $in->nama_rek_beda }}</td>
                                          <td>{{ $in->website }}</td>
                                          <td>{{ $in->fee_reguler }}</td>
                                          <td>{{ $in->fee_promo }}</td>
                                          <td>{{ $in->created_at }}</td>
                                          <td>{{ $in->updated_at }}</td>
                                      </tr>
                                      @endforeach
                                  </tbody>
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
                        "stateSave": true,
                        "scrollX": true,
                        "scrollY": "300",
                        "dom" : 'lBfrtip',
                        "buttons": [
                            {
                                extend: 'excel',
                                text: '<i class="fa fa-file-excel-o"></i> Download Agen',
                                title: 'data_agen_aiwa'
                            }
                        ],
                        "serverSide": false,
                        "ordering": true,
                        "searching": true,
                        "processing": false   
                    });
                   // // Refresh Table
                   // $('#refreshAgen').on('click', function(){
                   //          table.ajax.reload( null, false ); // user paging is not reset on reload
                   // });
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
