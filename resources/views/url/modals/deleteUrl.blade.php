<div class="modal fade" id="modalDeleteUrl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Excluir Url</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <label class="col-md-3 col-form-label">Deseja excluir a Url:</label>
                <div class="col-md-9">
                    <input type="hidden" id="modalDeleteUrlId" value="">
                    <input id="modalInputDeleteUrl" class="form-control" disabled value="{{ old('inputUrl') }}">
                </div>
            </div>
        </div>
        <div class="modal-footer text-center">
          <button type="button" class="btn btn-success" id="modalButtonDeleteUrl" value="">Confirmar</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
