<div class="btn-group">
    <a href="{{ route('workPlace.show', ['work_place' => $workPlace->id]) }}">
        <button type="button" class="btn btn-info">
            <i class="fas fa-eye"></i>
        </button>
    </a>
    <button type="button" class="btn btn-warning" data-toggle="modal"
        data-target="#modal-edit-tempat-tugas{{ $workPlace->id }}">
        <i class="fas fa-edit text-white"></i>
    </button>
    <form action="{{ route('workPlace.destroy', ['work_place' => $workPlace->id]) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
<div class="modal fade" id="modal-edit-tempat-tugas{{ $workPlace->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Masukan Tempat Tugas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('workPlace.update', ['work_place' => $workPlace->id]) }}" method="POST">
                <div class="modal-body">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="tempat_tugas">Edit Tempat Tugas</label>
                        <input type="text" name="tempat_tugas"
                            class="form-control @error('tempat_tugas')
                        is-invalid
                    @enderror"value="{{ old('tempat_tugas', $workPlace->work_place) }}"
                            id="tempat_tugas" placeholder="Masukan Tempat Tugas" />
                        @error('tempat_tugas')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary button-submit">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
