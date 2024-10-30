@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row"
                action="{{ route('back.user.staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Foto</h2>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0">
                            <style>
                                .image-input-placeholder {
                                    background-image: url('{{ asset('back/media/svg/files/blank-image.svg') }}');
                                }

                                [data-bs-theme="dark"] .image-input-placeholder {
                                    background-image: url('{{ asset('back/media/svg/files/blank-image-dark.svg') }}');
                                }
                            </style>
                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                data-kt-image-input="true">
                                <div class="image-input-wrapper w-150px h-150px"></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Thumbnail">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batalkan Thumbnail">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Thumbnail">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="text-muted fs-7">
                                Set foto anggota, hanya menerima file dengan ekstensi .png, .jpg, .jpeg
                            </div>
                        </div>
                    </div>
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Role</h2>
                            </div>
                            <div class="card-toolbar">
                                <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_category_status">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="role_admin" value="1"
                                    @if (old('role_admin') == 1) checked @endif id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Admin
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="role_kepsek" value="1"
                                    @if (old('role_kepsek') == 1) checked @endif id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kepala Sekolah
                                </label>
                            </div>
                             <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="role_humas" value="1"
                                    @if (old('role_humas') == 1) checked @endif id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Humas
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="role_guru" value="1"
                                    @if (old('role_guru') == 1) checked @endif id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Guru
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="role_guru_bk" value="1"
                                    @if (old('role_guru_bk') == 1) checked @endif id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Guru BK
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="role_bendahara" value="1"
                                    @if (old('role_bendahara') == 1) checked @endif id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Bendahara
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="role_staff" value="1"
                                    @if (old('role_staff') == 1) checked @endif id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Staff Lainnya
                                </label>
                            </div>


                            @error('status')
                                <div class="text-danger fs-7">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Biodata</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control mb-2"
                                    placeholder="Nomor Induk Pegawai (NIP)" value="{{ old('nip') }}" />
                                @error('nip')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Nama</label>
                                <input type="text" name="name" class="form-control mb-2"
                                    placeholder="Nama Anggota" value="{{ old('name') }}" required />
                                @error('name')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Jenis Kelamin</label>
                                <select name="gender" class="form-select mb-2" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" @if (old('gender') == 'Laki-laki') selected @endif>
                                        Laki-laki</option>
                                    <option value="Perempuan" @if (old('gender') == 'Perempuan') selected @endif> Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Tempat, Tanggal Lahir</label>
                                <div class="d-flex flex-stack mb-2">
                                    <input type="text" name="birth_place" class="form-control me-2"
                                        placeholder="Tempat Lahir" value="{{ old('birth_place') }}" required />
                                    <input type="date" name="birth_date" class="form-control"
                                        value="{{ old('birth_date') }}" required />
                                </div>
                                @error('birth_place')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                                @error('birth_date')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="form-label">Alamat</label>
                                <textarea name="address" class="form-control mb-2" rows="3" placeholder="Alamat Lengkap">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class=" form-label">Email</label>
                                <input type="email" name="email" class="form-control mb-2" placeholder="Email"
                                    value="{{ old('email') }}"  />
                                @error('email')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class=" form-label">No. Telepon</label>
                                <input type="text" name="no_telp" class="form-control mb-2"
                                    placeholder="Nomor Telepon" value="{{ old('no_telp') }}"  />
                                @error('no_telp')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="required form-label">Jenis Staff</label>
                                <select name="type" class="form-select mb-2" required>
                                    <option value="" disabled selected>Pilih Jenis Staff</option>
                                    <option value="Tenaga Pendidik" @if (old('type') == 'Tenaga Pendidik') selected @endif>
                                        Tenaga Pendidik</option>
                                    <option value="Tenaga Kependidikan" @if (old('type') == 'Tenaga Kependidikan') selected @endif>
                                        Tenaga Kependidikan</option>
                                </select>
                                @error('type')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="required form-label">Posisi</label>
                                <input type="text" name="position" class="form-control mb-2"
                                    placeholder="Posisi Staff" value="{{ old('position') }}" required />
                                @error('position')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="form-label">Tentang Anda</label>
                                <textarea name="about" class="form-control mb-2" rows="5" placeholder="Tentang Anda">{{ old('about') }}</textarea>
                                @error('about')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Media Sosial</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label mb-0">Facebook</label>
                                        <input type="text" name="facebook" class="form-control mb-2"
                                            placeholder="https://facebook.com/username" value="{{ old('facebook') }}" />
                                        @error('facebook')
                                            <div class="text-danger fs-7">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label mb-0">Twitter</label>
                                        <input type="text" name="twitter" class="form-control mb-2"
                                            placeholder="https://twitter.com/username" value="{{ old('twitter') }}" />
                                        @error('twitter')
                                            <div class="text-danger fs-7">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label mb-0">Instagram</label>
                                        <input type="text" name="instagram" class="form-control mb-2"
                                            placeholder="https://instagram.com/username" value="{{ old('instagram') }}" />
                                        @error('instagram')
                                            <div class="text-danger fs-7">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label mb-0">Linkedin</label>
                                        <input type="text" name="linkedin" class="form-control mb-2"
                                            placeholder="https://linkedin.com/username" value="{{ old('linkedin') }}" />
                                        @error('linkedin')
                                            <div class="text-danger fs-7">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Buat Password</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Password</label>
                                <input type="password" name="password" class="form-control mb-2" placeholder="Password"
                                    required />
                                    <small class="text-muted">Password minimal 8 karakter</small>
                                @error('password')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('back.user.staff.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan Perubahan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
