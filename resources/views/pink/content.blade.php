@if($portfolios && count($portfolios))
    <div id="content-home" class="content group">
        <div class="hentry group">
            <div class="section portfolio">

                <h3 class="title">{{ Lang::get('ru.latestProjects') }}</h3>
                @foreach($portfolios as $i => $item)
                    @if($i == 0)
                        <div class="hentry work group portfolio-sticky portfolio-full-description">
                            <div class="work-thumbnail">
                                <a class="thumb"><img alt="0081" title="0081"
                                    src="{{ asset(config('config.theme')) }}/images/projects/{{ $item->img->max }}"/></a>
                                <div class="work-overlay">
                                    <h3><a href="{{ route('portfolios.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h3>
                                    <p class="work-overlay-categories"><img alt="Categories"
                                        src="{{ asset(config('config.theme')) }}/images/categories.png"/>
                                        in: <a href="#">{{ $item->filter->title }}</a></p>
                                </div>
                            </div>
                            <div class="work-description">
                                <h2><a href="{{ route('portfolios.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h2>
                                <p class="work-categories">in: <a href="#">{{ $item->filter->title }}</a></p>
                                <p>{{ Str::limit($item->text, 200) }}</p>
                                <a href="{{ route('portfolios.show', ['alias' => $item->alias]) }}" class="read-more">Read more</a>
                            </div>
                        </div>
                        @continue
                    @endif
                @endforeach
                <div class="clear"></div>

                <div class="portfolio-projects">
                    @foreach($portfolios as $i => $item)
                        @if($i == 0)
                            @continue
                        @endif
                        <div class="related_project {{ ($i == config('config.indexPortfolioCount') - 1) ? 'related_project_last' : '' }}">
                            <div class="overlay_a related_img">
                                <div class="overlay_wrapper">
                                    <img src="{{ asset(config('config.theme')) }}/images/projects/{{ $item->img->mini }}" alt="0061" title="0061"/>
                                    <div class="overlay">
                                        <a class="overlay_img" rel="lightbox" title=""
                                           href="{{ asset(config('config.theme')) }}/images/projects/{{ $item->img->path }}"></a>
                                        <a class="overlay_project" href="#"></a>
                                        <span class="overlay_title">{{ $item->title }}</span>
                                    </div>
                                </div>
                            </div>
                            <h4><a href="#">{{ $item->title }}</a></h4>
                            <p>{{ Str::limit($item->text, 100) }}</p>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="clear"></div>
        </div>
        <!-- START COMMENTS -->
        <div id="comments">
        </div>
        <!-- END COMMENTS -->
    </div>
@endif
