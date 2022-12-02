<aside>
	<section class="panelV2">
@foreach ($articles as $article)
            <div class="panel panel-danger">
                <div class="nav nav-tabs-user">
                    <a href="{{ route('articles.show', ['id' => $article->id]) }}">
                        <h4 class="newtitle">
                            @joypixels(Str::limit($article->title, 48))
                        </h4>
                    </a>
                </div>
                <div class="panel-body no-padding">
                    <p class="text-muted" style="padding-bottom: 4px;">
                        <em>{{ __('articles.published-at') }}
                            {{ $article->created_at->format('d.m.Y') }} | {{ $article->created_at->format('H:m:s') }}
                        </em>
                    </p>
                    <!--Body-->
                    <div class="newbody">
                        <div class="newbodyimg">
                            <a href="{{ route('articles.show', ['id' => $article->id]) }}">
                            @if ( ! is_null($article->image))
                                <img src="{{ url('files/img/' . $article->image) }}" alt="{{ $article->title }}">
                            @else
                                <img src="{{ url('img/missing-image.png') }}" alt="{{ $article->title }}">
                            @endif
                            </a>
                        </div>
                            @joypixels(preg_replace('#\[[^\]]+\]#', '', Str::limit($article->content, 160)))
                    </div>
                    <!--Body-->
                    <!--Footer-->
                    <!--<div class="newfooter">
                        <a href="{{ route('articles.show', ['id' => $article->id]) }}" class="btn btn-success">
                            {{ __('articles.read-more') }}
                        </a>-->
                    <!-- SLOshare -->
                        <!--@if (auth()->user()->group->is_admin)
                        <div class="pull-right">
                            <a href="{{ route('articles.index') }}" class="btn btn-primary">
                                {{ __('common.view-all') }}
                            </a>
                        </div>
                        @endif-->
                    <!-- SLOshare -->
                    <!--</div>-->
                    <!--Footer-->
                </div>
            </div>
@endforeach
	</section>
</aside>