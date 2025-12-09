<?php
require 'db.php';
session_start();
$id = isset($_GET['id'])?(int)$_GET['id']:0;
$p = $pdo->prepare("SELECT p.*, s.name AS supplier_name FROM products p LEFT JOIN suppliers s ON p.supplier_id=s.id WHERE p.id=?");
$p->execute([$id]); $prod = $p->fetch();
if(!$prod){ header('Location: products.php'); exit; }
include 'partials/header.php'; 
?>
<div class="main">
  <div class="title"><?= htmlspecialchars($prod['name']) ?></div>
  <div class="card">
    <p><strong>SKU:</strong> <?= htmlspecialchars($prod['sku']) ?></p>
    <p><strong>Brand:</strong> <?= htmlspecialchars($prod['brand']) ?></p>
    <p><strong>Quantity:</strong> <?= (int)$prod['quantity'] ?></p>
    <p><strong>Price:</strong> <?= number_format($prod['price'],2) ?> €</p>
    <p><strong>Supplier:</strong> <?= htmlspecialchars($prod['supplier_name']) ?></p>
  </div>
</div>
<?php include 'partials/footer.php'; ?>
