<div class="btn-group">
    <a href="{{ route('lckh.show', ['lckh' => $data->id]) }}">
        <button type="button" class="btn btn-info">
            <i class="fas fa-eye"></i>
        </button>
    </a>
    @if (!(Route::is('listlckh.index') && auth()->user()->role->role== 'Pengawas'))
    <a href="{{ route('lckh.edit', ['lckh' => $data->id]) }}">
        <button type="button" class="btn btn-warning">
            <i class="fas fa-edit text-white"></i>
        </button>
    </a>
    <form action="{{ route('lckh.destroy', ['lckh' => $data->id]) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
    @endif
</div>
