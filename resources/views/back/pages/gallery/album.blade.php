@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-ecommerce-category-filter="search"
                                class="form-control form-control-solid w-250px ps-12" placeholder="Cari album" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_category" class="btn btn-primary">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah album
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_category_table .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="min-w-250px">album</th>
                                <th class="min-w-150px">Dibuat Oleh</th>
                                <th class="min-w-150px">Dibuat Tanggal</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($list_gallery_album as $album)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="symbol symbol-50px">
                                                <span class="symbol-label"
                                                    style="background-image:url({{ $album->getThumbnail() }});"></span>
                                            </a>
                                            <div class="ms-5">
                                                <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1"
                                                    data-kt-ecommerce-category-filter="category_name">{{ $album->title }}</a>
                                                <div class="text-muted fs-7 fw-bold">
                                                    {{ Str::limit(strip_tags($album->description), 100) }}  </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">{{ $album->user?->teacher?->name }}</div>
                                    </td>
                                    <td>
                                        <div class="">{{ $album->created_at->format('d M Y') }}</div>
                                    </td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#edit_category{{ $album->id }}">
                                                    Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#delete_category{{ $album->id }}">
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="add_category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah album</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.gallery.album.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class=" form-label required">Thumbnail</label>
                            <div class="card card-custom card-stretch" style="cursor: pointer;" onclick="$('#thumbnail').click()"
                            >
                                <div class="card-body">
                                    <img src="https://muhammadiyahbukittinggi.org/back/media/svg/files/blank-image.svg" id="thumbnail_preview"
                                        class="rounded" alt="" style="height: 200px; width: auto; margin: auto; display: block;"
                                        />
                                </div>
                            </div>
                            <input type="file" style="display: none" id="thumbnail" name="thumbnail" accept="image/*"
                                required>
                                <small class="text-muted">Klik gambar untuk mengganti thumbnail, maksimal 4MB</small>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label required">Nama album</label>
                            <input type="text" class="form-control form-control-solid" id="title" name="title"
                                placeholder="album Baru" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label required">Deskripsi</label>
                            <textarea class="form-control form-control-solid" id="description" name="description" rows="3"
                                placeholder="Deskripsi album"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat album</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($list_gallery_album as $album)
        <div class="modal fade" tabindex="-1" id="edit_category{{ $album->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit album</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.gallery.album.update', $album->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class=" form-label required">Thumbnail</label>
                                <div class="card card-custom card-stretch" style="cursor: pointer;" onclick="$('#edit_thumbnail').click()">
                                    <div class="card-body">
                                        <img src="{{ $album->getThumbnail() }}" id="edit_thumbnail_preview"
                                            class="rounded" alt="" style="height: 200px; width: auto; margin: auto; display: block;"
                                            />
                                    </div>
                                </div>
                                <input type="file" style="display: none" id="edit_thumbnail" name="thumbnail" accept="image/*"
                                    >
                                    <small class="text-muted">Klik gambar untuk mengganti thumbnail, maksimal 4MB</small>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label required">Nama album</label>
                                <input type="text" class="form-control form-control-solid" id="title"
                                    name="title" placeholder="album Baru" value="{{ $album->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control form-control-solid" id="description" name="description" rows="3"
                                    placeholder="Deskripsi album">{{ $album->description }}</textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update album</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="delete_category{{ $album->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Hapus album</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.gallery.album.destroy', $album->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus album <strong>{{ $album->title }}</strong>?</p>
                                <p>Semua foto dalam album ini akan ikut terhapus.</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Hapus album</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('scripts')
    <script src="{{ asset('back/js/custom/apps/ecommerce/catalog/categories.js') }}"></script>
    <script>
        $('#thumbnail').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#thumbnail_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
        $('#edit_thumbnail').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#edit_thumbnail_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
