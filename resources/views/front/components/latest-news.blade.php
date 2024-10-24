@php

    $latest_news = App\Models\News::latest()
        ->with(['category', 'user', 'viewers', 'comments'])
        ->where('status', 'published')
        ->limit(4)
        ->get();
@endphp
<div class="side-bar-widget">
    <h2 class="widget-title text-capitalize"><span>Berita </span>Terbaru.</h2>
    <div class="latest-news-posts">
        @foreach ($latest_news as $latest)
            <div class="latest-news-area">
                <div class="latest-news-thumbnile relative-position">
                    <img src="{{ $latest->getThumbnail() }}" alt="">
                    <div class="hover-search">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="blakish-overlay"></div>
                </div>
                <div class="date-meta">
                    <i class="fas fa-calendar-alt"></i>
                    {{ $latest->created_at->diffForHumans() }}
                </div>
                <h3 class="latest-title bold-font"><a
                        href="{{ route('news.show', $latest->slug) }}">
                        {{ Str::limit($latest->title, 50) }}
                    </a>
                </h3>
            </div>
        @endforeach


        <div class="view-all-btn bold-font">
            <a href="{{ route('news.index') }}">Lihat Semua berita <i
                    class="fas fa-chevron-circle-right"></i></a>
        </div>
    </div>
</div>
