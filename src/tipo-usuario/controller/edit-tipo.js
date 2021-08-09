$(document).ready(function() {

    $('#table-tipo').on('click', 'button.btn-edit', function(e) {

        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Edição do tipo usuário')

        let IDTIPO_USUARIO = `IDTIPO_USUARIO=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: IDTIPO_USUARIO,
            url: 'src/tipo-usuario/model/view-tipo.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/tipo-usuario/view/form-tipo.html', function() {
                        $('#DESCRICAO').val(dado.dados.DESCRICAO)
                        $('#IDTIPO_USUARIO').val(dado.dados.IDTIPO_USUARIO)
                    })
                    $('.btn-save').show()
                    $('.btn-save').removeAttr('data-operation')
                    $('#modal-tipo').modal('show')
                } else {
                    Swal.fire({
                        title: 'Library',
                        text: dado.mensagem,
                        type: dado.tipo,
                        confirmButtonText: 'OK'
                    })
                }
            }
        })

    })
})