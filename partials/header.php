<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// LOADING CORRECT SIDEBAR
function loadSidebar() {
    // Nëse nuk ka user fare → Admin default sidebar
    if (!isset($_SESSION['user'])) {
        include __DIR__ . '/sidebar.php';
        return;
    }

    // Admin → sidebar_admin
    if ($_SESSION['user']['role'] === 'admin') {
        include __DIR__ . '/sidebar.php';
        return;
    }

    // User → sidebar_user
    if ($_SESSION['user']['role'] === 'user') {
        include __DIR__ . '/sidebar_user.php';
        return;
    }

    // fallback
    include __DIR__ . '/sidebar.php';
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Inventar</title>

<link rel="stylesheet" href="/inv/assets/css/style.css?v=10">
<script defer src="/inv/assets/js/sidebar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
</head>

<body class="layout <?php if(isset($_SESSION['theme']) && $_SESSION['theme']=='light') echo 'light'; ?>">

<header class="topbar">
    <div class="topbar-inner">
        <button id="sidebarToggle" class="btn toggle">☰</button>
        <div class="brand">INVENTORY</div>

        <div class="top-actions">
            <?php if(isset($_SESSION['user'])): ?>
                <span class="user">Hello, <?= htmlspecialchars($_SESSION['user']['username']) ?></span>
                <a href="logout.php" class="btn small">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<div class="wrapper">   
    <?php loadSidebar(); ?>


<?php loadSidebar(); ?>
