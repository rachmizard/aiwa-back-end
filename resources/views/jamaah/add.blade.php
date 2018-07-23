@extends('layouts.master')
@section('content')

            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-user"></i> LAPORAN JAMAAH UMRAH</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <!--     -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table id="datatable" class="table table-bordered">
                                  <thead class="bg-info text-white">
                                    <tr>
                                        <td>No</td>
                                        <td>Tanggal Daftar</td>
                                        <td>ID Umrah</td>
                                        <td>Nama</td>
                                        <td>Tanggal Keberangkatan</td>
                                        <td>Maskapai</td>
                                        <td>Marketing</td>
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
            <div class="page-title">
                <h3 class="title text-center"><strong><i class="fa fa-user-plus"></i> TAMBAH JAMAAH</strong></h3>
            </div>
            <div class="divider" style="margin-bottom: 10px;">
                <!--     -->
            </div>
            <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-pencil"></i> Input Jamaah</h3></div>
                            <div class="panel-body">

                                <form class="form-horizontal" role="form">
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="id_umrah">Agen</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <select id="id_umrah" name="marketing" class="form-control select2" data-placeholder="Agen..." style="width: 100%;">
                                                  <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="id_umrah">ID Umrah</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <input type="text" id="id_umrah" name="id_umrah" class="form-control" placeholder="ID Umrah..">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="id_jamaah">ID Jamaah</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <input type="text" id="id_jamaah" name="id_jamaah" class="form-control" placeholder="ID Jamaah..">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="tanggal_daftar">Tanggal Daftar</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="tanggal_daftar" name="tanggal_daftar" class="form-control datepicker" placeholder="Tanggal Daftar">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="nama">Nama</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama..">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="tanggal_berangkat">Tanggal Berangkat</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="tanggal_berangkat" name="tanggal_berangkat" class="form-control datepicker" placeholder="Tanggal Berangkat..">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="tanggal_pulang">Tanggal Pulang</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="tanggal_pulang" name="tanggal_pulang" class="form-control datepicker" placeholder="Tanggal Pulang..">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="maskapai">Maskapai</label>
                                        <div class="col-md-7">
                                            <select name="maskapai" class="select2" data-placeholder="Pilih maskapai.." style="width: 100%;">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="maskapai">Marketing</label>
                                        <div class="col-md-7">
                                            <input type="text" id="example-input1-group1" name="marketing" class="form-control" placeholder="Marketing..">
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="staff">Staff</label>
                                        <div class="col-md-7">
                                            <input type="text" id="staff" name="staff" class="form-control" placeholder="Staff..">
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="no_telp">No. Telp</label>
                                        <div class="col-md-7">
                                            <input type="number" id="no_telp" name="no_telp" class="form-control" placeholder="No telepon..">
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="no_telp">Fee</label>
                                        <div class="col-md-7">
                                            <input type="number" id="fee" name="no_telp" class="form-control" placeholder="No telepon.." value="Rp. 900000">
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="no_telp">Jumlah bayar fee</label>
                                        
                                            <div class="checkbox">
                                                <label class="cr-styled">
                                                    <input type="checkbox">
                                                    <i class="fa"></i>
                                                </label>
                                            </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group text-center">
                                        <button class="btn btn-md btn-success col-lg-6 col-md-offset-3">Simpan</button>
                                    </div> <!-- form-group -->

                                </form>

                           </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-file-excel-o"></i> Input Jamaah Via Excel</h3></div>
                            <div class="panel-body">

                                <form class="form-horizontal" role="form">
                                    <div class="form-group">

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file-excel-o"></i></span>
                                                <input type="file" id="tanggal_daftar" name="file_excel" class="form-control" placeholder="File excel.xlsx">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group text-center">
                                        <button class="btn btn-md btn-success col-lg-6 col-md-offset-3">Upload & Simpan</button>
                                    </div> <!-- form-group -->

                                </form>

                           </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->
                </div> <!-- End row -->
            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

@endsection
