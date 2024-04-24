<footer class="footer">
    {{-- Initialize map coordinates --}}
    @php
        $mapLatitude = App\Models\Option::where('tag', 'map-lat-coordinates')->first();
        $mapLongitude = App\Models\Option::where('tag', 'map-lng-coordinates')->first();
        $markerLatitude = App\Models\Option::where('tag', 'marker-lat-coordinates')->first();
        $markerLongitude = App\Models\Option::where('tag', 'marker-lng-coordinates')->first();
    @endphp

    <script>
        let map_latitude = {{ $mapLatitude[$localedValue]}};
        let map_longitude = {{ $mapLongitude[$localedValue]}};
        let marker_latitude = {{ $markerLatitude[$localedValue]}};
        let marker_longitude = {{ $markerLongitude[$localedValue]}};
    </script>

    <div class="contact-us" id="contact_us">
        <div class="main-container contact-us__inner" style="background-image: url({{ asset('img/main/contact-us-pattern.svg') }})">
            <h1 class="main-title contact-us__title">{{ __('Свяжитесь с нами') }}!</h1>

            <form action="{{ route('email.feedback') }}" method="POST" class="contact-us__form" id="feedback-form">
                @csrf

                <div class="contact-us__email">
                    <label class="contact-us__label" for="feedback-email">{{ __('Почта') }}</label>
                    <input type="email" name="email" id="feedback-email"  class="contact-us__input" required>
                </div>

                <div class="contact-us__text">
                    <label class="contact-us__label" for="feedback-text">{{ __('Как мы можем Вам помочь') }}?</label>
                    <input type="text" name="text" id="feedback-text" class="contact-us__input" required>
                </div>

                <div class="button_style_more contact-us__submit">
                    <button class="g-recaptcha" type="submit" data-sitekey="6LeTtHcpAAAAANDcYSO5J8Kbpd6tYjERQ4-vocAG" data-callback='onRecaptchaSubmit' data-action='submit'>{{ __('Отправить') }}
                        <span class="material-icons-outlined">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($route == 'home')
        <div class="footer__news">
            <div class="footer__news-inner main-container">
                <div class="title_with_explore_more footer__news-title">
                    <h1 class="main-title">{{ __('Новости') }}</h1>
                    <a href="{{ route('news.index') }}">{{ __('Все новости') }} <span class="material-icons-outlined">arrow_forward</span></a>
                </div>

                <x-news.list :news="$news"/>
            </div>
        </div>
    @endif

    @if ($route == 'products.index')
        <div class="footer__supervision">
            <div class="footer__supervision main-container">
                {!! $supervisionForm !!}
            </div>
        </div>
    @endif

    <div class="footer-map">
        <div class="main-container footer__contacts">
            <div class="footer__contacts-inner">
                <div class="footer__contacts-block">
                    <div class="footer__socials">
                        @php $facebook = App\Models\Option::where('tag', 'facebook')->first(); @endphp
                        <a href="{{ $facebook[$localedValue] }}" class="footer__socials-link" target="_blank">
                            @include('svgs.facebook')
                        </a>

                        @php $instagram = App\Models\Option::where('tag', 'instagram')->first(); @endphp
                        <a href="{{ $instagram[$localedValue] }}" class="footer__socials-link" target="_blank">
                            @include('svgs.instagram')
                        </a>
                    </div>

                    @php $address = App\Models\Option::where('tag', 'address')->first(); @endphp
                    <p class="footer__contacts-address">
                        {{ $address[$localedValue] }}
                    </p>

                    @php $email = App\Models\Option::where('tag', 'email')->first(); @endphp
                    <a href="mailto:{{ $email[$localedValue] }}" class="footer__contacts-link">
                        {{ $email[$localedValue] }}
                    </a>

                    @php $phone = App\Models\Option::where('tag', 'phone')->first(); @endphp
                    <a href="tel:{{ str_replace(' ', '', $phone[$localedValue]) }}" class="footer__contacts-link">
                        {{ $phone[$localedValue] }}
                    </a>
                </div>
            </div>
        </div>

        <div id="map"></div>
    </div>

    <div class="main-container footer-bottom">
        <a href="{{ route('home') }}">
            <img class="footer__logo" src="{{ asset('img/main/logo-black.svg') }}" alt="Neo universe logo">
        </a>
        <p class="copyright">© 2012-{{date('Y')}} {{ __('NEO UNIVERSE. Все права защищены') }}</p>
    </div>
</footer>
