$(document).ready(function(){var t=$("#listUrl").DataTable({ajax:{url:URL_GET_LIST,headers:{"X-CSRF-TOKEN":document.getElementsByName("csrf-token")[0].getAttribute("content")},type:"POST"},drawCallback:function(){$('[data-toggle="tooltip"]').tooltip()},serverSide:!0,responsive:!0,processing:!0,searching:!1,columnDefs:[],order:[[0,"asc"]],columns:[{data:"id"},{data:"user_id"},{data:"url"},{data:"http_status"},{data:"http_body",bSortable:!1},{data:"action",bSortable:!1}]});function a(a,e,l,o){$.ajax({url:a,method:"POST",data:e,dataType:"json",success:function(a){if(1==a.result)switch(o){case 1:case 2:$("#inputUrl").val(""),$("#modalNewEditUrl").modal("hide"),t.ajax.reload(),alert(l);break;case 3:$("#modalDeleteUrl").modal("hide"),t.ajax.reload(),alert(l);break;case 4:$(".modalDetailUrlTextArea").val(a.httpBody),$("#modalDetailUrl").modal("show")}else alert("Aconteceu algum erro, tente novamente!")},error:function(t){alert(t)}})}function e(t){return new RegExp("^(http|https)?://").test(t)}function l(){$("#inputUrl").removeClass("is-valid"),$("#inputUrl").removeClass("is-invalid")}$("#showModalNewUrl").on("click",function(){$("#modalNewEditUrlTitle").text("Cadastro de Url"),$("#inputUrl").val(""),$("#modalUrlId").val(""),l(),$("#modalNewEditUrl").modal("show")}),$(document).on("click",".editarUrl",function(){$("#modalNewEditUrlTitle").text("Edição de Url"),$("#inputUrl").val($(this)[0].dataset.idUrlText),$("#modalUrlId").val($(this)[0].dataset.idUrl),l(),$("#modalNewEditUrl").modal("show")}),$(document).on("click",".deleteUrl",function(){$("#modalDeleteUrlId").val($(this)[0].dataset.idUrl),$("#modalInputDeleteUrl").val($(this)[0].dataset.idUrlText),$("#modalDeleteUrl").modal("show")}),$("#saveEditUrl").on("click",function(){e($("#inputUrl").val())?(""!=$("#modalUrlId").val()?(formData={_token:$("meta[name='csrf-token']").attr("content"),id:$("#modalUrlId").val(),url:$("#inputUrl").val()},msg="Url foi editado com sucesso!",a(URL_EDIT,formData,msg,2)):(formData={_token:$("meta[name='csrf-token']").attr("content"),url:$("#inputUrl").val()},msg="Url foi cadastrado com sucesso!",a(URL_REGISTER,formData,msg,1)),$("#modalUrlId").val(""),l()):(l(),$("#inputUrl").addClass("is-invalid"))}),$(document).on("click",".detailBodyUrl",function(){formData={_token:$("meta[name='csrf-token']").attr("content"),id:$(this)[0].dataset.idUrl},msg="",a(URL_DETAIL,formData,msg,4)}),$("#inputUrl").on("keyup",function(){l(),e($("#inputUrl").val())?$("#inputUrl").addClass("is-valid"):$("#inputUrl").addClass("is-invalid")}),$("#modalButtonDeleteUrl").on("click",function(){formData={_token:$("meta[name='csrf-token']").attr("content"),id:$("#modalDeleteUrlId").val()},msg="Url foi excluído com sucesso!",a(URL_DELETE,formData,msg,3)}),$(document).ready(function(){setInterval(function(){t.ajax.reload()},15e3)})});
