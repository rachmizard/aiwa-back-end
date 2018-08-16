@extends('layouts.master')
@section('content')
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
            <div class="page-title">
                <h3 class="title text-center"><strong><i class="fa fa-user"></i> {{ $jamaah->nama }}</strong></h3>
            </div>
            <div class="divider" style="margin-bottom: 10px;">
                <!--     -->
            </div>
            <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-pencil"></i> Edit Jamaah</h3></div>
                            <div class="panel-body">

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('aiwa.jamaah.updatecuy', $jamaah->id) }}">
                                    {{ csrf_field() }}
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
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="tgl_pulang">Tanggal Pulang</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="tgl_pulang" name="tgl_pulang" class="form-control datepicker" placeholder="Tanggal Pulang.." required value="{{ $jamaah->tgl_pulang }}">
                                            </div>
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
                                            <input type="number" id="no_telp" name="no_telp" class="form-control" placeholder="No telepon.." required value="{{ $jamaah->no_telp }}">
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
