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
                            <label for="title">Title</label>
                            <input id="title" type="text" class="form-control" name="title" required>
                        </div>

                        <div class="form-group my-3">
                            <label for="body">Body</label>
                            <textarea id="body" class="form-control" name="body" rows="8" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-outline-dark">Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
