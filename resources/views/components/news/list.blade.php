@if(!count($news))
    <div class="warning">
        {{ __('По вашему запросу ничего не найдено') }}! {{ __('Пожалуйста, попробуйте новый поиск') }}. 
    </div>
@endif

<div class="news-list" id="news_list">
    @foreach ($news as $new)
        <x-news.card  :new="$new"/>
    @endforeach
</div>

{{ $news->links('layouts.pagination') }}