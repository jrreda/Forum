<x-activity body="{{ $activity->subject->body }}">
    <span class="lead">
        {{ $user->name }}
    </span>
    published a 
    <a href="{{ $activity->subject->path() }}">
        {{ $activity->subject->title }}
    </a>
</x-activity>