$("#btnNovoCliente").on('click', function(){
    location.href = '/cliente/cadastrar';
});

function editarCliente(id){
    location.href = `/cliente/editar/${id}`;
}

function excluirCliente(id){
    let resp = confirm("Deseja realmente excluir esse cliente? Essa ação não pode ser desfeita");

    let token = document.getElementsByName("_token").value;
    if(resp){
        $.ajax({
            url: `/cliente/delete/${id}`,
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
