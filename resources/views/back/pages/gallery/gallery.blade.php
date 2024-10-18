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
                            <input type="text" data-kt-ecommerce-product-filter="search"
                                class="form-control form-control-solid w-250px ps-12" placeholder="Cari galeri" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <div class="w-100 mw-150px">
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Tipe Galeri" data-kt-ecommerce-product-filter="type_galeri">
                                <option></option>
                                <option value="all">Semua</option>
                                <option value="foto">Foto</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        <div class="card-toolbar">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_category" class="btn btn-primary">
                                <i class="ki-duotone ki-plus fs-2"></i>
                                Tambah Foto/Video
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="min-w-200px">Foto/Video</th>
                                <th class="text-end min-w-100px">Tipe</th>
                                <th class="text-end min-w-100px">Album</th>
                                <th class="text-end min-w-100px">Dibuat oleh</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($list_gallery as $gallery)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#preview_galeri{{ $gallery->id }}" class="symbol symbol-150px">
                                                <span class="symbol-label"
                                                    style="background-image:url( @if ($gallery->type == 'foto') {{ $gallery->getFoto() }} @else {{ asset('images/default_youtube.png') }} @endif); background-color: #F5F5F5;
                                                    "></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0">
                                        @if ($gallery->type == 'foto')
                                            <span class="badge badge-light-primary">Foto</span>
                                        @else
                                            <span class="badge badge-light-success">Video</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-0">
                                        <a href="#" class="text-gray-600 text-hover-primary fw-bolder fs-6">
                                            {{ $gallery->album->title }}</a>

                                    </td>
                                    <td class="text-end pe-0">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">
                                                {{ $gallery->user->name }}</a>
                                            <span
                                                class="text-muted fw-bold">{{ $gallery->created_at->diffForHumans() }}</span>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#edit_category{{ $gallery->id }}">
                                                    Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#delete_news{{ $gallery->id }}">Delete</a>
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
                    <h3 class="modal-title">Tambah Foto/Video Galeri</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="description" class="form-label required">Pilih Album</label>
                            <select class="form-select form-select-solid" name="gallery_album_id" required>
                                <option value="">Pilih album</option>
                                @foreach ($list_gallery_album as $album)
                                    <option value="{{ $album->id }}">{{ $album->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class=" form-label required">Foto/Video</label>
                            <select class="form-select form-select-solid" name="type" id="type"required>
                                <option value="">Pilih Tipe</option>
                                <option value="foto">Foto</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        <div id="type_galeri"></div>
                        {{-- <div class="mb-3">
                            <label for="name" class=" form-label required">Foto</label>
                            <input type="file" class="form-control form-control-solid" id="thumbnail" name="thumbnail" required>
                                <small class="text-muted">Foto harus berformat jpg, jpeg, png, atau gif, dengan ukuran maksimal 4MB</small>
                        </div>
                        <div class="mb-3">
                            <label for="video" class="form-label required">Link youtube</label>
                            <textarea class="form-control form-control-solid" id="video" name="video" rows="3"
                                placeholder="Link vide youtube"></textarea>
                        </div> --}}
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($list_gallery as $gallery)
        <div class="modal fade modal-lg " tabindex="-1" id="preview_galeri{{ $gallery->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Preview Galeri</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        @if ($gallery->type == 'foto')
                            <img src="{{ $gallery->getFoto() }}" class="img-fluid" alt="{{ $gallery->title }}">
                        @else

                            <iframe width="100%" height="500" src="{{ $gallery->getvideo() }}" title="{{ $gallery->title }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen>
                            </iframe>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="edit_category{{ $gallery->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Galeri</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="description" class="form-label required">Pilih Album</label>
                                <select class="form-select form-select-solid" name="gallery_album_id" required>
                                    <option value="">Pilih album</option>
                                    @foreach ($list_gallery_album as $album)
                                        <option value="{{ $album->id }}" @if ($album->id == $gallery->gallery_album_id) selected @endif>{{ $album->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                                <input type="hidden" name="type" value="{{ $gallery->type }}">
                            @if ($gallery->type == 'foto')
                                <div class="mb-3">
                                    <label for="name" class=" form-label">Foto</label>
                                    <input type="file" class="form-control form-control-solid" id="foto" name="foto" accept="image/*"
                                     required>
                                    <small class="">
                                        Link Foto : <a href="{{ $gallery->getFoto() }}" target="_blank">{{ $gallery->getFoto() }}</a>
                                    </small>
                                    <br>
                                    <small class="text-muted text-danger">Kosongkan jika tidak ingin mengganti foto</small>
                                    <br>
                                    <small class="text-muted text-danger">Foto harus berformat jpg, jpeg, png, atau gif, dengan ukuran maksimal 4MB</small>
                                </div>
                            @else
                                <div class="mb-3">
                                    <label for="video" class="form-label required">Link youtube</label>
                                    <textarea class="form-control form-control-solid" id="video" name="video" rows="3"
                                        placeholder="https://www.youtube.com/watch?v=XXXXXXXXXXX">{{ $gallery->video }}</textarea>
                                </div>
                            @endif
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Galeri</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="delete_news{{ $gallery->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Hapus Galeri</h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <form action="{{ route('back.gallery.destroy', $gallery->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus galeri Ini?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
    <script src="{{ asset('back/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#type').change(function() {
                var type = $(this).val();
                if (type == 'foto') {
                    $('#type_galeri').html(`
                        <div class="mb-3">
                            <label for="name" class="form-label required">Foto</label>
                            <input type="file" class="form-control form-control-solid" id="foto" name="foto" required>
                            <small class="text-muted text-danger">Foto harus berformat jpg, jpeg, png, atau gif, dengan ukuran maksimal 4MB</small>
                        </div>
                    `);
                } else {
                    $('#type_galeri').html(`
                        <div class="mb-3">
                            <label for="video" class="form-label required">Link youtube</label>
                            <textarea class="form-control form-control-solid" id="video" name="video" rows="3"
                                placeholder="https://www.youtube.com/watch?v=XXXXXXXXXXX"></textarea>
                        </div>
                    `);
                }
            });
        });
    </script>
@endsection
