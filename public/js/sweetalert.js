function deleteAlert(params = 'btn-danger')
{
    $('.'+params[0]).on('click',function(event){
        event.preventDefault(); //nao deixa o botao fazer o submit
        Swal.fire({
         title: params[1],
            text: params[2],
            icon: params[3],
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: params[4] + '!'//'Sim, excluir!'
        }).then((result) => {
            if (result.value) {
                this.parentNode.submit(); //submit do pai(form) do botao acionado
            } else {
                console.log('Error', result)
            }
        });

    });
}

function confirmeUrlExcludeRoleUserAlert(context, params)
{
    console.log(params)
    Swal.fire({
        title: params[2], //params[3]
        text: params[3],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: params[4],
        cancelButtonText: params[9]
    }).then((result) => {

        // console.log(result);
        if (result.value) {

            fetch('delete_roles_user/'+params[0]+'/'+params[1]).then(function(response) {
                if(response.ok) {
                    Swal.fire(
                        params[5],
                        params[6],
                        'success'
                    )
                    context.remove();//Exclui o botao da div

                } else {
                //   console.log('Network response was not ok.');
                  Swal.fire(
                    params[7],
                    params[8],
                    'error'
                  )
                }
            }).catch(function(error) {
                // console.log('There has been a problem with your fetch operation: ' + error.message);
                Swal.fire(
                    params[7],
                    error.message,
                    'error'
                  )
            });
        }
    });
}


function MessageAlert(params)
{
    let message = document.querySelector('#'+params[0]).textContent;

    if(params[1] == 'success') {
        type_message = params[2]
    } else if(params[1] == 'error') {
        type_message = params[2] + '!'
    }

    Swal.fire(
        type_message,
        message,
        params[1]
    )
}
