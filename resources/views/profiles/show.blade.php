@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center gap-3">
        <h1>
            {{ $user->name }}
        </h1>
        <small class="lead">Since {{ $user->created_at->diffForHumans() }}</small>
    </div>

    <hr class="text-body-tertiary">

    @foreach ($threads as $thread)
        <div class="card mb-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">
                    {{ $thread->title }}
                </h4>

                <span>
                    {{ $thread->created_at->diffForHumans() }}
                </span>
            </div>

            <div class="card-body">{{ $thread->body }}</div>
        </div>
    @endforeach

    {{ $threads->links() }}
</div>
@endsection
