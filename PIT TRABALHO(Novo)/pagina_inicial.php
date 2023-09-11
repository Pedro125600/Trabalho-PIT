




<?php

header('Content-type: text/html;charset=utf-8');

$con = new PDO("mysql:host=localhost;dbname=pit", "root", "root");
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['nome'])) {
    // Redirecionar para a página de login se não estiver logado
    header("Location: index.html");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirecionar se o usuário não estiver logado
    exit;
}



// Atualizar as informações do usuário na sessão em tempo real
$query = "SELECT * FROM conta WHERE email = :email";
$stmt = $con->prepare($query);
$stmt->bindParam(':email', $_SESSION['email']);
$stmt->execute();
$dados = $stmt->fetch(PDO::FETCH_ASSOC);

// Atualizar as informações na sessão
$_SESSION['nome'] = $dados['Nome'];
$_SESSION['sobrenome'] = $dados['Sobrenome'];
$_SESSION['email'] = $dados['Email'];
$_SESSION['info'] = $dados['Informacao'];
$_SESSION['tel'] = $dados['tel'];
$_SESSION['cpf'] = $dados['cpf'];
$_SESSION['tipo'] = $dados['tipo'];
$id_usuario = $_SESSION['user_id'];
?>




<?php
// Consultar todas as ideias criadas pelo usuário
$queryIdeias = "SELECT * FROM ideia WHERE Email = :email LIMIT 4"; // Limite de 4 ideias
$stmtIdeias = $con->prepare($queryIdeias);
$stmtIdeias->bindParam(':email', $_SESSION['email']);
$stmtIdeias->execute();
$ideias = $stmtIdeias->fetchAll(PDO::FETCH_ASSOC);
?>
<li><a href="ideias_seguidas.php">Ideias Seguidas</a></li>
<!-- Mostrar as ideias 
<h2>Minhas Ideias:</h2>
<ul>
    <?php $count = 0; // Contador de ideias exibidas ?>
    <?php foreach ($ideias as $ideia) : ?>
        <li>
            <strong>Nome da Ideia:</strong> <?php echo $ideia['nome_ideia']; ?><br>
            <strong>Descrição:</strong> <?php echo $ideia['descricao']; ?><br>
            <strong>Valor NIN:</strong> <?php echo $ideia['Valor_nin']; ?><br>
             Exibir a foto da ideia 
            <?php if (!empty($ideia['foto'])) : ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($ideia['foto']); ?>" alt="Foto da Ideia" width="200"><br>
            <?php endif; ?>
            <strong>Tipo de Apoiador:</strong> <?php echo $ideia['tipo_apoiador']; ?><br>
            <strong>Tag:</strong> <?php echo $ideia['Tag']; ?><br>
            <strong>Tipo de Ideia:</strong> <?php echo $ideia['tipo_ideia']; ?><br>
        </li>
        <br>
        <?php $count++; // Incrementar o contador de ideias exibidas ?>
        <?php if ($count === 4) break; // Interromper o loop após exibir as 4 primeiras ideias ?>
    <?php endforeach; ?> -->




   






<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Perfil de Usuário</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='assets/css/perfil.css'>
    <!-- biblioteca de ícones -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <script src='main.js'></script>
</head>
<body>
    
    <header>
        <div class="header-container">
            <nav class="desktop-nav">
                <ul>
                    <li><a href="exibir_ideias.php"><i class="fa-regular fa-lightbulb"></i> Ideias</a></li>
                    <li><a href="#"><i class="fa-solid fa-money-bill"></i> Apoiador</a></li>
                </ul>
            </nav>

        <a href="lading.html">    <div class="logo">
                <img alt="Logo" src="assets/img/LOGO.png">
            </div> </a>

            <nav class="desktop-nav">
                <ul>
                    <li><a href="#"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</a></li>
                    <li><a href="#"><i class="fa-regular fa-user "></i></a></li>
                </ul>
            </nav>

            <div class="mobile-nav-icon">
                <i class="fas fa-bars"></i>
            </div>

            <nav class="mobile-nav">
                <ul>
                    <li><a href="#"><i class="fa-regular fa-lightbulb"></i> Ideias</a></li>
                    <li><a href="#"><i class="fa-solid fa-money-bill"></i> Apoiador</a></li>
                    <li><a href="#"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</a></li>
                    <li><a href="perfil-user.html"><i class="fa-regular fa-user "></i></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="form-header">
                <div class="usuario">
                    <div class="title">
                        <h1>Seu Perfil</h1>
                    </div>
                    <div class="foto-user">
                        <img src="assets/img/user 5.svg" alt="Foto do Usuário">
                    </div>
                </div>

                <div class="detalhes-user">
                    <div class="nome-user">
                        <h2> <?php echo $_SESSION['nome']; ?>    <?php echo $_SESSION['sobrenome']; ?></h2>
                      <a href="atualizar_dados.php">  <img src="assets/img/lapis.svg" alt="Foto do Usuário"> </a>
                    </div>
                    <div class="dados">
                        <label>Tipo de conta : <?php echo $_SESSION['tipo']; ?></label>
                        <ul>
                            <li>Telefone: <?php echo $_SESSION['tel']; ?></li>
                            <li>Email: <?php echo $_SESSION['email']; ?></li>
                            <li>CPF: <?php echo $_SESSION['cpf']; ?></li>
                            <a href="ideias_seguidas.php">dsadsad</a>
                        </ul>
                    </div>
                </div>

                <div class="imagem-idea">
                    <img src="assets/img/ideia 1.svg" alt="bonequinho-lampada">
                </div>
            </div>

            <div class="seus-projetos">
                <div class="titulo">
                   <a href="ideia.html"> <h1>Seus Projetos+</h1> </a>
                </div>
                
                <div class="container-ideias">
                <?php foreach ($ideias as $ideia) : ?>

    <div class="box-ideia">
    
        <?php if (!empty($ideia['foto'])) : ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($ideia['foto']); ?>" alt="Foto da Ideia" width="200">
        <?php endif; ?>
      
    </div>
<?php endforeach; ?>

                </div>
                
            </div>
        </div>
    </main>
</body>
</html>
