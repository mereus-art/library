<?php

include('../../conexao/conn.php');

    $nome = $_REQUEST['NOME'];
    $dados = array();
    $sql = "SELECT * FROM USUARIO WHERE NOME LIKE '%$nome%' ORDER BY NOME ASC";
    $resultado = $pdo->query($sql);

    if($resultado){
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
            $dados[] = array_map('utf8_encode', $row);
        }
    }

    // Retorno JSON para
    echo json_encode($dados);