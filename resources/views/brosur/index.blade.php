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
                    <!-- <a href="{{ route('aiwa.master-hotel.add') }}" class="btn btn-sm btn-primary">Tambah Hotel</a> -->
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
                                            <td><img src="/storage/brosur/{{ $brosur->file_brosur }}" width="70" height="70" alt=""></td>
                                            <td>{{ $brosur->description }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('master-brosur.edit', $brosur->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();" href="#" class="btn btn-sm btn-danger">Hapus</a>
                                                <form id="delete-form" action="{{ route('master-brosur.destroy', $brosur->id) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
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
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus"></i> Tambah Brosur</h3></div>
                            <div class="panel-body panel-info">
                                <form role="form" method="POST" action="{{route('master-brosur.store')}}" enctype="multipart/form-data">
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
                                        <button type="submit" class="btn btn-purple">Submit</button>
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
