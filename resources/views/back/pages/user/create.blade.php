@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row"
                action="{{ route('back.user.store') }}" method="POST" enctype="multipart/form-data">
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
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="role_user" value="1" checked
                                    id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    User
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="role_admin" value="1" @if (old('role_admin') == 1) checked @endif
                                    id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Admin
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
                                    <option value="Perempuan" @if (old('gender') == 'Perempuan') selected @endif> Perempuan </option>
                                </select>
                                @error('gender')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Tempat, Tanggal Lahir</label>
                                <div class="d-flex flex-stack mb-2">
                                    <input type="text" name="place_of_birth" class="form-control me-2"
                                        placeholder="Tempat Lahir" value="{{ old('place_of_birth') }}" required />
                                    <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}"
                                        required />
                                </div>
                                @error('place_of_birth')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                                @error('birth_date')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Alamat</label>
                                <textarea name="address" class="form-control mb-2" rows="3"
                                    placeholder="Alamat Lengkap" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">No. Telepon</label>
                                <input type="text" name="phone" class="form-control mb-2"
                                    placeholder="Nomor Telepon" value="{{ old('phone') }}" required />
                                @error('phone')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Pekerjaan</label>
                                <select  id="job" class="form-select mb-2" name="job[]" data-control="select2"  data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" required>
                                    <option value="Ustadz"@if (old('job') == 'Ustadz') selected @endif >Ustadz</option>
                                        <option value="Dosen"@if (old('job') == 'Dosen') selected @endif>Dosen</option>
                                        <option value="Guru"@if (old('job') == 'Guru') selected @endif>Guru</option>
                                        <option value="Arsitek"@if (old('job') == 'Arsitek') selected @endif>Arsitek</option>
                                        <option value="Nelayan"@if (old('job') == 'Nelayan') selected @endif>Nelayan</option>
                                        <option value="Perawat"@if (old('job') == 'Perawat') selected @endif>Perawat</option>
                                        <option value="Dokter"@if (old('job') == 'Dokter') selected @endif>Dokter</option>
                                        <option value="Bidan"@if (old('job') == 'Bidan') selected @endif>Bidan</option>
                                        <option value="Pemadam Kebakaran"@if (old('job') == 'Pemadam Kebakaran') selected @endif>Pemadam Kebakaran</option>
                                        <option value="Kondektur"@if (old('job') == 'Kondektur') selected @endif>Kondektur</option>
                                        <option value="Pilot"@if (old('job') == 'Pilot') selected @endif>Pilot</option>
                                        <option value="Masinis"@if (old('job') == 'Masinis') selected @endif>Masinis</option>
                                        <option value="Wartawan"@if (old('job') == 'Wartawan') selected @endif>Wartawan</option>
                                        <option value="Penulis"@if (old('job') == 'Penulis') selected @endif>Penulis</option>
                                        <option value="Insinyur Mesin"@if (old('job') == 'Insinyur Mesin') selected @endif>Insinyur Mesin</option>
                                        <option value="Ahli Gizi"@if (old('job') == 'Ahli Gizi') selected @endif>Ahli Gizi</option>
                                        <option value="Pustakawan"@if (old('job') == 'Pustakawan') selected @endif>Pustakawan</option>
                                        <option value="Hakim"@if (old('job') == 'Hakim') selected @endif>Hakim</option>
                                        <option value="Notaris"@if (old('job') == 'Notaris') selected @endif>Notaris</option>
                                        <option value="Teller Bank"@if (old('job') == 'Teller Bank') selected @endif>Teller Bank</option>
                                        <option value="Koki"@if (old('job') == 'Koki') selected @endif>Koki</option>
                                        <option value="Artis"@if (old('job') == 'Artis') selected @endif>Artis</option>
                                        <option value="Penerjemah"@if (old('job') == 'Penerjemah') selected @endif>Penerjemah</option>
                                        <option value="Tentara"@if (old('job') == 'Tentara') selected @endif>Tentara</option>
                                        <option value="Tukang Cukur"@if (old('job') == 'Tukang Cukur') selected @endif>Tukang Cukur</option>
                                        <option value="Petani"@if (old('job') == 'Petani') selected @endif>Petani</option>
                                        <option value="Akuntan"@if (old('job') == 'Akuntan') selected @endif>Akuntan</option>
                                        <option value="Pengacara"@if (old('job') == 'Pengacara') selected @endif>Pengacara</option>
                                        <option value="Polisi"@if (old('job') == 'Polisi') selected @endif>Polisi</option>
                                        <option value="Pegawai Negeri"@if (old('job') == 'Pegawai Negeri') selected @endif>Pegawai Negeri</option>
                                        <option value="Pegawai Swasta"@if (old('job') == 'Pegawai Swasta') selected @endif>Pegawai Swasta</option>
                                        <option value="Wiraswasta"@if (old('job') == 'Wiraswasta') selected @endif>Wiraswasta</option>
                                        <option value="Lainnya"@if (old('job') == 'Lainnya') selected @endif>Lainnya</option>
                                </select>
                            </div>
                            <div id="kepakaran_view"></div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Keanggotaan</label>
                                <select name="keanggotaan" class="form-select mb-2" required>
                                    <option value="" disabled selected>Pilih Keanggotaan</option>
                                        <option value="Kader Muhammadiyah" @if (old('keanggotaan') == 'Kader Muhammadiyah') selected @endif>
                                            Kader Muhammadiyah</option>
                                        <option value="Warga Muhammadiyah" @if (old('keanggotaan') == 'Warga Muhammadiyah') selected @endif>
                                            Warga Muhammadiyah</option>
                                        <option value="Simpatisan Muhammadiyah" @if (old('keanggotaan') == 'Simpatisan Muhammadiyah') selected @endif>
                                            Simpatisan Muhammadiyah</option>
                                </select>
                                @error('keanggotaan')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="required form-label">Email</label>
                                <input type="email" name="email" class="form-control mb-2" placeholder="Email"
                                    value="{{ old('email') }}" required />
                                @error('email')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Password</label>
                                <input type="password" name="password" class="form-control mb-2" placeholder="Password"
                                    required />
                                @error('password')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('back.pengumuman.index') }}" id="kt_ecommerce_add_product_cancel"
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
                            <option value="Tafsir" @if (old('kepakaran') == 'Tafsir') selected @endif>Tafsir</option>
                            <option value="Hadist" @if (old('kepakaran') == 'Hadist') selected @endif>Hadist</option>
                            <option value="Fiqih" @if (old('kepakaran') == 'Fiqih') selected @endif>Fiqih</option>
                            <option value="Tarikh" @if (old('kepakaran') == 'Tarikh') selected @endif>Tarikh</option>
                            <option value="Aqidah" @if (old('kepakaran') == 'Aqidah') selected @endif>Aqidah</option>
                            <option value="Akhlak" @if (old('kepakaran') == 'Akhlak') selected @endif>Akhlak</option>
                            <option value="Tasawuf" @if (old('kepakaran') == 'Tasawuf') selected @endif>Tasawuf</option>
                            <option value="Sejarah" @if (old('kepakaran') == 'Sejarah') selected @endif>Sejarah</option>
                            <option value="Lainnya" @if (old('kepakaran') == 'Lainnya') selected @endif>Lainnya</option>
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
    </script>
@endsection
