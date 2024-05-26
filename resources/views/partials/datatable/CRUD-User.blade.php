<div class="btn-group">
    <a href="{{ route('userAdmin.show', ['nip' => $user->nip]) }}">
        <button type="button" class="btn btn-info">
            <i class="fas fa-eye"></i>
        </button>
    </a>
    <a href="{{ route('userAdmin.edit', ['nip' => $user->nip]) }}">
        <button type="button" class="btn btn-warning">
            <i class="fas fa-edit text-white"></i>
        </button>
    </a>
    <form
        action="{{ route('userAdmin.destroy', ['user' => $user->id]) }} "method="post">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
