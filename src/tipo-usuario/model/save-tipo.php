<?php

    include('../../conexao/conn.php');
    $requestData = $_REQUEST;

    if(empty($requestData['DESCRICAO'])){
        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    } else {
        $ID = isset($requestData['IDTIPO_USUARIO']) ? $requestData['IDTIPO_USUARIO'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        if($operacao == 'insert'){
            try{
                $stmt = $pdo->prepare('INSERT INTO TIPO_USUARIO (DESCRICAO) VALUES (:a)');
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['DESCRICAO'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Tipo úsuario cadastrado com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o cadastro do tipo úsuario.'
                );
            }
        } else {
            try{
                $stmt = $pdo->prepare('UPDATE TIPO_USUARIO SET DESCRICAO = :a WHERE IDTIPO_USUARIO = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => utf8_decode($requestData['DESCRICAO'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Tipo úsuario atualizado com sucesso.'
                );
            } catch (PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o alteração do tipo úsuario.'
                );
            }
        }
    }
    echo json_encode($dados);