@extends('layouts.master')
@section('content')
            
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-user"></i> AGEN NON APPROVAL</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <!-- <a href="tambah-gallery.html" class="btn btn-sm btn-primary">Tambah Dokumen Foto/Video</a> -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                               <!--  <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="periode">Periode</label>
                                        <select name="" id="periode" class="form-control">
                                            <option selected="" disabled="">Periode</option>
                                            <option value="1440">1440</option>
                                            <option value="1441">1441</option>
                                            <option value="1442">1442</option>
                                        </select>
                                    </div>
                                </div> -->
                                <table id="agent" class="table table-striped">
                                  <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Telp</th>
                                        <th>Domisli</th>
                                        <th>Koordinator</th>
                                        <th>Aksi</th>
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
        @foreach($agentagen as $agen)
        <div id="approveModal{{ $agen->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content p-0">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#home-{{ $agen->id }}" data-toggle="tab" aria-expanded="false"> 
                                    <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                    <span class="hidden-xs">Identitas Agen</span> 
                                </a> 
                            </li> 
                        </ul> 
                        <div class="tab-content"> 
                            <div class="tab-pane active" id="profile-{{ $agen->id }}">
                                <table class="table table-hover">
                                    <form action="{{ route('aiwa.approved', $agen->id) }}" method="POST">
                                        {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td><input type="text" name="id" class="form-control" value="" required="" placeholder="ID Wajib di edit sesuai format kantor..."></td>
                                        </tr>
                                        <tr>
                                            <th>Username</th>
                                            <td>{{ $agen->username }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $agen->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Approval</th>
                                            <td>
                                                <label class="cr-styled">
                                                    <input type="checkbox" name="status" value="1" required>
                                                    <i class="fa"></i>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><button id="loadAgen" type="submit" class="btn btn-sm btn-info">Simpan</button></td>
                                        </tr>
                                    </tbody>
                                </form>
                                </table>
                            </div>
                        </div> 
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    @endforeach
            <!-- Page Content Ends -->
            <!-- ================== -->
        @push('otherJavascript')
        <script>
            // Select2
            jQuery(".select2").select2({
                width: '100%'
            });
            function confirmBtn() {
                  if(!confirm("Anda yakin ingin mengapprove akun ini?"))
                  event.preventDefault();
            }
        </script>
        @endpush
        @push('dataTables')
            <!-- Datatable Serverside -->
            <script>
                $(document).ready(function(){
                    // Disable Error Debug
                    $.fn.dataTable.ext.errMode = 'none';
                    var table = $('#agent').DataTable({
                        "serverSide": true,
                        "ordering": true,
                        "searching": true,
                        "processing": false,
                        "ajax": "{{ route('aiwa.approval.load') }}", 
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "nama", name: "nama"},
                            { data: "no_telp", name: "no_telp" },
                            { data: "alamat", name: "alamat" },
                            { data: "koordinator", name: "koordinator" },
                            { data: "action", name: "action"}
                        ]
                    }).on('error.dt', function ( e, settings, techNote, message ) {
                     console.log( 'An error has been reported by DataTables: ', message );
                    });

                    // setInterval( function () {
                    //     table.ajax.reload( null, false ); // user paging is not reset on reload
                    // }, 3500 );
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
            swal("Good Job!", "{{ session('messageError') }}", "error");
        </script>
        @endif

@endsection
