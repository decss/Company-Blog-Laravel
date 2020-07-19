@foreach($comments as $comment)
    <li id="li-comment-{{ $comment->id }}"
        class="comment even {{ $comment->user_id == $article->user_id ? 'bypostauthor odd' : '' }}">
        <div id="comment-{{ $comment->id }}" class="comment-container">
            <div class="comment-author vcard">
                <img alt="" src="/{{ config('config.theme') }}/images/avatar/unknow.png" class="avatar" height="75"
                     width="75"/>
                <cite class="fn">
                    @if ($comment->user)
                        {{ $comment->user->name }}
                    @else
                        {{ $comment->name }}
                    @endif
                </cite>
            </div>

            <div class="comment-meta commentmetadata">
                <div class="intro">
                    <div class="commentDate">
                        <a href="#comment-2">{{ $comment->created_at->format('M d, Y \a\t h:i') }}</a>
                    </div>
                    <div class="commentNumber">#</div>
                </div>
                <div class="comment-body">
                    <p>{{ $comment->text }}</p>
                </div>
                <div class="reply group">
                    <a class="comment-reply-link" href="#respond"
                       onclick="return addComment.moveForm(&quot;comment-{{ $comment->id }}&quot;, &quot;{{ $comment->id }}&quot;, &quot;respond&quot;, &quot;{{ $comment->article_id }}&quot;)">Reply</a>
                </div>
            </div>
        </div>

        @if (isset($com[$comment->id]))
            <ul class="children">
                @include(config('config.theme') . '.comment', ['comments' => $com[$comment->id]])
            </ul>
        @endif
    </li>
@endforeach