<?php
include_once('conexao.php');


if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $nova_senha = $_POST['nova_senha'];


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
        $sqlUpdateContratante = "UPDATE contratante SET senha='$nova_senha' WHERE email='$email'";
        if ($conn->query($sqlUpdateContratante) === TRUE) {
            // Senha atualizada na tabela "contratante" com sucesso
            ?>
            <script>
            alert("Senha atualizada com sucesso!");
            window.location.href = "login.html";
            </script>
            <?php
        } else {
            // Erro ao atualizar a senha na tabela "contratante"
            ?>
            <script>
            alert("Ocorreu um problema ao atualizar a senha. Por favor, tente novamente mais tarde.");
            window.location.href = "editar.html";
            </script>
            <?php
        }


        // Atualização na tabela "programador"
        $sqlUpdateProgramador = "UPDATE programador SET senha='$nova_senha' WHERE email='$email'";
        if ($conn->query($sqlUpdateProgramador) === TRUE) {
            ?>
            <script>
            alert("Senha atualizada com sucesso!");
            window.location.href = "login.html";
            </script>
            <?php
        } else {
            // Erro ao atualizar a senha na tabela "programador"
            ?>
            <script>
            alert("Ocorreu um problema ao atualizar a senha. Por favor, tente novamente mais tarde.");
            window.location.href = "editar.html";
            </script>
            <?php
        }
    } else {
        // Email não encontrado em nenhuma das tabelas
        ?>
        <script>
        alert("O email fornecido não foi encontrado. Verifique e tente novamente.");
        window.location.href = "editar.html";
        </script>
        <?php
    }
} else {
    echo "Não foi possível alterar a senha.";
}
?>



