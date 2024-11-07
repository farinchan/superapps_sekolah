<!--begin::Menu wrapper-->
<div id="kt_app_header_menu_wrapper" class="d-flex align-items-center w-100">
    <!--begin::Header menu-->
    <div class="app-header-menu app-header-mobile-drawer align-items-start align-items-lg-center w-100"
        data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
        data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
        data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
        data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
        data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_menu_wrapper'}">
        <!--begin::Menu-->
        <div class="
                menu
                menu-rounded
                menu-column
                menu-lg-row
                menu-active-bg
                menu-state-primary
                menu-title-gray-700
                menu-arrow-gray-500
                menu-bullet-gray-500
                my-5
                my-lg-0
                align-items-stretch
                fw-semibold
                px-2
                px-lg-0
            "
            id="#kt_header_menu" data-kt-menu="true">
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
                data-kt-menu-offset="-100,0"
                class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2"><!--begin:Menu link--><span
                    class="menu-link"><span class="menu-title">Ujian</span><span
                        class="menu-arrow d-lg-none"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
                    {{-- @include('exam/layout/partials/header/_menu/__dashboards') --}}
                </div><!--end:Menu sub-->
            </div>
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Header menu-->
</div>
<!--end::Menu wrapper-->
