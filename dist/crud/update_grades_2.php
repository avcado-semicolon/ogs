<?php
include '/xampp/htdocs/dash/connection/conn.php';
include '/xampp/htdocs/dash/connection/db_connection.php';

if(isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $dataObj->selectUserById($id);
}else {
    header("Location:/login.php");
}
 

// $rs = $dataObj->displayGradingbydata();
$dataObj->updateGradesDataOrchid($_POST);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report Card</title>
    <link rel="stylesheet" href="../output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <style>
        h1 {
            font-family: 'Bungee', sans-serif; /* Add this line to set the font family */
        } 
    </style>
</head>

<body class="bg-gray-200 font-sans">
    <form action="update_grades_2.php" method="POST">
        <div class=" max-w-2xl mx-auto bg-amber-50 p-6 rounded-md shadow-md mt-8">
            <h1 class="text-4xl font-extrabold text-center mb-6">Update Student Grades</h1>
            <!-- Grades Table -->
            <div>
                <h2 class="text-lg font-bold mb-2">Grades</h2>
                <table class="w-full border-collapse  mb-2">
                    <thead>
                        <tr class="thead bg-slate-900 text-white">
                            <th class="hidden py-2 px-4 border-b-2 border-l-2 border-t-2 border-slate-900">ID</th>
                            <th class="py-2 px-4 border-b-2 border-l-2 border-t-2 border-slate-900">Subject</th>
                            <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q1</th>
                            <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q2</th>
                            <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q3</th>
                            <th class="py-2 px-4 border-b-2  border-r-2 border-t-2 border-slate-900">Q4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php 
                            // $urlId = isset($_POST['updateId']) ? $_POST['updateId'] : null;

                            // $queryStudentDetails =  mysqli_query($conn,"SELECT ID, Subject, student_id, 1st_Grading, 2nd_Grading, 3rd_Grading, 4th_Grading FROM grading_system  WHERE student_id = '$urlId'");

                            // if (mysqli_num_rows($queryStudentDetails) > 0) {
                            //     while($rs = mysqli_fetch_array($queryStudentDetails)){
                            
                        ?> -->
                        
                        <?php 
                        //edit record
                        if(isset($_GET['updateId']) && !empty($_GET['updateId'])){
                            $editId = $_GET['updateId'];//$_GET collect data submitted in a FORM
                            $rs = $dataObj->displayGradingByDataOrchid($editId);//
                        }
                        ?>
                        <tr> 
                        <td class="hidden py-2 px-2 border-2 border-slate-900 text-center">
                            <input type="hidden" name="ID" value="<?php echo $rs['ID']; ?>" class="w-full p-2 border border-slate-900 rounded text-center" style="background-color: #ffe6e6; color: #3b3b3b;">
                            <input type="hidden" name="student_id" value="<?php echo $rs['student_id']; ?>">
                        </td>
                        <td class="py-2 px-2 border-2 border-slate-900 text-center">
                            <p><?php echo $rs['Subject']; ?></p>
                        </td>
                        <td class="py-2 px-4 border-2 border-slate-900 text-center">
                            <input type="text" name="first" placeholder="Q1" value="<?php echo $rs['1st_Grading']; ?>" class="w-full p-2 border border-slate-900 rounded text-center" style="background-color: #ffe6e6; color: #3b3b3b;">
                        </td>
                        <td class="py-2 px-4 border-2 border-slate-900 text-center">
                            <input type="text" name="second" placeholder="Q2" value="<?php echo $rs['2nd_Grading']; ?>" class="w-full p-2 border border-slate-900 rounded text-center" style="background-color: #ffd699; color: #3b3b3b;">
                        </td>
                        <td class="py-2 px-4 border-2 border-slate-900 text-center">
                            <input type="text" name="third" placeholder="Q3" value="<?php echo $rs['3rd_Grading']; ?>" class="w-full p-2 border border-slate-900 rounded text-center" style="background-color: #ccffcc; color: #3b3b3b;">
                        </td>
                        <td class="py-2 px-4 border-2 border-slate-900 text-center">
                            <input type="text" name="fourth" placeholder="Q4" value="<?php echo $rs['4th_Grading']; ?>" class="w-full p-2 border border-slate-900 rounded text-center" style="background-color: #b3e0ff; color: #3b3b3b;">
                        </td>
                        </tr>
                        <!-- <?php   
                            //     }
                            // } else {
                            //     // No records found
                            //     echo '<tr><td colspan="5" class="py-2 px-4 text-center">No records found</td></tr>';
                            // }
                        ?> -->
                    </tbody>
                </table>
            </div>          
        </div>
            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row mt-4 ml-[364px] mb-4">
                <button name="update_grade" class="bg-purple-500 text-white mx-2 py-2 px-4 rounded-md hover:bg-purple-600 mb-2 md:mb-0">Update</button>
            </div> 
    </form>
            <div class=" -mt-14 ml-[460px] mb-4">
                <button class="bg-indigo-500 text-white mx-2 py-2 px-4 rounded-md hover:bg-indigo-700 mb-2 md:mb-0" onClick="window.location.replace('../orchid_profile.php');">Back</button>
            </div>
    
    
</body>

<script src="/dash/js/index.js"></script>
</html>
