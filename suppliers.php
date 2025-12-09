<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

include 'partials/header.php';
include 'partials/sidebar.php';
?>

<div class="main">

    <div class="title">Suppliers</div>

    <div class="card">
        <h3>Lista e Furnizuesve</h3>

        <?php
        $stmt = $pdo->query("SELECT * FROM suppliers ORDER BY id DESC");
        $suppliers = $stmt->fetchAll();
        ?>

        <table>
            <tr>
                <th>Emri</th>
                <th>Kontakti</th>
                <th>Telefoni</th>
            </tr>

            <?php foreach($suppliers as $s): ?>
                <tr>
                    <td><?= htmlspecialchars($s['name']) ?></td>
                    <td><?= htmlspecialchars($s['contact']) ?></td>
                    <td><?= htmlspecialchars($s['phone']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</div>

<?php include 'partials/footer.php'; ?>
