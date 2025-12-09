<?php
require 'db.php';
session_start();
$suppliers = $pdo->query("SELECT id,name FROM suppliers ORDER BY name")->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){
  $stmt = $pdo->prepare("INSERT INTO products (sku,name,serial_number,supplier_id,category,brand,cpu,ram,storage,gpu,purchase_price,price,quantity,warranty,image,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
  $stmt->execute([$_POST['sku'],$_POST['name'],$_POST['serial_number'],$_POST['supplier_id'],$_POST['category'],$_POST['brand'],$_POST['cpu'],$_POST['ram'],$_POST['storage'],$_POST['gpu'],$_POST['purchase_price'],$_POST['price'],$_POST['quantity'],$_POST['warranty'],$_POST['image']]);
  header('Location: products.php'); exit;
}
include 'partials/header.php';

?>
<div class="main">
  <div class="title">Add Product</div>
  <div class="card">
    <form method="post">
      <label>SKU<br><input name="sku" required></label><br>
      <label>Name<br><input name="name" required></label><br>
      <label>Brand<br><input name="brand"></label><br>
      <label>Quantity<br><input name="quantity" type="number" value="1"></label><br>
      <label>Price<br><input name="price" type="number" step="0.01"></label><br>
      <label>Supplier<br>
        <select name="supplier_id">
          <option value="">--</option>
          <?php foreach($suppliers as $s): ?>
            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </label><br><br>
      <button type="submit">Add</button>
    </form>
  </div>
</div>
<?php include 'partials/footer.php'; ?>
