<?php
// You can add your PHP logic here, for example, if you want to handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>
  <link rel="stylesheet" href="style.css"> <!-- External CSS file -->
</head>
<body>

  <!-- Background with overlay -->
  <div class="bg-overlay">
    <!-- Contact Form -->
    <div class="contact-form">
      <h2>Contact Us</h2>

      <form action="contact.php" method="POST">
        <div>
          <label for="name">Name</label>
          <input type="text" id="name" name="name" placeholder="Enter your name" required />
        </div>

        <div>
          <label for="surname">Surname</label>
          <input type="text" id="surname" name="surname" placeholder="Enter your surname" required />
        </div>

        <div>
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required />
        </div>

        <div>
          <label for="message">Message</label>
          <textarea id="message" name="message" placeholder="Your message" rows="4" required></textarea>
        </div>

        <button type="submit">Submit</button>
      </form>
    </div>
  </div>

</body>
</html>
