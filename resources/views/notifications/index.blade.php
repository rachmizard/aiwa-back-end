@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-bell"></i> Notifikasi Admin</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    @if(Auth::guard('admin')->user()->notifications->count() > 1)
                    <a href="{{ route('admin.deleteall.notification') }}" class="btn btn-sm btn-info"><i class="fa fa-trash"></i> Hapus semua notifikasi</a>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table class="table table-hovered table-bordered" id="notificationTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Notif</th>
                                            <th>Notifikasi Masuk</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach(Auth::guard('admin')->user()->notifications as $notification)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>
                                                {{ $notification->data['data'] }}
                                            </td>
                                            <td>{{ $notification->created_at }}</td>
                                            <td>
                                                <i class="fa fa-check text-green"> Dibaca</i>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.delete.notification', $notification->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Notif</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>
@push('otherJavascript')
<!-- sweet alerts -->
<link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
<!-- sweet alerts -->
<script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
<script>
    var notificationTable = $('#notificationTable').DataTable();

// $(function () {
//     $('#jadwal_edit').change(function() {
//         $('#link_Edit').val($(this,':selected').val())
//     })
//     $('#jadwal_tambah').change(function() {
//         $('#link_tambah').val($(this,':selected').val())
//     })
// })

// jQuery('.datepicker').datepicker({
//    todayBtn: "linked",
//    language: "it",
//    autoclose: true,
//    todayHighlight: true,
//    format: 'yyyy-mm-d' 
// });
// // Select2
// jQuery(".select2").select2({
//     width: '100%'
// });
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

@endsection
