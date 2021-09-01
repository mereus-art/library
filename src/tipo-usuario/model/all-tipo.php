<?php

    include('../../conexao/conn.php');
    $dados = array();
    $sql = "SELECT * FROM TIPO_USUARIO ORDER BY DESCRICAO ASC";
    $resultado = $pdo->query($sql);
    if($resultado){
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
            $dados[] = array_map('utf8_encode', $row);
        }
    }
    echo json_encode($dados);