function verProjeto(id_projeto)
{
    location.href = `/projeto/detalhes/${id_projeto}`;
}

function editarProjeto(id_projeto)
{
    location.href = `/projeto/editar/${id_projeto}`;
}

function excluir()
{
    let resp = confirm("Deseja realmente excluir esse projeto? Essa ação é irreversivel!");

    let token = document.getElementsByName("_token").value;

    if(resp){
        $.ajax({
            url: `/projeto/delete/${id}`,
            method: 'delete',
            dataType: 'json',
            data:{
                _token: $("[name='_token']").val()
            },
            success: function(resp){
                alert(resp.message);
                location.reload();
            }
        });
    }else{
        alert("Operação cancelada com sucesso!");
    }
}

$(document).ready(function(){
    $('.input_qtde').on('keyup', function (event) {
        this.value = this.value.replace(/[^0-9]/gm, '');
    });

    $("#btnSalvar").on("click", function(){
        let formData = new FormData($('#form_projetos')[0]);

        let url = '/projeto/salvar';

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false
        }).done(function(resp){
            alert(resp.mensage);
            location.href = '/projeto';
        }).fail(function(err){
            console.log(err);
        })
    });
})
