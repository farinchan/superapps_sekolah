<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Notifications-->
    {{-- <div class="app-navbar-item ms-1 ms-lg-5">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-active-color-primary btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom">
            <i class="ki-outline ki-calendar fs-1"></i>
        </div>
        @include('exam/partials/menus/_notifications-menu')

    </div> --}}
    <!--end::Notifications-->
    <!--begin::Quick links-->
    {{-- <div class="app-navbar-item ms-1 ms-lg-5">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-active-color-primary btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom">
            <i class="ki-outline ki-abstract-26 fs-1"></i>
        </div>
        @include('exam/partials/menus/_quick-links-menu')
    </div> --}}
    <!--end::Quick links-->
    <!--begin::Chat-->
    {{-- <div class="app-navbar-item ms-1 ms-lg-5">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-active-color-primary btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px position-relative"
            id="kt_drawer_chat_toggle">
            <i class="ki-outline ki-notification-on fs-1"></i>
        </div>
    </div> --}}
    @if (request()->routeIs('exam.show'))
        <div class="app-navbar-item ms-1 ms-lg-5 text-end">
            <div class="d-flex align-items-center flex-column ">
                <div class="d-flex  fw-bolder fs-6 text-gray-800  mt-auto ">
                    <span>Sisa Waktu Pengerjaan</span>
                </div>
                <div class="fw-semibold fs-4 text-danger mt-auto text-end">
                    <span id="timer"> </span>
                </div>
            </div>
        </div>
    @endif

    <!--end::Chat-->
    <!--begin::User menu-->
    <div class="app-navbar-item ms-3 ms-lg-5" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="cursor-pointer symbol symbol-35px symbol-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <img class="symbol symbol-circle symbol-35px symbol-md-40px" src="{{ Auth::user()->student->getPhoto() }}"
                alt="user" />
        </div>
        @include('exam/partials/menus/_user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
    <!--begin::Header menu toggle-->
    <div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
        <div class="btn btn-icon btn-custom btn-active-color-primary btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px"
            id="kt_app_header_menu_toggle">
            <i class="ki-outline ki-text-align-left fs-1"></i>
        </div>
    </div>
    <!--end::Header menu toggle-->
</div>
<!--end::Navbar-->
