<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
@include('layout/partials/_header')
        <!--begin::Wrapper-->
        <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
@include('layout/partials/_sidebar')
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
@include('layout/partials/_toolbar')
@include('layout/partials/_content')
                                    </div>
                <!--end::Content wrapper-->
@include('layout/partials/_footer')
                            </div>
            <!--end:::Main-->
                    </div>
        <!--end::Wrapper-->
            </div>
    <!--end::Page-->
</div>
<!--end::App-->
@include('partials/_drawers')