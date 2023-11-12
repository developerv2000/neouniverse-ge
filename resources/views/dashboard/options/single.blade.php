@extends('dashboard.layouts.app')
@section("main")

<form class="inner-form" action="{{ route('options.update') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="id" value="{{ $option->id }}">

    <div class="form-group">
        <label>Значение на русском <span>*</span></label>
        <textarea class="{{ $option->wysiwyg ? 'simditor-wysiwyg' : 'form-textarea' }}" name="ru_value" required rows="6">{{ $option->ru_value }}</textarea>
    </div>

    <div class="form-group">
        <label>Значение на английском <span>*</span></label>
        <textarea class="{{ $option->wysiwyg ? 'simditor-wysiwyg' : 'form-textarea' }}" name="en_value" required rows="6">{{ $option->en_value }}</textarea>
    </div>

    <div class="form-group">
        <label>Значение на грузинском <span>*</span></label>
        <textarea class="{{ $option->wysiwyg ? 'simditor-wysiwyg' : 'form-textarea' }}" name="ka_value" required rows="6">{{ $option->ka_value }}</textarea>
    </div>

    <div class="inner-form__actions">
        <input name="intended_url" type="hidden" value="{{ url()->previous() }}">

        <button class="button button--main" type="submit">
            <span class="material-icons-outlined">done_all</span> Сохранить
        </button>
    </div>

</form>

@endsection
