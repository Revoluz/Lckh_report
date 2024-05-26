<div class="btn-group">
    <button type="button" class="btn btn-warning" data-toggle="modal"
        data-target="#modal-edit-tipe-dokumen{{ $documentType->id }}">
        <i class="fas fa-edit text-white"></i>
    </button>
    <form
        action="{{ route('document-type.destroy', ['document_type' => $documentType->id]) }}"
        method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger"
            onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
    {{-- modal update --}}
            <div class="modal fade" id="modal-edit-tipe-dokumen{{ $documentType->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Masukan Tipe Dokumen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('document-type.update', ['document_type' => $documentType->id]) }}"
                        method="POST">
                        <div class="modal-body">
                            @method('put')
                            @csrf

                            <div class="form-group">
                                <label for="tipe_dokumen">Edit Tipe Dokumen</label>
                                <input type="text" name="tipe_dokumen"
                                    class="form-control @error('tipe_dokumen')
                                is-invalid
                            @enderror"value="{{ old('tipe_dokumen', $documentType->name) }}"
                                    id="tipe_dokumen" placeholder="Masukan Tipe Dokumen" />
                                @error('tipe_dokumen')
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
</div>
