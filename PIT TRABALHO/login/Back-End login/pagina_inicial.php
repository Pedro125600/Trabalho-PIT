<?php
$con = new PDO("mysql:host=localhost;dbname=PIT", "root", "");
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['nome'])) {
    // Redirecionar para a página de login se não estiver logado
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Inicial</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['nome']; ?></h1>
    <h2>Informações registradas:</h2>
    <p>Nome: <?php echo $_SESSION['nome']; ?></p>
    <p>Sobrenome: <?php echo $_SESSION['sobrenome']; ?></p>
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <p>Informação: <?php echo $_SESSION['info']; ?></p>
    <p>Telefone: <?php echo $_SESSION['tel']; ?></p>
    <p>CPF: <?php echo $_SESSION['cpf'] ; ?> </p>
   
</body>
</html>
