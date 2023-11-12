@extends('dashboard.layouts.app')
@section("main")

<form class="inner-form" action="{{ route('news.categories.update') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="id" value="{{ $category->id }}">

    <div class="form-group">
        <label>Заголовок на русском <span>*</span></label>
        <input class="form-input" name="ru_name" type="text" value="{{ $category->ru_name }}" required>
    </div>

    <div class="form-group">
        <label>Заголовок на английском</label>
        <input class="form-input" name="en_name" type="text" value="{{ $category->en_name }}">
    </div>

    <div class="form-group">
        <label>Заголовок на грузинкском</label>
        <input class="form-input" name="ka_name" type="text" value="{{ $category->ka_name }}">
    </div>

    <div class="form-group">
        <label>
            Показать в строке фильтра/поиска новостей, как ключевое слово, на <a href="{{ route('news.index') }}" target="_blank">главной странице новостей</a> ? <span>*</span>. Не рекомендуется добавлять больше 3 категорий в строке фильтра/поиска !
        </label>

        <select class="selectize-singular" name="highlight_in_filter" required>
            <option value="0" {{ !$category->highlight_in_filter ? 'selected' : '' }}>Нет</option>
            <option value="1" {{ $category->highlight_in_filter ? 'selected' : '' }}>Да</option>
        </select>
    </div>

    <div class="inner-form__actions">
        <input name="intended_url" type="hidden" value="{{ url()->previous() }}">

        <button class="button button--main" type="submit">
            <span class="material-icons-outlined">done_all</span> Сохранить
        </button>

        <button class="button button--secondary" type="button" data-bs-toggle="modal" data-bs-target="#remove_item_modal">
            <span class="material-icons-outlined">delete</span> Удалить
        </button>
    </div>

</form>

{{-- Remove Single Items Modal Start --}}
<div class="modal fade" id="remove_item_modal" tabindex="-1" aria-labelledby="remove_item_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remove_item_modal_label">Удалить</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                Вы уверены что хотите удалить ?
            </div>

            <div class="modal-footer">
                <button type="button" class="button button--thirdinary" data-bs-dismiss="modal">Отмена</button>

                <form action="{{ route('news.categories.remove') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $category->id }}" name="id" id="remove_item_modal_input">
                    <button type="submit" class="button button--secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Remove Single Items Modal End --}}

@endsection
