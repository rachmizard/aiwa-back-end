@extends('layouts.master')
@section('content')
            
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-user"></i> DAFTAR AGEN</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <!-- <a href="tambah-gallery.html" class="btn btn-sm btn-primary">Tambah Dokumen Foto/Video</a> -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="periode">Periode</label>
                                        <select name="" id="periode" class="form-control">
                                            <option selected="" disabled="">Periode</option>
                                            <option value="1440">1440</option>
                                            <option value="1441">1441</option>
                                            <option value="1442">1442</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button id="refreshAgen" class="btn btn-sm btn-info"><i class="fa fa-refresh"></i> Refresh Table</button>
                                    </div>
                                </div>
                                <table id="agent" class="stripe row-border order-column table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama</th>
                                        <th>Telp</th>
                                        <th>Domisli</th>
                                        <th>Koordinator</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>

    @foreach($agens as $agen)
        <div id="detailAgen{{ $agen->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content p-0">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#home-{{ $agen->id }}" data-toggle="tab" aria-expanded="false"> 
                                    <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                    <span class="hidden-xs">Personal</span> 
                                </a> 
                            </li> 
                            <li class=""> 
                                <a href="#profile-{{ $agen->id }}" data-toggle="tab" aria-expanded="false"> 
                                    <span class="visible-xs"><i class="fa fa-user"></i></span> 
                                    <span class="hidden-xs">Akun</span> 
                                </a> 
                            </li> 
                        </ul> 
                        <div class="tab-content"> 
                            <div class="tab-pane active" id="home-{{ $agen->id }}"> 
                                <table class="table table-hovered table-striped">
                                    <form action="{{ route('aiwa.anggota.update', $agen->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <tbody>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <td><input type="text" name="nama" value="{{ $agen->nama }}" class="form-control" required></td>
                                            </tr>
                                            <tr>
                                                <th>Domisili</th>
                                                <td><input type="text" name="alamat" value="{{ $agen->alamat }}" class="form-control" ></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td>
                                                    <select name="jenis_kelamin" id="" class="form-control" required>
                                                        <option value="L" {{ $agen->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                                        <option value="P" {{ $agen->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                            </td>
                                            </tr>
                                            <tr>
                                                <th>No KTP</th>
                                                <td><input type="text" value="{{ $agen->no_ktp }}" name="no_ktp" class="form-control" ></td>
                                            </tr>
                                            <tr>
                                                <th>No TELP</th>
                                                <td><input type="text" name="no_telp" value="{{ $agen->no_telp }}" class="form-control" ></td>
                                            </tr>
                                            <tr>
                                                <th>Koordinator</th>
                                                <td>
                                                    <select name="koordinator" id="" class="select2" style="width: 100%">
                                                        @foreach($agens as $key => $agent)
                                                            @if($agent->id == $agen->id)
                                                            @else
                                                            <option value="{{ $agent->id }}" {{ $agen->koordinator == $agent->id  ? 'selected' : '' }}>{{ $agent->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td><input type="text" value="{{ $agen->email }}" name="email" class="form-control" ></td>
                                            </tr>
                                            <tr>
                                                <th>BANK</th>
                                                <td><input type="text" class="form-control" value="{{ $agen->bank }}" name="bank" ></td>
                                            </tr>
                                            <tr>
                                                <th>No REKENING</th>
                                                <td><input type="text" class="form-control" value="{{ $agen->no_rekening }}" name="no_rekening" ></td>
                                            </tr>
                                            <tr>
                                                <th>Fee Reguler</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Rp.</span>
                                                        <input type="text" class="form-control rupiah" value="{{ $agen->fee_reguler }}" name="fee_reguler" >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Fee Promo</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Rp.</span>
                                                        <input type="text" class="form-control rupiah" value="{{ $agen->fee_promo }}" name="fee_promo" >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nama Rekening Beda</th>
                                                <td><input type="text" value="{{ $agen->nama_rek_beda }}" name="nama_rek_beda" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <th>Website</th>
                                                <td><input type="text" value="{{ $agen->website }}" name="website" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="12"><button id="loadAgen" type="submit" class="btn btn-sm btn-info">Simpan</button></td>
                                            </tr>
                                        </tbody>
                                    </form>
                                </table>
                            </div> 
                            <div class="tab-pane" id="profile-{{ $agen->id }}">
                                <table class="table table-hovered">
                                    <form action="{{ route('aiwa.anggota.updateaccount', $agen->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                    <tbody>
                                        <tr>
                                            <th>ID Sekarang</th>
                                            <td><input type="text" value="{{ $agen->id }}" class="form-control" disabled=""></td>
                                        </tr>
                                        <tr>
                                            <th>ID</th>
                                            <td><input type="text" placeholder="ID Baru" name="id" class="form-control">
                                                <span class="help-block"><small>ID tidak auto increment, hati-hati jika ingin merubah ID yang sudah tersinkronisasi dengan sistem bisa mengakibatkan kesalahan data.</small></span></td>
                                            <input type="hidden" name="old_id" value="{{ $agen->id }}">
                                        </tr>
                                        <tr>
                                            <th>Username</th>
                                            <td><input type="text" value="{{ $agen->username }}" name="username" class="form-control" required></td>
                                        </tr>
                                        <tr>
                                            <th>New Password</th>
                                            <td><input type="password" name="password" placeholder="Password baru..." name="email" class="form-control">
                                            <span class="help-block"><small>Jikalau user meminta passwordnya yang lupa direkomendasikan untuk membuat password baru & password juga akan terenskripsi di database</small></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><input type="text" value="{{ $agen->email }}" name="email" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th>Status Approval</th>
                                            <td>
                                              <label class="cr-styled" for="example-radio5">
                                                  <input type="checkbox" id="example-radio5" name="skor" {{ $agen->status == '1' ? 'checked value="1"' : 'value="0" unchecked' }} required>
                                                  <i class="fa"></i>
                                              </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <button type="submit" class="btn btn-md btn-success"> Simpan</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </form>
                                </table>
                            </div>
                        </div> 
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    @endforeach
            <!-- Page Content Ends -->
            <!-- ================== -->
            @push('otherJavascript')
            <script>

              jQuery(".select2").select2({
                  width: '100%'
              });
                // Mask Input
                $('.rupiah').mask('0.000.000.000', {reverse: true});
                $('#loadAgen').click(function(){
                    $('.rupiah').unmask();
                });
            </script>
            @endpush
        @push('dataTables')
            <!-- Datatable Serverside -->
            <script>
                $(document).ready(function(){
                   var table = $('#agent').DataTable({
                        serverSide: true,
                        ordering: true,
                        searching: true,
                        processing: false,
                        "ajax": "{{route('aiwa.anggota.load')}}", 
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "nama", name: "nama"},
                            { data: "no_telp", name: "no_telp" },
                            { data: "alamat", name: "alamat" },
                            { data: "agent.nama", name: "koordinator" },
                            { data: "foto", name: "foto", orderable: false, searchable: false},
                            { data: "action", name: "action", orderable: false, searchable: false}
                        ]
                    });
                   // Refresh Table
                   $('#refreshAgen').click(function(){
                        table.ajax.url("{{ route('aiwa.anggota.load') }}").load();
                   });

                    setInterval( function () {
                        table.ajax.reload( null, false ); // user paging is not reset on reload
                    }, 3500 );
                });
            </script>
            <!-- End Datatable Serverside -->
            @endpush
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
                swal("ID Berhasil di ganti!", "{{ session('message') }}", "success");
            </script>
            @endif

@endsection
