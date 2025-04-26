<html>
<head>
<title>Exemplo PHP</title>
</head>
<body>

<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=iso-8859-1');

$servername = getenv('DB_HOST') ?: 'db';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'Senha123';
$database = getenv('DB_NAME') ?: 'meubanco';

$link = new mysqli($servername, $username, $password, $database);

if ($link->connect_error) {
    die("Conexão falhou: " . $link->connect_error);
}

$valor_rand1 = rand(1, 999);
$valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
$host_name = gethostname();

$query = "INSERT INTO dados (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $link->prepare($query);
$stmt->bind_param('isssss', $valor_rand1, $valor_rand2, $valor_rand2, $valor_rand2, $valor_rand2, $host_name);

if ($stmt->execute()) {
    echo "Novo registro criado com sucesso.<br><br>";
} else {
    echo "Erro: " . $stmt->error;
}

// Listar registros
$result = $link->query("SELECT * FROM dados ORDER BY AlunoID DESC LIMIT 5");

if ($result->num_rows > 0) {
    echo "<h3>Últimos registros:</h3>";
    while($row = $result->fetch_assoc()) {
        echo "AlunoID: {$row['AlunoID']} - Nome: {$row['Nome']} - Host: {$row['Host']}<br>";
    }
} else {
    echo "Nenhum registro encontrado.";
}

$link->close();
?>
</body>
</html>
