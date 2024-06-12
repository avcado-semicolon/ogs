<?php
include '/xampp/htdocs/dash/connection/conn.php';
include '/xampp/htdocs/dash/connection/db_connection.php';

if(isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $user = $dataObj->selectUserById($id);
}else {
    header("Location:/login.php");
}

//section 1
if(isset($_POST['approved'])){
   
    $personalId = isset($_GET['approvalId']) ? $_GET['approvalId'] : null;
    $id = $_POST['ID'];

    $update = "UPDATE grading_system SET status = 'approved' WHERE ID = '$id'";
    $result = mysqli_query($conn, $update);
        if($result == true){
            echo '<script>';
            echo 'Swal.fire({';
            echo '    title: "Approved!",';
            echo '    text: "Grades Approved!",';
            echo '    icon: "success",';
            echo '    showConfirmButton: false';
            echo '}).then(function() {';
            echo '    window.location.href = "tulip_approval.php?approvalId=' . $personalId . '";';
            echo '});';
            echo '</script>';
        }else{
            echo '<script>';
            echo 'Swal.fire({';
            echo '    title: "Error",';
            echo '    text: "Failed to approved!",';
            echo '    icon: "error",';
            echo '    showConfirmButton: false';
            echo '}).then(function() {';
            echo '    window.location.href = "tulip_approval.php?approvalId=' . $personalId . '";';
            echo '});';
            echo '</script>';
        }
}


if(isset($_POST['deny'])){
   
    $personalId = isset($_GET['approvalId']) ? $_GET['approvalId'] : null;
    $id = $_POST['ID'];
    $update = "UPDATE grading_system SET status = 'denied' WHERE ID = '$id'";
    $result = mysqli_query($conn, $update);

        if($result == true){
            echo '<script>';
            echo 'Swal.fire({';
            echo '    title: "Approved!",';
            echo '    text: "Grades Approved!",';
            echo '    icon: "success",';
            echo '    showConfirmButton: false';
            echo '}).then(function() {';
            echo '    window.location.href = "tulip_approval.php?approvalId=' . $personalId . '";';
            echo '});';
            echo '</script>';
        }else{
            echo '<script>';
            echo 'Swal.fire({';
            echo '    title: "Error",';
            echo '    text: "Failed to approved!",';
            echo '    icon: "error",';
            echo '    showConfirmButton: false';
            echo '}).then(function() {';
            echo '    window.location.href = "tulip_approval.php?approvalId=' . $personalId . '";';
            echo '});';
            echo '</script>';
        }
}
// end of section 1

?>
<a href=""></a>

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
    <script src="./jquery-3.7.1.min.js"></script>
    <script src="./sweetalert2.all.min.js"></script>
    <style>
        h1 {
            font-family: 'Bungee', sans-serif; /* Add this line to set the font family */
        }
    </style>
</head>

