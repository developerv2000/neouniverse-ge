@if(!count($products))
    <div class="warning">
        {{ __('По вашему запросу ничего не найдено') }}! {{ __('Пожалуйста, попробуйте новый поиск') }}. 
    </div>
@endif

<div class="products-list" id="products_list">
    @foreach ($products as $product)
        <x-products.card :product="$product" />
    @endforeach
</div>

{{ $products->links('layouts.pagination') }}