@extends('front.app')

@section('seo')
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('teacher') }}">
    <link rel="canonical" href="{{ route('teacher') }}">
    <meta property="og:image" content="{{ Storage::url($favicon) }}">
@endsection

@section('styles')
@endsection

@section('content')
    <!-- Start of breadcrumb section
                                                                                              ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><span>
                            siswa/Siswi

                        </span></h2>

                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Siswa/Siswi</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
                                                                                              ============================================= -->

    <!-- Start of blog content
                                                                                              ============================================= -->
    <section id="blog-item" class="blog-item-post">
        <div class="container">
            <div class="blog-content-details">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h5 class="card-title">Pencarian</h5>
                                <div class="form-group">
                                    <label for="school_year">Tahun Ajaran</label>
                                    <select class="form-control" id="school_year">
                                        <option value="">Pilih Tahun Ajaran</option>
                                        @foreach ($list_school_year as $school_year)
                                            <option value="{{ $school_year->id }}">
                                                {{ $school_year->start_year }}/{{ $school_year->end_year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kelas</label>
                                    <select class="form-control" id="class">
                                        <option value="">Pilih Kelas</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"  id="card_sign">
                                <div class="card">
                                    <div class="card-body">
                                        <b>Search: </b>
                                        Silahkan pilih tahun ajaran dan kelas untuk melihat detail siswa/i dan wali kelas.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="wali_kelas_sign">
                                <h2 class="widget-title text-capitalize"><span>Wali Kelas</span></h2>
                            </div>

                            <div id="wali_kelas" style="max-width: 100%; display: flex; "></div>
                            <div class="col-md-12" id="student_sign">
                                <h2 class="widget-title text-capitalize"><span>Siswa/i</span></h2>
                            </div>
                            <div id="student_list" style="max-width: 100%; display: flex; flex-wrap: wrap;"></div>

                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="side-bar">
                            <div class="side-bar-search">
                                <form action="#" method="get">
                                    <input type="text" class="" placeholder="Search" name="q"
                                        value="{{ request('q') }}">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>

                            <div class="side-bar-widget ">
                                <h2 class="widget-title text-capitalize"><span>Tentang</span> MAN 1 Padang Panjang.</h2>

                                <div class="course-desc">
                                    <p>
                                        {{ strip_tags($setting_web->about) }}
                                    </p>
                                </div>
                                {{-- <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font">
                                    <a href="#">VIEW ONLINE COURSES <i class="fas fa-caret-right"></i></a>
                                </div> --}}
                            </div>

                            @include('front.components.news-categories')


                            @include('front.components.latest-news')


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of blog content
                                                                                              ============================================= -->
@endsection

@section('scripts')
    <script>
        $('#wali_kelas_sign').hide();
        $('#student_sign').hide();
        $(document).ready(function() {
            $('#school_year').change(function() {
                var school_year_id = $(this).val();
                $('#class').html('<option value="">Pilih Kelas</option>');
                if (school_year_id) {
                    $.ajax({
                        url: "{{ route('api.get-classroom') }}",
                        method: "GET",
                        data: {
                            school_year_id: school_year_id,
                        },
                        success: function(data) {
                            console.log(data);
                            data.forEach(function(classroom) {
                                $('#class').append('<option value="' + classroom.id +
                                    '">' + classroom.name +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#class').html('<option value="">Pilih Kelas</option>');
                }
            });

            $('#class').change(function() {
                var classroom_id = $(this).val();
                if (classroom_id) {
                    $('#student_list').html('');
                    $('#wali_kelas').html('');
                    $('#wali_kelas_sign').show();
                    $('#student_sign').show();
                    $('#card_sign').hide();
                    $.ajax({
                        url: "{{ route('api.get-detail-classroom') }}",
                        method: "GET",
                        data: {
                            classroom_id: classroom_id,
                        },
                        success: function(data) {
                            console.log(data);
                            data.student.forEach(function(student) {
                                $('#student_list').append(
                                    `<div class="col-md-4 mb-3">
                                        <div class="card bg-light" >
                                            <img src="${student.photo ? '/storage/' + student.photo : '/img_ext/anonim_person.png'} " class="card-img-top" alt="..." style="height: 230px; width: 100%; object-fit: cover;">
                                            <div class="card-body">
                                            <h5 class="card-title" style="margin-bottom: 3px; font-size: 1.25rem; color: #333;"><a href="#">${student.name}
                                                </a></h5>
                                            <p class="card-text" style="font-size: 0.9rem;">NISN. ${student.nisn}</p>
                                            </div>
                                        </div>
                                    </div>`);
                            });
                            $('#wali_kelas').html(`
                                <div class="col-md-12 mb-5">
                                    <div class="card bg-light">
                                        <div class="row no-gutters">
                                            <div class="col-md-3">
                                                <img src="${data.wali_kelas.photo ? '/storage/' + data.wali_kelas.photo : '/img_ext/anonim_person.png'}" class="card-img" alt="..."
                                                    style="height: 200px; width: 100%; object-fit: cover;">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="card-body">
                                                    <div class="teacher-details-text">
                                                        <div class="section-title-2  headline text-left">
                                                            <h2><span><a href="#">${data.wali_kelas.name}</a></span></h2>
                                                            <div class="teacher-deg">
                                                                NIP. <span>${data.wali_kelas.nip}</span>
                                                            </div>
                                                        </div>
                                                        <div class="teacher-address">
                                                            <div class="address-details ul-li-block">
                                                                <div class="add-info">
                                                                    <span>${data.wali_kelas.about}</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }
                    });
                }
            });
        });
    </script>
@endsection
