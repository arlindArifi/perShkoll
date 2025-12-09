<?php
require 'db.php';
session_start();

// =======================
//     ROLE CHECK
// =======================
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: dashboard_user.php");
    exit;
}

// =======================
//     ADMIN STATS
// =======================

// fetch stats
$total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$low_stock = $pdo->query("SELECT COUNT(*) FROM products WHERE quantity <= 5")->fetchColumn();
$stock_value = $pdo->query("SELECT COALESCE(SUM(price * quantity),0) FROM products")->fetchColumn();

// status logic
$has_status = false;
$cols = $pdo->query("SHOW COLUMNS FROM products")->fetchAll();
foreach($cols as $c){
    if($c['Field'] === 'status'){
        $has_status = true;
        break;
    }
}

if($has_status){
    $status_ok = $pdo->query("SELECT COUNT(*) FROM products WHERE status='OK'")->fetchColumn();
    $status_defekt = $pdo->query("SELECT COUNT(*) FROM products WHERE status='Defekt'")->fetchColumn();
    $status_servis = $pdo->query("SELECT COUNT(*) FROM products WHERE status='Ne servis'")->fetchColumn();
} else {
    $status_ok = $pdo->query("SELECT COUNT(*) FROM products WHERE warranty LIKE '24%' OR warranty LIKE '36%'")->fetchColumn();
    $status_defekt = $pdo->query("SELECT COUNT(*) FROM products WHERE warranty LIKE '%broken%' OR warranty LIKE '%defekt%'")->fetchColumn();
    $status_servis = 0;
}

$last5 = $pdo->query("SELECT name, brand, category, created_at FROM products ORDER BY created_at DESC LIMIT 5")->fetchAll();

include 'partials/header.php';
?>

<!-- WRAPPER FIX -->
<div class="wrapper">

    <?php loadSidebar(); ?>

    <main class="main">

        <div class="title">Dashboard</div>

        <div class="grid">
            <div class="card">
                <h3>Total Produkte</h3>
                <p><?= (int)$total_products ?></p>
            </div>

            <div class="card">
                <h3>Stok i ulët</h3>
                <p><?= (int)$low_stock ?></p>
            </div>

            <div class="card">
                <h3>Vlera e stokut</h3>
                <p><?= number_format($stock_value,2) ?> €</p>
            </div>
        </div>

        <br>

        <div class="grid">
            <div class="card status-ok"><h3>OK</h3><p><?= (int)$status_ok ?></p></div>
            <div class="card status-defekt"><h3>Defekt</h3><p><?= (int)$status_defekt ?></p></div>
            <div class="card status-servis"><h3>Në Servis</h3><p><?= (int)$status_servis ?></p></div>
        </div>

        <br>

        <div class="card last">
            <h3>Pajisjet e fundit</h3>
            <ul>
                <?php foreach($last5 as $item): ?>
                    <li>
                        <strong><?= htmlspecialchars($item['name']) ?></strong><br>
                        <span><?= htmlspecialchars($item['brand']) ?> - <?= htmlspecialchars($item['category']) ?></span><br>
                        <small><?= $item['created_at'] ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <br>

        <div class="card">
            <h3>Top Produkte (sipas stoku)</h3>

            <?php
                $top = $pdo->query("SELECT name, quantity FROM products ORDER BY quantity DESC LIMIT 8")->fetchAll();
                $labels = []; 
                $data = [];

                foreach($top as $r){
                    $labels[] = $r['name'];
                    $data[] = (int)$r['quantity'];
                }
            ?>

            <canvas id="stockChart"
                data-labels='<?= json_encode($labels) ?>'
                data-data='<?= json_encode($data) ?>'
                style="max-height:300px">
            </canvas>
        </div>

    </main>
</div>

<?php include 'partials/footer.php'; ?>
