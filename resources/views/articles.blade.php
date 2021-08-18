@extends('layout')

@section('content')

<div class="container mt-100 mt-60">
    <div class="row">
        <div class="col-12 text-center">
            <div class="section-title mb-4 pb-2">
                <h4 class="title mb-4">Latest Blog &amp; News</h4>
                <p class="text-muted para-desc mx-auto mb-0">Build responsive, mobile-first projects on the web with the world's most popular front-end component library.</p>
            </div>
        </div>
    </div>

    <div class="row">
        @if(isset($posts) && count($posts))
            @foreach($posts as $post)
                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                    <div class="blog-post rounded border">
                        <div class="blog-img d-block overflow-hidden position-relative">
                            <img src="{{$post->featured_image[0]->link}}" class="img-fluid rounded-top" alt="">
                            <div class="overlay rounded-top bg-dark"></div>
                            <div class="post-meta">
                                <a href="javascript:void(0)" class="text-light d-block text-right like"><i class="mdi mdi-heart"></i> {{ isset($post->likes) ? $post->likes : 0 }} Likes</a>
                                <a href="{{ route('article',$post->slug) }}" class="text-light read-more">Read More <i class="mdi mdi-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="content p-3">
                            <small class="text-muted p float-right">{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</small>
                            <small><a href="javascript:void(0)" class="text-primary">Marketing</a></small>
                            <h4 class="mt-2"><a href="{{ route('article',$post->slug) }}" class="text-dark title">{{ $post->title }}</a></h4>
                            <p class="text-muted mt-2">{{ $post->description }}</p>
                            <div class="pt-3 mt-3 border-top d-flex">
                                <img src="{{$post->created_by->photo_url}}" class="img-fluid avatar avatar-ex-sm rounded-pill mr-3 shadow" alt="">
                                <div class="author mt-2">
                                    <h6 class="mb-0"><a href="{{ route('article',$post->slug) }}" class="text-dark name">{{$post->created_by->name}}</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>


@endsection


