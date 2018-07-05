@extends('layouts.master')
@section('content')

            <!-- Page Content Start -->
            <!-- ================== -->


            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title">Form Jamaah</h3>
                </div>

                <!-- Wizard with Validation -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Input Jamaah</h3>
                            </div>
                            <div class="panel-body">
                              <form class="form-horizontal" role="form" method="POST" action="{{route('aiwa.jamaah.store')}}">
                              	{{ csrf_field() }}
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="judul">Agen yang dituju</label>
                                      <div class="col-md-10">
                                          <select name="anggota_id" class="form-control" id="">
                                          	<option value="1">1</option>
                                          	<option value="2">2</option>
                                          	<option value="3">3</option>
                                          	<option value="4">4/option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="judul">Nama (PIC)</label>
                                      <div class="col-md-10">
                                          <input name="nama" class="form-control" id="judul">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label">Alamat</label>
                                      <div class="col-md-10">
                                          <input type="text" class="form-control" name="alamat" value="" autofocus>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">No. Telp</label>
                                      <div class="col-md-10">
                                          <input type="number" class="form-control" name="no_telp">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Jenis Kelamin</label>
                                      <div class="col-md-10">
                                          <select name="jenis_kelamin" class="form-control" id="">
                                          	<option value="L">L</option>
                                          	<option value="P">P</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Jumlah Dewasa</label>
                                      <div class="col-md-10">
                                          <input type="number" class="form-control" name="jml_dewasa">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Jumlah Balita</label>
                                      <div class="col-md-10">
                                          <input type="number" class="form-control" name="jml_balita">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Jumlah Infant</label>
                                      <div class="col-md-10">
                                          <input type="number" class="form-control" name="jml_infant">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Pembayaran <span class="text-red">*</span></label>
                                      <div class="col-md-10">
                                          <input type="number" class="form-control" name="pembayaran">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Keterangan</label>
                                      <div class="col-md-10">
                                          <textarea name="keterangan" class="form-control" id="" cols="30" rows="10"></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Status</label>
                                      <div class="col-md-10">
                                          <select name="status" id="" class="form-control">
                                          	<option value="Lunas">Lunas</option>
                                          	<option value="DP">DP</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-md-offset-2 col-md-10">
                                          <button class="btn btn-sm btn-primary" type="submit">Tambah</button>
                                      </div>
                                  </div>
                              </form>
                            </div>  <!-- End panel-body -->
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

                </div> <!-- End row -->


            </div>

            <!-- Page Content Ends -->
            <!-- ================== -->

@endsection
