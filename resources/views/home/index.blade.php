@extends('layouts.app')

@section('main')
<main class="main home" id="main" role="main">
    <x-main-carousel />

    <section class="home__about">
        <div class="home__about-inner main-container">
            <div class="home__about-title title_with_explore_more">
                <h1 class="main-title">{{ __('О нас') }}</h1>
                <a href="{{ route('aboutUs') }}">{{ __('Подробнее о
                    NEOUNIVERSE') }} <span
                        class="material-icons-outlined">arrow_forward</span></a>
            </div>

            <div class="about-cards">
                <div class="about-cards__item">
                    <p class="about-cards__counter">1</p>
                    <p class="about-cards__text">{{ __('Опыт работы') }}<br>
                        <b>{{ __('с') }} <span
                                class="about-cards__highlight">2001</span> {{
                            __('года') }}</b>
                    </p>
                </div>

                <div class="about-cards__item">
                    <p class="about-cards__counter">2</p>
                    <p class="about-cards__text">{{ __('Производство по') }}<br>
                        <b>{{ __('стандартам') }} <span
                                class="about-cards__highlight">{{ __('GMP')
                                }}</span></b>
                    </p>
                </div>

                <div class="about-cards__item">
                    <p class="about-cards__counter">3</p>
                    <p class="about-cards__text">{{ __('Более') }} <b><span
                                class="about-cards__highlight">100</span><br>
                            {{ __('продуктов') }}</b>
                    </p>
                </div>

                <div class="about-cards__item">
                    <p class="about-cards__counter">4</p>
                    <p class="about-cards__text">{{ __('Более') }}<span
                            class="about-cards__highlight"> <b>15</span><br>
                        {{ __('категорий') }}</b>
                    </p>
                </div>
            </div>

            <p class="home__about-text">
                @php $aboutUs = App\Models\Option::where('tag',
                'about-us')->first(); @endphp
                {{ $aboutUs[$localedValue] }}
            </p>

        </div>
    </section>

    <section class="home__products">
        <div class="home__products-inner main-container">
            <div class="title_with_explore_more home__products-title">
                <h1 class="main-title">{{ __('Продукты') }}</h1>
                <a href="{{ route('products.index') }}">{{ __('Все продукты') }}
                    <span
                        class="material-icons-outlined">arrow_forward</span></a>
            </div>

            <x-products.carousel :products="$products" />
        </div>
    </section>

</main>

@endsection
