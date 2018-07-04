<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Jadwal</title>
	
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table id="myTable" class="table table-hover table-stripped display"  style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>ID</th>
							<th>Tgl BErangkat</th>
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
							<th>Paket</th>
							<th>Itinerary</th>
						</tr>
					</thead>
					<tbody>
						<?php for ($i=0; $i < $count; $i++) { ?>
						@foreach($jadwals['data'][$i]['jadwal'] as $in)
						<tr>
							<td>{{ $i+1 }}</td>
							<td>{{ $in['id'] }}</td>
							<td>{{ $in['tgl_berangkat'] }}</td>
							<td>{{ $in['jam_berangkat'] }}</td>
							<td>{{ $in['rute_berangkat'] }}</td>
							<td>{{ $in['pesawat_berangkat'] }}</td>
							<td>{{ $in['tgl_pulang'] }}</td>
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
								<button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#paket{{ $i+1 }}" title="{{ $i+1 }}">Lihat Paket</button>
							</td>
							<td><a href="{{ $in['itinerary'] }}" class="btn btn-success btn-sm" title="{{ $in['itinerary'] }}" download>Download</a></td>
						</tr>
						@endforeach
					<?php } ?>
					</tbody>
				</table>
				<!-- <table class="table table-hove">
					<thead>
						<tr>
							<th>Nama Paket</th>
							<th>Kamar</th>
							<th>Harga</th>
							<th>Hotel Madinah</th>
							<th>Bintang Madinah</th>
							<th>Hotel Mekah</th>
							<th>Bintang Mekah</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table> -->
			</div>
		</div>
	</div>

<!-- Modal -->
<?php for ($u=0; $u < $count ; $u++) { ?>
@foreach($jadwals['data'][$u]['jadwal'] as $on)
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
      		@foreach($on['paket'] as $oi)
		<strong>Nama Paket : </strong>{{ $oi['nama_paket'] }} <br>
		<strong>Kamar :</strong>{{ $oi['kamar'] }} <br>
		<strong>Hara :</strong>{{ $oi['harga'] }} <br>
		<strong>Hotel Madinah :</strong>{{ $oi['hotel_madinah'] }} <br>
		<strong>Bintang Madinah :</strong>{{ $oi['bintang_madinah'] }} <br>
		<strong>Hotel Mekkah :</strong>{{ $oi['hotel_mekkah'] }} <br>
		<strong>Bintang Mekkah :</strong>{{ $oi['bintang_mekkah'] }} <br>
		<hr>
			@endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<?php } ?>
<!-- SCRIPT -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable( {
        "scrollY": 300,
        "scrollX": true
    } );
} );
</script>
</body>
</html>
