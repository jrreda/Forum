<div class="card-header d-flex justify-content-between align-items-center">
    <div>
        <a href="#" class="text-decoration-none">{{ $reply->owner->name }}</a>
        said that {{ $reply->created_at->diffForHumans() }}...
    </div>

    <div>
        <form action="/replies/{{ $reply->id }}/favorites" method="POST">
            @csrf

            <button type="submit" class="btn btn-outline-secondary mb-1" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                {{ $reply->favorites()->count() }} {{ Str::plural('Favorite', $reply->favorites()->count()) }}
            </button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="body">{{ $reply->body }}</div>
    </div>
</div>
