<header class="header" id="header">
    <span class="material-icons-outlined aside-toggler" onclick="toggle_aside()"
        data-bs-toggle="tooltip" data-bs-placement="bottom" title="На весь экран">menu
    </span>

    {{-- Header Title start --}}
    <h1 class="header__title">
        @switch($route)

            {{-- Products --}}
            @case('dashboard.index')
                Продукты ({{$itemsCount}})
            @break
            @case('dashboard.products.create')
                Продукты / Добавить продукт
            @break
            @case('dashboard.products.single')
                Продукты / Редактировать / {{$product->ru_name}}
            @break

            @case('dashboard.products.relations.index')
                Продукты / {{$title}}
            @break
            @case('dashboard.products.relations.create')
                Продукты / {{$title}} / Добавить
            @break
            @case('dashboard.products.relations.single')
                Продукты / {{$title}} / Редактировать / {{$item->ru_name}}
            @break

            {{-- News --}}
            @case('dashboard.news.index')
                Новости ({{$itemsCount}})
            @break
            @case('dashboard.news.create')
                Новости / Добавить новость
            @break
            @case('dashboard.news.single')
                Новости / Редактировать / {{$news->ru_title}}
            @break

            @case('dashboard.news.categories.index')
                Новости / Категории
            @break
            @case('dashboard.news.categories.create')
                Новости / Категории / Добавить
            @break
            @case('dashboard.news.categories.single')
                Новости / Категории / Редактировать
            @break

            {{-- Options --}}
            @case('dashboard.options.index')
                Тексты ({{$itemsCount}})
            @break
            @case('dashboard.options.single')
                Тексты / Редактировать / {{$option->key}}
            @break

            {{-- Carousel --}}
            @case('dashboard.carousel.index')
                Слайдер
            @break
            @case('dashboard.carousel.create')
                Слайдер / Добавить
            @break
            @case('dashboard.carousel.single')
                Слайдер / Редактировать / {{$item->ru_title}}
            @break

            {{-- Translations --}}
            @case('dashboard.translations.index')
                Переводы
            @break
            @case('dashboard.translations.single')
                Переводы / Редактировать / {{$tag}}
            @break

            {{-- Locale --}}
            @case('dashboard.locale.index')
                Переключатель языков
            @break

        @endswitch
    </h1> {{-- Header Title end --}}


    {{-- Header actions start --}}
    <div class="header__actions">
        {{-- Routes may have different actions --}}
        @switch($route)

            @case('dashboard.index')
                <a href="{{route('dashboard.products.create')}}">Добавить</a>
                <a href="{{route('dashboard.products.relations.index')}}?model=ProductsCategory">Направления</a>
                <a href="{{route('dashboard.products.relations.index')}}?model=Symptom">Симптомы</a>
                <a href="{{route('dashboard.products.relations.index')}}?model=Form">Формы</a>
                <button onclick="select_all_checkboxes()">Отметить все</button>
                <button data-bs-toggle="modal" data-bs-target="#remove_items_modal">Удалить отмеченные</button>
            @break

            @case('dashboard.products.relations.index')
                <a href="{{route('dashboard.products.relations.create')}}?model={{$model}}">Добавить</a>
                <button onclick="select_all_checkboxes()">Отметить все</button>
                <button data-bs-toggle="modal" data-bs-target="#remove_items_modal">Удалить отмеченные</button>
            @break

            @case('dashboard.news.index')
                <a href="{{route('dashboard.news.create')}}">Добавить</a>
                <a href="{{route('dashboard.news.categories.index')}}">Категории</a>
                <button onclick="select_all_checkboxes()">Отметить все</button>
                <button data-bs-toggle="modal" data-bs-target="#remove_items_modal">Удалить отмеченные</button>
            @break

            @case('dashboard.news.categories.index')
                <a href="{{route('dashboard.news.categories.create')}}">Добавить</a>
                <button onclick="select_all_checkboxes()">Отметить все</button>
                <button data-bs-toggle="modal" data-bs-target="#remove_items_modal">Удалить отмеченные</button>
            @break

            @case('dashboard.carousel.index')
                <a href="{{route('dashboard.carousel.create')}}">Добавить</a>
                <button onclick="select_all_checkboxes()">Отметить все</button>
                <button data-bs-toggle="modal" data-bs-target="#remove_items_modal">Удалить отмеченные</button>
            @break

        @endswitch
    </div> {{-- Header actions end --}}

</header>