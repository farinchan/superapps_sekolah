@extends('ppdb.app-back')
@section('styles')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">

            <div class="card d-flex justify-content-xl-start w-500 w-xl-500px w-xxl-500px">
                @if ($information->login_status)
                <div class="card-body px-6 px-lg-10 px-xxl-15 py-20">
                    <div class="pb-10 pb-lg-15">
                        <h2 class="fw-bold d-flex justify-content-center text-gray-900">Form Login
                            <span class="ms-1" data-bs-toggle="tooltip" title="Gunakan NISN dan Password untuk login">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </h2>
                    </div>


                    <form action="{{ route('ppdb.login') }}" method="POST" class="form">
                        @csrf
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">NISN</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nomor Induk Siswa Nasional" name="nisn" value="{{ old('nisn') }}"
                                required />
                            @error('nisn')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Password</label>
                            <input type="password" class="form-control form-control-solid" placeholder="********"
                                name="password" value="{{ old('password') }}" required />
                            @error('password')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <a href="#" class="link-primary">
                                Lupa Password ?
                            </a>
                            <!--end::Link-->
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <span class="indicator-label">
                                    Masuk</span>
                            </button>
                        </div>
                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            Belum Punya Akun?

                            <a href="{{ route('ppdb.register') }}" class="link-primary">
                                Daftar Sekarang
                            </a>
                        </div>
                    </form>


                </div>
                @else
                <div class="card-body px-6 px-lg-10 px-xxl-15 py-20">
                    <div class="pb-5">
                        <h2 class="fw-bold d-flex justify-content-center text-gray-900">Login ditutup
                        </h2>
                    </div>
                    <div class="text-center">
                        <p class="fs-6 text-gray-600">
                            {{ $information->login_message ?? "" }}
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
