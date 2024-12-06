<?php
require 'config.php';

// Exclui um produto
if (isset($_GET['excluir'])) {
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = :id");
    $stmt->execute([':id' => (int)$_GET['excluir']]);
    header('Location: produtos.php');
    exit;
}

// Busca todos os produtos
$stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Catálogo de Produtos</title>
</head>
<body>
<main>
  <h1>Catálogo de Produtos</h1>
  <a href="index.php"><button>Cadastrar Novo Produto</button></a>
  <table border="1" cellpadding="10" cellspacing="0">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($produtos)): ?>
        <?php foreach ($produtos as $produto): ?>
          <tr>
            <td><?= htmlspecialchars($produto['nome']); ?></td>
            <td><?= htmlspecialchars($produto['descricao']); ?></td>
            <td>R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></td>
            <td><?= $produto['quantidade']; ?></td>
            <td>
              <a href="editar.php?id=<?= $produto['id']; ?>">Editar</a> |
              <a href="?excluir=<?= $produto['id']; ?>">Excluir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5">Nenhum produto cadastrado.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>
<footer>Desenvolvido por victoria - curso de Desenvolvimento de Sistemas</footer>
</body>
</html>