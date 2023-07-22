
<?php
include_once('conexao.php');


if (isset($_POST['delete'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    // Verifica se o email existe na tabela "contratante"
    $verificar_sql_contratante = "SELECT email FROM contratante WHERE email = ?";
    $verificar_stmt_contratante = $conn->prepare($verificar_sql_contratante);
    $verificar_stmt_contratante->bind_param("s", $email);
    $verificar_stmt_contratante->execute();
    $verificar_result_contratante = $verificar_stmt_contratante->get_result();


    // Verifica se o email existe na tabela "programador"
    $verificar_sql_programador = "SELECT email FROM programador WHERE email = ?";
    $verificar_stmt_programador = $conn->prepare($verificar_sql_programador);
    $verificar_stmt_programador->bind_param("s", $email);
    $verificar_stmt_programador->execute();
    $verificar_result_programador = $verificar_stmt_programador->get_result();


    // Verifica se o email existe em qualquer uma das tabelas
    if ($verificar_result_contratante->num_rows > 0 || $verificar_result_programador->num_rows > 0) {
        // Email encontrado em pelo menos uma das tabelas


        // Atualização na tabela "contratante"
        $sqlDeleteContratante = "DELETE FROM contratante WHERE email='$email' AND senha='$senha'";
        if ($conn->query($sqlDeleteContratante) === TRUE) {
            ?>
            <script>
            alert("Cadastro excluido com sucesso!");
            window.location.href = "index.html";
            </script>
            <?php
        } else {
            // Erro ao atualizar a senha na tabela "contratante"
            ?>
            <script>
            alert("Ocorreu um problema ao atualizar a senha. Por favor, tente novamente mais tarde.");
            window.location.href = "excluir.php";
            </script>
            <?php
        }


        // Atualização na tabela "programador"
        $sqlDeleteProgramador = "DELETE FROM programador WHERE email='$email' AND senha='$senha'";
        if ($conn->query($sqlDeleteProgramador) === TRUE) {
            // Senha atualizada na tabela "programador" com sucesso
            echo "Cadastro excluido com sucesso!";
            header('Location: index.html');
        } else {
            // Erro ao atualizar a senha na tabela "programador"
            ?>
            <script>
            alert("Nao foi possivel excluir seu cadastro, email ou senha estao incorretos.");
            window.location.href = "excluir.php";
            </script>
            <?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="ICONS/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="ICONS/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="ICONS/favicon-16x16.png">
<link rel="manifest" href="ICONS/site.webmanifest">
<link rel="mask-icon" href="ICONS/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
    <title>Excluir Perfil</title>
   </head>
   <body>
      <div class="wrapper">
         <div class="title-text">
            <div class="title login">
               Excluir cadastro
            </div>
         </div>
         <div class="form-container">
            <div class="form-inner">
               </form>
               <form action="excluir.php" method="POST" class="signup">
                <div class="field">
                  <label for="email">Confirmar email:</label>
                     <input type="email" placeholder="Email" id="email" name="email" required>
                  </div>
                  <div class="field">
                  <label for="senha">Confirmar senha:</label>
                     <input type="password" placeholder="Senha" id="senha" name="senha" required>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" name="delete" id="delete" value="Excluir">
                  </div>
               </form>
            </div>
         </div>
      </div>
   </body>
</html>

