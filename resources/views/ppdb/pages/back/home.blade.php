@extends('ppdb.app-back')

@section('styles')
@endsection

@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Row-->
        <div class="row g-5 g-xl-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                @include('ppdb/partials/widgets-2/misc/_widget-1')
                @include('ppdb/partials/widgets-2/lists/_widget-5')
                <!--begin::List widget 7-->
                <div class="card card-flush mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header py-7">
                        <!--begin::Statistics-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-2">
                                <!--begin::Title-->
                                <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">0.37%</span>
                                <!--end::Title-->
                                <!--begin::Badge-->
                                <span class="badge badge-light-danger fs-base">
                                    <i class="ki-outline ki-arrow-up fs-5 text-danger ms-n1"></i>
                                    8.02%
                                </span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Description-->
                            <span class="fs-6 fw-semibold text-gray-500">Online store convertion rate</span>
                            <!--end::Description-->
                        </div>
                        <!--end::Statistics-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Menu-->
                            <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                data-kt-menu-overflow="true">
                                <i class="ki-outline ki-dots-square fs-1 text-gray-500 me-n1"></i>
                            </button>
                            <!--begin::Menu 2-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator mb-3 opacity-75"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">
                                        New Ticket
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">
                                        New Customer
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                    data-kt-menu-placement="right-start">
                                    <!--begin::Menu item-->
                                    <a href="#" class="menu-link px-3">
                                        <span class="menu-title">New Group</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <!--end::Menu item-->
                                    <!--begin::Menu sub-->
                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">
                                                Admin Group
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">
                                                Staff Group
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">
                                                Member Group
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu sub-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">
                                        New Contact
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator mt-3 opacity-75"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content px-3 py-3">
                                        <a class="btn btn-primary  btn-sm px-4" href="#">
                                            Generate Reports
                                        </a>
                                    </div>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu 2-->
                            <!--end::Menu-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0">
                        <!--begin::Items-->
                        <div class="mb-0">
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center me-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5">
                                        <span class="symbol-label">
                                            <i class="ki-outline ki-magnifier fs-3 text-gray-600"></i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Content-->
                                    <div class="me-5">
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Search
                                            Retargeting</a>
                                        <!--end::Title-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link
                                            clicks</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-6 me-3">0.24%</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center">
                                        <!--begin::label-->
                                        <span class="badge badge-light-success fs-base">
                                            <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>
                                            2.4%
                                        </span>
                                        <!--end::label-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center me-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5">
                                        <span class="symbol-label">
                                            <i class="ki-outline ki-tiktok fs-3 text-gray-600"></i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Content-->
                                    <div class="me-5">
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Social
                                            Retargeting</a>
                                        <!--end::Title-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link
                                            clicks</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-6 me-3">0.94%</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center">
                                        <!--begin::label-->
                                        <span class="badge badge-light-danger fs-base">
                                            <i class="ki-outline ki-arrow-down fs-5 text-danger ms-n1"></i>
                                            9.4%
                                        </span>
                                        <!--end::label-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center me-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5">
                                        <span class="symbol-label">
                                            <i class="ki-outline ki-sms fs-3 text-gray-600"></i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Content-->
                                    <div class="me-5">
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Email
                                            Retargeting</a>
                                        <!--end::Title-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link
                                            clicks</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-6 me-3">1.23%</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center">
                                        <!--begin::label-->
                                        <span class="badge badge-light-success fs-base">
                                            <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>
                                            0.2%
                                        </span>
                                        <!--end::label-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center me-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5">
                                        <span class="symbol-label">
                                            <i class="ki-outline ki-icon fs-3 text-gray-600"></i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Content-->
                                    <div class="me-5">
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Referrals
                                            Customers</a>
                                        <!--end::Title-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link
                                            clicks</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-6 me-3">0.08%</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center">
                                        <!--begin::label-->
                                        <span class="badge badge-light-danger fs-base">
                                            <i class="ki-outline ki-arrow-down fs-5 text-danger ms-n1"></i>
                                            0.4%
                                        </span>
                                        <!--end::label-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center me-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5">
                                        <span class="symbol-label">
                                            <i class="ki-outline ki-abstract-25 fs-3 text-gray-600"></i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Content-->
                                    <div class="me-5">
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Other</a>
                                        <!--end::Title-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link
                                            clicks</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-6 me-3">0.46%</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center">
                                        <!--begin::label-->
                                        <span class="badge badge-light-success fs-base">
                                            <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>
                                            8.3%
                                        </span>
                                        <!--end::label-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List widget 7-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8 ps-xl-12">
                @include('ppdb/partials/widgets-2/engage/_widget-1')
                <!--begin::Row-->
                <div class="row g-5 g-xl-8 mb-5 mb-xl-8">
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        @include('ppdb/partials/widgets/charts/_widget-45')
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        @include('ppdb/partials/widgets/lists/_widget-7')
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                @include('ppdb/partials/widgets-2/tables/_widget-5')
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <!--begin::Mixed Widget 8-->
                        <div class="card h-xl-100 mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Heading-->
                                <div class="d-flex flex-stack">
                                    <!--begin:Info-->
                                    <div class="d-flex align-items-center">
                                        <!--begin:Image-->
                                        <div class="symbol symbol-60px me-5">
                                            <span class="symbol-label bg-danger-light">
                                                <img src="assets/media/svg/brand-logos/plurk.svg"
                                                    class="h-50 align-self-center" alt="" />
                                            </span>
                                        </div>
                                        <!--end:Image-->
                                        <!--begin:Title-->
                                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-5">
                                                Monthly Subscription </a>
                                            <span class="text-muted fw-bold">
                                                Due: 27 Apr 2020 </span>
                                        </div>
                                        <!--end:Title-->
                                    </div>
                                    <!--begin:Info-->
                                    <!--begin:Menu-->
                                    <div class="ms-1">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-outline ki-category fs-6"></i> </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                    Actions</div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    New Ticket
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    New Customer
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                data-kt-menu-placement="right-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">New Group</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">
                                                            Admin Group
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">
                                                            Staff Group
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">
                                                            Member Group
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    New Contact
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary  btn-sm px-4" href="#">
                                                        Generate Reports
                                                    </a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Heading-->
                                <!--begin:Stats-->
                                <div class="d-flex flex-column w-100 mt-12">
                                    <span class="text-gray-900 me-2 fw-bold pb-3">
                                        Progress
                                    </span>
                                    <div class="progress h-5px w-100">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <!--end:Stats-->
                                <!--begin:Team-->
                                <div class="d-flex flex-column mt-10">
                                    <div class="text-gray-900 me-2 fw-bold pb-4">
                                        Team
                                    </div>
                                    <div class="d-flex">
                                        <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                            title="Ana Stone">
                                            <img src="assets/media/avatars/300-6.jpg" alt="" />
                                        </a>
                                        <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                            title="Mark Larson">
                                            <img src="assets/media/avatars/300-5.jpg" alt="" />
                                        </a>
                                        <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                            title="Sam Harris">
                                            <img src="assets/media/avatars/300-9.jpg" alt="" />
                                        </a>
                                        <a href="#" class="symbol symbol-35px" data-bs-toggle="tooltip"
                                            title="Alice Micto">
                                            <img src="assets/media/avatars/300-10.jpg" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <!--end:Team-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Mixed Widget 8-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        @include('ppdb/partials/widgets-2/mixed/_widget-8')
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content-->
@endsection

@section('scripts')
@endsection
