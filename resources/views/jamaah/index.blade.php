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
                                    <td>Status</td>
                                    <td>Aksi</td>
                                  </thead>
                                  <tbody>
                                    <?php $no = 0; ?>
                                    @foreach($jamaah as $in)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ $in->nama }}</td>
                                        <td>{{ $in->no_telp }}</td>
                                        <td>{{ $in->status }}</td>
                                        <td>
                                            <a href="" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="" class="btn btn-danger"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
            <!-- Page Content Ends -->
            <!-- ================== -->
@endsection
