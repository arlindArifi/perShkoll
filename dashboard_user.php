<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
include 'partials/header.php';
include 'partials/sidebar_user.php';

$last5 = $pdo->query("SELECT name,brand,category,created_at FROM products ORDER BY created_at DESC LIMIT 5")->fetchAll();
$low = $pdo->query("SELECT COUNT(*) FROM products WHERE quantity<=5")->fetchColumn();
?>
<div class="main">
<h1 class="title">User Dashboard</h1>
<div class="grid">
 <div class="card"><h3>Stok i ulët</h3><p><?= $low ?></p></div>
 <div class="card"><h3>Pajisje Totale</h3><p><?= $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn(); ?></p></div>
</div>
<br>
<div class="card"><h3>Pajisjet e fundit</h3><ul>
<?php foreach($last5 as $i): ?>
<li><strong><?= htmlspecialchars($i['name']) ?></strong><br>
<?= htmlspecialchars($i['brand']) ?> - <?= htmlspecialchars($i['category']) ?><br>
<small><?= $i['created_at'] ?></small></li>
<?php endforeach; ?>
</ul></div>
</div>
<?php include 'partials/footer.php'; ?>