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
                    <h3 class="title"><i class="ion-map"></i><strong> MASTER VOUCHER</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <a href="{{ route('master-voucher.index') }}" class="btn btn-success"><i class="fa fa-sign-out"></i> Kembali </a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table id="vouchers" class="table table-striped table-bordered">
                                  <thead>
                                    <tr>    
                                        <th>No</th>
                                        <th>Anggota ID</th>
                                        <th>File</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($voucher as $voucher)
                                        @if(count($voucher) > 0)
                                        <tr>
                                            <td>{{ $voucher->id }}</td>
                                            <td>{{ $voucher->anggota_id }}</td>
                                            <td>{{ $voucher->file }}</td>
                                            <td>{{ $voucher->deskripsi }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('master-voucher.edit', $voucher->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();" href="#" class="btn btn-sm btn-danger">Hapus</a>
                                                <form id="delete-form" action="{{ route('master-voucher.destroy', $voucher->id) }}" method="POST" style="display: none;">
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
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Voucher ID: {{ $edit->id }}</h3></div>
                            <div class="panel-body panel-info">
                                <form role="form" method="POST" action="{{route('master-voucher.update', $edit->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <div class="form-group">
                                        <label for="file_voucher">File</label>
                                        <input type="file" class="form-control" name="file" placeholder="File.." value="{{ $edit->file }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="anggota_id">Anggota ID</label>
                                        <input type="text" class="form-control" name="anggota_id" placeholder="Anggota ID" required="" value="{{ $edit->anggota_id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="deskripsi" id="description" cols="30" rows="10" class="form-control" placeholder="Deskripsi" required="">{{ $edit->deskripsi }}
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
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus"></i> Tambah voucher</h3></div>
                            <div class="panel-body panel-info">
                                <form role="form" method="POST" action="{{route('master-voucher.store')}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="file_voucherr">File</label>
                                        <input type="file" class="form-control" name="file" placeholder="File.." required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Anggota ID</label>
                                        <input type="text" class="form-control" name="anggota_id" placeholder="Anggota ID.." required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="deskripsi" id="description" cols="30" rows="10" class="form-control" placeholder="Deksripsi.." required=""></textarea>
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
                    $('#vouchers').DataTable();
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
