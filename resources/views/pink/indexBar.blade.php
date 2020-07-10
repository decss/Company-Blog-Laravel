@if($articles)
    <div class="widget-first widget recent-posts">
        <h3>{{ Lang::get('ru.latestPosts') }}</h3>
        <div class="recent-post group">
        @foreach($articles as $article)
            <div class="hentry-post group">
                <div class="thumb-img"><img alt="image" title="image"
                            src="{{ asset(config('config.theme')) }}/images/articles/{{ $article->img->mini }}"/></div>
                <div class="text">
                    <a href="{{ route('articles.show', ['alias' => $article->alias]) }}" title="{{ $article->title }}" class="title">{{ $article->title }}</a>
                    <p class="post-date">{{ $article->created_at->format('F d Y, H:i') }}</p>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <div class="widget-last widget text-image">
        <h3>Customer support</h3>
        <div class="text-image" style="text-align:left"><img
                    src="{{ asset(config('config.theme')) }}/images/callus.gif" alt="Customer support"/>
        </div>
        <p>Proin porttitor dolor eu nibh lacinia at ultrices lorem venenatis. Sed volutpat scelerisquevulputate.</p>
    </div>
@endif




