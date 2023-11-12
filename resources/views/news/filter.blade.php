<form action="#" class="filter news-filter" id="news_filter_form">
    {{-- Categories select start --}}
    <div class="news-filter__select-container">
        <select class="filter-select news__filter-select" name="category_id">
            <option value="0">{{ __('Категория') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if($category->id == $request->category_id) selected @endif>{{ $category[$locale . '_name'] }}</option>
            @endforeach
        </select> {{-- Categories select end --}}
    </div>

    {{-- Search start --}}
    <div class="search filter__search">
        <input type="text" class="search__input" name="keyword" value="{{ $request->keyword }}" id="news_filter_search">
        <label class="filter__search-label">{{ __('По ключевым словам') }}
            {{-- first span is used to minify placeholder text on mobile (is hidden on mobile) --}}
            <span>, {{ __('например') }}</span>
            {{-- second span is used to colorize placeholder (is hidden on mobile) --}}
            @if(count($highlightedCategories))
                <span class="filter__search-placeholder">
                    @foreach ($highlightedCategories as $category)
                        @if($loop->last)
                            <a href="{{ route('news.index', ['category_id' => $category->id]) }}#news_filter_form">{{ $category->name }}</a>
                        @else
                            <a href="{{ route('news.index', ['category_id' => $category->id]) }}#news_filter_form">{{ $category->name }},</a>
                        @endif
                    @endforeach
                </span>
            @endif
        </label>
        <button type="button" class="search__button">
            <span class="material-icons-outlined search__icon">search</span>
        </button>
    </div> {{-- Search end --}}
</form>