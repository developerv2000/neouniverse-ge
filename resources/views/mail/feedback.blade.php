<h1>Пришло новое сообщение из сайта <a href="{{ route('home') }}">{{ route('home') }}</a></h1>
<p><b>Сообщение от :</b> {{ $request->email }}</p>
<p><b>Текст :</b> {{ $request->text }}</p>