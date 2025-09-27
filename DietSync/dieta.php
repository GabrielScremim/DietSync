<?php
$titulo = "Dieta";
$page = 'dieta';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/menu.inc.php';
require_once __DIR__ . '/classes/controller/dieta-cont.class.php';
$dietaController = new DietaController();

if (isset($_GET['id_excluir'])) {
    $id_dieta_excluir = addslashes($_GET['id_excluir']);
    $dietaController->ExcluirDieta($id_dieta_excluir);
}
$user_id = $_SESSION['id'];
$dadosDieta = $dietaController->DadosDieta($user_id);
$dia_semana = "";
?>

<div class="container" id="main">
    <?php
    echo $dia_semana;
    ?>
    <h2>Plano de Refeições do Dia</h2>
    <?php foreach ($dadosDieta as $dieta) :
        switch ($dieta['data_dieta']) {
            case 1:
                $dia_semana = "Segunda-feira";
                break;
            case 2:
                $dia_semana = "Terça-Feira";
                break;
            case 3:
                $dia_semana = "Quarta-Feira";
                break;
            case 4:
                $dia_semana = "Quinta-Feira";
                break;
            case 5:
                $dia_semana = "Sexta-feira";
                break;
            case 6:
                $dia_semana = "Sábado";
                break;
            case 7:
                $dia_semana = "Domingo";
                break;
            default:
                $dia_semana = "Dia desconhecido";
                break;
        } ?>
        <div class="list-group mt-4">
            <strong>
                <a href="#<?= $dieta['refeicao'] ?>" class="list-group-item list-group-item-action" data-toggle="collapse">
                    <?= $dieta['refeicao'] ?> - <?= $dia_semana ?>
                </a>
                <!-- Adicionando o botão de exclusão -->
                <a href="dieta.php?id_excluir=<?= $dieta['id_dieta'] ?>" class="btn btn-danger btn-sm ml-2">Excluir</a>
                <a href="registrar-dieta.php?id_editar_dieta=<?= $dieta['id_dieta'] ?>" class="btn btn-success btn-sm ml-2">Editar Dieta</a>
            </strong>
            <div class="collapse w-100" id="<?= $dieta['refeicao'] ?>">
                <div class="card card-body">
                    <ul>
                        <li><strong>Nome da Dieta:</strong> <?= $dieta['nome_dieta'] ?></li>
                        <li><strong>Tipo de Dieta:</strong> <?= $dieta['tipo_dieta'] ?></li>
                        <li><strong>Calorias:</strong> <?= $dieta['calorias'] ?></li>
                        <li><strong>Proteínas:</strong> <?= $dieta['proteinas'] ?></li>
                        <li><strong>Carboidratos:</strong> <?= $dieta['carboidratos'] ?></li>
                        <li><strong>Gorduras:</strong> <?= $dieta['gorduras'] ?></li>
                        <li><strong>Alimentos:</strong>
                            <?php
                            $alimentos = json_decode($dieta['alimentos'], true);
                            if ($alimentos !== null && is_array($alimentos)) {
                                echo '<ul>';
                                foreach ($alimentos as $alimento) {
                                    echo '<li>' . $alimento . '</li>';
                                }
                                echo '</ul>';
                            } else {
                                echo 'Nenhum alimento listado.';
                            }
                            ?>
                        </li>
                        <li><strong>Quantidade:</strong> <?= $dieta['quantidade'] ?></li>
                        <li><strong>Observações:</strong> <?= $dieta['observacoes'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
include __DIR__ . '/includes/footer.inc.php';
?>
</body>

</html>
