@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->
            <style>
                .dataTables_empty{
                    text-align: center;
                }
            </style>
            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><i class="ion-map"></i><strong> MASTER BROSUR</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <a href="{{ route('master-brosur.index') }}" class="btn btn-success"><i class="fa fa-sign-out"></i> Kembali </a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table id="brosurs" class="table table-striped table-bordered">
                                  <thead>
                                    <tr>    
                                        <th>No</th>
                                        <th>File</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($brosurs as $brosur)
                                        @if(count($brosur) > 0)
                                        <tr>
                                            <td>{{ $brosur->id }}</td>
                                            <td>{{ $brosur->file_brosur }}</td>
                                            <td>{{ $brosur->description }}</td>
                                            <td>
                                                <a href="{{ route('master-brosur.edit', $brosur->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ route('master-brosur.destroy', $brosur->id) }}" class="btn btn-sm btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="4">No was data found.</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                  </tbody>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Brosur ID: {{ $edit->id }}</h3></div>
                            <div class="panel-body panel-info">
                                <form role="form" method="POST" action="{{route('master-brosur.update', $edit->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <div class="form-group">
                                        <label for="file_brosur">File</label>
                                        <input type="file" class="form-control" name="file_brosur" placeholder="File.." value="{{ $edit->file_brosur }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Deksripsi.." required="">{{ $edit->description }}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info col-md-12"><i class="fa fa-check"></i> Edit</button>
                                    </div>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus"></i> Tambah Brosur</h3></div>
                            <div class="panel-body panel-info">
                                <form role="form" method="POST" action="{{route('master-brosur.store')}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="file_brosur">File</label>
                                        <input type="file" class="form-control" name="file_brosur" placeholder="File.." required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Deksripsi.." required=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-purple col-md-12"><i class="fa fa-plus"></i> Tambah</button>
                                    </div>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>
        @push('dataTables')

            <script>
                $(document).ready(function(){
                    $('#brosurs').DataTable();
                });
            </script>
        @endpush
        <!-- Success notification -->
        @if(session('message'))
        <!-- sweet alerts -->
        <link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
        <!-- sweet alerts -->
        <script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
        <script>
            swal("Good Job!", "{{ session('message') }}", "success");
        </script>
        @endif
            <!-- Page Content Ends -->
            <!-- ================== -->

@endsection
