<?php
include '/xampp/htdocs/dash/connection/conn.php';
include '/xampp/htdocs/dash/connection/db_connection.php';

if (isset($_POST['submit'])) {
    // Get user input
    $username = $_SESSION['Username'];
    $password = (md5($_POST['new_pass']));
    $cpassword = $_POST['confirm_pass'];

    if (isset($_POST['confirm_pass']) && $_POST['confirm_pass'] !== $_POST['new_pass']) {
        echo "<script>
                Swal.fire({
                    title: 'Oopss..!',
                    text: 'Passwords don't match!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        exit();
    } else {

    // Update the password for admin_log
    $updatePassword = "UPDATE users SET Password = '$password' WHERE Username = '$username'";
    mysqli_query($conn, $updatePassword);

    // Redirect to a success page or show a success message
        echo "<script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Change Password Successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '/dash/login.php';
                    });
                </script>";
            exit();
    // echo "<script>alert('Change Password Successfully!');
    // window.location.assign('/dash/login.php')
    // </script>";
    // exit();
}
}


?>
<a href=""></a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link rel="stylesheet" href="../output.css">
    <title>Forgot Password</title>
    <style>
        /* Custom style for white shadow */
        .white-shadow {
            box-shadow: 0 4px 6px -1px rgb(255, 255, 255), 0 2px 4px -1px rgb(255, 255, 255);
        }
    </style>
</head>
<body class="bg-gray-900 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded shadow-md w-96 white-shadow">
        <div class="flex items-center justify-center mb-6">
            <img src="../img/lock.png" alt="Padlock" class="w-32">
        </div>
        <div class="flex items-center justify-center mb-6">
            <h1 class="text-2xl font-semibold">Forgot Password</h1>
        </div>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                <input type="Password" name="new_pass" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" name="confirm_pass" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>

            <?php if ($_POST && ($_POST['new_pass'] !== $_POST['confirm_pass'])): ?>
                <span id="password-mismatch" style="color: red;">Passwords don't match!</span>
             <?php endif; ?>

            <input type="submit" name="submit"  value="Confirm Change" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
        
        </form>
    </div>

</body>
</html>
<script src="/dist/grades/jquery-3.7.1.min.js"></script>
<script src="/dist/grades/sweetalert2.all.min.js"></script>
