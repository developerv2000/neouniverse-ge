@props(['class' => '', 'product'])

<div class="{{$class}} products-card">
    <a href="{{ route('products.single', $product->url) }}" class="products-card__image-container">
        <img class="products-card__image" src="{{ asset('img/products/thumbs/' . $product[$locale . '_image']) }}" alt="{{ $product[$locale . '_name'] }}">
        <span class="products-card__prescription {{ $product->prescription ? 'products-card__prescription--rx' : 'products-card__prescription--otc' }}">{{ $product->prescription ? __('RX') : __('OTC') }}</span>
    </a>

    <h2 class="products-card__title">{{ $product[$locale . '_name'] }}</h2>

    <div class="products-card__categories">
        @foreach ($product->categories as $category)
            <a class="{{ $product->prescription ? 'products-card__categories--rx' : 'products-card__categories--otc' }}" href="{{ route('products.index') . '?category_id=' . $category->id . '#all_products'}}">
                {{ $category[$locale . '_name']; }}
            </a>
        @endforeach
    </div>
    
    <div class="products-card__description">{!! $product[$locale . '_description'] !!}</div>
</div>