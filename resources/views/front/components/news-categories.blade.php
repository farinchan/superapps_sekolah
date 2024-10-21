@php
    $categories = \App\Models\NewsCategory::with('news')->get();
@endphp


<div class="side-bar-widget">
    <h2 class="widget-title text-capitalize"><span>Kategori</span> berita.</h2>
    <div class="post-categori ul-li-block">
        <ul>
            @foreach ($categories as $category)
                <li class="cat-item"><a
                        href="{{ route('news.category', $category->slug) }}">{{ $category->name }} ({{ $category->news->count() }})
                    </a>
                </li>

            @endforeach
        </ul>
    </div>
</div>
