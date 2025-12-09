<?php
require 'db.php';
session_start();
if(!isset($_GET['id'])){ header('Location: products.php'); exit;}
$id = (int)$_GET['id'];
$pdo->prepare("DELETE FROM products WHERE id=?")->execute([$id]);
header('Location: products.php');
exit;
