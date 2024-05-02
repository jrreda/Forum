<div class="card-header">
    <a href="#" class="text-decoration-none">{{ $reply->owner->name }}</a>
    said that {{ $reply->created_at->diffForHumans() }}...
</div>
<div class="card">
    <div class="card-body">
        <div class="body">{{ $reply->body }}</div>
    </div>
</div>
