@extends('front.app')

@section('seo')
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('sekapur_sirih') }}">
    <link rel="canonical" href="{{ route('sekapur_sirih') }}">
    <meta property="og:image" content="{{ Storage::url($favicon) }}">
@endsection

@section('styles')
    <style>
        .fc-event {
            cursor: pointer;
            /* Mengubah kursor menjadi pointer */
        }

        .fc-event:hover {
            cursor: pointer;
            /* Menjaga kursor tetap pointer saat hover */
        }
    </style>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <link rel="stylesheet" href="{{ asset('front/css/micromodal.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/micromodal/0.4.6/micromodal.min.js"></script>


    <script>
        MicroModal.init();
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },

                initialView: 'dayGridMonth',
                height: 800,
                contentHeight: 780,
                aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio


                editable: true,
                eventStartEditable: false,
                eventDurationEditable: false,
                dayMaxEvents: true, // allow "more" link when too many events
                navLinks: true,
                events: function(info, successCallback, failureCallback) {
                    $.ajax({
                        url: '/api/get-calendar',
                        type: 'GET',
                        success: function(response) {
                            console.log(response);

                            var events = [];
                            $.each(response.calendar, function(index, value) {
                                events.push({
                                    id: value.id,
                                    title: value.title,
                                    start: value.start,
                                    end: value.end,
                                    description: value.description,
                                    location: value.location,
                                });
                            });


                            successCallback(events);
                        },
                        error: function(error) {
                            console.log(error);
                        },

                    });
                },
                eventClick: function(info) {
                    console.log("Event clicked:", info.event); // Pastikan ini tercetak di console
                    $('#event-title').val(info.event.title);
                    $('#event-start').val(info.event.start.toLocaleString());
                    $('#event-end').val(info.event.end.toLocaleString());
                    $('#event-description').val(info.event.extendedProps.description);
                    $('#event-location').val(info.event.extendedProps.location);
                    MicroModal.show('modal-1');
                }
            });
            calendar.render();
        });
    </script>
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
                            Kalender Akademin
                        </span></h2>

                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">kalender Akademik</li>
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
                        <div class="teachers-archive">

                            <h2 class="widget-title text-capitalize"><span>Kalender akademik</span></h2>

                            <div id='calendar'></div>
                        </div>

                        <div class="modal micromodal-slide" id="modal-1" aria-hidden="true" style="width: 100%;">
                            <div class="modal__overlay" tabindex="-1" data-micromodal-close>
                                <div class="modal__container" role="dialog" aria-modal="true"
                                    aria-labelledby="modal-1-title">
                                    <header class="modal__header">
                                        <h2 class="modal__title" id="modal-1-title">
                                            Kalender Akademik
                                        </h2>
                                        <button class="modal__close" aria-label="Close modal"
                                            data-micromodal-close></button>
                                    </header>
                                    <main class="modal__content" id="modal-1-content">
                                        <div class="form-group">
                                            <label for="event-title">Judul</label>
                                            <textarea class="form-control" id="event-title" readonly disabled style="background-color: #f8f8f8a2; resize: none;"
                                                rows="1"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="event-location">Lokasi</label>
                                            <textarea class="form-control" id="event-location" readonly disabled style="background-color: #f8f8f8a2; resize: none;"
                                                rows="1"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="event-description">Deskripsi</label>
                                            <textarea class="form-control" id="event-description" readonly disabled style="background-color: #f8f8f8a2;"
                                                rows="3"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="event-start">Mulai</label>
                                                    <input type="text" class="form-control" id="event-start" readonly
                                                        disabled style="background-color: #f8f8f8a2;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="event-end">Selesai</label>
                                                    <input type="text" class="form-control" id="event-end" readonly
                                                        disabled style="background-color: #f8f8f8a2;">
                                                </div>
                                            </div>
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-3">
                        <div class="side-bar">

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
@endsection
