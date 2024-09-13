<x-activity body="{{ $activity->subject->favorited->body }}">
    <span class="lead">
        {{ $user->name }}
    </span>
    favorited a 
    <a href="{{ $activity->subject->favorited->path() }}">
        reply
    </a> 
    in the 
    <a href="{{ $activity->subject->favorited->thread->path() }}">
        {{ $activity->subject->favorited->thread->title }}
    </a> 
    Thread
</x-activity>
