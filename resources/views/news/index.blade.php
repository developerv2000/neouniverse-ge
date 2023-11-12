@extends('layouts.app')

@section('title', __('Новости'))

@section('main')
<main class="main news" id="main" role="main">
    <x-main-carousel/>

    {{-- Products text start --}}
    <section class="all-news" id="all_news">
        <div class="all-news__inner main-container">
            <h1 class="all-news__title main-title">{{ __('Все новости') }} <span>{{ $newsCount }} {{ __('статей') }}</span></h1>
    
            <div class="all-news__text">
                @php $aboutNews = App\Models\Option::where('tag', 'about-news')->first(); @endphp
                {{ $aboutNews[$localedValue] }}
            </div>

            @include('news.filter')

            <div class="news-list-container" id="news_list_container">
                <x-news.list :news="$news" />
            </div>
        </div>
    </section> {{-- Products text end --}}

</main>
@endsection