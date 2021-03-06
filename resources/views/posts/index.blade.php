@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>一覧ページ</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">新規投稿</a>
            <div class="card text-center">
                <div class="card-header">
                    Blogs
                </div>
                @foreach ($posts as $post)
                    <div class="card-body">
                        <h5 class="card-title">タイトル：{{ $post->title }}</h5>
                        <p class="card-text">内容：{{ $post->body }}</p>
                        <p class="card-text">投稿者：{{ $post->user->name }}</p>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細</a>
                    </div>
                    <div class="card-footer text-muted">
                        投稿日：{{ $post->created_at }}
                    </div>
                    @endforeach
                </div>
        </div>
    </div>
</div>
@endsection
