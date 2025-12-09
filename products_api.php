<?php
require 'db.php';
header('Content-Type: application/json; charset=utf-8');
$rows = $pdo->query("SELECT id, sku, name, brand, quantity, price FROM products ORDER BY created_at DESC")->fetchAll();
echo json_encode($rows);
