<?php
// Configuração de conexão com o banco de dados
$host = 'localhost';
$db   = 'projeto_poo'; // Substitua pelo nome real do seu banco
$user = 'root';          // Ou o usuário configurado
$pass = '';              // Ou a senha do seu banco
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitiza e valida os dados
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if (!$email || empty($password)) {
        echo "E-mail ou senha inválidos.";
        exit;
    }

    // Consulta no banco
    $stmt = $pdo->prepare("SELECT * FROM login WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && ($password == $user['senha'])) {
        // Login bem-sucedido
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        header("Location: /concurso/poo"); // Redireciona para a página principal
        exit;
    } else {
        // Login falhou
        echo "<p style='color: red; text-align: center;'>E-mail ou senha incorretos.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
 
<main class="d-flex justify-content-center align-items-center flex-grow-1">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Acesso ao Sistema</h2>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Usuário (e-mail):</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu e-mail" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</main>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>