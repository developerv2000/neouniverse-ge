@extends('dashboard.layouts.app')
@section("main")

@if(!$errors->any())
    <div class="alert alert-success">
        Все картинки слайдера должны быть пропорциональны под размер 260x400!
    </div>
@endif

<form class="inner-form" action="{{ route('carousel.update') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="id" value="{{ $item->id }}">

    {{-- Tab start --}}
    <div class="languages-tab">
        {{-- Tab Navs start --}}
        <nav class="languages-nav">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-ru-tab" data-bs-toggle="tab" data-bs-target="#nav-ru"
                    type="button" role="tab" aria-controls="nav-ru" aria-selected="true">Русский
                </button>

                <button class="nav-link" id="nav-en-tab" data-bs-toggle="tab" data-bs-target="#nav-en"
                    type="button" role="tab" aria-controls="nav-en" aria-selected="false">Английский
                </button>

                <button class="nav-link" id="nav-ka-tab" data-bs-toggle="tab" data-bs-target="#nav-ka"
                    type="button" role="tab" aria-controls="nav-ka" aria-selected="false">Грузинский
                </button>
            </div>
        </nav> {{-- Tab Navs end --}}

        {{-- Tab Content start --}}
        <div class="tab-content languages-tab__content" id="nav-tabContent">
            {{-- RU Tab Content start --}}
            <div class="tab-pane fade show active" id="nav-ru" role="tabpanel" aria-labelledby="nav-ru-tab">
                <div class="form-group">
                    <label>Заголовок <span>*</span></label>
                    <input class="form-input" name="ru_title" type="text" value="{{ $item->ru_title }}" required>
                </div>

                <div class="form-group">
                    <label>Ссылка на продукт <span>*</span> {{ $item->product ? '' : 'Ссылка на продукт отсуствует. Пожалуйста выберите новую ссылку для слайдера !' }}</label>
                    <select class="selectize-singular" name="product_id" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{$product->id == $item->product_id ? 'selected' : ''}}>{{ $product->ru_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Изображение <span>*</span>. Рекомендуемый размер 260x400</label>
                    <input class="form-input" name="ru_image" type="file" accept=".png, .jpg, .jpeg">

                    <a class="form-group__image-container" href="{{ asset('img/carousel/' . $item->ru_image)}}" target="_blank">
                        <img src="{{ asset('img/carousel/' . $item->ru_image)}}">
                        <span>{{ $item->ru_image }}</span>
                    </a>
                </div>

                <div class="form-group">
                    <label>Описание <span>*</span></label>
                    <textarea class="form-textarea" name="ru_description" required>{{ $item->ru_description }}</textarea>
                </div>
            </div> {{-- RU Tab Content end --}}

            {{-- EN Tab Content start --}}
            <div class="tab-pane fade" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                <div class="form-group">
                    <label>Заголовок</label>
                    <input class="form-input" name="en_title" type="text" value="{{ $item->en_title }}">
                </div>

                <div class="form-group">
                    <label>Изображение</label>
                    <input class="form-input" name="en_image" type="file" accept=".png, .jpg, .jpeg">

                    <a class="form-group__image-container" href="{{ asset('img/carousel/' . $item->en_image)}}" target="_blank">
                        <img src="{{ asset('img/carousel/' . $item->en_image)}}">
                        <span>{{ $item->en_image }}</span>
                    </a>
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea class="form-textarea" name="en_description">{{ $item->en_description }}</textarea>
                </div>
            </div> {{-- EN Tab Content end --}}

            {{-- KA Tab Content start --}}
            <div class="tab-pane fade" id="nav-ka" role="tabpanel" aria-labelledby="nav-ka-tab">
                <div class="form-group">
                    <label>Заголовок</label>
                    <input class="form-input" name="ka_title" type="text" value="{{ $item->ka_title }}">
                </div>

                <div class="form-group">
                    <label>Изображение</label>
                    <input class="form-input" name="ka_image" type="file" accept=".png, .jpg, .jpeg">

                    <a class="form-group__image-container" href="{{ asset('img/carousel/' . $item->ka_image)}}" target="_blank">
                        <img src="{{ asset('img/carousel/' . $item->ka_image)}}">
                        <span>{{ $item->ka_image }}</span>
                    </a>
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea class="form-textarea" name="ka_description">{{ $item->ka_description }}</textarea>
                </div>
            </div> {{-- KA Tab Content end --}}

        </div> {{-- Tab Content end --}}
    </div> {{-- Tab end --}}

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
                Вы уверены что хотите удалить новость ?
            </div>

            <div class="modal-footer">
                <button type="button" class="button button--thirdinary" data-bs-dismiss="modal">Отмена</button>

                <form action="{{ route('carousel.remove') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $item->id }}" name="id" id="remove_item_modal_input" />
                    <button type="submit" class="button button--secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Remove Single Items Modal End --}}

@endsection
