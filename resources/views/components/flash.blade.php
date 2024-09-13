@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info" role="alert">
        {{ session('info') }}
    </div>
@endif

@section('scripts')
    <script>
        setTimeout(() => {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 5000); // Removes the alert after 5 seconds
    </script>
@endsection