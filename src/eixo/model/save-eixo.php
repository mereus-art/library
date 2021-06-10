<?php

    include('../../conexao/conn.php');
    $requestData = $_REQUEST;

    if(empty($requestData['NOME'])){
        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    } else {
        $IDEIXO = isset($requestData['IDEIXO']) ? $requestData['IDEIXO'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        if($operacao == 'insert'){
            try{
                $stmt = $pdo->prepare('INSERT INTO EIXO (NOME) VALUES (:nome)');
                $stmt->execute(array(
                    ':nome' => utf8_decode($requestData['NOME'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Eixo tecnológico cadastrado com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o cadastro do eixo.'
                );
            }
        } else {
            try{
                $stmt = $pdo->prepare('UPDATE EIXO SET NOME = :nome WHERE IDEIXO = :id');
                $stmt->execute(array(
                    ':id' => $IDEIXO,
                    ':nome' => utf8_decode($requestData['NOME'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Eixo tecnológico atualizado com sucesso.'
                );
            } catch (PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o alteração do eixo.'
                );
            }
        }
    }
    echo json_encode($dados);