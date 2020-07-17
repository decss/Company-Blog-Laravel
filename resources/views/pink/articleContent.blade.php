<div id="content-single" class="content group">
    <div class="hentry hentry-post blog-big group ">
        @if($article)
            <div class="thumbnail">
                <h1 class="post-title">{{ $article->title }}</h1>
                <div class="image-wrap">
                    <img src="{{ asset(config('config.theme')) }}/images/articles/{{ $article->img->max }}" alt="image"
                         title="image"/>
                </div>
                <p class="date">
                    <span class="month">{{ $article->created_at->format('M') }}</span>
                    <span class="day">{{ $article->created_at->format('d') }}</span>
                </p>
            </div>
            <div class="meta group">
                <p class="author">
                <span>
                    Автор <a href="#" title="{{ $article->user->name }}" rel="author">{{ $article->user->name }}</a>
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

            <div class="the-content single group">
                {!! $article->text !!}
            </div>
        @endif
    </div>

    <!-- START COMMENTS -->
    <div id="comments">
        <h3 id="comments-title">
            <span>{{ count($article->comments) }}</span> {{ Lang::choice('ru.comments', count($article->comments)) }}
        </h3>

        @if(count($article->comments) > 0)
            <ol class="commentlist group">
                @set($com, $article->comments->groupBy("parent_id"))
                @foreach($com as $k => $comments)
                    @if($k != 0)
                        @break
                    @endif
                    @include(config('config.theme') . '.comment', ['comments' => $comments])
                @endforeach
            </ol>
        @endif

        <h2 id="trackbacks">Trackbacks and pingbacks</h2>
        <ol class="trackbacklist"></ol>
        <p><em>No trackback or pingback available for this article.</em></p>

        <!-- END TRACKBACK & PINGBACK -->
        <div id="respond">
            <h3 id="reply-title">
                Leave a <span>Reply</span>
                <small>
                    <a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">
                        Cancel reply
                    </a>
                </small>
            </h3>
            <form action="{{ route('comment.store') }}" method="post" id="commentform">
                {{--@csrf--}}
                {{ csrf_field() }}

                @if(Auth::check())
                    <p class="comment-form-author">
                        <label for="author">Name</label>
                        <input id="author" name="author" type="text" value="" size="30" aria-required="true"/>
                    </p>
                    <p class="comment-form-email">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="text" value="" size="30" aria-required="true"/>
                    </p>
                    <p class="comment-form-url">
                        <label for="url">Website</label>
                        <input id="url" name="url" type="text" value="" size="30"/>
                    </p>
                @endif
                <p class="comment-form-comment">
                    <label for="comment">Your comment</label>
                    <textarea id="comment" name="comment" cols="45" rows="8"></textarea>
                </p>
                <div class="clear"></div>
                <p class="form-submit">
                    <input id="comment_post_ID" type="hidden" name="comment_post_ID" value="{{ $article->id }}">
                    <input id="comment_parent" type="hidden" name="comment_parent" value="">
                    <input name="submit" type="submit" id="submit" value="Post Comment"/>
                </p>

            </form>
        </div>
        <!-- #respond -->
    </div>
    <!-- END COMMENTS -->
</div>