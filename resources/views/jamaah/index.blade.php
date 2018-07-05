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
                                <table id="datatable" class="table table-striped table-bordered">
                                  <thead>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>Nomor Telepon</td>
                                    <td>Pembayaran</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                                  </thead>
                                  <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($jamaah as $in)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $in->nama }}</td>
                                        <td>{{ $in->no_telp }}</td>
                                        <td>Rp. {{ $in->pembayaran }}</td>
                                        <td>{{ $in->status }}</td>
                                        <td>
                                            <a href="#{{ $in->id }}" id="load-a" class="btn btn-primary" data-target="#modal-{{ $in->id }}" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="#" id="load-a" class="btn btn-danger"><i class="fa fa-pencil"></i></a>
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
            <div id="modal-{{ $on->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content p-0 b-0">
                        <div class="panel panel-color panel-primary">
                            <div class="panel-heading"> 
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                <h3 class="panel-title">Detail Jamaah {{ $on->nama }}</h3> 
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
