@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    <form action="/threads" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="channel_id">Choose a channel:</label>
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                <option value="">Choose one...</option>
                                @foreach (\App\Models\Channel::all() as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group my-3">
                            <label for="title">Title</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group my-3">
                            <label for="body">Body</label>
                            <textarea id="body" class="form-control" name="body" rows="8" required>{{ old('body') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-dark">Publish</button>
                        </div>
                    </form>

                    @if ($errors->any())
                        <ul class="alert alert-danger mt-2">
                            @foreach ($errors->all() as $error)
                                <li class="px-1 list-unstyled">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
