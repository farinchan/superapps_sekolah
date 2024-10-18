@extends('back.app')
@section('seo')
@endsection
@section('toolbar')
    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#add_banner">
        <i class="ki-duotone ki-plus"></i>
        Buat Banner Baru
    </a>

    <div class="modal fade modal-lg" tabindex="-1" id="add_banner">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Banner</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.setting.banner.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class=" form-label required">Banner</label>
                            <div class="card card-custom card-stretch" style="cursor: pointer;"
                                onclick="$('#banner').click()">
                                <div class="card-body">
                                    <img src="{{ asset('images/default.png') }}" id="banner_preview" class="rounded"
                                        alt="" style="height: 200px; width: auto; margin: auto; display: block;" />
                                </div>
                            </div>
                            <input type="file" style="display: none" id="banner" name="image" accept="image/*"
                                required>
                            <small class="text-muted">Klik gambar untuk mengganti thumbnail, maksimal 4MB</small>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label required">Judul</label>
                            <input type="text" class="form-control form-control-solid" id="title" name="title"
                                placeholder="Judul Banner" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Sub Judul</label>
                            <textarea class="form-control form-control-solid" id="subtitle" name="subtitle" rows="3"
                                placeholder="Sub Judul banner"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label required">Remote URL</label>
                            <input type="url" class="form-control form-control-solid" id="url" name="url"
                                placeholder="https://muhammadiyahbukittinggi.org/XXXXXXX" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            @foreach ($list_banner as $banner)
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Banner {{ $loop->iteration }}</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <form id="kt_account_profile_details_form" class="form" method="POST"
                            enctype="multipart/form-data" action="{{ route('back.setting.banner.update', $banner->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="card-body border-top p-9">
                                <div class="mb-3">
                                    <label for="name" class=" form-label required">Banner</label>
                                    <div class="card card-custom card-stretch" style="cursor: pointer;"
                                        onclick="$('#banner{{ $banner->id }}').click()">
                                        <div class="card-body">
                                            <img src="{{ Storage::url($banner->image) }}"
                                                id="banner_preview{{ $banner->id }}" class="rounded" alt=""
                                                style="height: 200px; margin: auto; display: block; object-fit: cover;" />
                                        </div>
                                    </div>
                                    <input type="file" style="display: none" id="banner{{ $banner->id }}"
                                        name="image" accept="image/*">
                                    <small class="text-muted">Klik gambar untuk mengganti thumbnail, maksimal 4MB</small>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label required">Judul</label>
                                    <input type="text" class="form-control form-control-solid" name="title"
                                        value="{{ $banner->title }}" placeholder="Judul Banner" required>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label">Sub Judul</label>
                                    <input type="text" class="form-control form-control-solid" name="subtitle"
                                        value="{{ $banner->subtitle }}" placeholder="Sub Judul Banner">
                                </div>
                                <div class="mb-6">
                                    <label class="form-label required">Remote URL</label>
                                    <input type="url" class="form-control form-control-solid" name="url"
                                        value="{{ $banner->url }}" placeholder="URL Tujuan" required>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                @if ($list_banner->count() > 1)
                                    <a href="{{ route('back.setting.banner.destroy', $banner->id) }}" class="btn btn-danger btn-active-light-danger me-2">Hapus</a>

                                @endif

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#banner').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#banner_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
    @foreach ($list_banner as $banner)
        <script>
            $('#banner{{ $banner->id }}').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#banner_preview{{ $banner->id }}').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        </script>
    @endforeach
@endsection
