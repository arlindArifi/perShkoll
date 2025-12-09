<?php
require 'db.php';
$users = $pdo->query("SELECT id, username, role, created_at FROM users ORDER BY id")->fetchAll();
include 'partials/header.php';

?>
<div class="main">
  <div class="title">Users</div>
  <div class="card">
    <table style="width:100%;color:#fff">
      <thead><tr><th>Username</th><th>Role</th><th>Created</th></tr></thead>
      <tbody>
        <?php foreach($users as $u): ?>
        <tr><td><?=htmlspecialchars($u['username'])?></td><td><?=htmlspecialchars($u['role'])?></td><td><?= $u['created_at'] ?></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include 'partials/footer.php'; ?>
