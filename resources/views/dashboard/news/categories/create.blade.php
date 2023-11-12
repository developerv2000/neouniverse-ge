@extends('dashboard.layouts.app')
@section("main")

<form class="inner-form" action="{{ route('news.categories.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label>Заголовок на русском <span>*</span></label>
        <input class="form-input" name="ru_name" type="text" value="{{ old('ru_name') }}" required>
    </div>

    <div class="form-group">
        <label>Заголовок на английском</label>
        <input class="form-input" name="en_name" type="text" value="{{ old('en_name') }}">
    </div>

    <div class="form-group">
        <label>Заголовок на грузинкском</label>
        <input class="form-input" name="ka_name" type="text" value="{{ old('ka_name') }}">
    </div>

    <div class="form-group">
        <label>
            Показать в строке фильтра/поиска новостей, как ключевое слово, на <a href="{{ route('news.index') }}" target="_blank">главной странице новостей</a> ? <span>*</span>. Не рекомендуется добавлять больше 3 категорий в строке фильтра/поиска !
        </label>
        
        <select class="selectize-singular" name="highlight_in_filter" required>
            <option value="0">Нет</option>
            <option value="1">Да</option>
        </select>
    </div>

    <div class="inner-form__actions">
        <button class="button button--main" type="submit">
            <span class="material-icons-outlined">done_all</span> Добавить
        </button>
    </div>
</form>

@endsection