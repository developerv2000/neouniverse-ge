@extends('dashboard.layouts.app')
@section("main")

<div class="alert alert-success">
    Языки добавляются / удаляются программистами !
</div>

{{-- List start --}}
<div class="main-list">
    <form action="#" class="main-form" id="main_form">
        @csrf

        @foreach ($languages as $lang)
            <div class="list__item">
                <div class="list__item-block">{{ $lang['name']}}</div>
                
                <div class="list__item-actions">
                    <a class="actions__button button--thirdinary" href="{{ route('dashboard.translations.single', $lang['tag']) }}" 
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                        <span class="material-icons">edit</span>
                    </a>
                </div>
            </div>
        @endforeach
    </form>
</div> {{-- List end --}}

@endsection