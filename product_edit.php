<?php
require 'db.php';
session_start();
$id = isset($_GET['id'])?(int)$_GET['id']:0;
$product = $pdo->prepare("SELECT * FROM products WHERE id=?"); $product->execute([$id]); $p = $product->fetch();
$suppliers = $pdo->query("SELECT id,name FROM suppliers ORDER BY name")->fetchAll();
if(!$p){ header('Location: products.php'); exit; }
if($_SERVER['REQUEST_METHOD']==='POST'){
  $stmt = $pdo->prepare("UPDATE products SET sku=?,name=?,serial_number=?,supplier_id=?,category=?,brand=?,cpu=?,ram=?,storage=?,gpu=?,purchase_price=?,price=?,quantity=?,warranty=?,image=? WHERE id=?");
  $stmt->execute([$_POST['sku'],$_POST['name'],$_POST['serial_number'],$_POST['supplier_id'],$_POST['category'],$_POST['brand'],$_POST['cpu'],$_POST['ram'],$_POST['storage'],$_POST['gpu'],$_POST['purchase_price'],$_POST['price'],$_POST['quantity'],$_POST['warranty'],$_POST['image'],$id]);
  header('Location: products.php'); exit;
}
include 'partials/header.php';

?>
<div class="main">
  <div class="title">Edit Product</div>
  <div class="card">
    <form method="post">
      <label>SKU<br><input name="sku" value="<?= htmlspecialchars($p['sku']) ?>" required></label><br>
      <label>Name<br><input name="name" value="<?= htmlspecialchars($p['name']) ?>" required></label><br>
      <label>Brand<br><input name="brand" value="<?= htmlspecialchars($p['brand']) ?>"></label><br>
      <label>Quantity<br><input name="quantity" type="number" value="<?= (int)$p['quantity'] ?>"></label><br>
      <label>Price<br><input name="price" type="number" step="0.01" value="<?= htmlspecialchars($p['price']) ?>"></label><br>
      <label>Supplier<br>
        <select name="supplier_id">
          <option value="">--</option>
          <?php foreach($suppliers as $s): ?>
            <option value="<?= $s['id'] ?>" <?php if($s['id']==$p['supplier_id']) echo 'selected'; ?>><?= htmlspecialchars($s['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </label><br><br>
      <button type="submit">Save</button>
    </form>
  </div>
</div>
<?php include 'partials/footer.php'; ?>
