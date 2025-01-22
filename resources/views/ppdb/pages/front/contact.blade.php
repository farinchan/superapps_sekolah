@extends('ppdb.app-front')
@section('styles')
    <style>
        #kt_contact_map {
            height: 486px;
    width: 100%;
    position: relative; /* Tambahkan ini untuk mencegah overflow */
    overflow: hidden; /* Pastikan kontainer tidak memengaruhi elemen lain */
        }
        .leaflet-container {
    background: #f0f0f0; /* Set background default */
    all: unset; /* Reset semua properti */
    display: block;
    height: 100%;
    width: 100%;
    position: relative;
    overflow: hidden;
}
    </style>
@endsection
@section('content')
    @php
        $setting_website = \App\Models\SettingWebsite::first();
    @endphp
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-body p-lg-17">
                <div class="row mb-3">
                    <div class="col-md-6 pe-lg-10">
                        <form action="" class="form mb-15" method="post" id="kt_contact_form">
                            <h1 class="fw-bold text-gray-900 mb-9">Kirim Kami Pertanyaan</h1>
                            <div class="row mb-5">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-5 fw-semibold mb-2">Nama</label>
                                    <input type="text" class="form-control form-control-solid" placeholder=""
                                        name="name" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-5 fw-semibold mb-2">Email</label>
                                    <input type="text" class="form-control form-control-solid" placeholder=""
                                        name="email" />
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row">
                                <label class="fs-5 fw-semibold mb-2">Subjek</label>
                                <input class="form-control form-control-solid" placeholder="" name="subject" />
                            </div>
                            <div class="d-flex flex-column mb-10 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Pesan</label>
                                <textarea class="form-control form-control-solid" rows="6" name="message" placeholder=""></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="kt_contact_submit_button">
                                <span class="indicator-label">Kirim Pertanyaan</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6 ps-lg-10">
                        <div id="kt_contact_map" class="w-100 rounded mb-2 mb-lg-0 mt-2" style="height: 486px"></div>
                    </div>
                </div>
                <div class="row g-5 mb-5 mb-lg-15">
                    <div class="col-sm-6 pe-lg-10">
                        <div class="bg-light card-rounded d-flex flex-column flex-center flex-center p-10 h-100">
                            <i class="ki-outline ki-briefcase fs-3tx text-primary"></i>
                            <h1 class="text-gray-900 fw-bold my-5">hubungi Kami</h1>
                            <div class="text-gray-700 fw-semibold fs-2">{{ $setting_website->phone }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6 ps-lg-10">
                        <div class="text-center bg-light card-rounded d-flex flex-column flex-center p-10 h-100">
                            <i class="ki-outline ki-geolocation fs-3tx text-primary"></i>
                            <h1 class="text-gray-900 fw-bold my-5">Alamat Kami</h1>
                            <div class="text-gray-700 fs-3 fw-semibold">{{ $setting_website->address }}</div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 bg-light text-center">
                    <div class="card-body py-12">
                        <a href="{{ $setting_website->facebook }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/facebook-4.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                        <a href="{{ $setting_website->instagram }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/instagram-2-1.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                        <a href="{{ $setting_website->twitter }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/twitter.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                        <a href="{{ $setting_website->youtube }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/youtube-play.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                        <a href="{{ $setting_website->telegram }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/telegram.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                        <a href="{{ $setting_website->linkedin }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/linkedin-1.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('back/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
    <script>
            var leaflet = L.map('kt_contact_map', {
                center: [{{ $setting_website->latitude }}, {{ $setting_website->longitude }}],
                zoom: 15
            });
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(leaflet);

            L.marker([{{ $setting_website->latitude }}, {{ $setting_website->longitude }}]).addTo(leaflet);

            // Panggil invalidateSize untuk memastikan layout map benar
            setTimeout(function() {
                leaflet.invalidateSize();
            }, 500);

    </script>
@endsection
