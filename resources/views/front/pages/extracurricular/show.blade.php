@extends('front.app')

@section('seo')
<title>{{ $title }}</title>
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $meta_description }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('extracurricular.show', $extracurricular->slug) }}">
<link rel="canonical" href="{{ route('extracurricular.show', $extracurricular->slug) }}">
<meta property="og:image" content="{{ $extracurricular->getLogo() }}">
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
                            {{ $extracurricular->name }}

                        </span></h2>

                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item active">Personalia</li>
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
                    <div class="col-md-3">
                        <div class="blog-item-img">
                            <img src="{{ $extracurricular->getLogo() }}" alt="{{ $extracurricular->name }}" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-9">
						<div class="teachers-archive">
                            <h2 class="widget-title text-capitalize"><span>{{ $extracurricular->name }}</span></h2>
							{{ $extracurricular->description }}
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
