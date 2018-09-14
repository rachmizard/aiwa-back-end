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
                                                <option value="1436">1436</option>
                                                <option value="1437">1437</option>
                                                <option value="1438">1438</option>
                                                <option value="1439">1439</option>
                                                <option value="1440">1440</option>
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
                                <table id="jadwal" class="table table-hover table-bordered">
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
                                        <?php for ($i=0; $i < $count; $i++) { ?>
                                        @if($jadwals)
                                            @foreach($jadwals['data'][$i]['jadwal'] as $key => $in or 'Terjadi kesalanan')
                                            <tr>
                                                <td>{{ $in['id'] }}</td>
                                                <td>{{ date('d/m/Y', strtotime($in['tgl_berangkat'])) }}
                                                    @if($in['promo'] == '1')
                                                    <span class="badge badge-sm bg-success">
                                                        @if($in['promo'] == '1')
                                                            P
                                                        @endif
                                                    </span>
                                                    @endif
                                                </td>
                                                <td>{{ $in['jam_berangkat'] }}</td>
                                                <td>{{ $in['rute_berangkat'] }}</td>
                                                <td>{{ $in['pesawat_berangkat'] }}</td>
                                                <td>{{ date('d-M-Y', strtotime($in['tgl_pulang'])) }}</td>
                                                <td>{{ $in['jam_pulang'] }}</td>
                                                <td>{{ $in['rute_pulang'] }}</td>
                                                <td>{{ $in['pesawat_pulang'] }}</td>
                                                <td>{{ $in['maskapai'] }}</td>
                                                <td>{{ $in['jml_hari'] }}</td>
                                                <td>{{ $in['seat_total'] }}</td>
                                                <td>{{ $in['seat_terpakai'] }}</td>
                                                <td>{{ $in['sisa'] }}</td>
                                                <td>{{ $in['status'] }}</td>
                                                <td>{{ $in['tgl_manasik'] }}</td>
                                                <td>{{ $in['jam_manasik'] }}</td>
                                                <td>
                                                    @if($in['itinerary'])
                                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#paket{{ $i+1 }}" title="{{ $i+1 }}">Lihat Paket</button>
                                                    @endif
                                                    <a href="{{ $in['itinerary'] }}" class="btn btn-success btn-sm" title="{{ $in['itinerary'] }}" download>Download Itinerary</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @elseif($nofound != null)
                                        <tr>
                                            <td colspan="10" class="text-center">$nofound.</td>
                                        </tr>
                                        @endif
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>
           
<!-- Modal -->
<?php for ($u=0; $u < $count ; $u++) { ?>
@foreach($jadwals['data'][$u]['jadwal'] as $on or 'Terjadi kesalanan')
<div class="modal fade" id="paket{{ $u+1 }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
            <table id="paket{{ $u+1 }}" class="table table-bordered table-striped table-hover nowrap" style="width: 100%;">
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
<?php } ?>

@push('dataTables')

<script>
$(document).ready(function() {
    $('#jadwal').DataTable( {
        "scrollX": true,
        "order": [ [1, 'desc'] ],

    } );

<?php for ($u=0; $u < $count ; $u++) { ?>
@foreach($jadwals['data'][$u]['jadwal'] as $on or 'Terjadi kesalanan')
    $('#paket{{ $on["id"] }}').DataTable( {
        // "scrollY": 300,
        "scrollX": true
    } );
@endforeach
<?php } ?>
} );
</script>
@endpush

@endsection
