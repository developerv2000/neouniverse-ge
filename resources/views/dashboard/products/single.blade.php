@extends('dashboard.layouts.app')
@section("main")

@if(!$errors->any())
    <div class="alert alert-success">
        Заполнения полей для русского языка объязателен! Незаполненные поля других языков автоматический заполнятся данными из русского языка!
    </div>
@endif

<form class="inner-form" action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="id" value="{{ $product->id }}">

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
                    <label>Название <span>*</span></label>
                    <input class="form-input" name="ru_name" type="text" value="{{ $product->ru_name }}" required>
                </div>

                <div class="form-group">
                    <label>Тип <span>*</span></label>
                    <select class="selectize-singular" name="prescription" required>
                        <option value="1" {{ $product->prescription ? 'selected' : '' }}>RX</option>
                        <option value="0" {{ !$product->prescription ? 'selected' : '' }}>OTC</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        Показать в строке фильтра/поиска продуктов, как ключевое слово, на <a href="{{ route('products.index') }}" target="_blank">главной странице продуктов</a> ? <span>*</span>. Не рекомендуется добавлять больше 3 продуктов в строке фильтра/поиска !
                    </label>

                    <select class="selectize-singular" name="highlight_in_filter" required>
                        <option value="0" {{ !$product->highlight_in_filter ? 'selected' : '' }}>Нет</option>
                        <option value="1" {{ $product->highlight_in_filter ? 'selected' : '' }}>Да</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Форма выпуска <span>*</span>{{ $product->form_id == '0' ? '. Отсуствует форма выпуска продукта. Выберите правльную форму из списка!' : '' }}</label>
                    <select class="selectize-singular" name="form_id" required>
                        @foreach ($forms as $form)
                            <option value="{{ $form->id }}" {{ $product->form_id == $form->id ? 'selected' : '' }}>{{ $form->ru_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Направления <span>*</span></label>
                    <select class="selectize-multiple" name="categories[]" multiple="multiple" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @foreach ($product->categories as $prodCat)
                                    @if($prodCat->id == $category->id) selected @endif
                                @endforeach
                                >{{ $category->ru_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Симптомы</label>
                    <select class="selectize-multiple" name="symptoms[]" multiple="multiple">
                        @foreach ($symptoms as $symptom)
                            <option value="{{ $symptom->id }}"
                                @foreach ($product->symptoms as $prodSym)
                                    @if($prodSym->id == $symptom->id) selected @endif
                                @endforeach
                                >{{ $symptom->ru_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Изображение. Ширина и высота должны быть равны !</label>
                    <input class="form-input" name="ru_image" type="file" accept=".png, .jpg, .jpeg" value="{{ old('ru_image') }}">

                    <a class="form-group__image-container" href="{{ asset('img/products/' . $product->ru_image)}}" target="_blank">
                        <img src="{{ asset('img/products/thumbs/' . $product->ru_image)}}">
                        <span>{{ $product->ru_image }}</span>
                    </a>
                </div>

                <div class="form-group">
                    <label>Инструкция. Формат : pdf.
                        <a href="/instructions/{{ $product->ru_instruction }}" target="_blank">{{ $product->ru_instruction }}</a>
                    </label>

                    <input class="form-input" name="ru_instruction" accept=".pdf" type="file" value="{{ old('ru_instruction') }}">
                </div>

                <div class="form-group">
                    <label>Ссылка на приобретение препарата. Полная ссылка включая https или http</label>
                    <input class="form-input" name="ru_obtain_link" type="text" placeholder="https://salomat.tj/" value="{{ $product->ru_obtain_link }}">
                </div>

                <div class="form-group">
                    <label>Количество <span>*</span> . 5 мл / 10 таблеток итд</label>
                    <input class="form-input" name="ru_amount" type="text" value="{{ $product->ru_amount }}" required>
                </div>

                <div class="form-group">
                    <label>Описание <span>*</span></label>
                    <textarea class="simditor-wysiwyg" name="ru_description" required>{{ $product->ru_description }}</textarea>
                </div>

                <div class="form-group">
                    <label>Состав <span>*</span></label>
                    <textarea class="simditor-wysiwyg" name="ru_composition" required>{{ $product->ru_composition }}</textarea>
                </div>

                <div class="form-group">
                    <label>Показания к применению <span>*</span></label>
                    <textarea class="simditor-wysiwyg" name="ru_testimony" required>{{ $product->ru_testimony }}</textarea>
                </div>

                <div class="form-group">
                    <label>Способ применения <span>*</span></label>
                    <textarea class="simditor-wysiwyg" name="ru_use" required>{{ $product->ru_use }}</textarea>
                </div>

            </div> {{-- RU Tab Content end --}}

            {{-- EN Tab Content start --}}
            <div class="tab-pane fade" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                <div class="form-group">
                    <label>Название</label>
                    <input class="form-input" name="en_name" type="text" value="{{ $product->en_name }}">
                </div>

                <div class="form-group">
                    <label>Изображение. Ширина и высота должны быть равны !</label>
                    <input class="form-input" name="en_image" type="file" accept=".png, .jpg, .jpeg">

                    <a class="form-group__image-container" href="{{ asset('img/products/' . $product->en_image)}}" target="_blank">
                        <img src="{{ asset('img/products/' . $product->en_image)}}">
                        <span>{{ $product->en_image }}</span>
                    </a>
                </div>

                <div class="form-group">
                    <label>Инструкция. Формат : pdf
                        <a href="/instructions/{{ $product->en_instruction }}" target="_blank">{{ $product->en_instruction }}</a>
                    </label>

                    <input class="form-input" name="en_instruction" accept=".pdf" type="file">
                </div>

                <div class="form-group">
                    <label>Ссылка на приобретение препарата. Полная ссылка включая https или http</label>
                    <input class="form-input" name="en_obtain_link" type="text" placeholder="https://salomat.tj/" value="{{ $product->en_obtain_link }}">
                </div>

                <div class="form-group">
                    <label>Количество. 5 мл / 10 таблеток итд</label>
                    <input class="form-input" name="en_amount" type="text" value="{{ $product->en_amount }}">
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea class="simditor-wysiwyg" name="en_description">{{ $product->en_description }}</textarea>
                </div>

                <div class="form-group">
                    <label>Состав</label>
                    <textarea class="simditor-wysiwyg" name="en_composition">{{ $product->en_composition }}</textarea>
                </div>

                <div class="form-group">
                    <label>Показания к применению</label>
                    <textarea class="simditor-wysiwyg" name="en_testimony">{{ $product->en_testimony }}</textarea>
                </div>

                <div class="form-group">
                    <label>Способ применения</label>
                    <textarea class="simditor-wysiwyg" name="en_use">{{ $product->en_use }}</textarea>
                </div>
            </div> {{-- EN Tab Content end --}}

            {{-- KA Tab Content start --}}
            <div class="tab-pane fade" id="nav-ka" role="tabpanel" aria-labelledby="nav-ka-tab">
                <div class="form-group">
                    <label>Название</label>
                    <input class="form-input" name="ka_name" type="text" value="{{ $product->ka_name }}">
                </div>

                <div class="form-group">
                    <label>Изображение. Ширина и высота должны быть равны !</label>
                    <input class="form-input" name="ka_image" type="file" accept=".png, .jpg, .jpeg">

                    <a class="form-group__image-container" href="{{ asset('img/products/' . $product->ka_image)}}" target="_blank">
                        <img src="{{ asset('img/products/' . $product->ka_image)}}">
                        <span>{{ $product->ka_image }}</span>
                    </a>
                </div>

                <div class="form-group">
                    <label>Инструкция. Формат : pdf
                        <a href="/instructions/{{ $product->ka_instruction }}" target="_blank">{{ $product->ka_instruction }}</a>
                    </label>

                    <input class="form-input" name="ka_instruction" accept=".pdf" type="file">
                </div>

                <div class="form-group">
                    <label>Ссылка на приобретение препарата. Полная ссылка включая https или http</label>
                    <input class="form-input" name="ka_obtain_link" type="text" placeholder="https://salomat.tj/" value="{{ $product->ka_obtain_link }}">
                </div>

                <div class="form-group">
                    <label>Количество. 5 мл / 10 таблеток итд</label>
                    <input class="form-input" name="ka_amount" type="text" value="{{ $product->ka_amount }}">
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea class="simditor-wysiwyg" name="ka_description">{{ $product->ka_description }}</textarea>
                </div>

                <div class="form-group">
                    <label>Состав</label>
                    <textarea class="simditor-wysiwyg" name="ka_composition">{{ $product->ka_composition }}</textarea>
                </div>

                <div class="form-group">
                    <label>Показания к применению</label>
                    <textarea class="simditor-wysiwyg" name="ka_testimony">{{ $product->ka_testimony }}</textarea>
                </div>

                <div class="form-group">
                    <label>Способ применения</label>
                    <textarea class="simditor-wysiwyg" name="ka_use">{{ $product->ka_use }}</textarea>
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
                Вы уверены что хотите удалить продукт ?
            </div>

            <div class="modal-footer">
                <button type="button" class="button button--thirdinary" data-bs-dismiss="modal">Отмена</button>

                <form action="{{ route('products.remove') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $product->id }}" name="id" id="remove_item_modal_input" />
                    <button type="submit" class="button button--secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Remove Single Items Modal End --}}

@endsection
