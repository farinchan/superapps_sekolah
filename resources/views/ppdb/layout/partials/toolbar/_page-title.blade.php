<!--begin::Page title-->
@isset($page_title)
    <div class="page-title me-5">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
            {{ $page_title }}
            <!--begin::Description-->
            @isset($page_description)
                <span class="page-desc text-gray-600 fw-semibold fs-6 pt-3">
                    {{ $page_description }}
                </span>
            @endisset
            <!--end::Description-->
        </h1>
        <!--end::Title-->
    </div>
    <!--end::Page title-->

@endisset
