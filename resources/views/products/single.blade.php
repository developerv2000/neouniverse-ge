@extends('layouts.app')

@section("title", $product[$locale . '_name'])

@section("meta-tags")
    @php
        //remove tags and slice body
        $shareText = preg_replace('#<[^>]+>#', ' ', $product[$locale . '_description']);
        $shareText = mb_strlen($shareText) < 170 ? $shareText : mb_substr($shareText, 0, 166) . '...';
    @endphp
    <meta name="description" content="{{ $shareText }}">
    <meta property="og:description" content="{{ $shareText }}">
    <meta property="og:title" content="{{ $product[$locale . '_name'] }}" />
    <meta property="og:image" content="{{ asset('img/products/thumbs/' . $product[$locale . '_image']) }}">
    <meta property="og:image:alt" content="{{ $product[$locale . '_name'] }}">
    <meta name="twitter:title" content="{{ $product[$locale . '_name'] }}">
    <meta name="twitter:image" content="{{ asset('img/products/thumbs/' . $product[$locale . '_image']) }}">
@endsection

@section('main')
<main class="main single-product" id="main" role="main">
    {{-- Breadcrumbs start --}}
    <section class="breadcrumbs">
        <div class="breadcrumbs__inner main-container">
            <ul class="breadcrumbs__ul">
                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ route('home') }}">{{ __('Главная') }}</a>
                </li>

                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ route('products.index') }}">{{ __('Продукты') }}</a>
                </li>

                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link">
                        @foreach ($product->categories as $category)
                            @if ($loop->last)
                                {{ $category[$locale . '_name']}}
                            @else
                                {{ $category[$locale . '_name']}} /
                            @endif
                        @endforeach
                    </a>
                </li>

                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ route('products.single', $product->url) }}">{{ $product[$locale . '_name']}}</a>
                </li>
            </ul>
        </div>
    </section> {{-- Breadcrumbs end --}}

    {{-- Product Inner start --}}
    <section class="product-content">
        <div class="product-content__inner main-container">
            <h1 class="product-content__title main-title">{{ $product[$locale . '_name'] }}</h1>
            {{-- Product image start --}}
            <div class="product-content__image-container">
                <img class="product-content__image" src="{{ asset('img/products/' . $product[$locale . '_image']) }}" alt="{{ $product[$locale . '_name'] }}">
                <span class="product-content__prescription {{ $product->prescription ? 'product-content__prescription--rx' : 'product-content__prescription--otc' }}">{{ $product->prescription ? __('RX') : __('OTC') }}</span>
            </div> {{-- Product image end --}}

            {{-- Product content body start --}}
            <div class="product-content__body">
                <p class="product-content__amount">{{ $product[$locale . '_amount'] }}</p>

                <div class="product-content__description">{!! $product[$locale . '_description'] !!}</div>
                <div class="product-content__categories">
                    @foreach ($product->categories as $category)
                        <a class="{{ $product->prescription ? 'product-content__categories--rx' : 'product-content__categories--otc' }}" href="{{ route('products.index') . '?category_id=' . $category->id . '#all_products'}}">
                            {{ $category[$locale . '_name']; }}
                        </a>
                    @endforeach
                </div>

                {{-- Actions start --}}
                <div class="product-content__actions">
                    <a href="{{ asset('instructions') . '/' . $product[$locale . '_instruction'] }}" class="action" target="blank">
                        <span class="material-icons-outlined action__icon">file_download</span>

                        <div class="action__div">
                            <h6 class="action__title">{{ __('Скачать') }}</h6>
                            <p class="action__text">{{ __('инструкцию') }}</p>
                        </div>
                    </a>
                    
                    @if($product[$locale . '_obtain_link'] != '')
                    <a href="{{ $product[$locale . '_obtain_link'] }}" class="action" target="_blank">
                        <span class="material-icons-outlined action__icon">shopping_cart</span>

                        <div class="action__div">
                            <h6 class="action__title">{{ __('Приобрести') }}</h6>
                            <p class="action__text">{{ __('препарат') }}</p>
                        </div>
                    </a>
                    @endif
                </div> {{-- Actions end --}}

                {{-- Accordion start --}}
                <div class="accordion product-accordion">
                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Состав') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                {!! $product[$locale . '_composition'] !!}
                            </div>
                        </div>
                    </div>

                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Показания к применению') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                {!! $product[$locale . '_testimony'] !!}
                            </div>
                        </div>
                    </div>

                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Способ применения') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                {!! $product[$locale . '_use'] !!}
                            </div>
                        </div>
                    </div>
                </div> {{-- Accordion end --}}
            </div> {{-- Product content body end --}}
        </div> {{-- Product content inner end --}}
    </section> {{-- Product Inner end --}}

    @if(count($similar_products) > 1)
        <section class="similar-products">
            <div class="similar-products__inner main-container">
                <div class="title_with_explore_more similar-products__title">
                    <h1 class="main-title">{{ __('Похожие продукты') }}</h1>
                    <a href="{{ route('products.index') }}">{{ __('Все продукты') }} <span class="material-icons-outlined">arrow_forward</span></a>
                </div>

                <x-products.carousel class="similar-products-carousel-container" :products="$similar_products"/>
            </div>
        </section>
    @endif

</main>
@endsection