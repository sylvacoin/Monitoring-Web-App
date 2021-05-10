<!--begin::Top-->
<div class="header-top">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Left-->
        <div class="d-none d-lg-flex align-items-center mr-3">
            <!--begin::Logo-->
            <a href="index-2.html" class="mr-20">
                <img alt="Logo" src="/dist/assets/media/logos/logo-letter-9.png" class="max-h-35px" />
            </a>
            <!--end::Logo-->
            <!--begin::Tab Navs(for desktop mode)-->
            <ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
                <!--begin::Item-->
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link py-4 px-6  {{ (request()->is('account')) ? 'active' : (request()->is('dashboard') ? 'active' : '') }}" role="tab">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-3">
                    <a href="{{route('packages.index')}}" class="nav-link py-4 px-6  {{ (request()->is('packages')) ? 'active' : (request()->is('packages/*') ? 'active' : '') }}" role="tab">Packages</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-3">
                    <a href="{{route('subscriptions')}}" class="nav-link py-4 px-6 {{ (request()->is('subs')) ? 'active' : (request()->is('subs/*') ? 'active' : '') }}" role="tab">Subscriptions</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-3">
                    <a href="{{route('help-center')}}" class="nav-link py-4 px-6 {{ (request()->is('pages')) ? 'active' : (request()->is('pages/*') ? 'active' : '') }}" role="tab">Help Center</a>
                </li>
                <!--end::Item-->
            </ul>
            <!--begin::Tab Navs-->
        </div>
        <!--end::Left-->
        <!--begin::Topbar-->
        <div class="topbar bg-primary">
            <!--begin::User-->
            <div class="topbar-item">
                <div class="btn btn-icon btn-hover-transparent-white w-sm-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <div class="d-flex flex-column text-right pr-sm-3">
                        <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline">{{ session('user.name') }}</span>
                        <span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline">{{session('user.role')}}</span>
                    </div>
                    <span class="symbol symbol-35">
                        <span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30">{{substr(session('user.name'),0,1)}}</span>
                    </span>
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
<!--end::Top-->
