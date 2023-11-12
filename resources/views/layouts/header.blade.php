<header class="header">
    {{-- Main container start --}}
    <div class="main-container header__inner">
        {{-- Logo start --}}
        <a href="{{ route('home') }}" class="logo">
            <img class="logo__image" src="{{ asset('img/main/logo.svg') }}" alt="Neo universe logo">
        </a>  {{-- Logo end --}}

        {{-- Search start --}}
        <form class="search header__search-form" action="{{ route('search') }}" onsubmit="return false;">
            <input type="text" class="search__input header__search-input" placeholder="{{ __('Поиск') }}" id="header_search_input">
            <button type="button" class="search__button">
                <span class="material-icons-outlined search__icon">search</span>
            </button>

            <div class="search__result" id="header_search_result"></div>
        </form>  {{-- Search end --}}

        {{-- Navbar start --}}
        <nav class="navbar">
            <ul class="navbar__list">
                <li class="navbar__item">
                    <a class="navbar__link @if($route == 'aboutUs') navbar__link--active @endif" href="{{ route('aboutUs') }}">{{ __('О нас') }}</a>
                </li>

                <li class="navbar__item">
                    <a class="navbar__link @if($route == 'products.index' || $route == 'products.single') navbar__link--active @endif" href="{{ route('products.index') }}">{{ __('Продукты') }}</a>
                </li>

                <li class="navbar__item">
                    <a class="navbar__link  @if($route == 'news.index' || $route == 'news.single') navbar__link--active @endif" href="{{ route('news.index') }}">{{ __('Новости') }}</a>
                </li>
            </ul>
        </nav>  {{-- Navbar end --}}

        {{-- Contact start --}}
        <a href="#contact_us" class="header__contact-us">
            <span class="material-icons-outlined search__icon">portrait</span> {{ __('Связаться с нами') }}
        </a>  {{-- Contact end --}}

        @if(count($locales))
            <div class="dropdown language-dropdown">
                <button class="dropdown__button">
                    {{ $localeShortName = App\Models\Locale::where('value', $locale)->first()->short_name }}
                    <span class="material-icons-outlined dropdown__button-icon">expand_more</span>
                </button>

                <div class="dropdown__content">
                    @foreach ($locales as $loc)
                        <form class="dropdown__item" action="{{ route('locale.switch') }}" method="POST">
                            @csrf
                            <input type="hidden" name="locale" value="{{ $loc->value }}">
                            <button class="language-button"><img src="{{ asset('img/main/') . '/' . $loc->image }}"> {{ $loc->short_name }}</button>
                        </form>
                    @endforeach
                </div>
            </div>
        @endif

    </div>  {{-- Main container end --}}
</header>
