  <!--begin::Breadcrumb-->
  <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
      <li class="breadcrumb-item text-white fw-bold lh-1">
          <a href="?page=index" class="text-white text-hover-primary">
              <i class="ki-outline ki-home text-gray-700 fs-6"></i>
          </a>
      </li>
      @isset($menu)
          <li class="breadcrumb-item">
              <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
          </li>
          <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
              <a href="" class="text-gray-700 text-hover-primary">
                  {{ $menu }}
              </a>
          </li>
      @endisset
      @isset($submenu)
          <li class="breadcrumb-item">
              <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
          </li>
          <li class="breadcrumb-item text-white fw-bold lh-1">
              {{ $submenu }}
          </li>
      @endisset

  </ul>
