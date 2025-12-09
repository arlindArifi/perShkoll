<?php
require 'db.php';
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!=='user'){
    header('Location: login.php'); exit;
}
include 'partials/header.php';
include 'partials/sidebar_user.php';

$q=$pdo->query("SELECT name,brand,category,quantity FROM products");
?>
<div class="main">
<h1 class="title">Products (View Only)</h1>
<div class="card">
<table class="table">
<thead><tr><th>Name</th><th>Brand</th><th>Category</th><th>Qty</th></tr></thead>
<tbody>
<?php foreach($q as $p): ?>
<tr>
<td><?= htmlspecialchars($p['name']) ?></td>
<td><?= htmlspecialchars($p['brand']) ?></td>
<td><?= htmlspecialchars($p['category']) ?></td>
<td><?= $p['quantity'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
<?php include 'partials/footer.php'; ?>