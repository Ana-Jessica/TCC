<?php
include_once("conexao.php");

if (isset($_POST['upload']) && $_FILES['imagem']['error'] === 0) {
    // Read the image file as binary data
    $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    $titulo = $_POST['titulo'];
    $sobre = $_POST['sobre'];

    // Prepare the SQL query with placeholders
    $inserir = "INSERT INTO vagas (id, imagem, titulo, sobre) VALUES (null, ?, ?, ?)";
    $stmt = $conn->prepare($inserir);

    // Bind the values to the prepared statement
    $stmt->bind_param("sss", $imagem, $titulo, $sobre);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Registro inserido com sucesso!";
    } else {
        echo "Falha na inserção dos dados: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar nova vaga</title>
  <link rel="stylesheet" href="style.css">
  <link rel="apple-touch-icon" sizes="180x180" href="ICONS/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="ICONS/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="ICONS/favicon-16x16.png">
  <link rel="manifest" href="ICONS/site.webmanifest">
  <link rel="mask-icon" href="ICONS/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
</head>

<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                Cadastrar nova vaga
            </div>
        </div>
        <div class="form-container">
            <div class="form-inner">
                <form action="criar_vaga.php" method="POST" enctype="multipart/form-data">
                    <div class="field">
                        <label for="imagem">Imagem:</label>
                        <input type="file" name="imagem" id="imagem" accept="image/*" required>
                    </div>
                    <div class="field">
                        <label for="titulo">Titulo da vaga:</label>
                        <input type="text" placeholder="Titulo" id="titulo" name="titulo" required>
                    </div>
                    <div class="field">
                        <label for="sobre">Sobre:</label>
                        <textarea name="sobre" placeholder="Fale um pouco sobre a vaga" id="sobre" rows="4" cols="50"
                            required></textarea>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" name="upload" id="upload" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>