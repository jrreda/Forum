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
    @foreach ($activities as $date => $activity)
        <h4 class="mt-5 mb-3 text-center">{{ $date }}</h4>

        @foreach ($activity as $record)
            @if (view()->exists('profiles.activities.' . $record->type))
                @include('profiles.activities.' . $record->type, ['activity' => $record])
            @endif
        @endforeach
    @endforeach
</div>
@endsection
