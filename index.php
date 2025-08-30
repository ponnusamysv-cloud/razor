<?php

require('config.php');
session_start();

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Use a prepared statement to prevent SQL injection
  $stmt = $GLOBALS['con']->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if ($result->num_rows !== 0) {
    $_SESSION['user_name'] = $username;
      $_SESSION['user_id'] = $row['id'];
    echo "<script>window.location.href='menu/index.php'</script>";
  } else {
    echo "<script>alert('Username and Password is incorrect')</script>";
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SBS-AI</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: #555;
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    .form-group input:focus {
      border-color: #007BFF;
      outline: none;
    }

    .form-group input[type="submit"] {
      background-color: #007BFF;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .form-group input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <h2>Login</h2>
    <form method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="text" id="password" name="password" required>
      </div>

      <div class="form-group">
        <input type="submit" name="submit" value="Login">
      </div>
    </form>
  </div>
</body>

</html>