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
                                <table id="agent" class="stripe row-border order-column table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                        <th>No</th>
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
                                                <td>{{ $agen->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>Domisili</th>
                                                <td>{{ $agen->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td>{{ $agen->jenis_kelamin }}</td>
                                            </tr>
                                            <tr>
                                                <th>No KTP</th>
                                                <td>{{ $agen->no_ktp }}</td>
                                            </tr>
                                            <tr>
                                                <th>No TELP</th>
                                                <td>{{ $agen->no_telp }}</td>
                                            </tr>
                                            <tr>
                                                <th>Koordinator</th>
                                                <td>{{ $agen->koordinator }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $agen->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>BANK</th>
                                                <td>{{ $agen->bank }}</td>
                                            </tr>
                                            <tr>
                                                <th>No REKENING</th>
                                                <td>{{ $agen->no_rekening }}</td>
                                            </tr>
                                            <tr>
                                                <th>Fee Reguler</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Rp.</span>
                                                        <input type="text" class="form-control rupiah" value="{{ $agen->fee_reguler }}" name="fee_reguler">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Fee Promo</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Rp.</span>
                                                        <input type="text" class="form-control rupiah" value="{{ $agen->fee_promo }}" name="fee_promo">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nama Rekening Beda</th>
                                                <td>{{ $agen->nama_rek_beda }}</td>
                                            </tr>
                                            <tr>
                                                <th>Website</th>
                                                <td>{{ $agen->website }}</td>
                                            </tr>
                                            <tr>
                                                <td><button id="load" type="submit" class="btn btn-sm btn-info">Simpan</button></td>
                                            </tr>
                                        </tbody>
                                    </form>
                                </table>
                            </div> 
                            <div class="tab-pane" id="profile-{{ $agen->id }}">
                                <table class="table table-hovered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Username</th>
                                            <td>{{ $agen->username }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $agen->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Approval</th>
                                            <td>{{ $agen->status == '1' ? 'Approved' : '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    @endforeach
            <!-- Page Content Ends -->
            <!-- ================== -->
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
                            { data: "koordinator", name: "koordinator" },
                            { data: "foto", name: "foto", orderable: false, searchable: false},
                            { data: "action", name: "action", orderable: false, searchable: false}
                        ]
                    });

                    setInterval( function () {
                        table.ajax.reload( null, false ); // user paging is not reset on reload
                    }, 3500 );
                });
            </script>
            <!-- End Datatable Serverside -->
            @endpush
            @push('otherJavascript')
            <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
            <script>
                // Mask Input
                $( '.rupiah' ).mask('0.000.000.000', {reverse: true});
                $('#load').click(function(){
                    $( '.rupiah' ).unmask();
                });
            </script>
            @endpush

@endsection
