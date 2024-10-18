@extends('back.app')
@section('seo')
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="card card-flush">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_settings_store">
                                <i class="ki-duotone ki-shop fs-2 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>Website</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary d-flex align-items-center pb-5 " data-bs-toggle="tab"
                                href="#kt_ecommerce_settings_general">
                                <i class="ki-duotone ki-home fs-2 me-2"></i>Informasi</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_ecommerce_settings_store" role="tabpanel">
                            <form id="kt_ecommerce_settings_general_store" class="form"
                                action="{{ route('back.setting.website.update') }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row mb-7">
                                    <div class="col-md-9 offset-md-3">
                                        <h2>Website Setting</h2>
                                    </div>
                                </div>
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span class="required">Nama Website</span>

                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control form-control-solid" name="name"
                                            value="{{ $setting->name }}" required />
                                    </div>
                                </div>
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span class="required">Logo</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url('{{ asset('back/media/svg/avatars/blank.svg') }}')">
                                            <div class="image-input-wrapper w-125px h-125px "
                                                style="background-image: url('{{ Storage::url( $setting->logo) }}')">
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Ganti Logo">
                                                <i class="ki-duotone ki-pencil fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="batal">
                                                <i class="ki-duotone ki-cross fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="Hapus Logo">
                                                <i class="ki-duotone ki-cross fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span class="required">Favicon</span>
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                title="Favicon website adalah ikon kecil yang muncul di tab browser Anda.">
                                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url('{{ asset('back/media/svg/avatars/blank.svg') }}')">
                                            <div class="image-input-wrapper w-125px h-125px "
                                                style="background-image: url('{{ Storage::url($setting->favicon) }}')">
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Ganti Favicon">
                                                <i class="ki-duotone ki-pencil fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <input type="file" name="favicon" accept="image/*"
                                                     />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="batal">
                                                <i class="ki-duotone ki-cross fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="hapus favicon">
                                                <i class="ki-duotone ki-cross fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Email --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span class="required">Email</span>

                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control form-control-solid" name="email"
                                            value="{{ $setting->email }}" />
                                    </div>
                                </div>
                                {{-- phone --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span class="required">No Telp</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="tel" class="form-control form-control-solid" name="phone"
                                            value="{{ $setting->phone }}" required />
                                    </div>
                                </div>
                                {{-- alamat --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span class="required">Alamat</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control form-control-solid" name="address" required>{{ $setting->address }}</textarea>
                                    </div>
                                </div>
                                {{-- latitude --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>latitude</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="latitude" class="form-control form-control-solid" name="latitude"
                                            value="{{ $setting->latitude }}" />
                                    </div>
                                </div>
                                {{-- longitude --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Longitude</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control form-control-solid" name="longitude"
                                            value="{{ $setting->longitude }}" />
                                    </div>
                                </div>
                                {{-- about --}}
                                <div class="row fv-row mb-18">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Tentang Website</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <div id="editor_about" class=" min-h-150px mb-5">
                                            {!! $setting->about !!}
                                        </div>
                                        <input type="hidden" id="about_quill" name="about">
                                    </div>
                                </div>

                                {{-- facebook --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Facebook</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url" class="form-control form-control-solid" name="facebook"
                                            value="{{ $setting->facebook }}" />
                                    </div>
                                </div>

                                {{-- instagram --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Instagram</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url" class="form-control form-control-solid" name="instagram"
                                            value="{{ $setting->instagram }}" />
                                    </div>
                                </div>

                                {{-- twitter --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Twitter</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url" class="form-control form-control-solid" name="twitter"
                                            value="{{ $setting->twitter }}" />
                                    </div>
                                </div>

                                {{-- youtube --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Youtube</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url" class="form-control form-control-solid" name="youtube"
                                            value="{{ $setting->youtube }}" />
                                    </div>
                                </div>

                                {{-- whatsapp --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Whatsapp</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="tel" class="form-control form-control-solid" name="whatsapp"
                                            value="{{ $setting->whatsapp }}" />
                                    </div>
                                </div>

                                {{-- telegram --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Telegram</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url" class="form-control form-control-solid" name="telegram"
                                            value="{{ $setting->telegram }}" />
                                    </div>
                                </div>

                                {{-- linkedin --}}
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Linkedin</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url" class="form-control form-control-solid" name="linkedin"
                                            value="{{ $setting->linkedin }}" />
                                    </div>
                                </div>
                                <div class="row py-10">
                                    <div class="col-md-9 offset-md-3">
                                        <div class="d-flex">
                                            <button type="reset" data-kt-ecommerce-settings-type="cancel"
                                                class="btn btn-light me-3">Cancel</button>
                                            <button type="submit" data-kt-ecommerce-settings-type="submit"
                                                class="btn btn-primary">
                                                <span class="indicator-label">Save</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade " id="kt_ecommerce_settings_general" role="tabpanel">
                            <form id="kt_ecommerce_settings_general_form" class="form" action="{{ route("back.setting.website.info") }}" method="POST">
                                @method("PUT")
                                @csrf
                                <div class="row mb-7">
                                    <div class="col-md-9 offset-md-3">
                                        <h2>Setting Informasi</h2>
                                    </div>
                                </div>
                                {{-- syarat & ketentuan --}}
                                <div class="row fv-row mb-18">
                                    <div class="col-md-3 text-md-end">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Syarat & Ketentuan</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <div id="editor_terms_conditions"
                                            class="form-control form-control-solid min-h-150px mb-5">
                                            {!! $setting->terms_conditions !!}
                                        </div>
                                        <input type="hidden" id="terms_conditions" name="terms_conditions">
                                    </div>
                                </div>

                                <div class="row py-10">
                                    <div class="col-md-9 offset-md-3">
                                        <div class="d-flex">
                                            <button type="reset" data-kt-ecommerce-settings-type="cancel"
                                                class="btn btn-light me-3">Cancel</button>
                                            <button type="submit" data-kt-ecommerce-settings-type="submit"
                                                class="btn btn-primary">
                                                <span class="indicator-label">Save</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const quill = new Quill('#editor_about', {
            theme: 'snow'
        });
        var quillEditor = document.getElementById('about_quill');
        quillEditor.value = quill.root.innerHTML;
        quill.on('text-change', function() {
            quillEditor.value = quill.root.innerHTML;
        });

        const quill_terms_conditions = new Quill('#editor_terms_conditions', {
            theme: 'snow'
        });
        var quillEditor_terms_conditions = document.getElementById('terms_conditions');
        quillEditor_terms_conditions.value = quill_terms_conditions.root.innerHTML;
        quill_terms_conditions.on('text-change', function() {
            quillEditor_terms_conditions.value = quill_terms_conditions.root.innerHTML;
        });

    </script>
@endsection
