@props(['body'])

<div class="card mb-2">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            {{ $slot }}
        </div>
    </div>

    <div class="card-body">
        {{ $body }}
    </div>
</div>