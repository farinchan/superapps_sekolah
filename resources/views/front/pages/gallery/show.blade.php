@extends('front.app')

@section('seo')
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('gallery.show', $gallery_album->slug) }} }}">
    <link rel="canonical" href="{{ route('gallery.show', $gallery_album->slug) }} }}">
    <meta property="og:image" content="{{ $gallery_album->getThumbnail() }}">
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
                            {{ $gallery_album->title }}

                        </span></h2>

                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
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
                    <div class="col-md-4">
                        <div class="blog-item-img">
                            <img src="{{ $gallery_album->getThumbnail() }}" alt="{{ $gallery_album->title }}"
                                class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="teachers-archive">
                            <h2 class="widget-title text-capitalize"><span>{{ $gallery_album->title }}</span></h2>
                            {{ $gallery_album->description }}
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="blog-item-img">
                            <div class="row">

                                @foreach ($list_gallery as $gallery)
                                    @php
                                        $gal = '';
                                        $popup = '';
                                        if ($gallery->type == 'foto') {
                                            $gal = $gallery->getFoto();
                                            $popup = $gallery->getFoto();
                                        } else {
                                            $gal = asset('img_ext/yt.jpg');
                                            $popup = $gallery->video;
                                        }
                                    @endphp
                                    <div class="col-md-3 mt-3">

                                        <div class="blog-item-img">
                                            <a href="{{$popup}}" class="image-popup">
                                                <img src="{{ $gal }}" alt="{{ $gallery->title }}"
                                                    style="width: 100%; height: 200px; object-fit: cover;"
                                                    onmouseover="this.style.filter='brightness(70%)';"
                                                    onmouseout="this.style.filter='brightness(100%)';"
                                                    class="img-responsive">
                                            </a>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
    $('.image-popup').magnificPopup({
    gallery: {
        enabled: true // Aktifkan galeri untuk navigasi antar video
    },
    callbacks: {
        elementParse: function(item) {
            // Deteksi gambar berdasarkan ekstensi URL
            if (item.src.match(/\.(jpg|jpeg|png|gif|heic)$/i)) {
                item.type = 'image'; // Tetapkan sebagai gambar
            }
            // Deteksi video YouTube
            else if (item.src.indexOf('youtube.com') !== -1 || item.src.indexOf('youtu.be') !== -1) {
                item.type = 'iframe'; // Tetapkan iframe untuk YouTube
            }
            // Deteksi video MP4
            else if (item.src.match(/\.(mp4)$/i)) {
                item.type = 'iframe'; // Tetapkan iframe untuk MP4
            }
        }
    },
    titleSrc: function(item) {
        return item.el.attr('title'); // Mengambil title dari atribut elemen
    }
});
</script>
@endsection
