$(document).ready(function() {

    $('#table-tipo').on('click', 'button.btn-view', function(e) {

        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Visualização do tipo usuário')

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
                        $('#DESCRICAO').attr('readonly', 'true')
                    })
                    $('.btn-save').hide()
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