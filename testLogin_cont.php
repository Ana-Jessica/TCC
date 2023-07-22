<?php
    session_start();
    //print_r($_REQUEST);
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){
        header('Location: cadastrar.html');
    } else{
        include_once('conexao.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        // print_r('<br>');
        // print_r('Email: '.$email);
        // print_r('<br>');
        // print_r('Senha: '.$senha);
        $sql = "SELECT * FROM contratante WHERE email = '$email' and senha = '$senha'";
        $result = $conn->query($sql);
        // print_r($result);
        if(mysqli_num_rows($result) < 1){
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            ?>
        <script>
    alert("A senha ou o email estao incorretos.");
    window.location.href = "login.html";
        </script>
            <?php
        } else{
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: grid_empresa.html');
        }
    }


?>



