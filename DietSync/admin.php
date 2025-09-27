<?php
$titulo = "Admin";
$page = 'admin';
include  __DIR__ . '/includes/header.inc.php';
include  __DIR__ . '/includes/menu.inc.php';
require_once __DIR__ . '/classes/controller/usuario-cont.class.php';
$usuario = new UsuarioController();
$usuarios = $usuario->InfosAdmin();
$dadosLogin = $usuario->dadosSessaoLogin();
if ($_SESSION['id'] != 1) {
    header('Location: index.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario->AtualizarUsuario(
        $_POST['id'],
        $_POST['name'],
        $_POST['sobrenome'],
        $_POST['meta'],
        $_POST['sexo'],
        $_POST['data_nasc'],
        $_POST['peso'],
        $_POST['altura'],
        $_POST['email'],
    );
}
?>
<div class="container-fluid mt-4" id="main">
    <h2>Lista de Usuários</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Meta</th>
                    <th>Sexo</th>
                    <th>Data de Nascimento</th>
                    <th>Peso</th>
                    <th>Altura</th>
                    <th>Email</th>
                    <th>Senha</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td><?php echo ($usuario['id']); ?></td>
                        <td><?php echo ($usuario['name']); ?></td>
                        <td><?php echo ($usuario['sobrenome']); ?></td>
                        <td><?php echo ($usuario['meta']); ?></td>
                        <td><?php echo ($usuario['sexo']); ?></td>
                        <td><?php echo ($usuario['data_nasc']); ?></td>
                        <td><?php echo ($usuario['peso']); ?></td>
                        <td><?php echo ($usuario['altura']); ?></td>
                        <td><?php echo ($usuario['email']); ?></td>
                        <td><?php echo ($usuario['password']); ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick='editUser(<?php echo json_encode($usuario); ?>)'>Editar</button>
                        </td>
                        <td>
                            <a href="remover.php?id=<?php echo htmlspecialchars($usuario['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja remover este usuário?');">Remover</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p>&nbsp;</p>
<hr>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data login</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosLogin as $login): ?>
                    <tr>
			<td><?= htmlspecialchars($login['name']) ?></td>
			 <td><?= htmlspecialchars($login['sobrenome']) ?></td>
			<td><?= htmlspecialchars($login['data_login']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Formulário de edição de usuário -->
    <h2>Editar Usuário</h2>
    <form id="editForm" method="POST">
        <input type="number" class="form-control" name="id" id="id">
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="forroup">
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
        </div>
        <div class="form-group">
            <label for="meta">Meta:</label>
            <input type="text" class="form-control" id="meta" name="meta" required>
        </div>
        <div class="form-group">
            <label for="sexo">Sexo:</label>
            <input type="text" class="form-control" id="sexo" name="sexo" required>
        </div>
        <div class="form-group">
            <label for="data_nasc">Data de Nascimento:</label>
            <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
        </div>
        <div class="form-group">
            <label for="peso">Peso:</label>
            <input type="text" class="form-control" id="peso" name="peso" required>
        </div>
        <div class="form-group">
            <label for="altura">Altura:</label>
            <input type="text" class="form-control" id="altura" name="altura" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-success mb-5">Salvar</button>
    </form>
</div>

<script>
    function editUser(user) {
        document.getElementById('id').value = user.id;
        document.getElementById('name').value = user.name;
        document.getElementById('sobrenome').value = user.sobrenome;
        document.getElementById('meta').value = user.meta;
        document.getElementById('sexo').value = user.sexo;
        document.getElementById('data_nasc').value = user.data_nasc;
        document.getElementById('peso').value = user.peso;
        document.getElementById('altura').value = user.altura;
        document.getElementById('email').value = user.email;
        document.getElementById('password').value = user.password;
    }
</script>

<?php
include  __DIR__ . '/includes/footer.inc.php';
?>
