@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row"
                action="{{ route('back.achievement.teacher.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Gambar</h2>
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
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" required />
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
                                Set Gambar Prestasi, Hanya menerima file dengan ekstensi png, jpg, jpeg
                            </div>
                        </div>
                    </div>
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Sertifikat</h2>
                            </div>
                            <div class="card-toolbar">
                                <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_category_status">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <input type="file" name="file" accept=".pdf" class="form-control mb-3" required />
                            <div class="text-muted fs-7">
                                Upload Sertifikat Prestasi, Hanya menerima file dengan ekstensi pdf
                            </div>
                        </div>
                    </div>

                </div>
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>prestasi</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Guru</label>
                                <select name="teacher_id" class="form-select mb-2" data-control="select2" data-placeholder="Pilih Guru" required>
                                    <option value=""></option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }} - NIP: {{ $teacher->nip }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Nama Perlombaan</label>
                                <input type="text" name="name" class="form-control  mb-2" value="{{ old('name') }}" placeholder="Nama Perlombaan" required />
                                @error('name')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label required">penyelenggara</label>
                                <input type="text" name="event" class="form-control  mb-2" value="{{ old('event') }}" placeholder="Penyelenggara" required />
                                @error('event')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label required">Tingkat</label>
                                <select name="level" class="form-select mb-2" required>
                                    <option value="">Pilih Tingkat</option>
                                    <option value="Sekolah" {{ old('level') == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                                    <option value="Kecamatan" {{ old('level') == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                                    <option value="Kabupaten/Kota" {{ old('level') == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                    <option value="Provinsi" {{ old('level') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="Nasional" {{ old('level') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="Internasional" {{ old('level') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                                @error('level')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label required">Peringkat</label>
                                <select name="rank" class="form-select mb-2" required>
                                    <option value="">Pilih Peringkat</option>
                                    <option value="Juara 1" {{ old('rank') == 'Juara 1' ? 'selected' : '' }}>Juara 1</option>
                                    <option value="Juara 2" {{ old('rank') == 'Juara 2' ? 'selected' : '' }}>Juara 2</option>
                                    <option value="Juara 3" {{ old('rank') == 'Juara 3' ? 'selected' : '' }}>Juara 3</option>
                                    <option value="Juara Harapan 1" {{ old('rank') == 'Juara Harapan 1' ? 'selected' : '' }}>
                                        Juara Harapan 1</option>
                                    <option value="Juara Harapan 2" {{ old('rank') == 'Juara Harapan 2' ? 'selected' : '' }}>
                                        Juara Harapan 2</option>
                                    <option value="Juara Harapan 3" {{ old('rank') == 'Juara Harapan 3' ? 'selected' : '' }}>
                                        Juara Harapan 3</option>
                                        <option value="Juara Lainnya" {{ old('rank') == 'Juara Lainnya' ? 'selected' : '' }}>
                                            Juara Lainnya</option>

                                </select>
                                @error('rank')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label required">Tanggal</label>
                                <input type="date" name="date" class="form-control  mb-2"
                                    value="{{ old('date') }}" required />
                                @error('date')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label required">Deskripsi</label>
                                <textarea name="description" class="form-control  mb-2" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('back.event.index') }}" id="kt_ecommerce_add_product_cancel"
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
