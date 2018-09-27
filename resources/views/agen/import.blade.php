@extends('layouts.master')
@section('content')
            
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-user-plus"></i> Akun</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <!-- <a href="tambah-gallery.html" class="btn btn-sm btn-primary">Tambah Dokumen Foto/Video</a> -->
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-file-excel-o"></i> Import Akun Agen</h3></div>
                            <div class="panel-body panel-info">
                                <form role="form" method="POST" action="{{route('aiwa.anggota.store.import')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="import_file">File Excel</label>
                                        <input type="file" class="form-control" name="import_file" placeholder="File excel.." required="">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-purple"><i class="fa fa-upload"></i> Upload</button>
                                    </div>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-file-excel-o"></i> Download Format Agen</h3></div>
                            <div class="panel-body panel-info">
                                <span class="help-block">Anda butuh format upload untuk agen? Klik di bawah ini</span>
                                <a href="{{ route('agen.download.format') }}" class="btn btn-md btn-success">Unduh Format <i class="fa fa-download"></i></a>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>
            <!-- Page Content Ends -->
            <!-- ================== -->
@endsection
