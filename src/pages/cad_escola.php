<?php
require __DIR__ . "/../classes/escola.php";
// Inicializa as variáveis
$nome = $endereco = $cidade = $cnpj = ""; // Corrigido $cidedade para $cidade
$escolaCriada = false;
 
// Cadastrando
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : "";
    $endereco = isset($_POST["endereco"]) ? trim($_POST["endereco"]) : "";
    $cidade = isset($_POST["cidade"]) ? trim($_POST["cidade"]) : "";
    $cnpj = isset($_POST["cnpj"]) ? trim($_POST["cnpj"]) : "";
 
    try {
        $escola = new Escola($nome, $endereco, $cidade, $cnpj);
        $escolaCriada = true;
    } catch (Exception $e) {
        echo "<div class='alert alert-danger mt-3'>" . $e->getMessage() . "</div>";
    }
}
?>
 
<h2>Cadastro de Escola</h2>
 
<form method="post" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" name="nome" id="nome" class="form-control"
            value="<?= htmlspecialchars($nome) ?>">
    </div>
 
    <div class="col-md-4">
        <label for="endereco" class="form-label">Endereço:</label>
        <input type="text" name="endereco" id="endereco" class="form-control"
            value="<?= htmlspecialchars($endereco) ?>">
    </div>
 
    <div class="col-md-4">
        <label for="cidade" class="form-label">Cidade:</label>
        <input type="text" name="cidade" id="cidade" class="form-control"
            value="<?= htmlspecialchars($cidade) ?>">
    </div>
 
    <div class="col-md-4">
        <label for="cnpj" class="form-label">CNPJ:</label>
        <input type="text" name="cnpj" id="cnpj" class="form-control"
            value="<?= htmlspecialchars($cnpj) ?>">
    </div>
 
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>
 
<?php
if ($escolaCriada) {
    echo "<h3>Resultado:</h3>";
    $escola->exibirDados();
}
?>