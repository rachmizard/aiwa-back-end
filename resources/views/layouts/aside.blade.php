 <!-- Aside Start-->
      <aside class="left-panel">

          <!-- brand -->
          <div class="logo">
              <a href="index-2.html" class="logo-expanded">
              <a href="#" class="logo-expanded">
                  <img src="/img/kaaba_Ccl_icon.ico" alt="logo" width="20" height="20" id="logo-mini" class="hiden">
                  <img src="/img/AiwaFontLogo.png" alt="logo" width="170" height="90" id="logo-full"> 
              </a>
          </div>
          <!-- / brand -->

          <!-- Navbar Start -->
          <nav class="navigation">
              <ul class="list-unstyled">
                  <li class="{{ Route::currentRouteNamed('admin.dashboard') ? 'active' : '' }} has-submenu"><a href="{{route('admin.dashboard')}}"><i class="ion-home"></i> <span class="nav-label">Dashboard</span></a>
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
                          <li class><a href="#"><i class="fa fa-money"></i> Komisi</a></li>
                          <li class="{{ Route::currentRouteNamed('master-itinerary.index') ? 'active' : '' }}"><a href="{{route('master-itinerary.index')}}"><i class="fa fa-book"></i>Itenary</a></li>
                          <li class><a href="{{ route('aiwa.master-kalkulasi') }}"><i class="ion-calculator"></i>Kalkulasi</a></li>
                          <li class><a href="{{ route('master-broadcast.index') }}"><i class="ion-speakerphone"></i> Broadcast</a></li>
                          <li class="{{ Route::currentRouteNamed('aiwa.master-gallery') ? 'active' : '' }}"><a href="{{ route('aiwa.master-gallery') }}"><i class="fa fa-file-image-o"></i>Gallery</a></li>
                          <li class="{{ Route::currentRouteNamed('aiwa.master-hotel') ? 'active' : '' }} {{ Route::currentRouteNamed('aiwa.master-hotel.add') ? 'active' : '' }}"><a href="{{route('aiwa.master-hotel')}}"><i class="fa fa-building-o"></i> Hotel</a></li>
                          <li class><a href="#"><i class="fa fa-bell-o"></i> Notifikasi</a></li>
                          <li class="{{ Route::currentRouteNamed('faq.index') ? 'active' : '' }}"><a href="{{ route('faq.index') }}"><i class="fa fa-question-circle"></i> F.A.Q</a></li>
                          <!-- <li><a href="notification.html">Notification</a></li>
                          <li><a href="sweet-alert.html">Sweet-Alert</a></li> -->
                      </ul>
                  </li>
              <li class="has-submenu"><a href="#"><i class="ion-ios7-person"></i> <span class="nav-label">Admin Authorize</span></a>
                <ul class="list-unstyled">
                    <li class="{{ Route::currentRouteNamed('aiwa.log-activity') ? 'active' : '' }}"><a href="{{route('aiwa.log-activity')}}"><i class="fa fa-clock-o"></i> Log Activity</a></li>
                    <li class="{{ Route::currentRouteNamed('aiwa.anggota.import') ? 'active' : '' }}"><a href="{{ route('aiwa.anggota.import') }}"><i class="fa fa-user-plus"></i> Import Akun Agen</a></li>
                    <li><a href="{{ route('aiwa.approval') }}"><i class="fa fa-check"></i> Approval Agen</a></li>
                    <li><a href="#"><i class="fa fa-bell"></i> Notifikasi</a></li>
                </ul>
              </li>
          </nav>

      </aside>
      <!-- Aside Ends-->
