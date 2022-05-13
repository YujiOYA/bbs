@extends('layouts.app')

@section('content')
<div class="container mt-4 ">
    <div class="mb-4">
        @if (Auth::check())
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            投稿を新規作成する!
        </a>
        @endif
    </div>
    <div class="row">
        @foreach ($posts as $post)
        @if($post-> confirms ==null)
        <div class="col-sm-4 mb-1">

            <div class="card">
                        <div class="d-flex justify-content-center align-items-center" style="width:300px; height:200px;"></div>
                        <div class="card-body">
                            <h5 class="">
                                この投稿は本部の承認待ちです       
                            </h5>

                            <p class="card-text">
                                この投稿は承認後に公開されます
                            </p>
                            <span class="card-link text-muted">
                                この投稿は承認後に公開されます
                            </span>
                        </div>
                        <div class="card-footer">
                            <p class="mr-2">
                                投稿者: {{App\User::find($post->user_id)['name'] }}
                            </p>
                            <p class="mr-2">
                                投稿日時 {{ $post->created_at->format('Y.m.d') }}
                            </p>

                            @if ($post->comments->count())
                            <p class="badge badge-primary">
                                コメント {{ $post->comments->count() }}件
                            </p>
                            @endif
                        </div>
            @auth()
            @if(Auth::user()->id == 1)
            <div class="card-body">
                            <h5 class="">
                                {{ $post->title }}
                                
                            </h5>

                            <p class="card-text">
                                {!! nl2br(e(Str::limit($post->body, 200))) !!}
                            </p>
                            <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                                続きを読む
                            </a>
                        </div>
            <div class="d-flex">
            <form method="post" action="posts/confirms">
            @csrf
            <input type="hidden" name="confirms" value=1>
            <input type="hidden" name="id" value="{{$post -> id}}">
            <button type="submit"class=" bg-success btn w-100">この投稿を承認する</button>
            </form>
            <form method="post" action="posts/confirms">
            @csrf
          
            <input type="hidden" name="confirms" value=0>
            <input type="hidden" name="id" value="{{$post -> id}}">
            <button type="submit"class=" bg-danger btn w-100">この投稿を承認しない</button>
            </form>
            </div>
            @endif
            @endauth
            </div>
            </div>
            @else
        <div class="col-sm-4 mb-1">
            <div class="card">
                @isset($post->imagePath)
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <img src={{Storage::disk('s3')->url($post->imagePath)}} aria-label="Image cap" width="auto" height='200px'></div>
                @else
                        <div class="d-flex justify-content-center align-items-center" style="width:auto; height:200px;"></div>
                @endisset
                        <div class="card-body">
                            <h5 class="">
                                {{ $post->title }}
                                
                            </h5>

                            <p class="card-text">
                                {!! nl2br(e(Str::limit($post->body, 200))) !!}
                            </p>
                            <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                                続きを読む
                            </a>
                        </div>
                        <div class="card-footer">
                            <span class="mr-2">
                                投稿者: {{App\User::find($post->user_id)['name'] }}
                            </span>
                            <span class="mr-2">
                                投稿日時 {{ $post->created_at->format('Y.m.d') }}
                            </span>

                            @if ($post->comments->count())
                            <span class="badge badge-primary">
                                コメント {{ $post->comments->count() }}件
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="d-flex justify-content-center mb-5">
                {{ $posts->links() }}
            </div>
        </div>
        @endsection