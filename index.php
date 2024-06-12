<?php 
include 'connection/db_connection.php';
$dataObj->login();
$dataObj->register();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>
  <link rel="stylesheet" href="font-awesome/all.min.css">
  <link rel="stylesheet" href="font-awesome/fontawesome.min.css">
  <link rel="icon" type="image/x-icon" href="/dash/image/logotab.png">
  <link rel="stylesheet" href="cssone/sign.css">
</head>
<body>
  <div class="container" id="container">

    <div class="form-container register-container">
      <form method="post" enctype="multipart/form-data">
        <h1>Register here</h1>
        <input type="text" placeholder="Name" name="fullname" required>
        <input type="file" name="images" accept="image/png, image/jpg, image/jpeg" class="box" required>
        <select name="role">
              <option value="----" selected>----</option>
              <option value="administrator">Administrator</option>
              <option value="Teacher">Teacher</option>
        </select> 
        <input type="email" name="username" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
        <button  type="submit" name="btnregister" >Register</button>
      </form>
    </div>

    <div class="form-container login-container">
      <form method="post">
        <h1>Login here</h1>
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="checkbox" id="checkbox">
            <label>Remember me</label>
          </div>
          <div class="pass-link">
            <a href="forgetpass.php">Forgot password?</a>
          </div>
        </div>
        <button type="submit" name="btnlogin">Login</button>
        <span>or use your account</span>
        <div class="social-container">
          <a href="#" class="social"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
          <a href="#" class="social"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1 class="title">Hello <br></h1>
          <p>if you have an account, login here</p>
          <button class="ghost" id="login">Login</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1 class="title">Start your <br> journey now</h1>
          <p>if you don't have an account yet, join us and start your journey.</p>
          <button class="ghost" id="register">Register</button>
        </div>
      </div>
    </div>

  </div>

  <script src="js/sign.js"></script>


</body>
</html>