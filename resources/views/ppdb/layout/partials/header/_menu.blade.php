<!--begin::Menu wrapper-->
<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
    data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
    data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
    data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
    <!--begin::Menu-->
    <div class=" menu
            menu-rounded
            menu-active-bg
            menu-state-primary
            menu-column
            menu-lg-row
            menu-title-gray-700
            menu-icon-gray-500
            menu-arrow-gray-500
            menu-bullet-gray-500
            my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0
        "
        id="kt_app_header_menu" data-kt-menu="true">

        <div class="menu-item @if (request()->routeIs('ppdb.home')) here show @endif menu-here-bg menu-lg-down-accordion me-0 me-lg-2 ">
            <span class="menu-link">
                <a href="{{ route('ppdb.home') }}">
                    <span class="menu-title">Beranda</span>
                </a>
            </span>
        </div>

        <div class="menu-item @if (request()->routeIs('ppdb.information')) here show @endif menu-here-bg menu-lg-down-accordion me-0 me-lg-2 ">
            <span class="menu-link">
                <a href="{{ route('ppdb.information') }}">
                    <span class="menu-title">Informasi</span>
                </a>
            </span>
        </div>
        <div class="menu-item @if (request()->routeIs('ppdb.contact')) here show @endif menu-here-bg menu-lg-down-accordion me-0 me-lg-2" >
            <span class="menu-link">
                <a href="{{ route('ppdb.contact') }}">
                    <span class="menu-title">Hubungi Kami</span>
                </a>
            </span>
        </div>


    </div>
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->
