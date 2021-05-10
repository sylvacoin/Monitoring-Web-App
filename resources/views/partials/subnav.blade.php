<!--begin::Bottom-->
<div class="header-bottom">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Header Menu Wrapper-->
        <div class="header-navs header-navs-left" id="kt_header_navs">
            <!--begin::Tab Navs(for tablet and mobile modes)-->
            <ul class="header-tabs p-5 p-lg-0 d-flex d-lg-none nav nav-bold nav-tabs" role="tablist">
                <!--begin::Item-->
                 @auth
                <li class="nav-item mr-2">
                    <a href="#" class="nav-link btn btn-clean  {{ (request()->is('account')) ? 'active' : (request()->is('dashboard') ? 'active' : '') }}" >Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-2">
                    <a href="{{ route('packages.index') }}" class="nav-link btn btn-clean {{ (request()->is('packages')) ? 'active' : (request()->is('packages/*') ? 'active' : '') }}" role="tab">Jobs</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-2">
                    <a href="{{ route('subscriptions') }}" class="nav-link btn btn-clean {{ (request()->is('subs')) ? 'active' : (request()->is('subs/*') ? 'active' : '') }}" role="tab">Subscriptions</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-2">
                    <a href="{{ route('help-center') }}" class="nav-link btn btn-clean {{ (request()->is('pages')) ? 'active' : (request()->is('pages/*') ? 'active' : '') }}" role="tab">Help Center</a>
                </li>
                @else
                <li class="nav-item mr-2">
                    <a href="{{ route('login') }}" class="nav-link btn btn-clean" role="tab">Log in</a>
                </li>
                <li class="nav-item mr-2">
                    <a href="{{ route('register') }}" class="nav-link btn btn-clean" role="tab">Register</a>
                </li>
                @endauth
                <!--end::Item-->
            </ul>
            <!--begin::Tab Navs-->
            <!--Dashboard::Tab Content-->
            <div class="tab-content">
                <!--begin::Tab Pane-->
                <div class="tab-pane py-5 p-lg-0 show {{ (request()->is('dashboard')) ? 'active' : '' }} justify-content-between" id="kt_header_tab_1">
                    <!--begin::Menu-->
                    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
                    </div>
                    <div class="d-flex align-items-center">
                        <!--begin::Actions-->
                        <a href="javascript:void()" class="btn btn-danger font-weight-bold my-2 my-lg-0" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log out</a>
                        <!--end::Actions-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--begin::Tab Pane-->
                <!--begin::Tab Pane-->
                <div class="tab-pane py-5 p-lg-0 show {{ (request()->is('packages')) ? 'active' : ((request()->is('packages/*'))? 'active' : '') }} justify-content-between" id="kt_header_tab_1">
                    <!--begin::Menu-->
                    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
                        <!--begin::Nav-->

                        <!--end::Nav-->
                        <!--begin::Actions-->
                        <ul class="menu-nav">

                            <li class="menu-item {{ (request()->is('packages')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{route('packages.index')}}" class="menu-link">
                                    <span class="menu-text">Packages</span>
                                </a>
                            </li>
                             <li class="menu-item {{ (request()->is('packages/applications')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{route('packages.applications')}}" class="menu-link">
                                    <span class="menu-text">My Applications</span>
                                </a>
                            </li>
                            @if(session('user.role') == 'administrator')
                                <li class="menu-item {{ (request()->is('packages/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                    <a href="{{route('packages.create')}}" class="menu-link">
                                        <span class="menu-text">Manage Packages</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ (request()->is('packages/review')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                    <a href="{{route('packages.review')}}" class="menu-link">
                                        <span class="menu-text">Review Applications</span>
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <!--end::Actions-->
                    </div>
                    <div class="d-flex align-items-center">
                        <!--begin::Actions-->
                        <a href="javascript:void()" class="btn btn-danger font-weight-bold my-2 my-lg-0" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log out</a>
                        <!--end::Actions-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--begin::Tab Pane-->

                <!--begin::Tab Pane-->
                <div class="tab-pane py-5 p-lg-0 show {{ (request()->is('subs')) ? 'active' : (request()->is('subs/*') ? 'active' : '') }} justify-content-between" id="kt_header_tab_1">
                    <!--begin::Menu-->
                    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
                        <!--begin::Nav-->

                        <!--end::Nav-->
                        <!--begin::Actions-->
                        <ul class="menu-nav">

                            <li class="menu-item {{ (request()->is('subs')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{route('subscriptions')}}" class="menu-link">
                                    <span class="menu-text">Subscriptions</span>
                                </a>
                            </li>
                            @if(session('user.role') == 'administrator')
                                <li class="menu-item {{ (request()->is('subs/manage')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                    <a href="{{route('subs.manage')}}" class="menu-link">
                                        <span class="menu-text">Manage Subscriptions</span>
                                    </a>
                                </li>
                            @endif
                             <li class="menu-item {{ (request()->is('subs/payments')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{route('subs.payments')}}" class="menu-link">
                                    <span class="menu-text">Payment History</span>
                                </a>
                            </li>
                        </ul>

                        <!--end::Actions-->
                    </div>
                    <div class="d-flex align-items-center">
                        <!--begin::Actions-->
                        <a href="javascript:void()" class="btn btn-danger font-weight-bold my-2 my-lg-0" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log out</a>
                        <!--end::Actions-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--begin::Tab Pane-->

                <!--begin::Tab Pane-->
                <div class="tab-pane p-5 p-lg-0 justify-content-between {{ (request()->is('page')) ? 'active' : (request()->is('page/*') ? 'active' : '') }}" id="kt_header_tab_2">
                    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
                        <!--begin::Nav-->

                        <!--end::Nav-->
                        <!--begin::Actions-->
                        <ul class="menu-nav">

                            <li class="menu-item {{ (request()->is('page/change-password')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{route('pages.change-password')}}" class="menu-link">
                                    <span class="menu-text">Change Password</span>
                                </a>
                            </li>
                            <li class="menu-item {{ (request()->is('page/help-center')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{route('help-center')}}" class="menu-link">
                                    <span class="menu-text">Help</span>
                                </a>
                            </li>
                        </ul>

                        <!--end::Actions-->
                    </div>
                    <div class="d-flex align-items-center">
                        <!--begin::Actions-->
                        <a href="javascript:void()" class="btn btn-danger font-weight-bold my-2 my-lg-0" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log out</a>
                        <!--end::Actions-->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </div>
                </div>
                <!--begin::Tab Pane-->
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end::Header Menu Wrapper-->
    </div>
    <!--end::Container-->
</div>
<!--end::Bottom-->
