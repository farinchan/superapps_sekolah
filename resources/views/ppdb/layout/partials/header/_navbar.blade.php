<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Notifications-->
    {{-- <div class="app-navbar-item ms-1 ms-lg-5">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom">
            <i class="ki-outline ki-calendar fs-1"></i>
        </div>
        @include('ppdb/partials/menus/_notifications-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Notifications-->
    <!--begin::Quick links-->
    <div class="app-navbar-item ms-1 ms-lg-5">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom">
            <i class="ki-outline ki-abstract-26 fs-1"></i>
        </div>
        @include('ppdb/partials/menus/_quick-links-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Quick links-->
    <!--begin::Chat-->
    <div class="app-navbar-item ms-1 ms-lg-5">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-active-color-primary w-35px h-35px w-md-40px h-md-40px position-relative"
            id="kt_drawer_chat_toggle">
            <i class="ki-outline ki-notification-on fs-1"></i>
        </div>
        <!--end::Menu wrapper-->
    </div> --}}
    <!--end::Chat-->
    <!--begin::User menu-->
    @auth('ppdb')
        <div class="app-navbar-item ms-5" id="kt_header_user_menu_toggle">
            <!--begin::Menu wrapper-->
            <div class="cursor-pointer symbol symbol-35px symbol-md-40px"
                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                data-kt-menu-placement="bottom-end">
                <img class="symbol symbol-circle symbol-35px symbol-md-40px" src="{{ asset('img_ext/anonim_person.png') }}"
                    alt="user" />
            </div>
            @include('ppdb/partials/menus/_user-account-menu')
            <!--end::Menu wrapper-->
        </div>
    @endauth
    @guest('ppdb')
        <div class="app-navbar-item ps-lg-2">
            <a href="{{ route('ppdb.login') }}"
                class="btn btn-flex btn-icon align-self-center fw-bold btn-primary w-35px w-md-100 h-35px h-md-40px px-4">
                <i class="ki-duotone ki-user fs-4 text-white">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <span class="d-none d-md-inline ms-2">Login</span>
            </a>
        </div>
    @endguest
</div>
<!--end::Navbar-->
