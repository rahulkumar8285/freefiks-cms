@include('layout.header')

<div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <!-- <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a> -->
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="{{ url('/') }}">
                            <!-- <img class="img-fluid" src="https://highgridmedia.com/assets/images/logohgm.png" alt="Theme-Logo" /> -->
                             <img class="img-fluid p-2" style="width:90%"  src="{{ asset('assets/images/logo.png') }}" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <!-- <a href="#!">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-pink"></span>
                                </a> -->
                                <!-- <ul class="show-notification">
                                    <li>
                                        <h6> </h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                    elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                   
                                </ul> -->
                            </li>
                            <li class="user-profile header-notification">
                                <a href="#!">
                                    <span>
                                        {{ ucfirst(session('name')) }}
                                    </span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <!-- <li>
                                        <a href="#!">
                                            <i class="ti-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-email"></i> My Messages
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-lock"></i> Lock Screen
                                        </a>
                                    </li> -->
                                    <li>
                                        <a href="{{url('/logout')}}">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                           
                            <ul class="pcoded-item pcoded-left-item mt-1">

                                <li class="">
                                    <a href="{{ url('/') }}">
                                        <span class="pcoded-micon"><i class=""></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                              
                                @php
                                 $menusList = getMenu();
                                @endphp


                                @foreach($menusList as $menu)
                                    <li class="">
                                        <a href="{{ url('/'.$menu->url) }}">
                                            <span class="pcoded-micon"><i class="{ti-user}"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">{{$menu->name}}</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                @endforeach

                                <!-- <li class="">
                                    <a href="{{ url('/tickets') }}">
                                        <span class="pcoded-micon"><i class="ti-ticket"></i><b>U</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Tickets</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li> --> 

                            </ul>
                          
                        </div>
                    </nav>

                   @yield('content')
                   

                </div>
            </div>

        </div>
    </div>



@include('layout.footer')
