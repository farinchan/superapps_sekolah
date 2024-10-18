<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                {{ $title ?? '' }}
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                @if (isset($menu))
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">
                            {{ $menu ?? '' }}
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                @endif
                @if (isset($sub_menu))
                    <li class="breadcrumb-item text-muted">
                        {{ $sub_menu }}
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                @endif
                @if (isset($title))
                    <li class="breadcrumb-item">
                        {{ $title }}
                    </li>
                @endif
            </ul>

        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            @yield('toolbar')

        </div>
    </div>
</div>
