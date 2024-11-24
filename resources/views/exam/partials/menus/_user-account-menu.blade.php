<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
    data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img alt="Logo" src="{{ Auth::user()->student->getPhoto() }}" />
            </div>
            <!--end::Avatar-->
            <!--begin::Username-->
            <div class="d-flex flex-column">
                <div class="fw-bold d-flex align-items-center fs-5">
                    {{ Auth::user()->student->name }} <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"></span>
                </div>
                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                    NISN. {{ Auth::user()->student->nisn }}
                     </a>
            </div>
            <!--end::Username-->
        </div>
    </div>

    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
        <a href="#" class="menu-link px-5">
            <span class="menu-title position-relative">
                Mode
                <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                    <i class="ki-outline ki-night-day theme-light-show fs-2"></i> <i
                        class="ki-outline ki-moon theme-dark-show fs-2"></i> </span>
            </span>
        </a>
        @include('exam/partials/theme-mode/__menu')
    </div>


    <livewire:exam.logout />
    <!--end::Menu item-->
</div>
<!--end::User account menu-->
