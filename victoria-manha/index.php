<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES (:nome, :descricao, :preco, :quantidade)");
    $stmt->execute([
        ':nome' => htmlspecialchars($_POST['produto']),
        ':descricao' => htmlspecialchars($_POST['descricao']),
        ':preco' => number_format((float)$_POST['preco'], 2, '.', ''), // Salva com ponto como separador decimal
        ':quantidade' => (int)$_POST['quantidade']
    ]);
    header('Location: produtos.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Cadastro de Produto</title>
</head>
<body>
<main>
  <h1>Cadastrar Novo Produto</h1>
  <form action="" method="post">
    Nome do produto: <br><input type="text" name="produto" required><br><br>
    Descrição: <br><input type="text" name="descricao" required><br><br>
    Preço: <br><input type="number" step="0.01" name="preco" required><br><br>
    Quantidade: <br><input type="number" name="quantidade" required><br><br>
    <input id="button" type="submit" value="Cadastrar">
  </form>
</main>

<footer >  
    <a href="https://upload.wikimedia.org/wikipedia/pt/c/c9/Barbie_Fairy_Secret.png" target="_blank">Visite o site da Barbie!</a>
    <!-- Imagem da Barbie (coloque a URL da imagem que deseja utilizar) -->
    <img src="img/barbie.png" alt="Imagem da Barbie">

    </footer>

</body>
</html>