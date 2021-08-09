<?php

    include('../../conexao/conn.php');

    $ID = $_REQUEST['IDCURSO'];

    $sql = "SELECT * FROM CURSO WHERE IDCURSO = $ID";

    $resultado = $pdo->query($sql);

    if($resultado){
        $dadosEixo = array();
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
            $dadosEixo = array_map('utf8_encode', $row);
        }
        $dados = array(
            'tipo' => 'success',
            'mensagem' => '',
            'dados' => $dadosEixo
        );
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Não foi possível obter o registro solicitado.',
            'dados' => array()
        );
    }

    echo json_encode($dados);