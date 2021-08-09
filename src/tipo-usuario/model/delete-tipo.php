<?php

    include("../../conexao/conn.php");

    $ID = $_REQUEST['IDTIPO_USUARIO'];

    $sql = "DELETE FROM TIPO_USUARIO WHERE IDTIPO_USUARIO = $ID";

    $resultado = $pdo->query($sql);

    if($resultado){
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Registro excluído com sucesso!'
        );
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Não foi possível excluir o registro'
        );
    }

    echo json_encode($dados);