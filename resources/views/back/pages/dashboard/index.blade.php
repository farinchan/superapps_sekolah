@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <div class="col-xl-12">
                    <div class="card border-transparent" data-bs-theme="light" style="background-color: #1C325E;">
                        <div class="card-body d-flex ps-xl-15">

                            <div class="m-0">
                                <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
                                    <span class="me-2">
                                        @if (now()->format('H') >= 0 && now()->format('H') < 12)
                                            Selamat Pagi,
                                        @elseif (now()->format('H') >= 12 && now()->format('H') < 15)
                                            Selamat Siang,
                                        @elseif (now()->format('H') >= 15 && now()->format('H') < 18)
                                            Selamat Sore,
                                        @elseif (now()->format('H') >= 18 && now()->format('H') < 24)
                                            Selamat Malam,
                                        @endif

                                        @if (Auth::user()->teacher)
                                            @if (Auth::user()->teacher->gender == 'laki-laki')
                                                Bapak
                                            @elseif (Auth::user()->teacher->gender == 'perempuan')
                                                Ibu
                                            @endif
                                            <span class="position-relative d-inline-block text-danger">
                                                <a href="#" class="text-danger opacity-75-hover">

                                                    {{ Auth::user()->teacher?->name }}
                                                </a>
                                                <span
                                                    class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                                            </span>
                                        @endif


                                    </span>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-white ">
                                            Selamat datang di sistem terpadu MAN 1 Padang Panjang, <br>
                                            Website ini merupakan media yang paling tepat untuk menampilkan informasi
                                            madrasah
                                            secara cepat dan akurat, antara lain keunggulan madrasah, prestasi akademik
                                            maupun non
                                            akademik, mendokumentasikan berbagai peristiwa dan kegiatan madrasah melalui
                                            dunia
                                            digital.
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <img src="{{ asset('back/media/illustrations/sigma-1/17-dark.png') }}"
                                            class="position-absolute mt-10 me-3 bottom-0 end-0 h-200px" alt="" />
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                @role('guru')
                <div class="col-xl-12">
                    <div class="card card-flush h-lg-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Statistik View Blog Saya Sebulan Terakhir</span>
                            </h3>
                        </div>
                        <div class="card-body pt-0 px-0">
                            {{-- INI TEMPAT STAT NYA --}}
                            <div id="chart_1" class="px-5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card card-flush h-lg-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Blog Saya yang Terpoluler</span>
                            </h3>
                        </div>
                        <div class="card-body pt-0 px-5">
                            <div class="table-responsive">
                                <table class="table gs-7 gx-7">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                            <th>Judul</th>
                                            <th class="text-center">Views</th>
                                            <th class="text-center">Komentar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($blog_popular as $item_blog_popular)
                                            <tr>
                                                <td><a class="text-gray-800 text-hover-primary fs-6" href="{{ route('news.show', $item_blog_popular->slug) }}">{{ $item_blog_popular->title }}</a></td>
                                                <td class="text-center">{{ $item_blog_popular->viewers_count }}</td>
                                                <td class="text-center">{{ $item_blog_popular->comments->count() }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Anda Belum Pernah Menulis</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endrole
            </div>
            {{-- <div class="row g-5 g-xl-10">
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">1</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">Pengumuman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $berita_count }}</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">Berita</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <img src="/metronic8/demo1/assets/media/svg/brand-logos/dribbble-icon-1.svg" class="w-35px"
                                    alt="">
                            </div>
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">84k</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">Followers</span>
                                </div>
                            </div>
                            <span class="badge badge-light-success fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1"><span class="path1"></span><span
                                        class="path2"></span></i>
                                0.6%
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <img src="/metronic8/demo1/assets/media/svg/brand-logos/twitter.svg" class="w-35px"
                                    alt="">
                            </div>
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">570k</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">Followers</span>
                                </div>
                            </div>
                            <span class="badge badge-light-success fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1"><span class="path1"></span><span
                                        class="path2"></span></i>
                                3%
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-5 mb-xl-10">
                    <div class="card card-flush border-0 h-lg-100" data-bs-theme="light" style="background-color: #7239EA">
                        <div class="card-header pt-2">
                            <h3 class="card-title">
                                <span class="text-white fs-3 fw-bold me-2">Facebook Campaign</span>
                                <span class="badge badge-success">Active</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex justify-content-between flex-column pt-1 px-0 pb-0">
                            <div class="d-flex flex-wrap px-9 mb-5">
                                <div class="rounded min-w-125px py-3 px-4 my-1 me-6"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                                    <div class="d-flex align-items-center">
                                        <div class="text-white fs-2 fw-bold counted" data-kt-countup="true"
                                            data-kt-countup-value="4368" data-kt-countup-prefix="$" data-kt-initialized="1">
                                            $4,368</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-white opacity-50">New Followers</div>
                                </div>
                                <div class="rounded min-w-125px py-3 px-4 my-1"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                                    <div class="d-flex align-items-center">
                                        <div class="text-white fs-2 fw-bold counted" data-kt-countup="true"
                                            data-kt-countup-value="120,000" data-kt-initialized="1">120,000</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-white opacity-50">Followers Goal</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection


@section('scripts')

<script>
    var chart_1 = new ApexCharts(document.querySelector("#chart_1"), {
        series: [{
            name: 'Pengunjung',
            data: [0]
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            curve: 'straight'
        },
        title: {
            text: 'Pengunjung',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        xaxis: {
            categories: ['x'],
        }
    });
    chart_1.render();



    $.ajax({
        url: "{{ route('back.dashboard.stat') }}",
        type: "GET",
        success: function(response) {
            console.log(response);

            chart_1.updateSeries([{
                data: response.blog_viewer_monthly.map(function(item) {
                    return item.total;
                }).reverse()
            }]);
            chart_1.updateOptions({
                xaxis: {
                    categories: response.blog_viewer_monthly.map(function(item) {
                        return item.date;
                    }).reverse()
                }
            });
        }
    });
</script>

@endsection
