@extends('ppdb.app-back')
@section('styles')
@endsection
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <div class="card d-flex justify-content-xl-start w-500 w-xl-500px w-xxl-500px">

                <div class="card-body px-6 px-lg-10 px-xxl-15 py-20">
                    <div class="pb-5">
                        <h2 class="fw-bold d-flex justify-content-center text-gray-900">Pendaftaran Ulang Berhasil
                        </h2>
                    </div>
                    <div class="text-center">
                        <p class="fs-6 text-gray-600">
                            Terimakash telah melakukan daftar ulang data ananda akan kami validasi. Untuk informasi selanjutnya silahkan bergabung melalui WAG ini <br> <br>
                            <a href="https://chat.whatsapp.com/IAhBNxJih10HWHNBOA80Fs">https://chat.whatsapp.com/IAhBNxJih10HWHNBOA80Fs</a>
                        </p>

                        <a href="{{ route('ppdb.dashboard') }}" class="btn btn-light-success mt-5">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
@endsection
@section('scripts')
@endsection
