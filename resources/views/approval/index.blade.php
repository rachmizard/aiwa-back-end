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
                                <table id="agent" class="stripe row-border order-column table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                        <th>No</th>
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
            <!-- Page Content Ends -->
            <!-- ================== -->
        @push('otherJavascript')
        <script>
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
                    $('#agent').DataTable({
                        "serverSide": true,
                        "ordering": true,
                        "searching": true,
                        "processing": true,
                        "ajax": "{{ route('aiwa.approval.load') }}", 
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "nama", name: "nama"},
                            { data: "no_telp", name: "no_telp" },
                            { data: "alamat", name: "alamat" },
                            { data: "koordinator", name: "koordinator" },
                            { data: "action", name: "action"}
                        ]
                    });
                });
            </script>
            <!-- End Datatable Serverside -->
            @endpush

@endsection
