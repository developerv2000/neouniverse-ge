@props(['class' => '', 'new'])

<div class="{{ $class }} news-card">
    <a class="news-card__img-container" href="{{ route('news.single', $new->url) }}">
        <img class="news-card__image" src="{{ asset('img/news/thumbs/' . $new[$locale . '_image']) }}" alt="{{ $new[$locale . '_title'] }}">
    </a>

    <h2 class="news-card__title">{{ $new[$locale . '_title'] }}</h2>
    <div class="news-card__body">{!! $new[$locale . '_body'] !!}</div>
    <a class="news-card__link" href="{{ route('news.single', $new->url) }}">{{ __('Подробнее') }}</a>
</div>