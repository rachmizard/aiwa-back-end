<!--Main Content Start -->
        <section class="content">

            <!-- Header -->
            <header class="top-head container-fluid">
                <button type="button" class="navbar-toggle pull-left" id="イロドリ-ea">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


                <!-- Right navbar -->
                <ul class="list-inline navbar-right top-menu top-right-menu">
                    <!-- Notification -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge badge-sm up bg-pink count">{{Auth::guard('admin')->user()->unreadNotifications->count()}}</span>
                        </a>
                        <ul class="dropdown-menu extended bounce animated nicescroll" tabindex="5002">
                            <li class="noti-header">
                                <p>Notifications</p>
                            </li>
                            @foreach(Auth::guard('admin')->user()->unreadNotifications as $notification)
                            <li>
                                @if($notification->type != 'App\Notifications\SyncWeeklyNotification')
                                <a {{ Auth::guard('admin')->user()->unreadNotifications->where('type', '=', 'App\Notifications\ApproveAgenNotification') ? 'href=prospek' : 'href=approval' }}
                                    <span class="pull-left"><i class="fa {{ $notification->type == 'App\Notifications\ProspekNewNotification' ? 'fa-user-plus fa-2x text-success' : 'fa-check fa-2x text-info' }}"></i></span>
                                    <span>{{ str_limit($notification->data['nama'], 5) }} {{ $notification->data['data'] }}<br><small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small></span>
                                </a>
                                @else
                                <a {{ Auth::guard('admin')->user()->unreadNotifications->where('type', '=', 'App\Notifications\SyncWeeklyNotification') ? 'href=' : 'href=' }}
                                    <span class="pull-left"><i class="fa {{ $notification->type == 'App\Notifications\SyncWeeklyNotification' ? 'fa-check fa-2x text-success' : 'fa-check fa-2x text-info' }}"></i></span>
                                    <span>{{ $notification->data['data'] }}<br><small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small></span>
                                </a>
                                @endif
                            </li>
                            @endforeach
                            <li>
                                <p><a href="{{ route('read.all.notification') }}" class="text-right">Mark as read</a></p>
                            </li>
                        </ul>
                    </li>
                    <!-- /Notification -->

                    <!-- user login dropdown start-->
                    <li class="dropdown text-center">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar-2.jpg" class="img-circle profile-img thumb-sm">
                            <span class="username">{{Auth::guard('admin')->user()->username}} </span> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu extended pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                            <li><a href="{{route('aiwa.admin.profile')}}"><i class="fa fa-user"></i>Profile</a></li>
                            <li>
                                <a href="#"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> 
                                            Logout
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- End right navbar -->

            </header>
            <!-- Header Ends -->
