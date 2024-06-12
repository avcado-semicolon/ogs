<?php
include '/xampp/htdocs/dash/connection/conn.php';
include '/xampp/htdocs/dash/connection/db_connection.php';

if (isset($_POST['username']) && isset($_POST['f_name'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $idnum = validate($_POST['username']);
    $email = validate($_POST['f_name']);

    if (empty($idnum) || empty($email)) {
        echo "<script>
                Swal.fire({
                    title: 'Oopss..!',
                    text: 'Each field must be filled out!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = '/dist/login/forgot_password.php';
                });
            </script>";
        exit();
    } else {
        // Using prepared statement to prevent SQL injection
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE Username = ? AND Fullname = ?");
        mysqli_stmt_bind_param($stmt, "ss", $idnum, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['Fullname'] = $row['Fullname'];
            $_SESSION['Username'] = $row['Username'];
            header("Location: change_password.php");
            

        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Oopss..!',
                        text: 'Username and Name does not match!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = 'forgot_password.php';
                    });
                </script>";
            exit();
        }
    }
}
?>
<script src="/dist/grades/jquery-3.7.1.min.js"></script>
<script src="/dist/grades/sweetalert2.all.min.js"></script>