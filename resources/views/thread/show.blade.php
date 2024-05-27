@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#" class="small">{{ $thread->creator->name }}</a> posted:
                    <br>
                    {{ $thread->title }}
                </div>

                <div class="card-body">{{ $thread->body }}</div>
            </div>

            </br>
            
            <h4 class="lead text-secondary">Comments: </h4>
            @foreach ($thread->replies as $reply)
                @include('thread._reply')
                </br>
            @endforeach

            {{ $replies->links() }}

            @auth
                <form action="{{ $thread->path() }}/replies" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="p-3 rounded-2" name="body" id="body" cols="90" rows="5" placeholder="Have Something to say?"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-dark mt-3">Post</button>
                </form>
            @else
                <p class="text-center lead">Please <a href="{{ route('login') }}">Login</a> to participate in this discussion.</p>
            @endauth
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p>
                        This Thread was published {{ $thread->created_at->diffForHumans() }} by <a href="#">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
