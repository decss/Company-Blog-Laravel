<div id="content-blog" class="content group">
    @if($articles)
        @foreach($articles as $article)
            <div class="hentry hentry-post blog-big group">
                <div class="thumbnail">
                    <h2 class="post-title">
                        <a href="{{ route('articles.show', ['alias' => $article->alias]) }}">{{ $article->title }}</a>
                    </h2>
                    <div class="image-wrap">
                        <img src="{{ asset(config('config.theme')) }}/images/articles/{{ $article->img->max }}"
                             alt="image" title="image"/>
                    </div>
                    <p class="date">
                        <span class="month">{{ $article->created_at->format('M') }}</span>
                        <span class="day">{{ $article->created_at->format('d') }}</span>
                    </p>
                </div>
                <div class="meta group">
                    <p class="author">
                        <span>
                            Автор <a href="#" title="{{ $article->user->name }}"
                                     rel="author">{{ $article->user->name }}</a>
                        </span>
                    </p>
                    <p class="categories">
                        <span>Раздел: <a href="{{ route('articlesCat', ['alias' => $article->category->alias]) }}"
                                         title="View all posts" rel="category tag">{{ $article->category->title }}</a>
                        </span>
                    </p>
                    <p class="comments">
                        <span><a href="{{ route('articles.show', ['alias' => $article->alias]) }}#respond"
                                 title="Comments">
                                {{ count($article->comments)
                                    ? count($article->comments) . ' ' . Lang::choice('ru.comments', count($article->comments))
                                    : 'Нет комментариев' }}
                        </a></span>
                    </p>
                </div>

                <div class="the-content group">
                    {!! $article->desc !!}
                    <p><a href="{{ route('articles.show', ['alias' => $article->alias]) }}"
                          class="btn btn-beetle-bus-goes-jamba-juice-4 btn-more-link">→ {{ Lang::get('ru.readMore') }}</a>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        @endforeach

        @if ($articles->lastPage() > 1)
            <div class="general-pagination group">
                @if ($articles->currentPage() != 1)
                    <a href="{{ $articles->url($articles->currentPage() - 1) }}">&laquo;</a>
                @endif

                @for($i = 1; $i <= $articles->lastPage(); $i++)
                    <a href="{{ $articles->url($i) }}" class="{{ $articles->currentPage() == $i ? 'selected' : '' }}">{{ $i }}</a>
                @endfor

                @if ($articles->currentPage() < $articles->lastPage())
                    <a href="{{ $articles->url($articles->currentPage() + 1) }}">&raquo;</a>
                @endif
            </div>
        @endif

    @else

        <h2>{{ Lang::get('ru.noArticlesMsg') }}</h2>

    @endif


</div>