@extends('dashboard.layouts.app')
@section("main")

<div class="alert alert-success">
    Слева в ковычках идёт текст на русском. Ни в коем случае не меняйте текст на русском.
    <br>А переводы идут после двоеточия в ковычках, которых можно менять, исправлять итд.
</div>

<form class="inner-form" action="{{ route('translations.update') }}" method="POST" onsubmit="validate_json_input(event)">
    {{ csrf_field() }}

    <input type="hidden" name="tag" value="{{ $tag }}">

    <div class="form-group">
        <pre id="json-display"></pre>
        <input type="hidden" name="content" id="json-input" value="{{ $content }}">
    </div>

    <div class="inner-form__actions">
        <input name="intended_url" type="hidden" value="{{ url()->previous() }}">

        <button class="button button--main" type="submit">
            <span class="material-icons-outlined">done_all</span> Сохранить
        </button>
    </div>
</form>

@endsection
