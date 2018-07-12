 <!-- Aside Start-->
      <aside class="left-panel">

          <!-- brand -->
          <div class="logo">
              <a href="index-2.html" class="logo-expanded">
                  <img src="/img/AiwaFontLogo.png" alt="logo" width="170" height="90">
                  <!-- <span class="nav-label text-center">AIWA</span> -->
              </a>
          </div>
          <!-- / brand -->

          <!-- Navbar Start -->
          <nav class="navigation">
              <ul class="list-unstyled">
                  <li class="has-submenu"><a href="index.html"><i class="ion-home"></i> <span class="nav-label">Dashboard</span></a>
                  </li>
                  <li class="has-submenu"><a href="{{route('aiwa.anggota')}}"><i class="fa fa-user"></i> <span class="nav-label">Data Agen</span></a>
                  </li>
                  <li class="{{ Route::currentRouteNamed('aiwa.jamaah') ? 'active' : '' }}
 has-submenu"><a href="{{route('aiwa.jamaah')}}"><i class="fa fa-group"></i> <span class="nav-label">Data Jamaah</span></a>
                  </li>
                  <li class="has-submenu"><a href="{{route('aiwa.prospek')}}"><i class="fa fa-group"></i> <span class="nav-label">Data Prospek</span></a>
                  </li>
                  <li class="has-submenu"><a href="#"><i class="ion-ios7-keypad"></i> <span class="nav-label">Data Master</span></a>
                      <ul class="list-unstyled">
                          <li class="{{ Route::currentRouteNamed('aiwa.jadwal') ? 'active' : '' }}
"><a href="{{route('aiwa.master-jadwal')}}"><i class="fa fa-calendar"></i> Jadwal</a></li>
                          <li clas><a href="komisi.html"><i class="fa fa-money"></i> Komisi</a></li>
                          <li clas><a href="itenary.html"><i class="fa fa-book"></i>Itenary</a></li>
                          <li clas><a href="brosur.html"><i class="ion-map"></i> Brosur</a></li>
                          <li clas><a href="kalkulasi.html"><i class="ion-calculator"></i>Kalkulasi</a></li>
                          <li clas><a href="broadcast.html"><i class="ion-speakerphone"></i> Broadcast</a></li>
                          <li clas><a href="master-gallery.html"><i class="fa fa-file-image-o"></i>Gallery</a></li>
                          <li class="{{ Route::currentRouteNamed('aiwa.master-hotel') ? 'active' : '' }} {{ Route::currentRouteNamed('aiwa.master-hotel.add') ? 'active' : '' }}"><a href="{{route('aiwa.master-hotel')}}"><i class="fa fa-building-o"></i> Hotel</a></li>
                          <li clas><a href="notifikasi.html"><i class="fa fa-bell-o"></i> Notifikasi</a></li>
                          <!-- <li><a href="notification.html">Notification</a></li>
                          <li><a href="sweet-alert.html">Sweet-Alert</a></li> -->
                      </ul>
                  </li>
                  <li class="has-submenu {{ Route::currentRouteNamed('aiwa.jamaah.add') ? 'active' : '' }}"><a href="#"><i class="fa fa-database"></i> <span class="nav-label">CRUD</span></a>
                    <ul class="list-unstyled">
                        <li class="{{ Route::currentRouteNamed('aiwa.jamaah.add') ? 'active' : '' }}"><a href="input-jamaah.html"><i class="fa fa-plus"></i> Input Jamaah</a></li>
                        <li class=""><a href="input-itenary.html"><i class="fa fa-plus"></i> Itenary</a></li>
                        <!-- <li><a href="komisi.html"><i class="fa fa-money"></i> Komisi</a></li>
                        <li><a href="itenary.html"><i class="fa fa-book"></i>Itenary</a></li> -->
                        <!-- <li><a href="notification.html">Notification</a></li>
                        <li><a href="sweet-alert.html">Sweet-Alert</a></li>
                    </ul> -->
                    </ul>
                </li>
              <li class="has-submenu"><a href="#"><i class="ion-ios7-person"></i> <span class="nav-label">Admin Authorize</span></a>
                <ul class="list-unstyled">
                    <li class="{{ Route::currentRouteNamed('aiwa.log-activity') ? 'active' : '' }}"><a href="{{route('aiwa.log-activity')}}"><i class="fa fa-clock-o"></i> Log Activity</a></li>
                    <li><a href="user-level.html"><i class="fa fa-user-plus"></i> User Level</a></li>
                    <li><a href="notifikasi.html"><i class="fa fa-bell"></i> Notifikasi</a></li>
                </ul>
              </li>
          </nav>

      </aside>
      <!-- Aside Ends-->
