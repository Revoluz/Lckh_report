<div class="btn-group">
    <a href="{{ route('document.show', ['document' => $data->id]) }}">
        <button type="button" class="btn btn-info">
            <i class="fas fa-eye"></i>
        </button>
    </a>
    @if (Gate::check('auth.admin'))

    <a href="{{ route('document.edit', ['document' => $data->id]) }}">
        <button type="button" class="btn btn-warning">
            <i class="fas fa-edit text-white"></i>
        </button>
    </a>
    <form action="{{ route('document.destroy', ['document' => $data->id]) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
    @endif
    <a href="{{ route('document.download', ['document' => $data->id]) }}">
        <button type="button" class="btn btn-success">
            <i class="fas fa-download text-white"></i>
        </button>
    </a>
</div>
