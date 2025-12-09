<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') { header('HTTP/1.1 403 Forbidden'); exit; }

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header("Location: sales.php"); exit; }

// fetch sale
$s = $pdo->prepare("SELECT * FROM sales WHERE id=?");
$s->execute([$id]);
$row = $s->fetch();
if (!$row) { header("Location: sales.php"); exit; }

// restore stock
$pdo->prepare("UPDATE products SET quantity = quantity + ? WHERE id=?")->execute([$row['quantity'],$row['product_id']]);

// delete sale
$pdo->prepare("DELETE FROM sales WHERE id=?")->execute([$id]);

// audit
$al = $pdo->prepare("INSERT INTO audit_log (`user`,`action`,`entity`,`entity_id`,`details`) VALUES (?,?,?,?,?)");
$al->execute([$_SESSION['user']['username'] ?? $_SESSION['user']['id'], 'delete', 'sale', $id, "restored_qty={$row['quantity']} product_id={$row['product_id']}"]);

header("Location: sales.php?deleted=1");
