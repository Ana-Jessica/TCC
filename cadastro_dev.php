<?php 
include_once("conexao.php");


$nome = $_POST['nome'];
$email = $_POST['email'];
$verificar_sql = "SELECT email FROM programador WHERE email = ? 
                  UNION
                  SELECT email FROM contratante WHERE email = ?";
$verificar_stmt = $conn->prepare($verificar_sql);
$verificar_stmt->bind_param("ss", $email, $email); 
$verificar_stmt->execute();


if ($verificar_stmt->fetch()) {
    ?>
    <script>
    alert("Nao foi possivel fazer cadastro, ja existe um usuario com esse email.");
    window.location.href = "cadastrar.html";
</script>
<?php
    exit;
}


$cpf = $_POST['cpf'];
$idade = $_POST['idade'];
$senha = $_POST['senha'];


$inserir = "insert into programador values(null,'$nome','$email','$cpf','$idade','$senha')";
$stmt = $conn->prepare($inserir);
$conexao = mysqli_query($conn, $inserir);
// if ($conexao){
//     echo "Registro inserido com sucesso!";
// }else{
//     echo "Falha na inserção dos dados".mysqli_connect_errno();
// }
mysqli_close($conn);
?>
<script>
    alert("Cadastro efetuado com sucesso! Bem-vindo(a) à equipe <?php echo $nome; ?>");
    window.location.href = "grid_dev.html";
</script>




