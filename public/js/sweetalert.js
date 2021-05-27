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


function MessageAlert(params)
{
    let message = document.querySelector('#'+params).textContent;

    if(params[1] == 'success') {
        type_message = "Sucesso"
    }

    Swal.fire(
        'Sucesso!',
        message,
        params[1]
    )
}
