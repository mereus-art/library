<?php

    include("../../conexao/conn.php");

    $IDEIXO = $_REQUEST['IDEIXO'];

    $sql = "DELETE FROM EIXO WHERE IDEIXO = $IDEIXO";

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