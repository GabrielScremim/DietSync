<?php
$titulo = "Menu";
$page = 'menu';
include 'includes/header.inc.php';
include 'includes/menu.inc.php';
require_once __DIR__ . '/classes/controller/dieta-cont.class.php';
require_once __DIR__ . '/classes/controller/treino-cont.class.php';
$user_id = $_SESSION['id'];
$dietaController = new DietaController();
$treinoController = new TreinoController();
$dadosTreino = $treinoController->BuscarTreinoInfosHome($user_id);
$dadosDieta = $dietaController->DadosDieta($user_id);
?>

<link rel="stylesheet" href="css/receba.css">
<div class="container-fluid" id="main">
  <h2>Desenvolvedores</h2>

  <div class="row">
    <div class="row text-center">
      <div class="col-md-6 col-sm-12">
        <div class="card">
          <div class="img-container">
            <img src="img/scremim.jpg" alt="foto perfil">
          </div>
          <div class="content">
            <h2 class="name-profile"> Gabriel Vaz Scremim</h2>
            <p class="job"> Desenvolvedor</p>
            <p class="descri">Aluno do curso de Ciência da Computação da UniFil - Londrina e estagiário no IDR-Paraná.</p>
          </div>
          <div class="links">
            <div class="links">
              <a href="https://www.instagram.com/gabrielscremim/" class="insta" target="blank">
                <i class="bi bi-instagram"></i>
              </a>
              <a href="https://www.linkedin.com/in/gabriel-vaz-scremim-a37b8b231/" class="linke" target="blank">
                <i class="bi bi-linkedin"></i>
              </a>
              <a href="https://github.com/gabrielscremim" class="github" target="blank">
                <i class="bi bi-github"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="img-container">
            <img src="img/segobi.jpg" alt="foto perfil">
          </div>
          <div class="content">
            <h2 class="name-profile"> Gabriel Segobi de Souza</h2>
            <p class="job"> Desenvolvedor</p>
            <p class="descri"> Aluno do curso de Ciência da Computação da UniFil - Londrina.</p>
            <br>
          </div>
          <div class="links">
            <a href="https://www.instagram.com/gabrielsegobi_/" class="insta" target="blank">
              <i class="bi bi-instagram"></i>
            </a>
            <a href="https://www.linkedin.com/in/gabriel-segobi-8a277628b/" class="linke" target="blank">
              <i class="bi bi-linkedin"></i>
            </a>
            <a href="https://github.com/segobinho" class="github" target="blank">
              <i class="bi bi-github"></i>
            </a>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-12">
      <?php
      $dia_semana_atual = date('N'); // Obtém o dia da semana atual (1 para segunda-feira, 7 para domingo)

      foreach ($dadosDieta as $dieta) {
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
        }
      }
      foreach ($dadosDieta as $dieta) {
        if ($dieta['data_dieta'] == $dia_semana_atual) {
          // Exibe apenas a dieta do dia de hoje
      ?>
          <h2>Dietas do dia</h2>
          <strong>
            <a href="#<?= $dieta['refeicao'] ?>" class="list-group-item list-group-item-action" data-toggle="collapse">
              <?php echo $dieta['refeicao'] ?>
              <!-- Adicionando o botão de exclusão -->
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
      <?php
        }
      }
      ?>
      <?php
      foreach ($dadosTreino as $treino) {
        if ($treino['dia_treino'] == $dia_semana_atual) {
          // Exibe apenas a dieta do dia de hoje
      ?>
          <p>&nbsp;</p>
          <h2>Treino do dia</h2>
          <strong>
            <a href="#<?= $treino['tipo'] ?>" class="list-group-item list-group-item-action" data-toggle="collapse">
              <?php echo $treino['nome_treino'] ?>
              <!-- Adicionando o botão de exclusão -->
              <a href="registrar-treino.php?id_treino_editar=<?= $treino['id'] ?>" class="btn btn-success btn-sm ml-2">Editar Treino</a>
          </strong>
          <div class="collapse w-100" id="<?= $treino['tipo'] ?>">
            <div class="card card-body">
              <ul>
                <li><strong>Tipo treino:</strong> <?= $treino['tipo'] ?></li>
                <li><strong>Repetições:</strong> <?= $treino['repeticoes'] ?></li>
                <li><strong>Séries:</strong> <?= $treino['series'] ?></li>
                <li><strong>Objetivo:</strong> <?= $treino['objetivo'] ?></li>
                <li><strong>Duração:</strong> <?= $treino['duracao'] ?></li>
                <li><strong>Frequência:</strong> <?= $treino['frequencia'] ?></li>

                <li><strong>Exercícios:</strong>
                  <?php
                  $exercicios = json_decode($treino['exercicios'], true);
                  if ($exercicios !== null && is_array($exercicios)) {
                    echo '<ul>';
                    foreach ($exercicios as $exercicio) {
                      echo '<li>' . $exercicio . '</li>';
                    }
                    echo '</ul>';
                  } else {
                    echo 'Nenhum exercício listado.';
                  }
                  ?>
                </li>
              </ul>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
</div>
<?php include __DIR__ . '/includes/footer.inc.php'; ?>
</body>

</html>