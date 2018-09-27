@extends('layouts.master')
@section('content')
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
            <div class="page-title">
                <h3 class="title text-center"><strong><div><i class="fa fa-user"></i> Agen {{ $agen->nama }}</div></strong></h3>
            </div>
            <div class="divider" style="margin-bottom: 10px;">
                <a href="{{ route('aiwa.anggota') }}" class="btn btn-md btn-success">Kembali</a>
            </div>
            <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-pencil"></i> Data Personal Agen {{ $agen->nama }}</h3></div>
                            <div class="panel-body">

                                <form class="form-horizontal" role="form" action="{{ route('aiwa.anggota.update', $agen->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="tgl_daftar">Nama Lengkap</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" name="nama" value="{{ $agen->nama }}" class="form-control" required>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="alamat">Alamat</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="ion-pin"></i></span>
                                                <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Id Umrah.." required value="{{ $agen->alamat }}">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="jenis_kelamin">Jenis Kelamin</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-mars-double"></i></span>
                                                    <select name="jenis_kelamin" id="" class="form-control" required style="width: 100%;">
                                                        <option value="L" {{ $agen->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                                        <option value="P" {{ $agen->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="no_ktp">No KTP</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="ion-card"></i></span>
                                                <input type="text" id="no_ktp" name="no_ktp" class="form-control" placeholder="No KTP.." required value="{{ $agen->no_ktp }}">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="no_telp">No Telp</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="ion-iphone"></i></span>
                                                <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="No Telepon Agen.." value="{{ $agen->no_telp }}">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="koordinator">Koordinator</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                @if($agen->id != 'SM140')
                                                    <select name="koordinator" id="" class="select2" style="width: 100%">
                                                        @foreach($agens as $key => $agent)
                                                            @if($agent->id == $agen->id)
                                                            @else
                                                            <option value="{{ $agent->id }}" {{ $agen->koordinator == $agent->id  ? 'selected' : '' }}>{{ $agent->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>    
                                                @endif      
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="bank">Bank</label>
                                        <div class="col-md-7">
                                            <input type="text" id="bank" name="bank" class="form-control" placeholder="ATM Bank agen.." value="{{ $agen->bank }}">
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="no_rekening">No. Rekening</label>
                                        <div class="col-md-7">
                                            <input type="number" id="no_rekening" name="no_rekening" class="form-control" placeholder="No Rekeing agen.." value="{{ $agen->no_rekening }}">
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="fee_reguler">Fee Reguler</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control rupiah" value="{{ $agen->fee_reguler }}" name="fee_reguler" >
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="fee_promo">Fee Promo</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control rupiah" value="{{ $agen->fee_promo }}" name="fee_promo" >
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="nama_rek_beda">Nama Rekening Beda</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                                <input type="text" class="form-control" name="nama_rek_beda" value="{{ $agen->nama_rek_beda }}">
                                                <!-- <span class="help-block text-success"><small></small></span>   -->
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="website">Website</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                                <input type="text" class="form-control" name="website" value="{{ $agen->website }}">
                                                <!-- <span class="help-block text-success"><small></small></span>   -->
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <button class="btn btn-md btn-success col-lg-6 col-md-offset-3" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit">Edit Personal</button> <!-- form-group -->

                                </form>

                           </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-pencil"></i> Data Akun Agen {{ $agen->nama }}</h3></div>
                            <div class="panel-body">

                                <form class="form-horizontal" role="form" action="{{ route('aiwa.anggota.updateaccount', $agen->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="id">ID Sekarang</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon">ID</span>
                                                <input type="text" value="{{ $agen->id }}" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="id">ID Baru</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon">ID</span>
                                                <input type="text" id="id" name="id" class="form-control" placeholder="ID Baru...">
                                                <input type="hidden" name="old_id" value="{{ $agen->id }}">
                                            </div>
                                                @if($agen->id != 'SM140')
                                                    <span class="help-block"><small>ID tidak auto increment, hati-hati jika ingin merubah ID yang sudah tersinkronisasi dengan sistem bisa mengakibatkan kesalahan data.</small></span>
                                                @else
                                                    <span class="help-block text-danger"><small>ID milik {{ $agen->nama }} ini disarankan untuk tidak di rubah rubah!</small></span>
                                                @endif
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="username">Username</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input type="text" value="{{ $agen->username }}" name="username" class="form-control" required>
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="password">New Password</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <input type="password" name="password" placeholder="Password baru..." name="email" class="form-control">
                                            </div>
                                                <span class="help-block"><small>Jikalau user meminta passwordnya yang lupa direkomendasikan untuk membuat password baru & password juga akan terenskripsi di database</small></span>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="email">Email</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="ion-ios7-email"></i></span>
                                                <input type="text" id="email" name="email" class="form-control" placeholder="Email Agen.." value="{{ $agen->email }}">
                                            </div>
                                        </div>
                                    </div> <!-- form-group -->
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="status">Status</label>
                                        <div class="col-md-7">
                                              <label class="cr-styled" for="example-radio5">
                                                  <input type="checkbox" id="example-radio5" name="skor" {{ $agen->status == '1' ? 'checked value="1"' : 'value="0" unchecked' }} required>
                                                  <i class="fa"></i>
                                              </label>
                                        </div>
                                    </div> <!-- form-group -->
                                    <button class="btn btn-md btn-info col-lg-6 col-md-offset-3" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit">Edit Akun</button> <!-- form-group -->

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
                   format: 'yyyy-mm-dd' 
               });
            </script>
            @endpush
            <!-- END MODAL DETAIL -->
            <!-- Success notification -->
            @if(session('messageError'))
            <!-- sweet alerts -->
            <link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
            <!-- sweet alerts -->
            <script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
            <script>
                swal("Error!", "{{ session('messageError') }}", "error");
            </script>
            @elseif(session('message'))
            <!-- sweet alerts -->
            <link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
            <!-- sweet alerts -->
            <script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
            <script>
                swal("Perubahan telah ditetapkan", "{{ session('message') }}", "success");
            </script>
            @endif
            <!-- Page Content Ends -->
            <!-- ================== -->

@endsection
