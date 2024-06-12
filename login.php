<?php 
include 'connection/db_connection.php';
$dataObj->login();
$dataObj->register();

include './dist/sweetalert/sweetalert_message.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome/all.min.css">
    <link rel="stylesheet" href="font-awesome/fontawesome.min.css">
    <script src="/dist/grades/jquery-3.7.1.min.js"></script>
    <script src="/dist/grades/sweetalert2.all.min.js"></script>
    <script src="/sweetalert2.all.js"></script>
    <link rel="icon" type="image/x-icon" href="./image/logotab.png">
    <link rel="stylesheet" href="cssone/login.css">
    <title>Sign in | Sign up</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post" enctype="multipart/form-data">
                <h1>Create Account</h1>
                <input type="text" placeholder="Name" name="fullname" required>
                <input type="file" name="images" accept="image/png, image/jpg, image/jpeg" class="box" required>
                <select name="role" required>
                    <option value="----" selected>----</option>
                    <option value="administrator">Administrator</option>
                    <option value="Teacher">Teacher</option>
                </select> 
                <input type="email" name="username" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
                <button type="submit" name="btnregister">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="login.php" method="post">
                <h1>Sign In</h1>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>

                    <div class="content">
                        <div class="pass-link">
                            <a href="./dist/login/forgot_password.php" class="forget-pass">Forgot password?</a>
                        </div>
                    </div>
                <button type="submit" name="btnlogin" >Sign in</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
</body>

</html>