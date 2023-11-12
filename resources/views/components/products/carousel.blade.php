@props(['products', 'class' => ''])

<div class="products-carousel-container {{ $class }}">
    <div class="owl-carousel products-carousel" id="products_carousel">
        @foreach ($products as $product)
            <x-products.card class="products-carousel__item" :product="$product" />
        @endforeach
    </div>
    
    <span class="material-icons-outlined unselectable owl-nav owl-nav--prev products-carousel__owl-nav--prev">arrow_back_ios</span>
    <span class="material-icons-outlined unselectable owl-nav owl-nav--next products-carousel__owl-nav--next">arrow_forward_ios</span>
</div>