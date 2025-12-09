<?php
require 'db.php';
session_start();
if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: dashboard_user.php");
    exit;
}

$products = $pdo->query("SELECT p.*, s.name AS supplier_name FROM products p LEFT JOIN suppliers s ON p.supplier_id = s.id ORDER BY p.created_at DESC")->fetchAll();
include 'partials/header.php';

?>
<div class="main">
  <div class="title">Products</div>
  <div style="margin-bottom:12px">
    <a href="product_add.php" class="btn">+ Add product</a>
  </div>
  <div class="card">
    <table style="width:100%;border-collapse:collapse;color:#fff">
      <thead>
        <tr style="text-align:left;border-bottom:1px solid #222">
          <th>SKU</th><th>Name</th><th>Brand</th><th>Qty</th><th>Price</th><th>Supplier</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($products as $p): ?>
        <tr style="border-bottom:1px solid #222">
          <td><?= htmlspecialchars($p['sku']) ?></td>
          <td><?= htmlspecialchars($p['name']) ?></td>
          <td><?= htmlspecialchars($p['brand']) ?></td>
          <td><?= (int)$p['quantity'] ?></td>
          <td><?= number_format($p['price'],2) ?> €</td>
          <td><?= htmlspecialchars($p['supplier_name']) ?></td>
          <td>
            <a href="product_edit.php?id=<?= $p['id'] ?>">Edit</a> |
            <a href="product_delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include 'partials/footer.php'; ?>
