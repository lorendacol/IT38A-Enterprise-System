<?php
$conn = new mysqli("localhost", "root", "", "dacol");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$filter = isset($_GET['category']) ? $_GET['category'] : 'all';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM equipment WHERE 1";

if ($filter !== 'all') {
    $sql .= " AND category = '$filter'";
}

if (!empty($search)) {
    $sql .= " AND name LIKE '%$search%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sports Equipment</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<main class="equipment-page">
  <h2 class="equipment-title">Sports Equipment</h2>

  <!-- Search and filter wrapped together -->
  <div class="search-and-filter">
    <form method="GET" class="search-form">
      <input 
        type="text" 
        name="search" 
        placeholder="Search..." 
        value="<?= htmlspecialchars($search) ?>" 
        class="search-input"
      >
      <button type="submit" class="search-button">Search</button>
    </form>

    <div class="category-filters">
      <?php foreach (['All', 'Volleyball', 'Basketball', 'Frisbee'] as $cat): ?>
        <a 
          href="?category=<?= strtolower($cat) ?>" 
          class="filter-btn <?= $filter == strtolower($cat) ? 'active' : '' ?>"
        >
          <?= $cat ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="equipment-grid">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="equipment-card">
        <img src="<?= $row['image_url'] ?>" alt="<?= $row['name'] ?>" class="equipment-image">
        <h3 class="equipment-name"><?= $row['name'] ?></h3>
        <p class="equipment-description"><?= $row['description'] ?></p>
        <form method="GET" action="borrow.php">
  <input type="hidden" name="equipment_id" value="<?= $row['id'] ?>">
  <button type="submit" class="borrow-button">Borrow</button>
</form>
      </div>
    <?php endwhile; ?>
  </div>
</main>

</body>
</html>
