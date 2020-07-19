<li id="li-comment-{{ $comment['id'] }}"
    class="comment even borGreen">
    <div id="comment-{{ $comment['id'] }}" class="comment-container">
        <div class="comment-author vcard">
            <img alt="" src="/{{ config('config.theme') }}/images/avatar/unknow.png" class="avatar" height="75"
                 width="75"/>
            <cite class="fn">
                {{ $comment['name'] }}
            </cite>
        </div>

        <div class="comment-meta commentmetadata">
            <div class="intro">
                {{--<div class="commentDate"></div>--}}
                {{--<div class="commentNumber">#</div>--}}
            </div>
            <div class="comment-body">
                <p>{{ $comment['text'] }}</p>
            </div>
        </div>
    </div>
</li>
