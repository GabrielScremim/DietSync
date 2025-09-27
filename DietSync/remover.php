<?php
require_once 'usuario-cont.class.php';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Certifique-se de sanitizar a entrada

    // Crie uma instância do seu controlador de usuário
    $usuarioController = new UsuarioController();
    $usuarioController->RemoverUsuario($id);
    header("Location: admin.php");
    exit();
}

