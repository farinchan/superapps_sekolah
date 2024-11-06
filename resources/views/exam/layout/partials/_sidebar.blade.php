<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar  flex-column "
     data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="275px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_toggle"
     >
            <!--begin::Sidebar nav-->
<div class="app-sidebar-wrapper py-8 py-lg-10" id="kt_app_sidebar_wrapper">
    <!--begin::Nav wrapper-->
    <div
        id="kt_app_sidebar_nav_wrapper"
        class="d-flex flex-column px-8 px-lg-10 hover-scroll-y"
        data-kt-scroll="true"
        data-kt-scroll-activate="true"
        data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="{default: false, lg: '#kt_app_header'}"
        data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_wrapper"
        data-kt-scroll-offset="{default: '10px', lg: '40px'}"
    >
@include('exam/layout/partials/sidebar/_goal')
@include('exam/layout/partials/sidebar/_stats')
@include('exam/layout/partials/sidebar/_links')
    </div>
    <!--end::Nav wrapper-->
</div>
<!--end::Sidebar nav-->    </div>
<!--end::Sidebar-->
