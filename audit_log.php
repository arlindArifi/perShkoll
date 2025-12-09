<?php
require 'db.php';
if(!isset($_SESSION['user'])){ header('Location: login.php'); exit; }
$rows = $pdo->query('SELECT * FROM audit_log ORDER BY created_at DESC LIMIT 200')->fetchAll();
include 'partials/header.php';
?>
<div class="card">
  <h2>Audit Log</h2>
  <table class="table"><thead><tr><th>Time</th><th>User</th><th>Action</th><th>Entity</th><th>Details</th></tr></thead>
  <tbody>
  <?php foreach($rows as $r): ?>
    <tr><td><?=htmlspecialchars($r['created_at'])?></td><td><?=htmlspecialchars($r['user'])?></td><td><?=htmlspecialchars($r['action'])?></td><td><?=htmlspecialchars($r['entity'])?> #<?=htmlspecialchars($r['entity_id'])?></td><td><?=htmlspecialchars($r['details'])?></td></tr>
  <?php endforeach; ?>
  </tbody></table>
</div>
<?php include 'partials/footer.php'; ?>