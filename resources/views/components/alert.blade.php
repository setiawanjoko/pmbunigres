@if(session('status') || $errors->any())
    <div>
        <div class="alert alert-{{ session('status') ?? 'danger' }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            @if(isset($errors))
                @foreach($errors->all() as $message)
                    {{ $message }}
                @endforeach
            @endif
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
