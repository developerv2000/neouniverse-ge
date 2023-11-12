@extends('layouts.app')

@section('main')
<section class="error-page">
    <div class="error-page__inner main-container">
        <div class="error-page__txt">
            <h1 class="error-page__title main-title">{{ __('Страница не найдена') }}!
            </h1>
            <p class="error-page__desc">{{ __('Ошибка') }}. {{ __('Страница не найдена') }}.<br>
                {{ __('Возможно она была удалена или перемещена на другой адрес') }}.
            </p>

            <div class="button_style_more error-page__button">
                <a href="{{ route('home') }}">{{ __('Вернуться домой') }}
                    <span class="material-icons-outlined">home</span>
                </a>
            </div>
        </div>

        <div class="error-page__image-container">
            <img class="error-page__image" src="{{ asset('img/main/404.png') }}"
                alt="not found">
        </div>
    </div>
</section>
@endsection
