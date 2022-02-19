<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3" style="text-align: right">
            <button id='showModalNewUrl' class="btn btn-primary">
                {{ __('Cadastrar Url') }}
            </button>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __("Lista de Url's Cadastradas") }}</div>
                <div class="card-body">
                    <table
                        class="table table-hover"
                        id="listUrl"
                        style="width: 100%">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>user_id</td>
                            <td>url</td>
                            <td>http_status</td>
                            <td>http_body</td>
                            <td>Ações</td>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
