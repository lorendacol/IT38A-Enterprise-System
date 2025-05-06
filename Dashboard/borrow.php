<?php
$conn = new mysqli("localhost", "root", "", "dacol");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipment_id = intval($_POST['equipment_id']);
    $stmt = $conn->prepare("INSERT INTO borrow_requests (equipment_id) VALUES (?)");
    $stmt->bind_param("i", $equipment_id);
    $stmt->execute();
    $stmt->close();
    header("Location: equipment.php?success=1");
    exit();
}
?>
