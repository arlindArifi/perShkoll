<nav class="sidebar admin" id="siteSidebar" aria-label="Admin Menu">
  <div class="sidebar-inner">
    <div class="logo">⚡ Inventory</div>

    <ul class="menu">
      <li><a href="/inv/dashboard.php" class="<?= basename($_SERVER['PHP_SELF'])=='dashboard.php'?'active':'' ?>">Dashboard</a></li>
      <li><a href="/inv/products.php" class="<?= basename($_SERVER['PHP_SELF'])=='products.php'?'active':'' ?>">Products</a></li>
      <li><a href="/inv/suppliers.php" class="<?= basename($_SERVER['PHP_SELF'])=='suppliers.php'?'active':'' ?>">Suppliers</a></li>
      <li><a href="/inv/sales.php" class="<?= basename($_SERVER['PHP_SELF'])=='sales.php'?'active':'' ?>">Sales</a></li>
      <li><a href="/inv/users.php" class="<?= basename($_SERVER['PHP_SELF'])=='users.php'?'active':'' ?>">Users</a></li>
      <li><a href="/inv/settings.php" class="<?= basename($_SERVER['PHP_SELF'])=='settings.php'?'active':'' ?>">Settings</a></li>
      <li><a href="/inv/logout.php">Logout</a></li>
    </ul>

    <div class="sidebar-footer">
      <small>Admin Mode</small>
    </div>
  </div>
</nav>
