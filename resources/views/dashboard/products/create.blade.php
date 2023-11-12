@extends('dashboard.layouts.app')
@section("main")

@if(!$errors->any())
    <div class="alert alert-success">
        Заполнения полей для русского языка объязателен! Незаполненные поля других языков автоматический заполнятся данными из русского языка!
    </div>
@endif

<form class="inner-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

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
                    <input class="form-input" name="ru_name" type="text" value="{{ old('ru_name') }}" required>
                </div>

                <div class="form-group">
                    <label>Тип <span>*</span></label>
                    <select class="selectize-singular" name="prescription" required>
                        <option value="1">RX</option>
                        <option value="0">OTC</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        Показать в строке фильтра/поиска продуктов, как ключевое слово, на <a href="{{ route('products.index') }}" target="_blank">главной странице продуктов</a> ? <span>*</span>. Не рекомендуется добавлять больше 3 продуктов в строке фильтра/поиска !
                    </label>
                    
                    <select class="selectize-singular" name="highlight_in_filter" required>
                        <option value="0">Нет</option>
                        <option value="1">Да</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Форма выпуска <span>*</span></label>
                    <select class="selectize-singular" name="form_id" required>
                        @foreach ($forms as $form)
                            <option value="{{ $form->id }}">{{ $form->ru_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Направления <span>*</span></label>
                    <select class="selectize-multiple" name="categories[]" multiple="multiple" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->ru_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Симптомы</label>
                    <select class="selectize-multiple" name="symptoms[]" multiple="multiple">
                        @foreach ($symptoms as $symptom)
                            <option value="{{ $symptom->id }}">{{ $symptom->ru_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Изображение <span>*</span>. Ширина и высота должны быть равны !</label>
                    <input class="form-input" name="ru_image" type="file" accept=".png, .jpg, .jpeg" value="{{ old('ru_image') }}" required>
                </div>

                <div class="form-group">
                    <label>Инструкция <span>*</span>. Формат : pdf</label>
                    <input class="form-input" name="ru_instruction" accept=".pdf" type="file" value="{{ old('ru_instruction') }}" required>
                </div>

                <div class="form-group">
                    <label>Ссылка на приобретение препарата. Полная ссылка включая https или http</label>
                    <input class="form-input" name="ru_obtain_link" type="text" placeholder="https://salomat.tj/" value="{{ old('ru_obtain_link') }}">
                </div>

                <div class="form-group">
                    <label>Количество <span>*</span> . 5 мл / 10 таблеток итд</label>
                    <input class="form-input" name="ru_amount" type="text" value="{{ old('ru_amount') }}" required>
                </div>

                <div class="form-group">
                    <label>Описание <span>*</span></label>
                    <textarea class="simditor-wysiwyg" name="ru_description" required>{{ old("ru_description") }}</textarea>
                </div>

                <div class="form-group">
                    <label>Состав <span>*</span></label>
                    <textarea class="simditor-wysiwyg" name="ru_composition" required>{{ old("ru_composition") }}</textarea>
                </div>

                <div class="form-group">
                    <label>Показания к применению <span>*</span></label>
                    <textarea class="simditor-wysiwyg" name="ru_testimony" required>{{ old("ru_testimony") }}</textarea>
                </div>

                <div class="form-group">
                    <label>Способ применения <span>*</span></label>
                    <textarea class="simditor-wysiwyg" name="ru_use" required>{{ old("ru_use") }}</textarea>
                </div>

            </div> {{-- RU Tab Content end --}}
    
            {{-- EN Tab Content start --}}
            <div class="tab-pane fade" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                <div class="form-group">
                    <label>Название</label>
                    <input class="form-input" name="en_name" type="text" value="{{ old('en_name') }}">
                </div>

                <div class="form-group">
                    <label>Изображение. Ширина и высота должны быть равны !</label>
                    <input class="form-input" name="en_image" type="file" accept=".png, .jpg, .jpeg" value="{{ old('en_image') }}">
                </div>

                <div class="form-group">
                    <label>Инструкция. Формат : pdf</label>
                    <input class="form-input" name="en_instruction" accept=".pdf" type="file" value="{{ old('en_instruction') }}">
                </div>

                <div class="form-group">
                    <label>Ссылка на приобретение препарата. Полная ссылка включая https или http</label>
                    <input class="form-input" name="en_obtain_link" type="text" placeholder="https://salomat.tj/" value="{{ old('en_obtain_link') }}">
                </div>

                <div class="form-group">
                    <label>Количество. 5 мл / 10 таблеток итд</label>
                    <input class="form-input" name="en_amount" type="text" value="{{ old('en_amount') }}">
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea class="simditor-wysiwyg" name="en_description">{{ old("en_description") }}</textarea>
                </div>

                <div class="form-group">
                    <label>Состав</label>
                    <textarea class="simditor-wysiwyg" name="en_composition">{{ old("en_composition") }}</textarea>
                </div>

                <div class="form-group">
                    <label>Показания к применению</label>
                    <textarea class="simditor-wysiwyg" name="en_testimony">{{ old("en_testimony") }}</textarea>
                </div>

                <div class="form-group">
                    <label>Способ применения</label>
                    <textarea class="simditor-wysiwyg" name="en_use">{{ old("en_use") }}</textarea>
                </div>
            </div> {{-- EN Tab Content end --}}
    
            {{-- KA Tab Content start --}}
            <div class="tab-pane fade" id="nav-ka" role="tabpanel" aria-labelledby="nav-ka-tab">
                <div class="form-group">
                    <label>Название</label>
                    <input class="form-input" name="ka_name" type="text" value="{{ old('ka_name') }}">
                </div>

                <div class="form-group">
                    <label>Изображение. Ширина и высота должны быть равны !</label>
                    <input class="form-input" name="ka_image" type="file" accept=".png, .jpg, .jpeg" value="{{ old('ka_image') }}">
                </div>

                <div class="form-group">
                    <label>Инструкция. Формат : pdf</label>
                    <input class="form-input" name="ka_instruction" accept=".pdf" type="file" value="{{ old('ka_instruction') }}">
                </div>

                <div class="form-group">
                    <label>Ссылка на приобретение препарата. Полная ссылка включая https или http</label>
                    <input class="form-input" name="ka_obtain_link" type="text" placeholder="https://salomat.tj/" value="{{ old('ka_obtain_link') }}">
                </div>

                <div class="form-group">
                    <label>Количество. 5 мл / 10 таблеток итд</label>
                    <input class="form-input" name="ka_amount" type="text" value="{{ old('ka_amount') }}">
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea class="simditor-wysiwyg" name="ka_description">{{ old("ka_description") }}</textarea>
                </div>

                <div class="form-group">
                    <label>Состав</label>
                    <textarea class="simditor-wysiwyg" name="ka_composition">{{ old("ka_composition") }}</textarea>
                </div>

                <div class="form-group">
                    <label>Показания к применению</label>
                    <textarea class="simditor-wysiwyg" name="ka_testimony">{{ old("ka_testimony") }}</textarea>
                </div>

                <div class="form-group">
                    <label>Способ применения</label>
                    <textarea class="simditor-wysiwyg" name="ka_use">{{ old("ka_use") }}</textarea>
                </div>
            </div> {{-- KA Tab Content end --}}

        </div> {{-- Tab Content end --}}
    </div> {{-- Tab end --}}

    <div class="inner-form__actions">
        <button class="button button--main" type="submit">
            <span class="material-icons-outlined">done_all</span> Добавить
        </button>
    </div>

</form>

@endsection