@extends('dashboard.layouts.app')
@section("main")

@if($model == 'Form')
    <div class="alert alert-success">
        Будьте внимательны при удалении форм. Так как продукт с удаляемой формой останется без формы. Вам вручную нужно будет задать им новую новую форму.
    </div>
@endif

{{-- List start --}}
<div class="main-list">
    {{-- List Titles start --}}
    <div class="titles">

        <div class="titles__item">
            <a>Заголовок</a>
        </div>

        <div class="titles__actions">
            <a>Действие</a>
        </div>

    </div> {{-- List Titles end --}}


    {{-- Main Form start --}}
    <form action="{{ route('products.relations.remove.multiple') }}" class="main-form" method="POST" id="main_form">
        @csrf
        <input type="hidden" value="{{$model}}" name="model">

        @foreach ($items as $item)
            <div class="list__item">
                <div class="checkbox">
                    <label for="{{$item->id}}" class="checkbox__label">
                        <input class="checkbox__input" id="{{$item->id}}" type="checkbox" name="ids[]" value="{{$item->id}}">
                        <span class="checkbox__checkmark"></span>
                    </label>
                </div>

                <div class="list__item-block">{{ $item->ru_name }}</div>

                <div class="list__item-actions">
                    <a class="actions__button button--thirdinary" href="{{ route('dashboard.products.relations.single', $item->id) }}?model={{$model}}" 
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                        <span class="material-icons">edit</span>
                    </a>

                    <button class="actions__button button--secondary" type="button" onclick="show_item_remove_modal({{ $item->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить">
                        <span class="material-icons">delete</span>
                    </button>
                </div>
            </div>
        @endforeach
    </form> {{-- Main Form end --}}

</div> {{-- List end --}}


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
                    <input type="hidden" value="0" name="id" id="remove_item_modal_input" />
                    <input type="hidden" value="{{$model}}" name="model">
                    <button type="submit" class="button button--secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Remove Single Items Modal End --}}


{{-- Remove Multiple Items Modal Start --}}
<div class="modal fade" id="remove_items_modal" tabindex="-1" aria-labelledby="remove_items_modal_label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remove_items_modal_label">Удалить</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                Вы уверены что хотите удалить отмеченные ?<br><br>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="button button--thirdinary" data-bs-dismiss="modal">Отмена</button>
                <button type="button" class="button button--secondary" onclick="submit_main_form()">Удалить</button>
            </div>
        </div>
    </div>
</div>
{{-- Rmove Multiple Items Modal End --}}

@endsection