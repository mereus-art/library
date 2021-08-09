<?php
    include('../../conexao/conn.php');

    $requestData = $_REQUEST;

    if(empty($requestData['NOME'])){
        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    } else {
        $ID = isset($requestData['IDCURSO']) ? $requestData['IDCURSO'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        if($operacao == 'insert'){
            try{
                $stmt = $pdo->prepare('INSERT INTO CURSO (NOME, EIXO_IDEIXO) VALUES (:a, :b)');
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => $requestData['EIXO_IDEIXO']
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Curso cadastrado com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o cadastro do curso.'
                );
            }
        } else {
            try{
                $stmt = $pdo->prepare('UPDATE CURSO SET NOME = :a, EIXO_IDEIXO = :b WHERE IDCURSO = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => $requestData['EIXO_IDEIXO']
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Curso atualizado com sucesso.'
                );
            } catch (PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o alteração do curso.'
                );
            }
        }
    }

    echo json_encode($dados);