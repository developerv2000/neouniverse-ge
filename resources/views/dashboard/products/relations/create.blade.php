@extends('dashboard.layouts.app')
@section("main")

<form class="inner-form" action="{{ route('products.relations.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="model" value="{{ $model }}">

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

    <div class="inner-form__actions">
        <button class="button button--main" type="submit">
            <span class="material-icons-outlined">done_all</span> Добавить
        </button>
    </div>
</form>

@endsection