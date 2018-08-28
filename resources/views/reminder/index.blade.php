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
                    <h3 class="title"><strong><i class="fa fa-bell"></i> Reminder Notifikasi</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-clock-o"></i> Penjadwalan Notifikasi {{ $followup->judul }}</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ route('master-reminder.update', $followup->id ) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="harga_promo">Atur Penjadwalan {{ $followup->judul }}</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select name="cron" id="" class="form-control">
                                                <option value="0 */5 * * *" {{ $followup->cron == '0 */5 * * *' ? 'selected' : '' }}>5 Jam sekali</option>
                                                <option value="0 */6 * * *" {{ $followup->cron == '0 */6 * * *' ? 'selected' : '' }}>6 Jam sekali</option>
                                                <option value="0 */7 * * *" {{ $followup->cron == '0 */7 * * *' ? 'selected' : '' }}>7 Jam sekali</option>
                                                <option value="0 */8 * * *" {{ $followup->cron == '0 */8 * * *' ? 'selected' : '' }}>8 Jam sekali</option>
                                                <option value="0 */9 * * *" {{ $followup->cron == '0 */9 * * *' ? 'selected' : '' }}>9 Jam sekali</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-success purple col-md-12">Edit</button>
                                    </div>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-3">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-clock-o"></i> Penjadwalan Notifikasi {{ $jamaahBerangkat->judul }}</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ route('master-reminder.update', $jamaahBerangkat->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="harga_promo">Atur Penjadwalan {{ $jamaahBerangkat->judul }}</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select name="cron" id="" class="form-control">
                                                <option value="0 */5 * * *" {{ $jamaahBerangkat->cron == '0 */5 * * *' ? 'selected' : '' }}>5 Jam sekali</option>
                                                <option value="0 */6 * * *" {{ $jamaahBerangkat->cron == '0 */6 * * *' ? 'selected' : '' }}>6 Jam sekali</option>
                                                <option value="0 */7 * * *" {{ $jamaahBerangkat->cron == '0 */7 * * *' ? 'selected' : '' }}>7 Jam sekali</option>
                                                <option value="0 */8 * * *" {{ $jamaahBerangkat->cron == '0 */8 * * *' ? 'selected' : '' }}>8 Jam sekali</option>
                                                <option value="0 */9 * * *" {{ $jamaahBerangkat->cron == '0 */9 * * *' ? 'selected' : '' }}>9 Jam sekali</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-warning col-md-12">Edit</button>
                                    </div>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-3">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-clock-o"></i> Penjadwalan Notifikasi {{ $jamaahPulang->judul }}</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ route('master-reminder.update', $jamaahPulang->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="harga_promo">Atur Penjadwalan {{ $jamaahPulang->judul }}</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select name="cron" id="" class="form-control">
                                                <option value="0 */5 * * *" {{ $jamaahPulang->cron == '0 */5 * * *' ? 'selected' : '' }}>5 Jam sekali</option>
                                                <option value="0 */6 * * *" {{ $jamaahPulang->cron == '0 */6 * * *' ? 'selected' : '' }}>6 Jam sekali</option>
                                                <option value="0 */7 * * *" {{ $jamaahPulang->cron == '0 */7 * * *' ? 'selected' : '' }}>7 Jam sekali</option>
                                                <option value="0 */8 * * *" {{ $jamaahPulang->cron == '0 */8 * * *' ? 'selected' : '' }}>8 Jam sekali</option>
                                                <option value="0 */9 * * *" {{ $jamaahPulang->cron == '0 */9 * * *' ? 'selected' : '' }}>9 Jam sekali</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-purple col-md-12">Edit</button>
                                    </div>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-sm-3">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-clock-o"></i> Penjadwalan Notifikasi {{ $sinkronisasi->judul }}</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ route('master-reminder.update', $sinkronisasi->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="harga_promo">Atur Penjadwalan {{ $sinkronisasi->judul }}</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select name="cron" id="" class="form-control">
                                                <option value="0 */5 * * *" {{ $sinkronisasi->notifikasi == 
                                                'sinkronisasi' ? '0 */5 * * *' : '' }}>5 Jam sekali</option>
                                                <option value="0 */6 * * *" {{ $sinkronisasi->notifikasi == 
                                                'sinkronisasi' ? '0 */6 * * *' : '' }}>6 Jam sekali</option>
                                                <option value="0 */7 * * *" {{ $sinkronisasi->notifikasi == 
                                                'sinkronisasi' ? '0 */7 * * *' : '' }}>7 Jam sekali</option>
                                                <option value="0 */8 * * *" {{ $sinkronisasi->notifikasi == 
                                                'sinkronisasi' ? '0 */8 * * *' : '' }}>8 Jam sekali</option>
                                                <option value="0 */9 * * *" {{ $sinkronisasi->notifikasi == 
                                                'sinkronisasi' ? '0 */9 * * *' : '' }}>9 Jam sekali</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-info col-md-12">Edit</button>
                                    </div>
                                </form>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>
@push('otherJavascript')
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script>

// Mask Input
$( '.rupiah' ).mask('0.000.000.000', {reverse: true});
$('#load').click(function(){
    $( '.rupiah' ).unmask();
});

jQuery('.datepicker').datepicker();
// Select2
jQuery(".select2").select2({
    width: '100%'
});

function confirmBtn() {
      if(!confirm("Are You Sure to delete this?"))
      event.preventDefault();
}
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
        @elseif(session('messageError'))
        <!-- sweet alerts -->
        <link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
        <!-- sweet alerts -->
        <script src="{{asset('/assets/sweet-alert/sweet-alert.min.js')}}"></script>
        <script>
            swal("Oppps!", "{{ session('messageError') }}", "danger");
        </script>
        @endif

@endsection
