@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row"
                action="{{ route('back.user.parent.profile.update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
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
                                    background-image: url('{{ $user->getPhoto() }}');
                                }

                                [data-bs-theme="dark"] .image-input-placeholder {
                                    background-image: url('{{ $user->getPhoto()  }}');
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
                                <label class="required form-label">NIK</label>
                                <input type="text" name="nik" class="form-control mb-2" placeholder="Nomor Induk Kependudukan"
                                    value="{{ $user->nik }}" required />
                                @error('nik')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Nama</label>
                                <input type="text" name="name" class="form-control mb-2"
                                    placeholder="Nama Anggota" value="{{ $user->name }}" required />
                                @error('name')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Jenis Kelamin</label>
                                <select name="gender" class="form-select mb-2" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="laki-laki" @if ($user->gender == 'laki-laki') selected @endif>
                                        Laki-laki</option>
                                    <option value="perempuan" @if ($user->gender == 'perempuan') selected @endif> Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class=" form-label">Email</label>
                                <input type="email" name="email" class="form-control mb-2" placeholder="Email"
                                    value="{{ $user->email }}"  />
                                @error('email')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" name="no_telp" class="form-control mb-2" placeholder="62xxxxxxxxxx"
                                    placeholder="Nomor Telepon" value="{{ $user->no_telp }}"  />
                                @error('no_telp')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Profesi</label>
                                <input type="text" name="profession" class="form-control mb-2"
                                    placeholder="profesi/pekerjaan" value="{{ $user->profession }}" required />
                                @error('profession')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Edit Password</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class=" form-label">Password</label>
                                <input type="password" name="password" class="form-control mb-2" placeholder="Password"
                                     />
                                    <small class="text-muted">
                                        Kosongkan jika tidak ingin mengubah password
                                    </small>
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
    <script>
        $('#job').on('change', function() {
            var job = $(this).val();
            if (job.includes('Ustadz')) {
                $('#kepakaran_view').html(`
                    <div class="mb-5 fv-row">
                        <label class="required form-label">Kepakaran</label>
                        <select name="kepakaran" class="form-select mb-2" required>
                            <option value="" disabled selected>Pilih Kepakaran</option>
                            <option value="Tafsir" @if ($user->kepakaran == 'Tafsir') selected @endif>Tafsir</option>
                            <option value="Hadist" @if ($user->kepakaran == 'Hadist') selected @endif>Hadist</option>
                            <option value="Fiqih" @if ($user->kepakaran == 'Fiqih') selected @endif>Fiqih</option>
                            <option value="Tarikh" @if ($user->kepakaran == 'Tarikh') selected @endif>Tarikh</option>
                            <option value="Aqidah" @if ($user->kepakaran == 'Aqidah') selected @endif>Aqidah</option>
                            <option value="Akhlak" @if ($user->kepakaran == 'Akhlak') selected @endif>Akhlak</option>
                            <option value="Tasawuf" @if ($user->kepakaran == 'Tasawuf') selected @endif>Tasawuf</option>
                            <option value="Sejarah" @if ($user->kepakaran == 'Sejarah') selected @endif>Sejarah</option>
                            <option value="Lainnya" @if ($user->kepakaran == 'Lainnya') selected @endif>Lainnya</option>
                        </select>
                        @error('kepakaran')
                            <div class="text-danger fs-7">{{ $message }}</div>
                        @enderror
                    </div>
                `);
            } else {
                $('#kepakaran_view').html('');
            }
        });
        $('#job').trigger('change');
    </script>
@endsection
