@extends('layouts.app')

@section('title', __('Продукты'))

@section('main')
<main class="main products" id="main" role="main">
    <x-main-carousel/>
    {{-- Products text start --}}
    <section class="products__text">
        <div class="products__text-inner main-container">
            <div class="about-products">
                <h1 class="about-products__title main-title">{{ __('О нашей продукции') }}</h1>
    
                <div class="about-products__text">
                    @php $aboutProducts = App\Models\Option::where('tag', 'about-products')->first(); @endphp
                    {{ $aboutProducts[$localedValue] }}
                </div>
            </div>

            <div class="products-warning">
                <h1 class="products-warning__title main-title">{{ __('Внимание') }}</h1>
    
                <div class="products-warning__text">
                    @php $productsWarning = App\Models\Option::where('tag', 'products-warning')->first(); @endphp
                    {{ $productsWarning[$localedValue] }}
                </div>
            </div>
        </div>
    </section> {{-- Products text end --}}

    <section class="all-products" id="all_products">
        <div class="all-products__inner main-container">
            <h1 class="all-products__title main-title">{{ __('Все продукты') }} <span>{{ $productsCount }} {{ __('продукта') }}</span></h1>

            @include('products.filter')
            <div class="products-list-container" id="products_list_container">
                <x-products.list :products="$products" />
            </div>
        </div>

    </section>

</main>
@endsection