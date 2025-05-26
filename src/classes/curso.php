<?php
 
require_once "db/db.php";
 
class Curso {
    public $titulo;
    public $dias;
    public $horas;
   
 
    // Construtor com validação
    public function __construct($titulo, $dias, $horas) {
        if (empty($titulo)) {
            throw new Exception("O campo Titulo é obrigatório.");
        }
        if (empty($dias)) {
            throw new Exception("O campo Dias é obrigatório.");
        }
        if (empty($horas)) {
            throw new Exception("O campo Horas é obrigatório.");
        }
       
        $this->titulo = $titulo;
        $this->dias = $dias;
        $this->horas = $horas;
       
    }
 
    // Método para exibir os dados
    public function exibirDados() {
        echo "<p>Nome do curso: <strong>$this->titulo</strong><br>";
        echo "dias: <strong>$this->dias</strong><br>";
        echo "horas: <strong>$this->horas</strong><br>";
       
    }
 
    // Método para cadastrar a escola no banco de dados
    public function cadastrar() {
        // Conexão com o banco de dados
        $database = new Database();
        $conn = $database->getConnection();
 
        // Preparar a consulta SQL
        $query = "INSERT INTO curso (titulo, dias, horas) VALUES (:titulo,  :dias, :horas)";
        $stmt = $conn->prepare($query);
 
        // Bind dos parâmetros
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':dias', $this->dias);
        $stmt->bindParam(':horas', $this->horas);
       
 
        // Executar a consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public static function listar() {
        // Conexão com o banco de dados
        $database = new Database();
        $conn = $database->getConnection();
 
        // Preparar a consulta SQL
        $query = "SELECT * FROM curso";
        $stmt = $conn->prepare($query);
        $stmt->execute();
 
        // Retornar os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}