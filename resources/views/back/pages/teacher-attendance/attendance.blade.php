@extends('back.app')
@section('seo')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row row gx-6 gx-xl-9">
                <div class="col-md-4">
                    <div class="card card-flush shadow-sm">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Jadwal Presensi Saya</span>
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="m-0">
                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                    data-bs-toggle="collapse" data-bs-target="#kt_support_1_1">
                                    <div class="ms-n1 me-5">
                                        <i class="ki-outline ki-down toggle-on text-primary fs-2"></i>
                                        <i class="ki-outline ki-right toggle-off fs-2"></i>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <h3 class="text-gray-800 fw-semibold cursor-pointer me-3 mb-0">Hari Senin</h3>
                                    </div>
                                </div>
                                <div id="kt_support_1_1" class="collapse show fs-6 ms-10">
                                    <div class="mb-4">
                                        @forelse ($attendance_senin as $senin)
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">{{ $senin->start }} -
                                                    {{ $senin->end }}</span>
                                            </div>
                                        @empty
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">Tidak ada jadwal</span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="m-0">
                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                    data-bs-toggle="collapse" data-bs-target="#kt_support_1_2">
                                    <div class="ms-n1 me-5">
                                        <i class="ki-outline ki-down toggle-on text-primary fs-2"></i>
                                        <i class="ki-outline ki-right toggle-off fs-2"></i>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <h3 class="text-gray-800 fw-semibold cursor-pointer me-3 mb-0">Hari Selasa</h3>
                                    </div>
                                </div>
                                <div id="kt_support_1_2" class="collapse show fs-6 ms-10">
                                    <div class="mb-4">
                                        @forelse ($attendance_selasa as $selasa)
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">{{ $selasa->start }} -
                                                    {{ $selasa->end }}</span>
                                            </div>
                                        @empty
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">Tidak ada jadwal</span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="m-0">
                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                    data-bs-toggle="collapse" data-bs-target="#kt_support_1_3">
                                    <div class="ms-n1 me-5">
                                        <i class="ki-outline ki-down toggle-on text-primary fs-2"></i>
                                        <i class="ki-outline ki-right toggle-off fs-2"></i>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <h3 class="text-gray-800 fw-semibold cursor-pointer me-3 mb-0">Hari Rabu</h3>
                                    </div>
                                </div>
                                <div id="kt_support_1_3" class="collapse show fs-6 ms-10">
                                    <div class="mb-4">
                                        @forelse ($attendance_rabu as $rabu)
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">{{ $rabu->start }} -
                                                    {{ $rabu->end }}</span>
                                            </div>
                                        @empty
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">Tidak ada jadwal</span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="m-0">
                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                    data-bs-toggle="collapse" data-bs-target="#kt_support_1_4">
                                    <div class="ms-n1 me-5">
                                        <i class="ki-outline ki-down toggle-on text-primary fs-2"></i>
                                        <i class="ki-outline ki-right toggle-off fs-2"></i>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <h3 class="text-gray-800 fw-semibold cursor-pointer me-3 mb-0">Hari Kamis</h3>
                                    </div>
                                </div>
                                <div id="kt_support_1_4" class="collapse show fs-6 ms-10">
                                    <div class="mb-4">
                                        @forelse ($attendance_kamis as $kamis)
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">{{ $kamis->start }} -
                                                    {{ $kamis->end }}</span>
                                            </div>
                                        @empty
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">Tidak ada jadwal</span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="m-0">
                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                    data-bs-toggle="collapse" data-bs-target="#kt_support_1_5">
                                    <div class="ms-n1 me-5">
                                        <i class="ki-outline ki-down toggle-on text-primary fs-2"></i>
                                        <i class="ki-outline ki-right toggle-off fs-2"></i>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <h3 class="text-gray-800 fw-semibold cursor-pointer me-3 mb-0">Hari Jumat</h3>
                                    </div>
                                </div>
                                <div id="kt_support_1_5" class="collapse show fs-6 ms-10">
                                    <div class="mb-4">
                                        @forelse ($attendance_jumat as $jumat)
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">{{ $jumat->start }} -
                                                    {{ $jumat->end }}</span>
                                            </div>
                                        @empty
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">Tidak ada jadwal</span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="m-0">
                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                    data-bs-toggle="collapse" data-bs-target="#kt_support_1_6">
                                    <div class="ms-n1 me-5">
                                        <i class="ki-outline ki-down toggle-on text-primary fs-2"></i>
                                        <i class="ki-outline ki-right toggle-off fs-2"></i>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <h3 class="text-gray-800 fw-semibold cursor-pointer me-3 mb-0">Hari Sabtu</h3>
                                    </div>
                                </div>
                                <div id="kt_support_1_6" class="collapse show fs-6 ms-10">
                                    <div class="mb-4">
                                        @forelse ($attendance_sabtu as $sabtu)
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">{{ $sabtu->start }} -
                                                    {{ $sabtu->end }}</span>
                                            </div>
                                        @empty
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <span class="text-gray-800 fw-semibold fs-6">Tidak ada jadwal</span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-flush shadow-sm">
                        <div class="card-body py-5 d-flex flex-column flex-center">
                            <div class="mb-2">
                                <h1 class="fw-semibold text-gray-800 text-center lh-lg">
                                    Presensi
                                    <span class="fw-bolder"> Saya </span>
                                </h1>
                                <div class=" text-gray-800 text-center fs-5 mb-5 ">
                                    {{ now()->translatedFormat('l, d F Y') }}
                                </div>
                            </div>
                            <div class="m-0 w-100 text-center">
                                <div class="table-responsive">
                                    <table class="table table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th class="fs-2" scope="col">Presensi Aktif</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @if ($attendance_active)
                                                    <td class="fs-3">
                                                        <b>Jadwal : </b> {{ $attendance_active->start }} - {{ $attendance_active->end }} <br>
                                                        <b>Status Lokasi : </b> <span id="status"></span> <br>
                                                        <b>Status Presensi : </b>
                                                        @if ($attendance_active_present)
                                                            <span class="badge badge-success">Sudah Absen</span>
                                                        @else
                                                            <span class="badge badge-danger">Belum Absen </span>
                                                        @endif <br> <br>
                                                        @if ($attendance_active_present)
                                                        <button id="actionButton" class="btn btn-success" onclick="checkLocation()">Sudah melakukan Presensi</button>
                                                        @else
                                                        <button id="actionButton" class="btn btn-primary" disabled>Presensi Sekarang</button>
                                                        @endif
                                                    </td>
                                                @else
                                                    <td class="fs-3">
                                                        Tidak ada jadwal presensi aktif
                                                    </td>
                                                @endif

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Koordinat target
        const targetLatitude = -0.8553750401972288; // Contoh latitude
        const targetLongitude = 100.39068172744277; // Contoh longitude
        const radius = 10000; // Radius dalam meter (1 km)
        const statusElement = document.getElementById("status");
        const actionButton = document.getElementById("actionButton");
        // Fungsi untuk menghitung jarak menggunakan Haversine Formula
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371000; // Radius bumi dalam meter
            const toRadians = angle => (angle * Math.PI) / 180;
            const dLat = toRadians(lat2 - lat1);
            const dLon = toRadians(lon2 - lon1);
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; // Jarak dalam meter
        }
        // Periksa lokasi pengguna
        function checkLocation() {
            if (!navigator.geolocation) {
                statusElement.textContent = "Geolocation tidak didukung oleh browser Anda.";
                return;
            }
            navigator.geolocation.getCurrentPosition(
                position => {
                    const userLatitude = position.coords.latitude;
                    const userLongitude = position.coords.longitude;
                    const distance = calculateDistance(
                        userLatitude,
                        userLongitude,
                        targetLatitude,
                        targetLongitude
                    );
                    if (distance <= radius) {
                        statusElement.textContent = "Anda berada di dalam area yang ditetapkan.";
                        statusElement.style.color = "green";
                        actionButton.disabled = false;
                    } else {
                        statusElement.textContent =
                            `Anda berada di luar area. Jarak Anda: ${Math.round(distance)} meter.`;
                        statusElement.style.color = "red";
                        actionButton.disabled = true;
                    }
                },
                error => {
                    statusElement.textContent = "Gagal mendapatkan lokasi ( " + error.message + " )"
                    statusElement.style.color = "red";
                }
            );
        }

        
        // Periksa lokasi saat halaman dimuat
        window.onload = checkLocation;
        // Opsi tambahan untuk memeriksa lokasi ulang
        actionButton.addEventListener("click", () => {
            alert("Tombol ditekan!");
        });
    </script>
@endsection
