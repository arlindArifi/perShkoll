<?php
require 'db.php';
include 'partials/header.php';

?>

<div class="main">
    <h1 class="title">Settings</h1>

    <div class="card" style="max-width:400px;">
        <h3>Theme Mode</h3>

        <label class="theme-switch">
            <input type="checkbox" id="themeToggle">
            <span class="slider"></span>
        </label>

        <p style="margin-top:10px;">Switch between Dark & Light mode.</p>
    </div>

    <br>

    <div class="card">
        <h3>System Settings</h3>
        <p>Here you can add DB Backup, Import/Export, User Roles, System Name, Email settings, etc.</p>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
