<?php
class UsuarioModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function InfosAdmin()
    {
        $comando = $this->pdo->prepare("SELECT * from users");
        $comando->execute();
        return $comando->fetchAll(PDO::FETCH_ASSOC);
    }

    public function RemoverUsuario($id)
    {
        try {
            // Inicie uma transação
            $this->pdo->beginTransaction();

            // Remover dados relacionados em outras tabelas
            $this->pdo->exec("DELETE FROM dietas WHERE fk_id_usuario_dieta = $id");
            $this->pdo->exec("DELETE FROM evolucaos WHERE fk_id_evolucaos = $id");
            $this->pdo->exec("DELETE FROM receita WHERE fk_id_user_receita = $id");
            $this->pdo->exec("DELETE FROM treino WHERE fk_id_usuario_treino = $id");
            // Remover o usuário principal
            $comando = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
            $comando->bindValue(":id", $id);
            $comando->execute();

            // Commit da transação
            $this->pdo->commit();
        } catch (Exception $e) {
            // Reverte a transação em caso de erro
            $this->pdo->rollBack();
            throw $e; // Propague a exceção para ser tratada no controlador
        }
    }
    public function VerificarEmail($email)
    {
        $comando = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $comando->bindValue(":email", $email);
        $comando->execute();

        // Obtém o resultado da consulta
        $result = $comando->fetchColumn();

        // Verifica se o resultado é maior que zero (o email existe)
        if ($result > 0) {
            return true; // Email existe
        } else {
            return false; // Email não existe
        }
    }


    public function CadastrarUser($nome, $sobrenome, $meta, $sexo, $data_nasc, $peso, $altura, $email, $senha)
    {
        $comando = $this->pdo->prepare("INSERT INTO users(name, sobrenome, meta, sexo, data_nasc, peso, altura, email, password) VALUES(:name,:sobrenome, :meta, :sexo, :data, :peso, :altura, :email, :password)");

        $comando->bindValue(":name", $nome);
        $comando->bindValue(":sobrenome", $sobrenome);
        $comando->bindValue(":meta", $meta);
        $comando->bindValue(":sexo", $sexo);
        $comando->bindValue(":data", $data_nasc);
        $comando->bindValue(":peso", $peso);
        $comando->bindValue(":altura", $altura);
        $comando->bindValue(":email", $email);
        $comando->bindValue(":password", $senha);
        $comando->execute();

        header("Location: home.php");
        exit();
    }

    public function VerificarLogin($email, $senha)
    {
        // Verifica na tabela 'users'
        $comandoUser = $this->pdo->prepare("SELECT id, name, email, password FROM users WHERE email = :email");
        $comandoUser->bindValue(":email", $email);
        $comandoUser->execute();
        $user = $comandoUser->fetch(PDO::FETCH_ASSOC);
        // Verifica se o usuário foi encontrado e se a senha está correta
        if ($user && password_verify($senha, $user['password'])) {
            return $user; // Retorna os dados do usuário
        }
    }

    public function ObterNomeUsuario($email)
    {
        // Verifica na tabela 'users'
        $comandoUser = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $comandoUser->bindValue(":email", $email);
        $comandoUser->execute();
        $user = $comandoUser->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function ObterUsuario($id_user)
    {
        // Verifica na tabela 'users'
        $comandoUser = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $comandoUser->bindValue(":id", $id_user);
        $comandoUser->execute();
        $user = $comandoUser->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function AtualizarUsuario($id, $nome, $sobrenome, $meta, $sexo, $data_nasc, $peso, $altura, $email)
    {
        $comando = $this->pdo->prepare("UPDATE users SET name = :name, sobrenome = :sobrenome, meta = :meta, sexo = :sexo, data_nasc = :data, peso = :peso, altura = :altura, email = :email WHERE id = :id");

        $comando->bindValue(":id", $id);
        $comando->bindValue(":name", $nome);
        $comando->bindValue(":sobrenome", $sobrenome);
        $comando->bindValue(":meta", $meta);
        $comando->bindValue(":sexo", $sexo);
        $comando->bindValue(":data", $data_nasc);
        $comando->bindValue(":peso", $peso);
        $comando->bindValue(":altura", $altura);
        $comando->bindValue(":email", $email);
        $comando->execute();
        // Redireciona para a mesma página após a atualização
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }

    public function AlterarSenha($id_user, $novaSenha)
    {
        $comando = $this->pdo->prepare("UPDATE users  SET `password` = :novasenha WHERE id = :id");
        $comando->bindValue(":novasenha", $novaSenha);
        $comando->bindValue(":id", $id_user);
        $comando->execute();
        // Redireciona para a mesma página após a atualização
        header("Location: logout.php");
        exit();
    }

    public function Contador()
    {
        // Consulta o valor atual do contador
        $comando = $this->pdo->prepare("SELECT contador FROM contador");
        $comando->execute();
        $ultimo_contador = $comando->fetch(PDO::FETCH_ASSOC);

        // Incrementa o valor do contador em 1
        $novo_contador = $ultimo_contador['contador'] + 1;

        // Atualiza o último registro na tabela 'contador' com o novo valor do contador
        $comando = $this->pdo->prepare("UPDATE contador SET contador = :novo_contador");
        $comando->bindValue(":novo_contador", $novo_contador);
        $comando->execute();
    }

    public function BuscarDadosAlterarSenha($email, $data_nasc)
    {
        $comando = $this->pdo->prepare("SELECT id FROM users WHERE email = :email AND data_nasc = :data_nasc");
        $comando->bindValue(":email", $email);
        $comando->bindValue(":data_nasc", $data_nasc);
        $comando->execute();
        $resultado = $comando->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function TotalAcesso()
    {
        $comando = $this->pdo->prepare("SELECT contador FROM contador");
        $comando->execute();
        return $comando->fetch(PDO::FETCH_ASSOC);
    }

    public function InserirDadosSessao($id_user, $dataHoraAtual)
    {
        $comando = $this->pdo->prepare("INSERT INTO dados_sessao (fk_id_user_login, data_login) VALUES(:fk_id_user_login, :data_login)");
        $comando->bindValue(":fk_id_user_login", $id_user);
        $comando->bindValue(":data_login", $dataHoraAtual);
        $comando->execute();
        exit();
    }
    public function dadosSessaoLogin()
    {
        $resultado = array();
        $comando = $this->pdo->prepare("SELECT dados_sessao.data_login, users.name, users.sobrenome
        FROM dados_sessao
        JOIN users ON dados_sessao.fk_id_user_login = users.id;");
        $comando->execute();

        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
