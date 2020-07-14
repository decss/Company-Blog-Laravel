<div class="widget-first widget recent-posts">
    <h3>{{ Lang::get('ru.latestProjects') }}</h3>
    <div class="recent-post group">
        @if(!$portfolios->isEmpty())
            @foreach($portfolios as $portfolio)
                <div class="hentry-post group">
                    <div class="thumb-img">
                        <img src="{{ asset(config('config.theme')) }}/images/projects/{{ $portfolio->img->mini }}"
                             alt="image" title="image" style="width: 55px;"/>
                    </div>
                    <div class="text">
                        <a href="{{ route('portfolios.show', ['alias' => $portfolio->alias]) }}"
                           title="{{ $portfolio->title }}" class="title">
                            {{ $portfolio->title }}
                        </a>
                        <p>{{ str_limit($portfolio->text, 130) }}</p>
                        <a class="read-more" href="{{ route('portfolios.show', ['alias' => $portfolio->alias]) }}">
                            &rarr; {{ Lang::get('ru.readMore') }}
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>


<div class="widget-last widget recent-comments">
    <h3>{{ Lang::get('ru.latestComments') }}</h3>
    <div class="recent-post recent-comments group">
        @if(!$comments->isEmpty())
            @foreach($comments as $comment)
                <div class="the-post group">
                    <div class="avatar"><img alt="" src="{{ config('config.theme') }}/images/avatar/unknow55.png" class="avatar"/></div>
                    <span class="author"><strong><a href="mailto:{{ $comment->user->email }}">{{ $comment->user->name }}</a></strong> in</span>
                    <a class="title" href="{{ route('articles.show', ['alias' => $comment->article->alias]) }}">{{ $comment->article->title }}</a>
                    <p class="comment">
                        {{ str_limit($comment->text, 100) }}
                        <a class="goto" href="{{ route('articles.show', ['alias' => $comment->article->alias]) }}#respond">&#187;</a>
                    </p>
                </div>
            @endforeach
        @endif
    </div>
</div>

