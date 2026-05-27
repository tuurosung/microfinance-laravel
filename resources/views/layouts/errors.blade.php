@if ($errors->any())

    <div class="bg-error/20 border text-sm text-error rounded-md p-4 mb-6" role="alert">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item bg-none border-0">{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif
