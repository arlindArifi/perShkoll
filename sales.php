<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// products for dropdown + filter list
$products = $pdo->query("SELECT id, name, price FROM products ORDER BY name")->fetchAll();

// FILTER handling (GET)
$where = "1=1";
$params = [];
if (!empty($_GET['from'])) { $where .= " AND DATE(sold_at) >= ?"; $params[] = $_GET['from']; }
if (!empty($_GET['to']))   { $where .= " AND DATE(sold_at) <= ?"; $params[] = $_GET['to']; }
if (!empty($_GET['product']) && $_GET['product'] !== 'all') { $where .= " AND product_id = ?"; $params[] = (int)$_GET['product']; }

// PAGINATION for table (sales_view also exists but keep small here)
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 20;
$offset = ($page-1)*$perPage;

// fetch table data
$stmt = $pdo->prepare("SELECT s.id, s.product_id, s.quantity, s.total_price, s.sold_at, p.name, p.price
    FROM sales s JOIN products p ON p.id = s.product_id
    WHERE $where
    ORDER BY s.sold_at DESC
    LIMIT $perPage OFFSET $offset");
$stmt->execute($params);
$sales = $stmt->fetchAll();

// count total for pagination
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM sales s JOIN products p ON p.id = s.product_id WHERE $where");
$countStmt->execute($params);
$totalRows = $countStmt->fetchColumn();
$totalPages = ceil($totalRows / $perPage);

// quick stats
$todayTotal = $pdo->query("SELECT COALESCE(SUM(total_price),0) FROM sales WHERE DATE(sold_at)=CURDATE()")->fetchColumn();
$monthTotal = $pdo->query("SELECT COALESCE(SUM(total_price),0) FROM sales WHERE DATE_FORMAT(sold_at,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m')")->fetchColumn();
$txCount = $pdo->query("SELECT COUNT(*) FROM sales")->fetchColumn();

// charts data (sales per month)
$monthly = $pdo->query("SELECT DATE_FORMAT(sold_at,'%Y-%m') AS month, SUM(total_price) AS total
    FROM sales GROUP BY month ORDER BY month ASC")->fetchAll();
$months = array_column($monthly,'month');
$monthTotals = array_map('floatval', array_column($monthly,'total'));

// best selling
$best = $pdo->query("SELECT p.name, SUM(s.quantity) AS qty FROM sales s JOIN products p ON p.id=s.product_id
    GROUP BY p.id ORDER BY qty DESC LIMIT 6")->fetchAll();
$best_names = array_column($best,'name');
$best_qty = array_map('intval', array_column($best,'qty'));

include 'partials/header.php';
?>
<div class="main">
  <div class="title">Sales Management</div>

  <!-- quick stats -->
  <div class="grid">
    <div class="card"><h3>Today Revenue</h3><p><?= number_format($todayTotal,2) ?> €</p></div>
    <div class="card"><h3>This Month</h3><p><?= number_format($monthTotal,2) ?> €</p></div>
    <div class="card"><h3>Transactions</h3><p><?= (int)$txCount ?></p></div>
  </div>

  <!-- filter -->
  <div class="card" style="margin-top:16px">
    <form method="get" class="filter-grid" style="display:flex;gap:12px;flex-wrap:wrap">
      <div><label>From</label><input type="date" name="from" class="form-control" value="<?= htmlspecialchars($_GET['from'] ?? '') ?>"></div>
      <div><label>To</label><input type="date" name="to" class="form-control" value="<?= htmlspecialchars($_GET['to'] ?? '') ?>"></div>
      <div>
        <label>Product</label>
        <select name="product" class="form-control">
          <option value="all">All</option>
          <?php foreach($products as $p): ?>
            <option value="<?= $p['id'] ?>" <?= (isset($_GET['product']) && $_GET['product']==$p['id'])?'selected':''; ?>>
              <?= htmlspecialchars($p['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div style="align-self:end">
        <button class="btn btn-info">Filter</button>
        <a href="sales.php" class="btn btn-secondary">Reset</a>
        <a href="sales_export.php?<?= http_build_query($_GET) ?>" class="btn btn-outline-light">Export CSV</a>
      </div>
    </form>
  </div>

  <!-- add button -->
  <div style="margin-top:12px">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSaleModal">+ Add Sale</button>
  </div>

  <!-- table -->
  <div class="card" style="margin-top:12px;overflow:auto">
    <table class="table table-dark table-hover">
      <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th><th>Date</th><th></th></tr></thead>
      <tbody>
        <?php foreach($sales as $s): ?>
        <tr>
          <td><?= htmlspecialchars($s['name']) ?></td>
          <td><?= number_format($s['price'],2) ?></td>
          <td><?= (int)$s['quantity'] ?></td>
          <td><?= number_format($s['total_price'],2) ?></td>
          <td><?= $s['sold_at'] ?></td>
          <td>
            <a href="sales_receipt.php?id=<?= $s['id'] ?>" class="btn small">Receipt</a>
            <a href="sales_delete.php?id=<?= $s['id'] ?>" class="btn small danger" onclick="return confirm('Delete sale? This will restore stock.')">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- pagination -->
    <div style="display:flex;gap:8px;align-items:center;justify-content:center;margin-top:12px">
      <?php for($i=1;$i<=$totalPages;$i++): ?>
        <a class="btn small <?= $i==$page ? 'active' : '' ?>" href="?<?= http_build_query(array_merge($_GET,['page'=>$i])) ?>"><?= $i ?></a>
      <?php endfor; ?>
    </div>
  </div>

  <!-- charts -->
  <div class="sales-grid" style="margin-top:18px">
    <div class="chart-box card">
      <h3>Total Sales Per Month</h3>
      <canvas id="salesMonthChart" class="chart-small"></canvas>
    </div>
    <div class="chart-box card">
      <h3>Best Selling Products</h3>
      <canvas id="bestProductsChart" class="chart-small"></canvas>
    </div>
  </div>
</div>

<!-- ADD SALE MODAL (Bootstrap) -->
<div class="modal fade" id="addSaleModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title">Add Sale</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form method="post" action="sales_add.php">
        <div class="modal-body">
          <label>Product</label>
          <select name="product_id" id="productSelect" class="form-control">
            <option value="">-- select --</option>
            <?php foreach($products as $p): ?>
            <option value="<?= $p['id'] ?>" data-price="<?= $p['price'] ?>"><?= htmlspecialchars($p['name']) ?> (<?= number_format($p['price'],2) ?> €)</option>
            <?php endforeach; ?>
          </select>

          <label class="mt-2">Quantity</label>
          <input type="number" min="1" name="quantity" id="qtyInput" class="form-control">

          <label class="mt-2">Total (€)</label>
          <input type="text" readonly name="total_price" id="totalInput" class="form-control">
        </div>

        <div class="modal-footer">
          <button class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- scripts for charts & calc -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function calcTotal(){
  const price = document.querySelector('#productSelect option:checked')?.dataset.price;
  const qty = document.getElementById('qtyInput').value;
  document.getElementById('totalInput').value = (price && qty) ? (price * qty).toFixed(2) : '';
}
document.getElementById('productSelect')?.addEventListener('change', calcTotal);
document.getElementById('qtyInput')?.addEventListener('input', calcTotal);

document.addEventListener('DOMContentLoaded', ()=>{
  new Chart(document.getElementById('salesMonthChart'), {
    type:'line',
    data:{ labels: <?= json_encode($months) ?>, datasets:[{label:'Total (€)', data: <?= json_encode($monthTotals) ?>, borderColor:'#00eaff', backgroundColor:'#00eaff33', fill:true}]},
    options:{responsive:true}
  });

  new Chart(document.getElementById('bestProductsChart'), {
    type:'bar',
    data:{ labels: <?= json_encode($best_names) ?>, datasets:[{label:'Sold qty', data: <?= json_encode($best_qty) ?>, backgroundColor:'#00eaff88'}] },
    options:{responsive:true}
  });
});
</script>

<?php include 'partials/footer.php'; ?>
