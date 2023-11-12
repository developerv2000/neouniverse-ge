{{-- Main carousel start --}}
<section class="main-carousel owl-carousel-container">
    <div class="main-carousel__inner owl-carousel" id="main_carousel">

        @foreach ($carouselItems as $item)
            <div class="main-carousel__item">
                <div class="main-carousel__item-inner">
                    <img class="main-carousel__image" src="{{ asset('img/carousel/' . $item[$locale . '_image']) }}" alt="{{ $item[$locale . '_title'] }}">

                    <div class="main-carousel__text">
                        <h1 class="main-carousel__title">{{ $item[$locale . '_title'] }}</h1>
                        <p class="main-carousel__description">{{ $item[$locale . '_description'] }}</p>
                        <div class="button_style_more main-carousel__button">
                            <a href="{{ route('products.single', $item->product->url ?? '#') }}">{{ __('Подробнее') }}
                                <span class="material-icons-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

                <span class="material-icons-outlined unselectable owl-nav owl-nav--prev main-carousel__owl-nav--prev">arrow_back_ios</span>
                <span class="material-icons-outlined unselectable owl-nav owl-nav--next main-carousel__owl-nav--next">arrow_forward_ios</span>
            </div>
        @endforeach

    </div>
</section> {{-- Main carousel end --}}