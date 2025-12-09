<?php
require 'db.php';
session_start();

// Nëse user është loguar – ridrejto sipas rolit
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: dashboard_user.php");
        exit;
    }
}

$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
    $stmt->execute([$u]);
    $user = $stmt->fetch();

    if ($user && ($p === $user['password'])) {
        $_SESSION['user'] = $user;

        if ($user['role'] === 'admin') {
            header("Location: dashboard.php");
        } else {
            header("Location: dashboard_user.php");
        }
        exit;
    } else {
        $err = "Login failed";
    }
}

include 'partials/header.php';
?>

<div class="login-wrapper">
    <div class="login-card">
        <h2 class="login-title">Welcome Back</h2>
        <p class="login-subtitle">Sign in to continue</p>

        <?php if ($err): ?>
            <p class="login-error"><?= htmlspecialchars($err) ?></p>
        <?php endif; ?>

        <form method="post" class="login-form">
            <div class="input-group">
                <label>Username</label>
                <input name="username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input name="password" type="password" required>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
