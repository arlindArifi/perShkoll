<nav class="sidebar" id="siteSidebar" aria-label="User Menu">
<div class="sidebar-inner">
<div class="logo">👤 User Panel</div>

<ul class="menu">
<li><a href="/inv/dashboard_user.php" class="<?= basename($_SERVER['PHP_SELF'])=='dashboard_user.php'?'active':'' ?>">Dashboard</a></li>
<li><a href="/inv/products_user.php" class="<?= basename($_SERVER['PHP_SELF'])=='products_user.php'?'active':'' ?>">Products</a></li>
<li><a href="/inv/suppliers_user.php" class="<?= basename($_SERVER['PHP_SELF'])=='suppliers_user.php'?'active':'' ?>">Suppliers</a></li>
<li><a href="/inv/sales_user.php" class="<?= basename($_SERVER['PHP_SELF'])=='sales_user.php'?'active':'' ?>">Sales</a></li>

<li><a href="/inv/logout.php">Logout</a></li>
</ul>

<div class="sidebar-footer"><small>User Mode</small></div>
</div>
</nav>