@extends('layouts.master')
@section('content')

            <!-- Page Content Start -->
            <!-- ================== -->


            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title">Form Edit Jamaah</h3>
                </div>

                <!-- Wizard with Validation -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $edit->nama }}</h3>
                            </div>
                            <div class="panel-body">
                              <form class="form-horizontal" role="form" method="POST" action="{{route('aiwa.jamaah.update', $edit->id)}}">
                              	{{ csrf_field() }}
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="judul">Agen yang dituju</label>
                                      <div class="col-md-10">
                                          <select name="anggota_id" class="form-control" id="">
                                            @foreach($anggota as $in)
                                          	<option value="{{$in->id}}" @if($edit->anggota_id == $in->id) selected @endif>{{$in->nama}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="judul">Nama (PIC)</label>
                                      <div class="col-md-10">
                                          <input name="nama" class="form-control" id="judul" value="{{ $edit->nama }}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label">Alamat</label>
                                      <div class="col-md-10">
                                          <input type="text" class="form-control" name="alamat" value="{{ $edit->alamat }}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">No. Telp</label>
                                      <div class="col-md-10">
                                          <input type="number" class="form-control" name="no_telp" value="{{ $edit->no_telp }}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Jenis Kelamin</label>
                                      <div class="col-md-10">
                                          <select name="jenis_kelamin" class="form-control" id="">
                                          	<option value="L" @if($edit->jenis_kelamin == 'L') selected @endif>L</option>
                                          	<option value="P">P</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Jumlah Dewasa</label>
                                      <div class="col-md-10">
                                          <input type="number" class="form-control" name="jml_dewasa" value="{{ $edit->jml_dewasa }}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Jumlah Balita</label>
                                      <div class="col-md-10">
                                          <input type="number" class="form-control" name="jml_balita" value="{{ $edit->jml_balita }}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Jumlah Infant</label>
                                      <div class="col-md-10">
                                          <input type="number" class="form-control" name="jml_infant" value="{{ $edit->jml_infant }}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Pembayaran <span class="text-red">*</span></label>
                                      <div class="col-md-10">
                                          <input type="number" class="form-control" name="pembayaran" value="{{ $edit->pembayaran }}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Keterangan</label>
                                      <div class="col-md-10">
                                          <textarea name="keterangan" class="form-control" id="" cols="30" rows="10">{{ $edit->keterangan }}</textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="">Status</label>
                                      <div class="col-md-10">
                                          <select name="status" id="" class="form-control">
                                          	<option value="Lunas" @if($edit->status == 'Lunas') selected @endif>Lunas</option>
                                          	<option value="DP">DP</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-md-offset-2 col-md-10">
                                          <button class="btn btn-md btn-success" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit">Edit</button>
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
