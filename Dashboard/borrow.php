<?php
$conn = new mysqli("localhost", "root", "", "dacol");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipment_id = intval($_POST['equipment_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $student_id = $conn->real_escape_string($_POST['student_id']);
    $email = $conn->real_escape_string($_POST['email']);

    $stmt = $conn->prepare("INSERT INTO borrow_requests (equipment_id, name, student_id, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $equipment_id, $name, $student_id, $email);

    if ($stmt->execute()) {
        header("Location: borrow.php?submitted=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$equipment_id = isset($_GET['equipment_id']) ? intval($_GET['equipment_id']) : 0;
$show_confirmation = isset($_GET['submitted']) && $_GET['submitted'] == 1;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Borrow Equipment</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body.borrow-page {
            background: url('bgrnd.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        body.borrow-page::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(255, 255, 255, 0.5);
            z-index: 1;
        }

        .borrow-form-container {
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.96);
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
            margin: auto;
        }

        .confirmation-message {
            background-color: #e0ffe0;
            border: 1px solid #2ecc71;
            color: #2e7d32;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .borrow-form-container h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .borrow-form-container label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        .borrow-form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .borrow-form-container button {
            width: 100%;
            background-color: #223080;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .borrow-form-container button:hover {
            background-color: #1a245c;
        }
    </style>
</head>
<body class="borrow-page">

<div class="borrow-form-container">
    <?php if ($show_confirmation): ?>
        <div class="confirmation-message">
            ✅ Your request is being processed. Please wait...
        </div>
    <?php endif; ?>

    <h2>Borrow Equipment</h2>
    <form method="POST" action="borrow.php">
        <input type="hidden" name="equipment_id" value="<?= htmlspecialchars($equipment_id) ?>">

        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <button type="submit">Submit Request</button>
    </form>
</div>

</body>
</html>
