<?php
require_once "src/classes/curso.php";
 
// Inicializa as variáveis
$titulo = $dias = $horas = "";
$cursoCriado = false;
 
//Cadastrando
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $dias = $_POST["dias"];
    $horas = $_POST["horas"];
   
 try {
$curso = new Curso($titulo, $dias, $horas);
    $cursoCriado = $curso->cadastrar();
 
    if ($cursoCriado) {
        echo "<div class='alert alert-success'>Cadastro efetuado com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao cadastrar a escola</div>";
    }
     } catch (Exception $e) {
        echo "<div class='alert alert-danger mt-3'>" . $e->getMessage() . "</div>";
}
   }
   $cursos= Curso::listar();
?>
 
<h2>Cadastro de Curso</h2>
 
<form method="post" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="titulo" class="form-label">Titulo:</label>
        <input type="text" name="titulo" id="titulo" class="form-control"
            value="<?= htmlspecialchars($titulo) ?>">
    </div>
 
    <div class="col-md-2">
        <label for="dias" class="form-label">Dias:</label>
        <input type="text" name="dias" id="dias" class="form-control"
            value="<?= htmlspecialchars($dias) ?>">
    </div>
 
    <div class="col-md-2">
        <label for="horas" class="form-label">Horas:</label>
        <input type="text" name="horas" id="horas" class="form-control"
            value="<?= htmlspecialchars($horas) ?>">
    </div>
 
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>
<h3>Lista de Cursos</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th>Horas</th>
            <th>Dias</th>
        </tr>
    </thead>
    <tbody>
       <?php if ($cursos && count($cursos) > 0): ?>
            <?php foreach ($cursos as $curso): ?>
                <tr>
                    <td><?= htmlspecialchars($curso['titulo']) ?></td>
                    <td><?= htmlspecialchars($curso['horas']) ?></td>
                    <td><?= htmlspecialchars($curso['dias']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">Nenhum curso cadastrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>