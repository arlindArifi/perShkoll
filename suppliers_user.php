<?php
require 'db.php';
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!=='user'){
    header('Location: login.php'); exit;
}
include 'partials/header.php';
include 'partials/sidebar_user.php';

$s=$pdo->query("SELECT name,phone,email FROM suppliers");
?>
<div class="main">
<h1 class="title">Suppliers (View Only)</h1>
<div class="card">
<table class="table">
<thead><tr><th>Name</th><th>Phone</th><th>Email</th></tr></thead>
<tbody>
<?php foreach($s as $x): ?>
<tr>
<td><?= htmlspecialchars($x['name']) ?></td>
<td><?= htmlspecialchars($x['phone']) ?></td>
<td><?= htmlspecialchars($x['email']) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
<?php include 'partials/footer.php'; ?>