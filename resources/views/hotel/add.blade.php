@extends('layouts.master')
@section('content')

            <!-- Page Content Start -->
            <!-- ================== -->


            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title">Form Tambah Hotel</h3>
                </div>

                <!-- Wizard with Validation -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Input Hotel Baru</h3>
                            </div>
                            <div class="panel-body">
                              <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                      <label class="col-md-2 control-label">File</label>
                                      <div class="col-md-10">
                                          <input type="file" class="form-control" name="file" value="Masukan gambar hotel..." autofocus>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="kota">Kota</label>
                                      <div class="col-md-10">
                                          <input type="kota" id="kota" name="kota" class="form-control" placeholder="">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="nama">Nama</label>
                                      <div class="col-md-10">
                                          <input type="text" id="nama" class="form-control" name="nama">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label">Lokasi Map</label>
                                      <div class="col-md-10">
                                          <input type="text" class="form-control" name="lokasi_map">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label">Skor</label>
                                      <div class="col-md-10">
                                        <div class="radio-inline">
                                              <label class="cr-styled" for="example-radio4">
                                                  <input type="radio" id="example-radio4" name="slpr" value="1">
                                                  <i class="fa"></i>
                                                  1
                                              </label>
                                          </div>
                                          <div class="radio-inline">
                                              <label class="cr-styled" for="example-radio5">
                                                  <input type="radio" id="example-radio5" name="slpr" value="2">
                                                  <i class="fa"></i>
                                                  2
                                              </label>
                                          </div>
                                          <div class="radio-inline">
                                              <label class="cr-styled" for="example-radio6">
                                                  <input type="radio" id="example-radio6" name="slpr" value="3">
                                                  <i class="fa"></i>
                                                  3
                                              </label>
                                          </div>
                                          <div class="radio-inline">
                                              <label class="cr-styled" for="example-radio7">
                                                  <input type="radio" id="example-radio7" name="slpr" value="4">
                                                  <i class="fa"></i>
                                                  4
                                              </label>
                                          </div>
                                          <div class="radio-inline">
                                              <label class="cr-styled" for="example-radio8">
                                                  <input type="radio" id="example-radio8" name="slpr" value="5">
                                                  <i class="fa"></i>
                                                  5
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group m-b-0">
                                      <div class="col-sm-offset-2 col-sm-9">
                                        <button type="submit" class="btn btn-info">Tambah</button>
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

