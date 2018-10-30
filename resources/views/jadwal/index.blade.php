@extends('layouts.master')
@section('content')
<!-- Page Content Start -->
            <!-- ================== -->
            <!-- <style>
                div.dataTables_wrapper {
                    width: 800px;
                    margin: 0 auto;
                }
            </style> -->
            <div class="wraper container-fluid">
                <div class="page-title">
                    <h3 class="title"><strong><i class="fa fa-calendar"></i> Jadwal</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-filter"></i> Filter Periode
                        </div>
                            <div class="panel-body">
                                <form action="" id="periode" method="GET">
                                    <div class="form-group">
                                        <label for="">Periode yang di pilih </label>
                                        <select name="periode" class="form-control" id="" onchange="document.getElementById('periode').submit();">
                                            <option disabled selected>Pilih Periode</option>
                                                <option value="1439" {{ Request::get('periode') == '1439' ? 'selected' : '' }}
>1439</option>
                                                <option value="1440" {{ Request::get('periode') == '1440' ? 'selected' : '' }}
>1440</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body">
                                <table id="jadwalTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tgl Berangkat</th>
                                            <th>Jam Berangkat</th>
                                            <th>Rute Berangkat</th>
                                            <th>Pesawata Berangkat</th>
                                            <th>Tgl Pulang</th>
                                            <th>Jam Pulang</th>
                                            <th>Rute Pulang</th>
                                            <th>Pesawat Pulang</th>
                                            <th>Maskapai</th>
                                            <th>Jml Hari</th>
                                            <th>Seat Total</th>
                                            <th>Seat Terpakai</th>
                                            <th>Sisa</th>
                                            <th>Status</th>
                                            <th>Tgl Manasik</th>
                                            <th>Jam Manasik</th>
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

<!-- Modal -->
@foreach($jadwals as $on)
<div class="modal fade" id="paket{{ $on['id_jadwal'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Paket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            @if(!$on['paket'] == null)
            <table id="paket{{ $on['id_jadwal'] }}" class="table table-bordered table-striped table-hover nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Kamar</th>
                        <th>Harga</th>
                        <th>Hotel Madinah</th>
                        <th>Bintang Madinah</th>
                        <th>Hotel Mekkah</th>
                        <th>Bintang Mekkah</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                @foreach($on['paket'] as $key => $oi)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $oi['nama_paket'] }}</td>
                        <td>{{ $oi['kamar'] }}</td>
                        <td>{{ $oi['harga'] }}</td>
                        <td>{{ $oi['hotel_madinah'] }}</td>
                        <td>{{ $oi['bintang_madinah'] }}</td>
                        <td>{{ $oi['hotel_mekkah'] }}</td>
                        <td>{{ $oi['bintang_mekkah'] }}</td>
                    </tr>
                <?php $no++; ?>
                @endforeach
                </tbody>
            </table>
            @else
            <strong class="text-center">Packet is not already exist for right now.</strong>
            @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@push('dataTables')

<script>
  $(document).ready(function(){
      $.fn.dataTable.ext.errMode = 'none';
      var table = $('#jadwalTable').DataTable({
      "stateSave": true,
      "scrollX": true,
      "searching": true,
      "processing": true,
      "serverSide": true,
      "ajax": {
          url: "/admin/master-jadwal/jadwalJson"
      },
      "order": [ [1, 'desc'] ],
      "columns": [
          { data: "id_jadwal", name: "id_jadwal" },
          { data: "tgl_berangkat", name: "tgl_berangkat" },
          { data: "jam_berangkat", name: "jam_berangkat" },
          { data: "rute_berangkat", name: "rute_berangkat" },
          { data: "pesawat_berangkat", name: "pesawat_berangkat" },
          { data: "tgl_pulang", name: "tgl_pulang" },
          { data: "jam_pulang", name: "jam_pulang" },
          { data: "rute_pulang", name: "rute_pulang" },
          { data: "pesawat_pulang", name: "pesawat_pulang" },
          { data: "maskapai", name: "maskapai" },
          { data: "jml_hari", name: "jml_hari" },
          { data: "seat_total", name: "seat_total" },
          { data: "sisa", name: "sisa" },,
          { data: "status", name: "status" },
          { data: "tgl_manasik", name: "tgl_manasik" },
          { data: "jam_manasik", name: "jam_manasik" },
          { data: "action", name: "action", orderable: false, searchable: false }
      ]
  }).on('error.dt', function ( e, settings, techNote, message ) {
       console.log( 'An error has been reported by DataTables: ', message );
    });

    @foreach($jadwals as $on)
        $('#paket{{ $on["id"] }}').DataTable( {
            // "scrollY": 300,
            "scrollX": true
        } );
    @endforeach

  });
</script>
@endpush
@endsection
