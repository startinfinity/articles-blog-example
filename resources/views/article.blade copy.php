@extends('layout')

@section('script')
@parent
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.17.1/components/prism-core.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.17.1/plugins/autoloader/prism-autoloader.min.js"></script>

@endsection

@section('css')
@parent
<link href="https://cdn.jsdelivr.net/npm/prismjs@1.17.1/themes/prism.css" rel="stylesheet" />
<style type="text/css" media="screen">
    body {
        /* background: #e8eaed; */
        background: #f7f8fa;
    }

    .post-body {
        border-bottom-right-radius: 2px;
        border-bottom-left-radius: 2px;
        padding: 32px;
        border: 1px solid #e1e4e8;
        background: white;
        margin-bottom: 100px;
    }

    .devsite-article-body img {
        max-width: 100%;
        max-height:600px;
        display: flex;
        margin: 0 auto;
    }
</style>

<style>
    .wf-byline {
        /* display: inline-flex;
        margin: 16px 32px 16px 0; */
    }

    .wf-byline .attempt-left {
        margin: 0 16px 0 0;
    }

    .wf-byline img {
        border-radius: 100%;
        min-width: 64px;
        height: 64px;
    }

    .wf-byline .wf-byline-desc {
        font-size: smaller;
        word-break: break-word;
    }

    .wf-byline .wf-byline-social {
        font-size: smaller;
    }
</style>

<style>
    .devsite-banner-announcement {
        background-color: #e8f0fe;
        color: #424242;
    }

    .devsite-banner-announcement :link,
    .devsite-banner-announcement :visited {
        background: #e8f0fe;
        color: #039BE5;
    }

    .devsite-banner-announcement span.material-icons {
        vertical-align: middle;
        margin-right: 8px;
    }
</style>
@endsection

@section('content')

{{-- @include('frontend.components.blog_search') --}}

