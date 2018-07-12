@extends('layouts.master')
@section('content')

            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><i class="fa fa-clock-o"></i> <strong>Log Activity</strong></h3>
                </div>
                <!-- <div class="divider" style="margin-bottom: 10px;">
                    <a href="tambah-gallery.html" class="btn btn-sm btn-primary">Tambah Dokumen Foto/Video</a>
                </div> -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table id="log-activity" class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                    	<td>No</td>
	                                    <td>Subjek</td>
	                                    <td>User ID</td>
	                                    <td>Tanggal</td>
	                                    <td>Aksi</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  	<?php $no = 1; ?>
                                  	@foreach($logs as $log)
                                  	<tr>
                                  		<td>{{ $no }}</td>
	                                    <td><span class="text-success">{{ $log->subjek }}</span></td>
	                                    <td>{{ $log->user_id }}</td>
	                                    <td>{{ $log->tanggal }}</td>
	                                    <td>
	                                      <a href="#" class="btn btn-sm btn-warning">Edit</a>
	                                      <a href="#" class="btn btn-sm btn-danger">Hapus</a>
	                                    </td>
                                  	</tr>
                                  	<?php $no++; ?>
                                  	@endforeach
                                  </tbody>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>
            <!-- Page Content Ends -->
            <!-- ================== -->


         @push('dataTables')
            <!-- Datatable Serverside -->
            <script>
                $(document).ready(function(){
                    $('#log-activity').dataTable();
                });
            </script>
            <!-- End Datatable Serverside -->
            @endpush
@endsection