<body class="bg-gray-200 font-sans">
            <div class="max-w-[750px] mx-auto bg-amber-50 p-6 rounded-md shadow-md mt-8">
                <h1 class="text-4xl font-extrabold text-center mb-6">Approval of Student Grades</h1>
                <?php 
                $personalId = isset($_GET['approvalId']) ? $_GET['approvalId'] : null;
                
                $queryStudentDetails = "SELECT t1.ID, t1.Fullname, t1.Grade_level, t1.Teacher, t1.Section FROM studentdata t1 LEFT JOIN grading_system t2 ON t1.ID = t2.student_id WHERE t1.ID = $personalId";
                $resultStudentDetails = mysqli_query($conn, $queryStudentDetails);
                $studentDetails = mysqli_fetch_assoc($resultStudentDetails);
                
            ?>
            <!-- Student Details Grid -->
            <div class="student_d grid grid-cols-1 border-collapse md:grid-cols-2 border-black mb-4 border-2">
                <div class="f_name border-b-2 border-r-2 p-2 border-black">
                    <p class="font-semibold"><span class="font-bold">Name:</span> <?php echo $studentDetails['Fullname'];?></p>
                </div>
                <div class="st_id border-b-2 p-2 border-black">
                    <p class="font-semibold"><span class="font-bold">Student Id:</span> <?php echo $studentDetails['ID'];;?></p>
                </div>
                <div class="grade border-r-2 p-2 border-black">
                    <p class="font-semibold"><span class="font-bold">Section:</span> <?php echo $studentDetails['Section'];?></p>
                </div>
                <div class="f_name p-2">
                    <p class="font-semibold"><span class="font-bold">Teacher:</span> <?php echo $studentDetails['Teacher'];?></p>
                </div>
            </div>
            <!-- Grades Table -->
            <div>
                <h2 class="text-lg font-bold mb-2">Grades</h2>
                <table class="w-full border-collapse  mb-2">
                    <thead>
                        <tr class="thead bg-slate-900 text-white">
                        <th class="py-2 px-4 border-b-2 border-l-2 border-t-2 border-slate-900">Subject</th>
                            <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q1</th>
                            <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q2</th>
                            <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q3</th>
                            <th class="py-2 px-4 border-b-2  border-r-2 border-t-2 border-slate-900">Q4</th>
                            <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Average</th>
                            <th class="py-2 px-4 border-b-2  border-r-2 border-t-2 border-slate-900">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $urlId = isset($_GET['approvalId']) ? $_GET['approvalId'] : null;

                        $query = "SELECT t1.ID, t1.student_id, t1.Subject, t1.1st_Grading, t1.2nd_Grading, t1.3rd_Grading, t1.4th_Grading, t1.Status, t1.Average,
                            ROUND(t1.Average / 8) 
                        
                            FROM grading_system t1 
                            INNER JOIN studentdata t2 
                            ON t1.student_Id = t2.ID 
                            WHERE status = 'pending' AND t1.student_id = $urlId ORDER BY t1.student_id";
                        
                        $result = mysqli_query($conn, $query);
                        
                        if (mysqli_num_rows($result) > 0) {
                            $gwa = 0;
                            while($rs = mysqli_fetch_array($result)){
                                // Update GWA for each row
                                $gwa += $rs['Average'];
                                
                                // Calculate the final GWA outside the loop
                                $finalGWA = $gwa / mysqli_num_rows($result);  
                                $overallRemarks = ($finalGWA >= 75) ? 'Passed' : 'Failed';
                        ?>

                        <tr> 
                            <td class="py-2 px-2 border-2 border-slate-900 text-center">
                                <input type="hidden" name="student_id" value="<?php echo $rs['student_id']; ?>">
                                <?php echo $rs['Subject']; ?>
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
                            <td class="py-2 px-3 border-2 border-slate-900 text-center"><?php echo $rs['Average'];?></td>
                            <td class="py-2 px-4 border-2 border-slate-900 text-center">
                                <form action="tulip_approval.php?approvalId=<?php echo $rs['student_id']; ?>" method="POST" class="relative flex items-center">
                                    <input type="hidden" name="ID" value="<?php echo $rs['ID'];?>">
                                    <button type="submit"  name="approved" value="Approve"><img src="../img/checked.png" class="w-7"></button>
                                    <button type="submit" name="deny" value="Deny"><img src="../img/x.png" class="w-7"></button>
                                </form>
                            </td>
                        </tr>
                        <?php   
                                }
                            } else {
                                // No records found
                                echo '<tr><td colspan="7" class="py-2 px-4 text-center">No records found</td></tr>';
                            }
                        ?>
                         <?php if (mysqli_num_rows($result) > 0): ?>
                        <tr>
                            <td colspan="1" class="py-2 px-3"></td>
                            <td colspan="4" class="py-2 px-3 border-r-2 border-l-2 border-b-2 border-slate-900 font-semibold">General Average</td>
                            <td colspan="1"  class="py-2 px-3 border-r-2 border-b-2 text-center font-extrabold border-slate-900"><?php echo number_format($finalGWA, 0);  ?></td>
                            <td colspan="1"  class="py-2 px-3 border-r-2 border-b-2 text-center border-slate-900" style="background-color: <?php echo ($overallRemarks == 'Failed') ? 'red' : 'green'; ?>"><?php echo $overallRemarks; ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>          
        </div>
           
            <div class="flex flex-col md:flex-row mt-4 ml-[325px] mb-4">
                <?php 
                     $personalId = isset($_GET['approvalId']) ? $_GET['approvalId'] : null;
                ?>
                <button class="bg-indigo-500 text-white mx-2 py-2 px-4 rounded-md hover:bg-indigo-700 mb-2 md:mb-0" onClick="window.location.replace('grades_1.php?viewGrades=<?php echo $personalId; ?>');">Back</button>
            </div>
    
    
</body>

<script src="/dash/js/index.js"></script>
</html>
