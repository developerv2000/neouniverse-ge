@extends('dashboard.layouts.app')
@section("main")

@include('dashboard.layouts.search')

{{-- List start --}}
<div class="main-list">
    {{-- List Titles start --}}
    <div class="titles">

        <div class="titles__item">
            <a class="{{$orderType}} {{$orderBy == 'ru_title' ? 'active' : ''}}" href="{{route('dashboard.news.index')}}?page={{$activePage}}&orderBy=ru_title&orderType={{$reversedOrderType}}">Заголовок</a>
        </div>

        <div class="titles__item">
            <a class="{{$orderType}} {{$orderBy == 'created_at' ? 'active' : ''}}" href="{{route('dashboard.news.index')}}?page={{$activePage}}&orderBy=created_at&orderType={{$reversedOrderType}}">Дата добавление</a>
        </div>

        <div class="titles__item">
            <a>Категории</a>
        </div>

        <div class="titles__actions">
            <a>Действие</a>
        </div>

    </div> {{-- List Titles end --}}


    {{-- Main Form start --}}
    <form action="{{ route('news.remove.multiple') }}" class="main-form" method="POST" id="main_form">
        @csrf

        @foreach ($news as $new)
            <div class="list__item">
                <div class="checkbox">
                    <label for="{{$new->id}}" class="checkbox__label">
                        <input class="checkbox__input" id="{{$new->id}}" type="checkbox" name="ids[]" value="{{$new->id}}">
                        <span class="checkbox__checkmark"></span>
                    </label>
                </div>

                <div class="list__item-block">{{ $new->ru_title }}</div>
                <div class="list__item-block">{{ Carbon\Carbon::create($new->created_at)->locale("ru")->isoFormat("DD MMMM YYYY HH:mm:s") }}</div>
                <div class="list__item-block">
                    @foreach ($new->categories as $category)
                        {{ $category->ru_name }}
                    @endforeach
                </div>

                <div class="list__item-actions">
                    <a class="actions__button button--main" href="{{ route('news.single', $new->url) }}"
                        target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Посмотреть">
                        <span class="material-icons">visibility</span>
                    </a>

                    <a class="actions__button button--thirdinary" href="{{ route('dashboard.news.single', $new->id) }}" 
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                        <span class="material-icons">edit</span>
                    </a>

                    <button class="actions__button button--secondary" type="button" onclick="show_item_remove_modal({{ $new->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить">
                        <span class="material-icons">delete</span>
                    </button>
                </div>
            </div>
        @endforeach
    </form> {{-- Main Form end --}}

    {{ $news->links('dashboard.layouts.pagination') }}
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
                Вы уверены что хотите удалить новость ?
            </div>

            <div class="modal-footer">
                <button type="button" class="button button--thirdinary" data-bs-dismiss="modal">Отмена</button>

                <form action="{{ route('news.remove') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="0" name="id" id="remove_item_modal_input" />
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
                Вы уверены что хотите удалить отмеченные новости ?<br><br>
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