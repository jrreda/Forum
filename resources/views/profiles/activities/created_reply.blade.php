<x-activity body="{{ $activity->subject->body }}">
    <span class="lead">
        {{ $user->name }}
    </span> replied to a 
    <a href="{{ $activity->subject->thread->path() }}">
        {{ $activity->subject->thread->title }}
    </a>
</x-activity>