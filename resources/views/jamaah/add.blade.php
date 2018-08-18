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

                                <form class="form-horizontal" role="form" method="POST" action="{{route('aiwa.jamaah.store')}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="id_umrah">ID Umrah</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <input type="text" id="id_umrah" name="id_umrah" class="form-control" placeholder="ID Umrah.." required>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="id_jamaah">ID Jamaah</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <input type="text" id="id_jamaah" name="id_jamaah" class="form-control" placeholder="ID Jamaah.." required>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="tgl_daftar">Tanggal Daftar</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="tgl_daftar" name="tgl_daftar" class="form-control datepicker" placeholder="Tanggal Daftar" required>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="nama">Nama</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama.." required>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="tgl_berangkat">Tanggal Berangkat</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="tgl_berangkat" name="tgl_berangkat" class="form-control datepicker" placeholder="Tanggal Berangkat.." required>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="tgl_pulang">Tanggal Pulang</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="tgl_pulang" name="tgl_pulang" class="form-control datepicker" placeholder="Tanggal Pulang.." required>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="maskapai">Maskapai</label>
                                        <div class="col-md-7">
                                            <select name="maskapai" class="select2" data-placeholder="Pilih maskapai.." style="width: 100%;" required>
                                                <option value="SAUDIA">SAUDIA</option>
                                                <option value="TURKI">TURKI</option>
                                                <option value="LEBANON">LEBANON</option>
                                            </select>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="maskapai">Marketing</label>
                                        <div class="col-md-7">
                                            <select name="marketing" class="select2" data-placeholder="Pilih Agen.." style="width: 100%;" required>
                                                @foreach($agents as $agent)
                                                <option value="{{ $agent->id }}">{{ $agent->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="staff">Staff</label>
                                        <div class="col-md-7">
                                            <input type="text" id="staff" name="staff" class="form-control" placeholder="Staff.." required>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="no_telp">No. Telp</label>
                                        <div class="col-md-7">
                                            <input type="number" id="no_telp" name="no_telp" class="form-control" placeholder="No telepon.." required>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="fee">Fee</label>
                                        <div class="col-md-7">
                                            <input type="number" id="fee" name="fee" class="form-control" placeholder="No telepon.." value="Rp. 900000" required>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="jumlah_fee">Jumlah Fee</label>
                                        <div class="col-md-7">
                                            <select name="jumlah_fee" id="jumlah_fee" class="form-control">
                                                <option value="Ya">Ya</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                    </div> <!-- form-group -->
                                    <button class="btn btn-md btn-success col-lg-6 col-md-offset-3" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit">Simpan</button> <!-- form-group -->

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
