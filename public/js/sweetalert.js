function deleteAlert(params = 'btn-danger')
{
    $('.'+params).click(function(event){
        event.preventDefault(); //nao deixa o botao fazer o submit
        Swal.fire({
            title: 'Tem certeza disso?',
            text: "Esta ação não poderá ser revertida",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!'
        }).then((result) => {
            if (result.value) {
                this.parentNode.submit(); //submit do pai(form) do botao acionado
            } else {
                console.log('Error', result)
            }
        });

    });
}

function confirmeUrlExcludeRoleUserAlert(params)
{
    Swal.fire({
        title: 'Tem certeza?',
        text: "Após a confirmação positiva o usuário não terá mais as permissões fornecidas por esse Perfil do sistema.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, desvincule o perfil!'
    }).then((result) => {

        console.log(result);
        if (result.value) {

            fetch('delete_roles_user/'+params[1]+'/'+params[2]).then(function(response) {
                if(response.ok) {
                    Swal.fire(
                        'Desvinculado!',
                        'O usuário desvinculado do Perfil',
                        'success'
                    )
                    params[0].remove();//Exclui o botao da div

                } else {
                  console.log('Network response was not ok.');
                  Swal.fire(
                    'Erro ao tentar Desvincular!',
                    'O usuário não pôde desvinculado do Perfil',
                    'error'
                  )
                }
            }).catch(function(error) {
                console.log('There has been a problem with your fetch operation: ' + error.message);
                Swal.fire(
                    'Erro ao tentar Desvincular!',
                    error.message,
                    'error'
                  )
            });
        }
    });
}


function MessageAlert(params)
{
    let message = document.querySelector('#'+params).textContent;

    if(params[1] == 'success') {
        type_message = "Sucesso"
    } else if(params[1] == 'error') {
        type_message = "Opss!"
    }

    Swal.fire(
        type_message,
        message,
        params[1]
    )
}
