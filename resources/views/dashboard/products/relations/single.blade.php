@extends('dashboard.layouts.app')
@section("main")

<form class="inner-form" action="{{ route('products.relations.update') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="id" value="{{ $item->id }}">
    <input type="hidden" name="model" value="{{ $model }}">

    <div class="form-group">
        <label>Заголовок на русском <span>*</span></label>
        <input class="form-input" name="ru_name" type="text" value="{{ $item->ru_name }}" required>
    </div>

    <div class="form-group">
        <label>Заголовок на английском</label>
        <input class="form-input" name="en_name" type="text" value="{{ $item->en_name }}">
    </div>

    <div class="form-group">
        <label>Заголовок на грузинкском</label>
        <input class="form-input" name="ka_name" type="text" value="{{ $item->ka_name }}">
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

                <form action="{{ route('products.relations.remove') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $item->id }}" name="id" id="remove_item_modal_input">
                    <input type="hidden" name="model" value="{{ $model }}">
                    <button type="submit" class="button button--secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Remove Single Items Modal End --}}

@endsection
