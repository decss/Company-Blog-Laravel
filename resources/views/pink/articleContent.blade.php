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
            <span>2</span> comments
        </h3>
        <ol class="commentlist group">
            <li class="comment even depth-1">
                <div class="comment-container">
                    <div class="comment-author vcard">
                        <img alt="" src="images/avatar/unknow.png" class="avatar" height="75" width="75"/>
                        <cite class="fn">Anonymous</cite>
                    </div>
                    <!-- .comment-author .vcard -->
                    <div class="comment-meta commentmetadata">
                        <div class="intro">
                            <div class="commentDate">
                                <a href="#comment-2">
                                    September 24, 2012 at 1:31 pm</a>
                            </div>
                            <div class="commentNumber">#&nbsp;1</div>
                        </div>
                        <div class="comment-body">
                            <p>Hi all, i’m a guest and this is the guest’s awesome comments template!</p>
                        </div>
                        <div class="reply group">
                            <a class="comment-reply-link" href="#respond"
                               onclick="return addComment.moveForm(&quot;comment-2&quot;, &quot;2&quot;, &quot;respond&quot;, &quot;41&quot;)">Reply</a>
                        </div>
                        <!-- .reply -->
                    </div>
                    <!-- .comment-meta .commentmetadata -->
                </div>
                <!-- #comment-##  -->
            </li>
            <li class="comment bypostauthor odd">
                <div class="comment-container">
                    <div class="comment-author vcard">
                        <img alt="" src="images/avatar/nicola.jpeg" class="avatar" height="75" width="75"/>
                        <cite class="fn">nicola</cite>
                    </div>
                    <!-- .comment-author .vcard -->
                    <div class="comment-meta commentmetadata">
                        <div class="intro">
                            <div class="commentDate">
                                <a href="#">
                                    September 24, 2012 at 1:32 pm</a>
                            </div>
                            <div class="commentNumber">#&nbsp;2</div>
                        </div>
                        <div class="comment-body">
                            <p>While i’m the author of the post. My comment template is different, something like a
                                “sticky comment”!</p>
                        </div>
                        <div class="reply group">
                            <a class="comment-reply-link" href="#respond"
                               onclick="return addComment.moveForm(&quot;comment-3&quot;, &quot;3&quot;, &quot;respond&quot;, &quot;41&quot;)">Reply</a>
                        </div>
                        <!-- .reply -->
                    </div>
                    <!-- .comment-meta .commentmetadata -->
                </div>
                <!-- #comment-##  -->
            </li>
        </ol>

        <!-- START TRACKBACK & PINGBACK -->
        <h2 id="trackbacks">Trackbacks and pingbacks</h2>
        <ol class="trackbacklist"></ol>
        <p><em>No trackback or pingback available for this article.</em></p>

        <!-- END TRACKBACK & PINGBACK -->
        <div id="respond">
            <h3 id="reply-title">Leave a <span>Reply</span> <small><a rel="nofollow" id="cancel-comment-reply-link"
                                                                      href="#respond" style="display:none;">Cancel
                        reply</a></small></h3>
            <form action="sendmail.PHP" method="post" id="commentform">
                <p class="comment-form-author"><label for="author">Name</label> <input id="author" name="author"
                                                                                       type="text" value="" size="30"
                                                                                       aria-required="true"/></p>
                <p class="comment-form-email"><label for="email">Email</label> <input id="email" name="email"
                                                                                      type="text" value="" size="30"
                                                                                      aria-required="true"/></p>
                <p class="comment-form-url"><label for="url">Website</label><input id="url" name="url" type="text"
                                                                                   value="" size="30"/></p>
                <p class="comment-form-comment"><label for="comment">Your comment</label><textarea id="comment"
                                                                                                   name="comment"
                                                                                                   cols="45"
                                                                                                   rows="8"></textarea>
                </p>
                <div class="clear"></div>
                <p class="form-submit">
                    <input name="submit" type="submit" id="submit" value="Post Comment"/>
                </p>
            </form>
        </div>
        <!-- #respond -->
    </div>
    <!-- END COMMENTS -->
</div>