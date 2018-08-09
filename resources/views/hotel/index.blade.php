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
                    <h3 class="title"><i class="fa fa-building-o"></i><strong> MASTER HOTEL</strong></h3>
                </div>
                <div class="divider" style="margin-bottom: 10px;">
                    <a href="{{ route('aiwa.master-gallery.index.hotel') }}" class="btn btn-sm btn-primary"><i class="fa fa-file-image-o"></i> Lihat Gallery Hotel</a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <table id="hotel" class="table table-striped table-bordered">
                                  <thead>
                                    <tr>    
                                        <td>No</td>
                                        <td>Nama Hotel</td>
                                        <td>Kota</td>
                                        <td>Link Map</td>
                                        <td>Skor</td>
                                        <td>Aksi</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark">
                                    Ambil Koordinat Maps
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet1"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet1" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="mapCanvas" class="gmaps"></div>
                                </div>
                            </div>
                        </div>
                        
                        <b>Marker status:</b>
                        <div id="markerStatus"><i>Click and drag the marker.</i></div>
                        <b>Current position:</b>
                        <div id="info"></div>
                        <b>Closest matching address:</b>
                        <div id="address"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Input Hotel</h3>
                            </div>
                            <div class="panel-body">
                              <form class="form-horizontal" role="form" method="POST" action="{{ route('aiwa.master-hotel.store') }}">
                                {{ csrf_field() }}
                                  <div class="form-group">
                                      <label class="col-md-2 control-label">Nama Hotel</label>
                                      <div class="col-md-10">
                                          <input type="text" class="form-control" name="nama_hotel" required="">
                                      </div>
                                  </div>
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="kota">Kota</label>
                                        <div class="col-md-10 input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <select id="kota" name="kota" class="select2" data-placeholder="Kota..." style="width: 100%;">
                                              <option value="mekkah">Mekkah</option>
                                              <option value="madinah">Madinah</option>
                                              <option value="palestina">Palestina</option>
                                              <option value="turki">Turki</option>
                                              <option value="dubai">Dubai</option>
                                              <option value="cairo">Cairo</option>
                                            </select>
                                        </div>
                                    </div> <!-- form-group -->
                                  <div class="form-group">
                                      <label class="col-md-2 control-label">Lokasi Map</label>
                                      <div class="col-md-10">
                                          <input type="text" class="form-control" name="link_map" id="coordinate" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Wifi</label>
                                    <div class="checkbox">
                                        <label class="cr-styled">
                                            <input type="checkbox" name="wifi" value="true">
                                            <i class="fa"></i>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Park</label>
                                    <div class="checkbox">
                                        <label class="cr-styled">
                                            <input type="checkbox" name="park" value="true">
                                            <i class="fa"></i>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Kamar Bebas Rokok</label>
                                    <div class="checkbox">
                                        <label class="cr-styled">
                                            <input type="checkbox" name="kamar_rokok" value="true">
                                            <i class="fa"></i>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Kamar AC</label>
                                    <div class="checkbox">
                                        <label class="cr-styled">
                                            <input type="checkbox" name="kamar_ac" value="true">
                                            <i class="fa"></i>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Kamar Keluarga</label>
                                    <div class="checkbox">
                                        <label class="cr-styled">
                                            <input type="checkbox" name="kamar_keluarga" value="true">
                                            <i class="fa"></i>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Makanan Enak</label>
                                    <div class="checkbox">
                                        <label class="cr-styled">
                                            <input type="checkbox" name="makanan_enak" value="true">
                                            <i class="fa"></i>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label">Skor</label>
                                      <div class="col-md-10">
                                        <div class="radio-inline">
                                              <label class="cr-styled" for="example-radio4">
                                                  <input type="radio" id="example-radio4" name="skor" value="1">
                                                  <i class="fa"></i>
                                                  1
                                              </label>
                                          </div>
                                          <div class="radio-inline">
                                              <label class="cr-styled" for="example-radio5">
                                                  <input type="radio" id="example-radio5" name="skor" value="2">
                                                  <i class="fa"></i>
                                                  2
                                              </label>
                                          </div>
                                          <div class="radio-inline">
                                              <label class="cr-styled" for="example-radio6">
                                                  <input type="radio" id="example-radio6" name="skor" value="3">
                                                  <i class="fa"></i>
                                                  3
                                              </label>
                                          </div>
                                          <div class="radio-inline">
                                              <label class="cr-styled" for="example-radio7">
                                                  <input type="radio" id="example-radio7" name="skor" value="4">
                                                  <i class="fa"></i>
                                                  4
                                              </label>
                                          </div>
                                          <div class="radio-inline">
                                              <label class="cr-styled" for="example-radio8">
                                                  <input type="radio" id="example-radio8" name="skor" value="5">
                                                  <i class="fa"></i>
                                                  5
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 control-label" for="info">Deskripsi Hotel/Info Lanjut</label>
                                      <div class="col-md-10">
                                          <textarea name="info" id="info" class="form-control" cols="30" rows="10"></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group m-b-0">
                                        <button id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.." type="submit" class="btn btn-success col-md-12">Simpan</button>
                                  </div>

                              </form>
                            </div>  <!-- End panel-body -->
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

            </div> <!-- END Wraper -->
        </div>
         @push('dataTables')
            <!-- Datatable Serverside -->
            <script>
                $(document).ready(function(){
                    $('#hotel').dataTable({
                        serverSide: true,
                        ordering: true,
                        searching: true,
                        processing: false,
                        "ajax": "{{route('aiwa.master-hotel.load.table')}}", 
                        "columns": [
                            { data: "id", name: "id" },
                            { data: "nama_hotel", name: "nama_hotel" },
                            { data: "kota", name: "kota" },
                            { data: "link_map", name: "link_map" },
                            { data: "skor", name: "skor" },
                            { data: "action", name: "action", orderable:false, searchable: false}
                        ]
                    });
                });
            </script>
            <!-- End Datatable Serverside -->
            @endpush
        @push('otherJavascript')
        <script>
          jQuery(".select2").select2({
              width: '100%'
          });
        </script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=&sensor=false&language=id&region=EG"></script>
        <script type="text/javascript">
var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng(),
    'or click button on beside here <a class="btn btn-sm btn-info" href="https://www.google.com/maps/?q='+ latLng.lat() +","+ latLng.lng() +'" target="_blank">Lihat di google maps</a>'
  ].join(',');
  document.getElementById('coordinate').value = [
  latLng.lat(),
  latLng.lng()
  ].join(',');
}

function updateMarkerAddress(strRl) {
  document.getElementById('address').innerHTML = strRl;
}

function initialize() {
  var latLng = new google.maps.LatLng(21.4220326,39.822832,16);
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 16,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });

  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
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
