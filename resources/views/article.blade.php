@extends('layout')

@section('script')
@parent

@endsection

@section('css')
@parent

<style type="text/css" media="screen">

</style>
@endsection

@section('content')
<div class="container pb50">
    <div class="row">
        <div class="col-md-10 offset-md-1 mb40">
            <article>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('articles')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                    </ol>
                </nav>
                <h1>{{ $post->title}}</h1>
                <img src="https://images.unsplash.com/photo-1455734729978-db1ae4f687fc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80" alt="" class="img-fluid mb30">
                <div class="post-content">
                    <ul class="post-meta list-inline">
                        <li class="list-inline-item">
                            <img itemprop="image" src="{{$post->created_by->photo_url}}" alt="Ivan Mijatovic" class="avatar-small">
                            <a href="#">{{$post->created_by->name}}</a>
                        </li>
                        <li class="list-inline-item">
                            <i class="fa fa-calendar-o"></i> <a href="#">{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</a>
                        </li>
                        <li class="list-inline-item">
                            <form action="{{route('artice-post-like')}}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{$post->id}}">
                                <input type="hidden" name="slug" value="{{$post->slug}}">
                                <input type="hidden" name="attribute_id" value="{{$attributes->where('name', 'likes')->first()->id}}">
                                <button type="submit" class="btn btn-outline-secondary  ">Likes : <b>{{ $post->likes}}</b></button>
                            </form>
                            {{-- <i class="fa fa-tags"></i> <a href="#">Bootstrap4</a> --}}
                        </li>
                    </ul>
                    <div>
                        {!! $post->body !!}
                    </div>
                    <ul class="list-inline share-buttons">
                        <li class="list-inline-item">Share Post:</li>
                        <li class="list-inline-item">
                            <a href="#" class="social-icon-sm si-dark si-colored-facebook si-gray-round">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="social-icon-sm si-dark si-colored-twitter si-gray-round">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="social-icon-sm si-dark si-colored-linkedin si-gray-round">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                    {{-- <hr class="mb40">
                    <h4 class="mb40 text-uppercase font500">About Author</h4>
                    <div class="media mb40">
                        <i class="d-flex mr-3 fa fa-user-circle fa-5x text-primary"></i>
                        <div class="media-body">
                            <h5 class="mt-0 font700">Jane Doe</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div> --}}
                    <hr class="mb40">
                    <h4 class="mb40 text-uppercase font500">Comments</h4>
                    @foreach($post->comments as $comment)
                        <div class="media mb40">
                            <i class="d-flex mr-3 fa fa-user-circle-o fa-3x"></i>
                            <div class="media-body">
                                {{-- <h5 class="mt-0 font400 clearfix">Jane Doe</h5> --}}

                                {!! $comment->text !!}
                            </div>
                        </div>
                    @endforeach

                    <hr class="mb40">
                    <h4 class="mb40 text-uppercase font500">Post a comment</h4>
                    <form action="{{route('artice-post-comment')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea   name="text"  class="form-control" rows="5" placeholder="Type your comment"></textarea>

                            <input type="hidden" name="item_id" value="{{$post->id}}">
                            <input type="hidden" name="slug" value="{{$post->slug}}">
                        </div>
                        <div class="clearfix float-right">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </article>

        </div>
    </div>
</div>

@endsection
