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
        </div>
    </div>
    </br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class="lead text-secondary">Comments: </h4>
            @foreach ($thread->replies as $reply)
                @include('thread._reply')
                </br>
            @endforeach
        </div>
    </div>

    @auth    
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ $thread->path() }}/replies" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="p-3 rounded-2" name="body" id="body" cols="90" rows="5" placeholder="Have Something to say?"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-dark mt-3">Post</button>
                </form>
            </div>
        </div>
    @else
        <p class="text-center lead">Please <a href="{{ route('login') }}">Login</a> to participate in this discussion.</p>
    @endauth
</div>
@endsection

