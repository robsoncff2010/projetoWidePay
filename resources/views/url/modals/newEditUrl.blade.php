<div class="modal fade" id="modalNewEditUrl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalNewEditUrlTitle"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <label for="inputUrl" class="col-md-1 col-form-label">Url:</label>
                <div class="col-md-11">
                    <input type="hidden" id="modalUrlId" value="">
                    <input id="inputUrl" class="form-control" name="inputUrl" value="{{ old('inputUrl') }}" placeholder="http://127.0.0.1:8000/exemplo" autofocus>
                    <div class="invalid-feedback">url inválido</div>
                </div>
            </div>
        </div>
        <div class="modal-footer text-center">
          <button type="button" class="btn btn-success" id="saveEditUrl">Salvar</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
