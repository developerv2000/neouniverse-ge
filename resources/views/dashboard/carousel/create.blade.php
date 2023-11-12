@extends('dashboard.layouts.app')
@section("main")

@if(!$errors->any())
    <div class="alert alert-success">
        Все картинки слайдера должны быть пропорциональны под размер 260x400!
    </div>
@endif

<form class="inner-form" action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label>Заголовок <span>*</span></label>
                    <input class="form-input" name="ru_title" type="text" value="{{ old('ru_title') }}" required>
                </div>

                <div class="form-group">
                    <label>Ссылка на продукт <span>*</span></label>
                    <select class="selectize-singular" name="product_id" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->ru_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Изображение <span>*</span>. Рекомендуемый размер 260x400</label>
                    <input class="form-input" name="ru_image" type="file" accept=".png, .jpg, .jpeg" value="{{ old('ru_image') }}" required>
                </div>

                <div class="form-group">
                    <label>Описание <span>*</span></label>
                    <textarea class="form-textarea" name="ru_description" required>{{ old("ru_description") }}</textarea>
                </div>
            </div> {{-- RU Tab Content end --}}
    
            {{-- EN Tab Content start --}}
            <div class="tab-pane fade" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                <div class="form-group">
                    <label>Заголовок</label>
                    <input class="form-input" name="en_title" type="text" value="{{ old('en_title') }}">
                </div>

                <div class="form-group">
                    <label>Изображение</label>
                    <input class="form-input" name="en_image" type="file" accept=".png, .jpg, .jpeg" value="{{ old('en_image') }}">
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea class="form-textarea" name="en_description">{{ old("en_description") }}</textarea>
                </div>
            </div> {{-- EN Tab Content end --}}
    
            {{-- KA Tab Content start --}}
            <div class="tab-pane fade" id="nav-ka" role="tabpanel" aria-labelledby="nav-ka-tab">
                <div class="form-group">
                    <label>Заголовок</label>
                    <input class="form-input" name="ka_title" type="text" value="{{ old('ka_title') }}">
                </div>

                <div class="form-group">
                    <label>Изображение</label>
                    <input class="form-input" name="ka_image" type="file" accept=".png, .jpg, .jpeg" value="{{ old('ka_image') }}">
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea class="form-textarea" name="ka_description">{{ old("ka_description") }}</textarea>
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