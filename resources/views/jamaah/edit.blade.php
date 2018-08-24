@extends('layouts.master')
@section('content')
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
            <div class="page-title">
                <h3 class="title text-center"><strong><i class="fa fa-user"></i> {{ $jamaah->nama }}</strong></h3>
            </div>
            <div class="divider" style="margin-bottom: 10px;">
                <a href="{{ route('aiwa.jamaah') }}" class="btn btn-md btn-success">Kembali</a>
            </div>
            <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-pencil"></i> Edit Jamaah</h3></div>
                            <div class="panel-body">

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('aiwa.jamaah.updatecuy', $jamaah->id) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="id_umrah">ID Umrah</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" id="id_umrah" name="id_umrah" class="form-control" placeholder="Id Umrah.." required value="{{ $jamaah->id_umrah }}">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="id_jamaah">ID Jamaah</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" id="id_jamaah" name="id_jamaah" class="form-control" placeholder="ID Jamaah.." required value="{{ $jamaah->id_jamaah }}">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="nama">Nama</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama.." required value="{{ $jamaah->nama }}">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="tgl_berangkat">Tanggal Berangkat</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="tgl_berangkat" name="tgl_berangkat" class="form-control datepicker" placeholder="Tanggal Berangkat.." required value="{{ $jamaah->tgl_berangkat }}">
                                            </div>
                                            <span class="help-block text-success"><small>Format tanggal contoh : 11/07/2018</small></span>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="tgl_pulang">Tanggal Pulang</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="tgl_pulang" name="tgl_pulang" class="form-control datepicker" placeholder="Tanggal Pulang.." required value="{{ $jamaah->tgl_pulang }}">          
                                            </div>
                                            <span class="help-block text-success"><small>Format tanggal contoh : 11/07/2018</small></span>    
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="maskapai">Marketing</label>
                                        <div class="col-md-7">
                                            <select name="marketing" class="select2" data-placeholder="Pilih Agen.." style="width: 100%;" required>
                                                @foreach($agents as $agent)
                                                <option value="{{ $agent->id }}" @if($agent->id == $jamaah->marketing) selected @endif>{{ $agent->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="staff">Staff</label>
                                        <div class="col-md-7">
                                            <input type="text" id="staff" name="staff" class="form-control" placeholder="Staff.." required value="{{ $jamaah->staff }}">
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="no_telp">No. Telp</label>
                                        <div class="col-md-7">
                                            <input type="number" id="no_telp" name="no_telp" class="form-control" placeholder="No telepon.." value="{{ $jamaah->no_telp }}">
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="nama">Status</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                                <select name="status" class="select2" data-placeholder="Status.." style="width: 100%;" required>
                                                    <option value="POTENSI" @if($jamaah->status == 'POTENSI') selected @endif>POTENSI</option>
                                                    <option value="KOM" @if($jamaah->status == 'KOM') selected @endif>KOMISI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="nama">Diskon</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                <input type="text" class="form-control" name="diskon_marketing" value="{{ $jamaah->diskon_marketing }}">
                                                <!-- <span class="help-block text-success"><small></small></span>   -->
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="nama">Tgl Transfer</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control datepicker" name="tgl_transfer" value="{{ $jamaah->tgl_transfer }}">
                                                <!-- <span class="help-block text-success"><small></small></span>   -->
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <button class="btn btn-md btn-success col-lg-6 col-md-offset-3" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit">Simpan</button> <!-- form-group -->

                                </form>

                           </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->
                </div> <!-- End row -->
            </div>

         @push('dataTables')
            <!-- Datatable Serverside -->
            <script>
                $(document).ready(function(){
                    $('#jamaah').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "http://localhost:8000/jamaah/loadTableJamaah", 
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "tgl_daftar", name: "tgl_daftar" },
                            { data: "id_umrah", name: "id_umrah" },
                            { data: "nama", name: "nama" },
                            { data: "tgl_berangkat", name: "tgl_berangkat" },
                            { data: "maskapai", name: "maskapai" },
                            { data: "anggota.nama", name: "anggota.nama" },
                            { data: "action", name: "action"}
                        ]
                    });
                });
            </script>
            <!-- End Datatable Serverside -->
            @endpush
            @push('otherJavascript')
            <script>
                // Select2
                jQuery(".select2").select2({
                    width: '100%'
                });
                // DatePicker
                jQuery('.datepicker').datepicker({
                   todayBtn: "linked",
                   language: "it",
                   autoclose: true,
                   todayHighlight: true,
                   format: 'd/m/yyyy' 
               });
            </script>
            @endpush
            <!-- END MODAL DETAIL -->
            <!-- Page Content Ends -->
            <!-- ================== -->

@endsection
