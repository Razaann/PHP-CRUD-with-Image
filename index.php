<!-- M. Razaan Arjuna
NIM 09021282328060 -->

<?php
// index.php
// Menghubungkan dengan database
include('config.php');

// Memilih sorting yang dipilih user
$sort = $_GET['sort'] ?? 'id_desc';

// Membuat query SQL berdasarkan sorting
$order_by = "ORDER BY id DESC";
if ($sort === 'name_asc') {
    $order_by = "ORDER BY name ASC";
} elseif ($sort === 'name_desc') {
    $order_by = "ORDER BY name DESC";
} elseif ($sort === 'price_asc') {
    $order_by = "ORDER BY price ASC";
} elseif ($sort === 'price_desc') {
    $order_by = "ORDER BY price DESC";
}

// Membuat query SQL yang akan menampilkan semua data games
$query = "SELECT * FROM games $order_by";
$result = $conn->query($query);

// Membuat folder uploads jika belum dibuat
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS Razaan</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <img src="Nintendo.svg"></img>
    
<!-- Button untuk menambah produk -->
<div class="header-actions">
    <button class="add-btn" onclick="window.location.href='create.php'">Manage Product</button>
    
    <!-- Dropdown menu untuk mengurutkan produk -->
    <form method="GET" action="index.php">
        <select name="sort" onchange="this.form.submit()" class="sort-dropdown">
            <option value="id_desc" <?= ($sort === 'id_desc') ? 'selected' : '' ?>>Default</option>
            <option value="name_asc" <?= ($sort === 'name_asc') ? 'selected' : '' ?>>Name (A-Z)</option>
            <option value="name_desc" <?= ($sort === 'name_desc') ? 'selected' : '' ?>>Name (Z-A)</option>
            <option value="price_asc" <?= ($sort === 'price_asc') ? 'selected' : '' ?>>Price (Low to High)</option>
            <option value="price_desc" <?= ($sort === 'price_desc') ? 'selected' : '' ?>>Price (High to Low)</option>
        </select>
    </form>
</div>

<!-- Container untuk menampilkan semua produk -->
<div class="container">
    <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="card">
            <img src="<?= htmlspecialchars($row['img']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
            <h2><?= htmlspecialchars($row['name']) ?></h2>
            <p><?= htmlspecialchars($row['description']) ?></p>
            <div class="price">Rp <?= number_format($row['price'], 0, ',', '.') ?></div>
            <div style="display: flex; gap: 5px;">
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php $conn->close(); ?>

</body>
</html>
