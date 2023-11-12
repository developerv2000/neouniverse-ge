@extends('layouts.app')

@section('title', __('О нас'))

@section('main')
<main class="main about" id="main" role="main">
    <x-main-carousel/>
    {{-- About text start --}}
    <section class="about__text">
        <div class="about__text-inner main-container">
            <h1 class="about__title main-title">{{ __('О нашей компании') }}</h1>
    
            <div class="about__text-body">
                @php $aboutCompany = App\Models\Option::where('tag', 'about-company')->first(); @endphp
                {!! $aboutCompany[$localedValue] !!}
            </div>
        </div>
    </section> {{-- About text start --}}

    {{-- Corporate culture start --}}
    <section class="corporate-culture">
        <div class="corporate-culture__inner main-container">
            <div class="our-wealth">
                <h1 class="main-title our-wealth__title">{{ __('Мы ценим') }}</h1>
                {{-- Our Wealth accordion start --}}
                <div class="accordion">
                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Здоровье') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                @php $health = App\Models\Option::where('tag', 'wealth-health')->first(); @endphp
                                {{ $health[$localedValue] }}
                            </div>
                        </div>
                    </div>

                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Эффективность в работе') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                @php $efficiency = App\Models\Option::where('tag', 'wealth-efficiency')->first(); @endphp
                                {{ $efficiency[$localedValue] }}
                            </div>
                        </div>
                    </div>

                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Уверенность') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                @php $confidence = App\Models\Option::where('tag', 'wealth-confidence')->first(); @endphp
                                {{ $confidence[$localedValue] }}
                            </div>
                        </div>
                    </div>

                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Обязанность') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                @php $duty = App\Models\Option::where('tag', 'wealth-duty')->first(); @endphp
                                {{ $duty[$localedValue] }}
                            </div>
                        </div>
                    </div>
                </div> {{-- Our Wealth accordion end --}}
            </div> {{-- Our Wealth end --}}
    
            {{-- Our Base start --}}
            <div class="our-base">
                <h1 class="main-title our-base__title">{{ __('Наша основа') }}</h1>
                {{-- Our Base accordion start --}}
                <div class="accordion">
                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Стратегия') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                @php $strategy = App\Models\Option::where('tag', 'base-strategy')->first(); @endphp
                                {{ $strategy[$localedValue] }}
                            </div>
                        </div>
                    </div>

                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Миссия') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                @php $mission = App\Models\Option::where('tag', 'base-mission')->first(); @endphp
                                {{ $mission[$localedValue] }}
                            </div>
                        </div>
                    </div>

                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Цель') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                @php $aim = App\Models\Option::where('tag', 'base-aim')->first(); @endphp
                                {{ $aim[$localedValue] }}
                            </div>
                        </div>
                    </div>

                    <div class="accordion__item">
                        <button class="accordion__button">{{ __('Ценность') }} <span class="material-icons-outlined accordion__button-icon">chevron_right</span></button>
                        <div class="accordion__collapse">
                            <div class="accordion__collapse-body">
                                @php $wealth = App\Models\Option::where('tag', 'base-wealth')->first(); @endphp
                                {{ $wealth[$localedValue] }}
                            </div>
                        </div>
                    </div>
                </div> {{-- Our Base accordion end --}}
            </div> {{-- Our Base end --}}

        </div> {{-- Corporate culture inner end --}}
    </section> {{-- Corporate culture end --}}

    <section class="slogan">
        <div class="slogan__inner main-container">
            <a href="{{ route('products.index') }}" class="slogan__text">{{ __('Здоровье – новые возможности') }}</a>
        </div>
    </section>

</main>

@endsection