<div class="devsite-main-content" has-book-nav="" has-toc="">

    @if(isset($post->tocMenu) && count($post->tocMenu))
    <div class="devsite-nav devsite-toc devsite-toc-outside" visible="" fixed="" max-height="481" offset="0">
        <ul class="devsite-nav-list" scrollbars=""
            style="max-height: 481px; transform: translate3d(0px, 0px, 0px); max-width: 756px;">

            <li class="devsite-nav-item devsite-nav-heading devsite-toc-toggle">
                <a href="#top_of_page" class="devsite-nav-title">
                    <span class="devsite-nav-text">Contents</span>
                </a>
            </li>
            @foreach($post->tocMenu as $menu)
            <li class="devsite-nav-item">
                <a href="{{$menu->getUri()}}" class="devsite-nav-title"><span
                        class="devsite-nav-text">{{$menu->getLabel()}}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="devsite-content">

        <div class="devsite-article-meta">
            <ul class="devsite-breadcrumb-list">
                <li class="devsite-breadcrumb-item">
                    <a href="/" class="devsite-breadcrumb-link " data-category="Site-Wide Custom Events"
                        data-label="Breadcrumbs" data-value="1">
                        Home
                    </a>
                </li>
                <li class="devsite-breadcrumb-item">
                    <div class="devsite-breadcrumb-guillemet material-icons" aria-hidden="true"></div>
                    <a href="{{ route('articles') }}" class="devsite-breadcrumb-link "
                        data-category="Site-Wide Custom Events" data-label="Breadcrumbs" data-value="2">
                        Articles
                    </a>
                </li>
                <li class="devsite-breadcrumb-item">
                    <div class="devsite-breadcrumb-guillemet material-icons" aria-hidden="true"></div>
                    <a href="{{ route('article', $post->slug) }}" class="devsite-breadcrumb-link "
                        data-category="Site-Wide Custom Events" data-label="Breadcrumbs" data-value="3">
                        {{ $post->title }}
                    </a>
                </li>
            </ul>
        </div>

        <article class="devsite-article">

            <section class="wf-byline" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                <div class="attempt-left">
                    <figure>
                        <img itemprop="image" src="{{$post->created_by->photo_url}}" alt="Ivan Mijatovic">
                    </figure>
                </div>
                <section class="wf-byline-meta">
                    <div class="wf-byline-name">
                        By
                        <span itemprop="name" class="text-muted">
                            <span itemprop="givenName">{{$post->created_by->name}}</span>
                        </span>
                    </div>
                </section>
            </section>
            <article class="devsite-article-inner">
                {{-- <div class="devsite-banner devsite-banner-announcement">
                    <div class="devsite-banner-message">
                        <div class="devsite-banner-message-text">
                            Didn't make the <code>#ChromeDevSummit</code> this year? Catch all the content (and
                            more!) in the <a
                                href="https://www.youtube.com/playlist?list=PLNYkxOF6rcIDA1uGhqy45bqlul0VcvKMr">Chrome
                                Dev Summit 2019</a> playlist on our <a
                                href="https://www.youtube.com/user/ChromeDevelopers/">Chrome Developers YouTube
                                Channel</a>.

                        </div>
                    </div>
                </div> --}}

                <div text="{{ $post->title}}" for="get-on-the-css-grid" level="h1" class="devsite-heading">
                    <h1 class="devsite-page-title" is-upgraded="" id="get-on-the-css-grid">{{ $post->title}}</h1>
                </div>

                <div>
                    <form action="{{route('artice-post-like')}}" method="POST">
                        @csrf
                        <input type="hidden" name="item_id" value="{{$post->id}}">
                        <input type="hidden" name="slug" value="{{$post->slug}}">
                        <input type="hidden" name="attribute_id" value="{{$attributes->where('name', 'likes')->first()->id}}">
                        <button type="submit">Likes : <b>{{ $post->likes}}</b></button>
                    </form>
                </div>

                <div class="devsite-toc devsite-nav devsite-toc-embedded" devsite-toc-embedded="" visible="">
                    <ul class="devsite-nav-list" scrollbars="">
                        <li class="devsite-nav-item devsite-nav-heading devsite-toc-toggle"><a href="#top_of_page"
                                class="devsite-nav-title"><span class="devsite-nav-text">Contents</span></a>
                        </li>
                        <li class="devsite-nav-item">
                            <a href="#executive_summary" class="devsite-nav-title"><span
                                    class="devsite-nav-text">Executive summary</span>
                            </a>
                        </li>
                        <li class="devsite-nav-item">
                            <a href="#try_it_out" class="devsite-nav-title"><span class="devsite-nav-text">Try it
                                    out</span>
                            </a>
                        </li>
                        <li class="devsite-nav-item">
                            <a href="#let_us_know_what_you_think" class="devsite-nav-title"><span
                                    class="devsite-nav-text">Let us know what youthink</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="devsite-article-body  clearfix">

                    {{-- <section class="wf-byline" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                        <div class="attempt-left">
                            <figure>
                                <img itemprop="image" src="{{ asset('img/ivan-mijatovic.jpg') }}" alt="Ivan Mijatovic">
                            </figure>
                        </div>
                        <section class="wf-byline-meta">
                            <div class="wf-byline-name">
                                <strong>By</strong>
                                <span itemprop="name">
                                    <span itemprop="givenName">Ivan</span>
                                        <span itemprop="familyName">Mijatović</span>
                                </span>
                            </div>
                        </section>
                    </section> --}}

                    {!! $post->body !!}

                </div>


                <div>
                    <h3>Comments:</h3>
                        @foreach($post->comments as $comment)
                            <div style="background:#f2f2f2; border-radius:16px; padding:10px 20px;margin-bottom:20px;">
                                {!! $comment->text !!}
                            </div>
                        @endforeach

                        <h4>Add new Comment</h4>
                        <form action="{{route('artice-post-comment')}}" method="POST">
                            @csrf
                            <textarea name="text"  rows="5" style="width:100%;margin-bottom:10px;" placeholder="Type your comment"></textarea>
                            <input type="hidden" name="item_id" value="{{$post->id}}">
                            <input type="hidden" name="slug" value="{{$post->slug}}">
                            <br>
                            <button type="submit">Post Comment</button>
                        </form>
                </div>


                <div position="footer" selected-rating="0" hover-rating-star="0" class="devsite-page-rating">

                    <div>
                        <div id="disqus_thread"></div>
                        <script>
                            var disqus_config = function () {
                            this.page.url = "{{ route('article',$post->slug) }}";
                            this.page.identifier = {{$post->id}};
                        };

                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://ivanmijatovic.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                        </script>
                    </div>


                    {{-- <div>
                        <div class="devsite-rating-caption">Was this page helpful?</div>
                        <div class="devsite-rating-stars">
                            <div class="devsite-rating-star devsite-rating-star-outline  material-icons"
                                data-rating-val="1" role="button" data-title="Unusable documentation"
                                aria-label="Site content star ratings, rating 1 out of 5"></div>
                            <div class="devsite-rating-star devsite-rating-star-outline  material-icons"
                                data-rating-val="2" role="button" data-title="Poor documentation"
                                aria-label="Site content star ratings, rating 2 out of 5"></div>
                            <div class="devsite-rating-star devsite-rating-star-outline  material-icons"
                                data-rating-val="3" role="button" data-title="OK documentation"
                                aria-label="Site content star ratings, rating 3 out of 5"></div>
                            <div class="devsite-rating-star devsite-rating-star-outline  material-icons"
                                data-rating-val="4" role="button" data-title="Good documentation"
                                aria-label="Site content star ratings, rating 4 out of 5"></div>
                            <div class="devsite-rating-star devsite-rating-star-outline  material-icons"
                                data-rating-val="5" role="button" data-title="Excellent documentation"
                                aria-label="Site content star ratings, rating 5 out of 5"></div>
                        </div>
                        <div class="devsite-rating-internal"><span class="devsite-rating-stats"></span></div>
                    </div> --}}
                </div>

            </article>
        </article>

        {{-- <div class="devsite-content-footer">
            <div class="nocontent">
                <p>Except as otherwise noted, the content of this page is licensed under the <a
                        href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0
                        License</a>,
                    and code samples are licensed under the <a href="https://www.apache.org/licenses/LICENSE-2.0">Apache
                        2.0
                        License</a>. For details, see the <a href="https://developers.google.com/site-policies">Google
                        Developers Site Policies</a>. Java is a registered trademark of Oracle and/or its affiliates.
                </p>
            </div>
        </div> --}}

    </div>
</div>




@endsection
