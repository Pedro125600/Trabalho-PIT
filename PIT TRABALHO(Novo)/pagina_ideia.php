<?php

// Verificar se o parâmetro ID foi passado na URL
if (isset($_GET['id'])) {
    $id_ideia = $_GET['id'];

    // Consultar os detalhes da ideia específica usando o ID
    $con = new PDO("mysql:host=localhost;dbname=pit", "root", "root");
    $queryIdeia = "SELECT * FROM ideia WHERE id = :id";
    $stmtIdeia = $con->prepare($queryIdeia);
    $stmtIdeia->bindParam(':id', $id_ideia, PDO::PARAM_INT);
    $stmtIdeia->execute();
    $ideia = $stmtIdeia->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirecionar para a página anterior se o ID não estiver presente na URL
    header("Location: todas_ideias.php");
    exit;
}

session_start(); // Certifique-se de iniciar a sessão antes de verificar a variável $_SESSION

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $ideia['nome_ideia']; ?></title>
</head>
<body>
    <h1><?php echo $ideia['nome_ideia']; ?></h1>
    <p><strong>Descrição:</strong> <?php echo $ideia['descricao']; ?></p>
    <p><strong>Valor NIN:</strong> <?php echo $ideia['Valor_nin']; ?></p>
    <!-- Exibir a foto da ideia -->
    <?php if (!empty($ideia['foto'])) : ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($ideia['foto']); ?>" alt="Foto da Ideia" width="200"><br>
    <?php endif; ?>
    <p><strong>Tipo de Apoiador:</strong> <?php echo $ideia['tipo_apoiador']; ?></p>
    <p><strong>Tag:</strong> <?php echo $ideia['Tag']; ?></p>
    <p><strong>Tipo de Ideia:</strong> <?php echo $ideia['tipo_ideia']; ?></p>
    <p><strong>Email:</strong> <?php echo $ideia['Email']; ?></p>

    <?php if (isset($_SESSION['user_id'])) : ?>
        <?php
        // Verificar se o usuário já segue essa ideia
        $queryCheckSeguir = "SELECT id_seguidor FROM seguidores WHERE id_usuario = :id_usuario AND id_ideia = :id_ideia";
        $stmtCheckSeguir = $con->prepare($queryCheckSeguir);
        $stmtCheckSeguir->bindParam(':id_usuario', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmtCheckSeguir->bindParam(':id_ideia', $id_ideia, PDO::PARAM_INT);
        $stmtCheckSeguir->execute();
        $seguindo = $stmtCheckSeguir->rowCount() > 0;
        ?>

        <form action="seguir_ideia.php" method="post">
            <input type="hidden" name="id_ideia" value="<?php echo $id_ideia; ?>">
            <?php if (!$seguindo) : ?>
                <button type="submit">Seguir</button>
            <?php else : ?>
                <button type="submit" disabled>Você está seguindo esta ideia</button>
            <?php endif; ?>
        </form>
    <?php else: ?>
        <p>Faça o login para seguir esta ideia.</p>
    <?php endif; ?>

    <a href="exibir_ideias.php">Voltar para todas as ideias</a>
   
</body>
</html>
