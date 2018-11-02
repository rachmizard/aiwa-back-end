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
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-clock-o"></i> Notifikasi Follow Up</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ route('master-reminder.update', $reminders->id ) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" value="{{ $reminders->cron_followup }}" name="cron_followup">
                                    <input type="hidden" value="{{ $reminders->cron_jamaah_berangkat }}" name="cron_jamaah_berangkat">
                                    <input type="hidden" value="{{ $reminders->cron_jamaah_pulang }}" name="cron_jamaah_pulang">
                                    <input type="hidden" value="{{ $reminders->cron_sinkronisasi }}" name="cron_sinkronisasi">
                                    <input type="hidden" value="{{ $reminders->cron_jadwal }}" name="cron_jadwal">
                                    <div class="form-group">
                                        <label for="harga_promo">Atur Penjadwalan</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select name="cron_followup" id="" class="form-control">
                                                <option value="0 */5 * * *" {{ $reminders->cron_followup == '0 */5 * * *' ? 'selected' : '' }}>5 Jam sekali</option>
                                                <option value="0 */6 * * *" {{ $reminders->cron_followup == '0 */6 * * *' ? 'selected' : '' }}>6 Jam sekali</option>
                                                <option value="0 */7 * * *" {{ $reminders->cron_followup == '0 */7 * * *' ? 'selected' : '' }}>7 Jam sekali</option>
                                                <option value="0 */8 * * *" {{ $reminders->cron_followup == '0 */8 * * *' ? 'selected' : '' }}>8 Jam sekali</option>
                                                <option value="0 */9 * * *" {{ $reminders->cron_followup == '0 */9 * * *' ? 'selected' : '' }}>9 Jam sekali</option>
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
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-clock-o"></i> Notifikasi Jamaah (Berangkat)</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ route('master-reminder.update', $reminders->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" value="{{ $reminders->cron_followup }}" name="cron_followup">
                                    <input type="hidden" value="{{ $reminders->cron_jamaah_berangkat }}" name="cron_jamaah_berangkat">
                                    <input type="hidden" value="{{ $reminders->cron_jamaah_pulang }}" name="cron_jamaah_pulang">
                                    <input type="hidden" value="{{ $reminders->cron_sinkronisasi }}" name="cron_sinkronisasi">
                                    <input type="hidden" value="{{ $reminders->cron_jadwal }}" name="cron_jadwal">
                                    <div class="form-group">
                                        <label for="harga_promo">Atur Penjadwalan</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select name="cron_jamaah_berangkat" id="" class="form-control">
                                                <option value="0 */5 * * *" {{ $reminders->cron_jamaah_berangkat == '0 */5 * * *' ? 'selected' : '' }}>5 Jam sekali</option>
                                                <option value="0 */6 * * *" {{ $reminders->cron_jamaah_berangkat == '0 */6 * * *' ? 'selected' : '' }}>6 Jam sekali</option>
                                                <option value="0 */7 * * *" {{ $reminders->cron_jamaah_berangkat == '0 */7 * * *' ? 'selected' : '' }}>7 Jam sekali</option>
                                                <option value="0 */8 * * *" {{ $reminders->cron_jamaah_berangkat == '0 */8 * * *' ? 'selected' : '' }}>8 Jam sekali</option>
                                                <option value="0 */9 * * *" {{ $reminders->cron_jamaah_berangkat == '0 */9 * * *' ? 'selected' : '' }}>9 Jam sekali</option>
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
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-clock-o"></i> Notifikasi Jamaah (Pulang)</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ route('master-reminder.update', $reminders->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" value="{{ $reminders->cron_followup }}" name="cron_followup">
                                    <input type="hidden" value="{{ $reminders->cron_jamaah_berangkat }}" name="cron_jamaah_berangkat">
                                    <input type="hidden" value="{{ $reminders->cron_jamaah_pulang }}" name="cron_jamaah_pulang">
                                    <input type="hidden" value="{{ $reminders->cron_sinkronisasi }}" name="cron_sinkronisasi">
                                    <input type="hidden" value="{{ $reminders->cron_jadwal }}" name="cron_jadwal">
                                    <div class="form-group">
                                        <label for="harga_promo">Atur Penjadwalan</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select name="cron_jamaah_pulang" id="" class="form-control">
                                                <option value="0 */5 * * *" {{ $reminders->cron_jamaah_pulang == '0 */5 * * *' ? 'selected' : '' }}>5 Jam sekali</option>
                                                <option value="0 */6 * * *" {{ $reminders->cron_jamaah_pulang == '0 */6 * * *' ? 'selected' : '' }}>6 Jam sekali</option>
                                                <option value="0 */7 * * *" {{ $reminders->cron_jamaah_pulang == '0 */7 * * *' ? 'selected' : '' }}>7 Jam sekali</option>
                                                <option value="0 */8 * * *" {{ $reminders->cron_jamaah_pulang == '0 */8 * * *' ? 'selected' : '' }}>8 Jam sekali</option>
                                                <option value="0 */9 * * *" {{ $reminders->cron_jamaah_pulang == '0 /9 * * *' ? 'selected' : '' }}>9 Jam sekali</option>
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
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-clock-o"></i> Notifikasi Sinkronisasi</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ route('master-reminder.update', $reminders->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" value="{{ $reminders->cron_followup }}" name="cron_followup">
                                    <input type="hidden" value="{{ $reminders->cron_jamaah_berangkat }}" name="cron_jamaah_berangkat">
                                    <input type="hidden" value="{{ $reminders->cron_jamaah_pulang }}" name="cron_jamaah_pulang">
                                    <input type="hidden" value="{{ $reminders->cron_sinkronisasi }}" name="cron_sinkronisasi">
                                    <input type="hidden" value="{{ $reminders->cron_jadwal }}" name="cron_jadwal">
                                    <div class="form-group">
                                        <label for="harga_promo">Atur Penjadwalan</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select name="cron_sinkronisasi" id="" class="form-control">
                                                <option value="0 */5 * * *" {{ $reminders->cron_sinkronisasi == '0 */5 * * *' ? 'selected' : '' }}>5 Jam sekali</option>
                                                <option value="0 */6 * * *" {{ $reminders->cron_sinkronisasi == '0 */6 * * *' ? 'selected' : '' }}>6 Jam sekali</option>
                                                <option value="0 */7 * * *" {{ $reminders->cron_sinkronisasi == '0 */7 * * *' ? 'selected' : '' }}>7 Jam sekali</option>
                                                <option value="0 */8 * * *" {{ $reminders->cron_sinkronisasi == '0 */8 * * *' ? 'selected' : '' }}>8 Jam sekali</option>
                                                <option value="0 */9 * * *" {{ $reminders->cron_sinkronisasi == '0 */9 * * *' ? 'selected' : '' }}>9 Jam sekali</option>
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
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-clock-o"></i> Sinkronisasi Jadwal</h3></div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ route('master-reminder.update', $reminders->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" value="{{ $reminders->cron_followup }}" name="cron_followup">
                                    <input type="hidden" value="{{ $reminders->cron_jamaah_berangkat }}" name="cron_jamaah_berangkat">
                                    <input type="hidden" value="{{ $reminders->cron_jamaah_pulang }}" name="cron_jamaah_pulang">
                                    <input type="hidden" value="{{ $reminders->cron_sinkronisasi }}" name="cron_sinkronisasi">
                                    <input type="hidden" value="{{ $reminders->cron_jadwal }}" name="cron_jadwal">
                                    <div class="form-group">
                                        <label for="harga_promo">Atur Penjadwalan Sinkronisasi</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select name="cron_jadwal" id="" class="form-control">
                                              <option value="30 * * * *" {{ $reminders->cron_jadwal == '30 * * * *' ? 'selected' : '' }}>Setengah Jam sekali</option>
                                              <option value="0 */1 * * *" {{ $reminders->cron_jadwal == '0 */1 * * *' ? 'selected' : '' }}>1 Jam sekali</option>
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
