<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar  flex-column " data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="275px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_toggle">
    <div class="app-sidebar-wrapper py-8 py-lg-10" id="kt_app_sidebar_wrapper">
        <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column px-8 px-lg-10 hover-scroll-y"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
            data-kt-scroll-dependencies="{default: false, lg: '#kt_app_header'}"
            data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_wrapper"
            data-kt-scroll-offset="{default: '10px', lg: '40px'}">
            @include('exam/layout/partials/sidebar/_goal')
            <div class="mb-0">
                <h3 class="text-gray-800 fw-bold mb-8">Soal</h3>
                <div class="row g-5 justify-content-center" >
                    <div class="col-4">
                        <a href="#"
                            class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-65px h-65px border-gray-200"
                            data-kt-button="true">
                            <span class="mb-2" style="font-size: 1.8rem;">1 </span>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="#"
                            class="btn btn-icon btn-outline btn-light-success btn-active-light-primary btn-flex flex-column flex-center w-65px h-65px border-gray-200"
                            data-kt-button="true">
                            <span class="mb-2" style="font-size: 1.8rem;">2 </span>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
