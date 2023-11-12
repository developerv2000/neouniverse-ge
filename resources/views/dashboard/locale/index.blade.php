@extends('dashboard.layouts.app')
@section("main")

<div class="alert alert-success">
    Отображение переключателя языков на верхнем меню.
</div>

<form action="{{ route('locale.update.switcher') }}" class="inner-form" method="POST">
    @csrf

    @foreach ($locales as $locale)
        <div class="form-group">
            <div class="checkbox-container">
                <input type="checkbox" id="locale{{ $locale->id }}" name="{{ $locale->value }}" {{ $locale->visibility ? 'checked' : ''}}>
                <label for="locale{{ $locale->id }}"><img src="{{ asset('img/main/' . $locale->image) }}">  {{ $locale->name }}</label>
            </div>
        </div>
    @endforeach

    <div class="inner-form__actions">
        <button class="button button--main" type="submit">
            <span class="material-icons-outlined">done_all</span> Сохранить
        </button>
    </div>
</form>

@endsection