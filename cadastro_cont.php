<?php 
include_once("conexao.php");


$nome = $_POST['nome'];
$empresa = $_POST['nomeEmpresa'];
$email = $_POST['email'];
$verificar_sql = "SELECT email FROM contratante WHERE email = ? 
                  UNION
                  SELECT email FROM programador WHERE email = ?";
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


$cnpj = $_POST['cnpj'];
$senha = $_POST['senha'];


$inserir = "insert into contratante values(null,'$nome','$empresa','$email','$cnpj','$senha')";
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
    window.location.href = "index.html";
</script>

