@extends('dashboard.layouts.app')
@section("main")

<div class="alert alert-success">
    Тексты добавляются / удаляются программистами !
</div>

@include('dashboard.layouts.search')

{{-- List start --}}
<div class="main-list">
    {{-- List Titles start --}}
    <div class="titles">

        <div class="titles__item">
            <a class="{{$orderType}} {{$orderBy == 'key' ? 'active' : ''}}" href="{{route('dashboard.options.index')}}?page={{$activePage}}&orderBy=key&orderType={{$reversedOrderType}}">Ключ</a>
        </div>

        <div class="titles__item">
            <a>Значение</a>
        </div>

        <div class="titles__actions">
            <a>Действие</a>
        </div>

    </div> {{-- List Titles end --}}


    {{-- Main Form start --}}
    <form action="#" class="main-form" id="main_form">
        @csrf

        @foreach ($options as $option)
            <div class="list__item">
                <div class="checkbox">
                    <label for="{{$option->id}}" class="checkbox__label">
                        <input class="checkbox__input" id="{{$option->id}}" type="checkbox" name="ids[]" value="{{$option->id}}">
                        <span class="checkbox__checkmark"></span>
                    </label>
                </div>

                <div class="list__item-block">{{ $option->key }}</div>
                <div class="list__item-block">{{ $option->ru_value}}</div>

                <div class="list__item-actions">
                    <a class="actions__button button--thirdinary" href="{{ route('dashboard.options.single', $option->id) }}" 
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                        <span class="material-icons">edit</span>
                    </a>
                </div>
            </div>
        @endforeach
    </form> {{-- Main Form end --}}

    {{ $options->links('dashboard.layouts.pagination') }}
</div> {{-- List end --}}

@endsection