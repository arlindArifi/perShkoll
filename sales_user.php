<?php
require 'db.php';
session_start();

// Vetëm USER lejohet këtu
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

include 'partials/header.php';
include 'partials/sidebar_user.php';

// Merr shitjet
$sql = "
    SELECT sales.id, products.name, products.brand, sales.quantity, sales.total_price, sales.sold_at
    FROM sales
    JOIN products ON sales.product_id = products.id
    ORDER BY sold_at DESC
    LIMIT 50
";

$sales = $pdo->query($sql)->fetchAll();
?>

<div class="main">
    <h1 class="title">Sales (View Only)</h1>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Produkti</th>
                    <th>Brand</th>
                    <th>Sasia</th>
                    <th>Totali (€)</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sales as $s): ?>
                <tr>
                    <td><?= htmlspecialchars($s['name']) ?></td>
                    <td><?= htmlspecialchars($s['brand']) ?></td>
                    <td><?= $s['quantity'] ?></td>
                    <td><?= number_format($s['total_price'], 2) ?></td>
                    <td><?= $s['sold_at'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
