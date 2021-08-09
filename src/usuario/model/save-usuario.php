<?php
    include('../../conexao/conn.php');
    $requestData = $_REQUEST;
    if(empty($requestData['NOME'])){        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    } else {        $ID = isset($requestData['IDUSUARIO']) ? $requestData['IDUSUARIO'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';
        if($operacao == 'insert'){            try{
                $stmt = $pdo->prepare('INSERT INTO aluno (NOME, EMAIL, SENHA, TIPO_USUARIO_IDTIPO_USUARIO, CURSO_IDCURSO) VALUES (:a, :b, :c, :d, :e)');
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => utf8_decode($requestData['EMAIL']),
                    ':c' => md5($requestData['SENHA']),
                    ':d' => $requestData['TIPO_USUARIO_IDTIPO_USUARIO'],
                    ':e' => $requestData['CURSO_IDCURSO']
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Usuário cadastrado com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o cadastro do curso.'
                );
            }
        } else {            try{
                $stmt = $pdo->prepare('UPDATE aluno SET NOME = :a, EMAIL = :b, SENHA = :c, TIPO_USUARIO_IDTIPO_USUARIO = :d, CURSO_IDCURSO = :e WHERE IDUSUARIO = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => utf8_decode($requestData['EMAIL']),
                    ':c' => md5($requestData['SENHA']),
                    ':d' => $requestData['TIPO_USUARIO_IDTIPO_USUARIO'],
                    ':e' => $requestData['CURSO_IDCURSO']
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Usuário atualizado com sucesso.'
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
