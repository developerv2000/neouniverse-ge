<form action="#" class="filter products-filter" id="product_filter_form">
    {{-- Products top filter start --}}
    <div class="products-filter__top">
        {{-- Filter by prescription start --}}
        <div class="prescription-filter">
            <input type="radio" id="all_rx_and_otc" name="prescription" value="all" @if($request->prescription == 'all' || $request->prescription == '') checked @endif>
            <label for="all_rx_and_otc">{{ __('Все') }}</label>

            <input type="radio" id="otc" name="prescription" value="0" @if($request->prescription == '0') checked @endif>
            <label for="otc">{{ __('OTC') }}</label>

            <input type="radio" id="rx" name="prescription" value="1" @if($request->prescription == '1') checked @endif>
            <label for="rx">{{ __('RX') }}</label>
        </div> {{-- Filter by prescription end --}}

        {{-- Search start --}}
        <div class="search filter__search">
            <input type="text" class="search__input" name="keyword" value="{{ $request->keyword }}" id="products_filter_search">
            
            <label class="filter__search-label">{{ __('По названию или веществу') }}
                {{-- first span is used to minify placeholder text on mobile (is hidden on mobile) --}}
                <span>, {{ __('например') }}</span>
                {{-- second span is used to colorize placeholder (is hidden on mobile) --}}
                @if(count($highlightedProducts))
                    <span class="filter__search-placeholder">
                        @foreach ($highlightedProducts as $product)
                            @if($loop->last)
                                <a href="{{ route('products.single', $product->url) }}">{{ $product->name }}</a>
                            @else
                                <a href="{{ route('products.single', $product->url) }}">{{ $product->name }},</a>
                            @endif
                        @endforeach
                    </span>
                @endif
            </label>

            <button type="button" class="search__button">
                <span class="material-icons-outlined search__icon">search</span>
            </button>
        </div> {{-- Search end --}}
    </div>{{-- Products top filter end --}}

    {{-- Products bottom fitler start --}}
    <div class="products-filter__bottom">
        <div class="products-filter__bottom-item">
            <select class="filter-select products__filter-select" name="category_id">
                <option value="0">{{ __('Направления') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == $request->category_id) selected @endif>{{ $category[$locale . '_name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="products-filter__bottom-item">
            <select class="filter-select products__filter-select" name="symptom_id">
                <option value="0">{{ __('Симптомы') }}</option>
                @foreach ($symptoms as $symptom)
                    <option value="{{ $symptom->id }}" @if($symptom->id == $request->symptom_id) selected @endif>{{ $symptom[$locale . '_name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="products-filter__bottom-item">
            <select class="filter-select products__filter-select" name="form_id">
                <option value="0">{{ __('Форма выпуска') }}</option>
                @foreach ($forms as $form)
                    <option value="{{ $form->id }}" @if($form->id == $request->form_id) selected @endif>{{ $form[$locale . '_name'] }}</option>
                @endforeach
            </select>
        </div>
    </div> {{-- Products bottom fitler end --}}
</form>