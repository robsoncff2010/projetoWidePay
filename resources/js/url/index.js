$(document).ready(function(){
    var tableUrl = $('#listUrl').DataTable({
        ajax: {
            url: URL_GET_LIST,
            headers: {
                "X-CSRF-TOKEN": document.getElementsByName('csrf-token')[0].getAttribute('content')
            },
            type: 'POST',
        },
        drawCallback: function (){
            $('[data-toggle="tooltip"]').tooltip()
        },
        serverSide: true,
        responsive: true,
        processing: true,
        searching : false,
        columnDefs: [
            /*{"width": "30%", "targets": [1]},
            {"width": "15%", "targets": [4, 5]},
            {"width": "5%", "targets": [0, 2, 3]},
            {"className": "text-center", "targets": [1, 2, 3, 4, 7, 8, 9]},
            {"className": "text-right", "targets": [5, 6]},*/
        ],
        order: [[ 0, "asc" ]],
        columns: [
            {data: 'id'},
            {data: 'user_id'},
            {data: 'url'},
            {data: 'http_status'},
            {data: 'http_body'},
            {data: 'action', "bSortable": false},
        ]
    })

    $('#showModalNewUrl').on('click', function(){
        $('#modalNewEditUrlTitle').text('Cadastro de Url');
        $('#inputUrl').val('');
        $('#modalUrlId').val('');
        $('#modalNewEditUrl').modal('show');
    })

    $(document).on('click', '.editarUrl', function(){
        $('#modalNewEditUrlTitle').text('Edição de Url');
        $('#inputUrl').val($(this)[0].dataset.idUrlText);
        $('#modalUrlId').val($(this)[0].dataset.idUrl);
        $('#modalNewEditUrl').modal('show');
    })

    $(document).on('click', '.deleteUrl', function(){
        $('#modalDeleteUrlId').val($(this)[0].dataset.idUrl);
        $('#modalInputDeleteUrl').val($(this)[0].dataset.idUrlText);
        $('#modalDeleteUrl').modal('show');
    })

    $('#saveEditUrl').on('click', function(){
        if($('#modalUrlId').val() != '')
        {
            formData = {
                _token : $("meta[name='csrf-token']").attr('content'),
                id     : $('#modalUrlId').val(),
                url    : $('#inputUrl').val(),
            };

            msg = 'Url foi editado com sucesso!';

            ajaxUrl(URL_EDIT, formData, msg, 2); // 1 = cadastrar url, 2 = editar url, 3 = excluir url
        }else
        {
            formData = {
                _token : $("meta[name='csrf-token']").attr('content'),
                url    : $('#inputUrl').val(),
            };

            msg = 'Url foi cadastrado com sucesso!';

            ajaxUrl(URL_REGISTER, formData, msg, 1); // 1 = cadastrar url, 2 = editar url, 3 = excluir url
        }

        $('#modalUrlId').val('');
    })

    $('#modalButtonDeleteUrl').on('click', function(){
        formData = {
            _token : $("meta[name='csrf-token']").attr('content'),
            id     : $('#modalDeleteUrlId').val(),
        };

        msg = 'Url foi excluído com sucesso!';

        ajaxUrl(URL_DELETE, formData, msg, 3); // 1 = cadastrar url, 2 = editar url, 3 = excluir url
    })

    function ajaxUrl(url, formData, msg, action)
    {
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function success(response) {
                if(response.result == true)
                {
                    switch (action) {
                        case 1:
                        case 2:
                            $('#inputUrl').val('');
                            $('#modalNewEditUrl').modal('hide');
                            break;
                        case 3:
                            $('#modalDeleteUrl').modal('hide');
                            break;
                    }

                    tableUrl.ajax.reload();

                    alert(msg);
                }else
                {
                    alert('Aconteceu algum erro, tente novamente!');
                }
            },
            error: function error(msg) {
                alert(msg);
            },
        });
    }
});
