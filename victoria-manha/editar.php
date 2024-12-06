<?php
require 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: produtos.php');
    exit;
}

// Busca o produto para edição
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->execute([':id' => $id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    header('Location: produtos.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, quantidade = :quantidade WHERE id = :id");
    $stmt->execute([
        ':nome' => htmlspecialchars($_POST['produto']),
        ':descricao' => htmlspecialchars($_POST['descricao']),
        ':preco' => number_format((float)$_POST['preco'], 2, '.', ''),
        ':quantidade' => (int)$_POST['quantidade'],
        ':id' => $id
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
  <title>Editar Produto</title>
</head>
<body>
<main>
  <h1>Editar Produto</h1>
  <form action="" method="post">
    Nome do produto: <br><input type="text" name="produto" value="<?= htmlspecialchars($produto['nome']); ?>" required><br><br>
    Descrição: <br><input type="text" name="descricao" value="<?= htmlspecialchars($produto['descricao']); ?>" required><br><br>
    Preço: <br><input type="number" step="0.01" name="preco" value="<?= number_format($produto['preco'], 2, '.', ''); ?>" required><br><br>
    Quantidade: <br><input type="number" name="quantidade" value="<?= $produto['quantidade']; ?>" required><br><br>
    <input id="button" type="submit" value="Salvar">
  </form>
  <br>
  <a href="produtos.php"><button>Cancelar</button></a>
</main>
<footer>Desenvolvido por victoria - curso de Desenvolvimento de Sistemas</footer>
</body>
</html>