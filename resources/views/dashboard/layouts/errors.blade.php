@if($errors->any())
    <div class="alert alert-danger inner-page-alert">
        <b>Ошибка! Пожалуйста исправьте ошибки и попробуйте заново.</b>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif