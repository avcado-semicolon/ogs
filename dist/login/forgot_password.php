<?php
include '/xampp/htdocs/dash/connection/conn.php';
include '/xampp/htdocs/dash/connection/db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="" />
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

        <form action="forget_action.php" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="Name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="f_name" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <input type="submit" name="confirm" value="Confirm" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
        </form>

        <p class="mt-4 text-sm text-gray-600">Remember your password? <a href="../../login.php" class="text-blue-500">Login here</a>.</p>
    </div>

</body>
</html>
