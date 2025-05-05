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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">




<main class="max-w-6xl mx-auto py-10 px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Sports Equipment</h2>

    <form method="GET" class="flex flex-wrap justify-center gap-4 mb-6">
        <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search) ?>" class="border px-4 py-2 rounded w-64">
        <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-700">Search</button>
    </form>

    <div class="flex flex-wrap justify-center gap-4 mb-8">
        <?php foreach (['all', 'Volleyball', 'Basketball', 'Frisbee'] as $cat): ?>
            <a href="?category=<?= strtolower($cat) ?>" class="px-4 py-2 rounded-full text-sm font-medium <?= ($filter == strtolower($cat)) ? 'bg-blue-900 text-white' : 'bg-gray-300 text-gray-800' ?>">
                <?= $cat ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="flex flex-col items-center p-4">
                <img src="<?= $row['image_url'] ?>" alt="<?= $row['name'] ?>" class="w-28 h-28 object-contain mb-4">
                <h3 class="text-lg font-bold text-gray-800"><?= $row['name'] ?></h3>
                <p class="text-sm text-gray-600 text-center"><?= $row['description'] ?></p>
                <form method="POST" action="borrow.php" class="mt-4">
                    <input type="hidden" name="equipment_id" value="<?= $row['id'] ?>">
                    <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-700">Borrow</button>
                </form>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</main>

</body>
</html>
