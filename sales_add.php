<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') { header('HTTP/1.1 403 Forbidden'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = (int)($_POST['product_id'] ?? 0);
    $qty = (int)($_POST['quantity'] ?? 0);
    $total = (float)($_POST['total_price'] ?? 0);

    if (!$pid || $qty<=0) { header("Location: sales.php?err=bad"); exit; }

    // check stock
    $st = $pdo->prepare("SELECT quantity, name FROM products WHERE id=?");
    $st->execute([$pid]);
    $p = $st->fetch();
    if (!$p) { header("Location: sales.php?err=nf"); exit; }
    if ($p['quantity'] < $qty) { header("Location: sales.php?err=nostock"); exit; }

    // insert sale
    $ins = $pdo->prepare("INSERT INTO sales (product_id, quantity, total_price, sold_at) VALUES (?,?,?,NOW())");
    $ins->execute([$pid,$qty,$total]);
    $saleId = $pdo->lastInsertId();

    // update product stock
    $upd = $pdo->prepare("UPDATE products SET quantity = quantity - ? WHERE id=?");
    $upd->execute([$qty,$pid]);

    // audit log
    $al = $pdo->prepare("INSERT INTO audit_log (`user`,`action`,`entity`,`entity_id`,`details`) VALUES (?,?,?,?,?)");
    $al->execute([$_SESSION['user']['username'] ?? $_SESSION['user']['id'], 'create', 'sale', $saleId, "product={$p['name']},qty={$qty},total={$total}"]);

    header("Location: sales.php?ok=1");
    exit;
}
header("Location: sales.php");
