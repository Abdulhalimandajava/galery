
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <style>
       body {
              font-family: Arial, Helvetica, sans-serif;
              margin: 0;
              padding: 0;
              background-color: #f0f0f0;
}
.container {
              max-width: 400px;
              margin: 50px auto;
              padding: 20px;
              background-color: #fff;
              border-radius: 8px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
              text-align: center;
              margin-bottom: 20px;

}

input[type="text"],
input[type="email"],
input[type="password"]{
              width: calc(100% - 20px);
              padding: 10px;
              margin: 8px 0;
              border: 1px solid #ccc;
              border-radius: 4px;
              box-sizing: border-box;
}

input[type="submit"] {
              width: 100%;
              background-color: green;
              color: white;
              padding: 14px 20px;
              margin: 10px 0;
              border: none;
              border-radius: 4px;
              cursor: pointer;
}

input[type="submit"]:hover {
              background-color: green;

}

.signin-link {
              text-align: center;
}

.signin-link a {
              color: #dd2f6e;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="config/aksi_login.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <label for="password">password</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="login">
        </form>
        <div class="signin-link">
            <p>you don't have an acount?<a href="register.php">Sign Up</a></p>
        </div>
    </div>
</body>
</html>