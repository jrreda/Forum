@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                    @forelse ($threads as $thread)
                        <article>
                            <div class="d-flex justify-content-between pb-2">
                                <a class="pb-1 text-decoration-none" href="{{ $thread->path() }}">{{ $thread->title }}</a>
                                <a class="text-decoration-none" href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</a>
                            </div>

                            <div class="body">{{ $thread->body }}</div>
                        </article>

                        <hr>
                    @empty
                        <p>There are no relevant results at this time.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
