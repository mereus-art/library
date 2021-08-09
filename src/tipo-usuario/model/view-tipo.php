<?php

    include('../../conexao/conn.php');

    $ID = $_REQUEST['IDTIPO_USUARIO'];

    $sql = "SELECT * FROM TIPO_USUARIO WHERE IDTIPO_USUARIO = $ID";

    $resultado = $pdo->query($sql);
    if($resultado){
        $resultQuery = array();
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
            $resultQuery = array_map('utf8_encode', $row);
        }
        $dados = array(
            'tipo' => 'success',
            'mensagem' => '',
            'dados' => $resultQuery
        );
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Não foi possível obter o registro solicitado.',
            'dados' => array()
        );
    }

    echo json_encode($dados);