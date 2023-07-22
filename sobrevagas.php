<?php
session_start();
include_once('conexao.php');

if (!empty($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT * FROM vagas WHERE titulo LIKE '%$search%' ORDER BY id DESC";
} else {
  $sql = "SELECT * FROM vagas ORDER BY id DESC";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vagas</title>
  <link rel="apple-touch-icon" sizes="180x180" href="ICONS/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="ICONS/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="ICONS/favicon-16x16.png">
  <link rel="manifest" href="ICONS/site.webmanifest">
  <link rel="mask-icon" href="ICONS/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <style>
    body {
      background-image: linear-gradient(to right top, #4a007a, #4f0e88, #541a95, #5824a4, #5b2eb2, #5f30bc, #6333c5, #6735cf, #6d2fd5, #7426db, #7c1ae1, #8400e6);
      background-repeat: no-repeat;
      background-size: cover;
      min-height: 100vh;
    }

    .vagas {
      background-color: white;
      background-size: cover;
      margin: 0 auto;
      width: 1000px;
      height: 900px;
      border-radius: 5px;
    }

    .nav {
      width: 60%;
      margin: auto;
      text-align: center;
      display: flex;
      justify-content: space-around;
    }

    .pesquisa {
      height: 50px;
      display: flex;
    }

    .botao {
      background-color: white;
      color: #541a95;
      border-radius: 5px;
      width: 40px;
      height: 40px;
      border: none;
      outline: none;
      font-size: 15px;
    }

    .botao:hover {
      background: #e40189;
      border: 1px solid #e40189;
      border-radius: 5px;
      cursor: pointer;
      color: white;
      display: block;
    }

    .pesquisar_insira {
      width: 600px;
      height: 40px;
      display: block;
      border-radius: 5px;
      outline: #5824a4;
      padding-left: 2%;
    }

    .saber {
      background: #5F3BC6;
      font-weight: bold;
      width: 130px;
      height: 40px;
      border: 1px solid white;
      color: white;
      float: right;
      border-radius: 20px;
      font-size: 15px;
      transition: 0.5s;
      margin-right: 10px;
    }

    .saber:hover {
      background: #e40189;
      border: 1px solid white;
      color: white;
      border-radius: 20px;
      transition: 0.5s;
    }

    .log {
      padding-left: 10px;
    }

    .voltar {
      text-align: center;
      background: white;
      width: 165px;
      height: 28px;
      border: 1px solid white;
      color: #5F3BC6;
      border-radius: 20px;
      font-size: 14px;
      transition: 0.4s;
      margin-left: 40px;
      margin-top: 20px;
    }

    .voltar:hover {
      background: #e40189;
      border: 1px solid #e40189;
      color: white;
      border-radius: 20px;
      margin-top: 20px;
    }

    .lupa {
      height: 20px;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .box {
      width: 550px;
      min-height: 200px;
      border: 1px solid #5F3BC6;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 0;
      margin: 10px;
      display: flex;
      font-size: 18px;
    }
    .imagem {
        width: 60px;
        height: 60px;
        margin: 10px;
        border-radius: 50%; /* To make the image circular, if desired */
    }
    .titulo{
      margin-top: 10px;
      font-size: 20px;
      font-weight: bold;
      width: 550px;
    }
    .sobre{
      margin-top: 50px;
      width: 700px;
      height: 110px;
      margin-left: -450px;
      margin-right: -200px;
      text-align: justify;
    }
    .saiba-mais {
      text-align: center;
      background: white;
      width: 165px;
      height: 28px;
      border: 1px solid white;
      color: #5F3BC6;
      border-radius: 20px;
      font-size: 14px;
      transition: 0.4s;
      margin: 30px;
      margin-top: 100%;
    }

    .saiba-mais:hover {
      background: #e40189;
      border: 1px solid #e40189;
      color: white;
      border-radius: 20px;
    }

    form .btn .btn-layer {
            height: 100%;
            width: 300%;
            position: absolute;
            background: -webkit-linear-gradient(right, #a445b2, #fa4299, #a445b2, #fa4299);
            border-radius: 5px;
            transition: all 0.4s ease;
            ;
        }

        form .btn:hover .btn-layer {
            width: 150%;
            height: 150%;
        }
    /* Media Queries for Responsive Layout */
    @media screen and (max-width: 768px) {
      .box {
        width: 100%;
        height: 200px;
        font-size: 16px;
      }

      .pesquisar_insira {
        width: 80vw;
        height: 40px;
        display: block;
        border-radius: 5px;
        outline: #5824a4;
        padding-left: 2%;
      }
    }

    @media screen and (max-width: 576px) {
      .box {
        width: 100%;
        height: 200px;
        margin: 10px;
        font-size: 14px;
      }

      .container {
        justify-content: center;
      }

      .pesquisar_insira {
        width: 80vw;
        height: 40px;
        display: block;
        border-radius: 5px;
        outline: #5824a4;
        padding-left: 2%;
      }
    }
  </style>
</head>

<body>
  <a href="index.html"> <button class="voltar">Voltar à página inicial</button></a><br><br>
  <div class="nav">
    <nav class="navbar bg-body-tertiary">
      <form class="pesquisa" role="search" onsubmit="searchData(); return false;">
        <input class="pesquisar_insira" type="search" id="search" placeholder="Insira sua busca" aria-label="Search">
        <button class="botao" type="submit"><img src="imgs/icons8-lupa-30.png" class="lupa"></button>
      </form>
    </nav>
  </div>
  <div class="container">
    <?php
    while ($user_data = mysqli_fetch_assoc($result)) {
      echo '<div class="box">';
      echo '<img class="imagem" src="data:image/jpeg;base64,' . base64_encode($user_data['imagem']) . '" alt="Imagem da vaga">';
      echo '<h2 class="titulo">' . $user_data['titulo'] . '</h2>';
      echo '<p class="sobre">' . $user_data['sobre'] . '</p>';
      echo '<a href="#vagas"><button class="saiba-mais">Saiba mais</button></a>';
      echo '</div>';
    }
    ?>
  </div>
  <script>
    var search = document.getElementById('search');

    function searchData() {
      window.location = "sobrevagas.php?search=" + search.value;
    }
  </script>
</body>

</html>