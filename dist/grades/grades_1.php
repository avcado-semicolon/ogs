<?php
include '/xampp/htdocs/dash/connection/conn.php';
include '/xampp/htdocs/dash/connection/db_connection.php';

// Add this check after retrieving the user ID
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    // Assuming you have a function to get the user role based on the user ID
    $user = $dataObj->selectUserById($id);
      // Check the user's role
      $isAdmin = ($user['access'] == 'administrator');

} else {
    header("Location:/login.php");
}



// Assuming the user's role is stored in the session as 'role'
$userRole = isset($_SESSION['access']) ? $_SESSION['access'] : '';


if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $viewGrades = isset($_GET['viewGrades']) ? $_GET['viewGrades'] : null;
    $dataObj->deleteGradesTulip($deleteId, $viewGrades);
}



$insert = $dataObj->getSingleDataTulip();

include '/xampp/htdocs/dash/dist/sweetalert/sweetalert_message.php';
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
    <style>
        h1 {
            font-family: 'Bungee', sans-serif; /* Add this line to set the font family */
        }
        @media print {
            .f_name{
                border: 1px  solid #000;
            }
            .grade{
                border: 1px  solid #000;
            }
            .student_d{ 
                border: 1px  solid #000;
            }
            .st_id{
                border: 1px  solid #000;
            }
            
            body {
                background-color: white; /* Set a white background for printing */
            }
            
            button{
                display: none;
            }
            h1 {
                font-size: 24px; /* Adjust font size for printing */
            }
            .thead{
                color: #000;
            }
            .ID{
                display: none;
            }
            .status{
                display: none;
            }
            .action{
                display: none;
            }
            .remarks{
                border-right: 2px  solid #000 ;
            }
            
        /* Additional styles for printing... */

        /* Hide action buttons for printing */
        .flex.flex-col.md\:flex-row.mt-4 {
            display: none;
        }
    }
    </style>
</head>

<body class="bg-gray-200 font-sans">

    <div class=" max-w-[750px] mx-auto bg-amber-50 p-6 rounded-md shadow-md mt-8">

        <h1 class="text-4xl font-extrabold text-center mb-6">Student Report Card</h1>
        <h2 class="text-lg font-bold mb-2">Student Details</h2>
        <?php 
            $personalId = isset($_GET['viewGrades']) ? $_GET['viewGrades'] : null;
            
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
                        <th class="ID hidden py-2 px-4 border-b-2 border-l-2 border-t-2 border-slate-900">ID</th>
                        <th class="py-2 px-4 border-b-2 border-l-2 border-t-2 border-slate-900">Subject</th>
                        <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q1</th>
                        <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q2</th>
                        <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q3</th>
                        <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q4</th>
                        <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Average</th>
                        <th class="remarks py-2 px-4 border-b-2 border-t-2 border-slate-900">Remarks</th>
                        <th class="status py-2 px-4 border-b-2 border-r-2 border-t-2 border-slate-900">Status</th>
                        <th class="action py-2 px-4 border-b-2 border-r-2 border-t-2 border-slate-900">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $studentId = isset($_GET['viewGrades']) ? $_GET['viewGrades'] : null;

                        $query = "SELECT t1.ID, t1.student_id, t1.Subject, t1.1st_Grading, t1.2nd_Grading, t1.3rd_Grading, t1.4th_Grading, t1.Status, t1.Average , t2.Fullname, t1.Status,
                        ROUND(AVG(Average)),
                        CASE 
                            WHEN AVG(Average) < 75 THEN 'Failed'
                            ELSE 'Passed'
                        END as Remarks
        
                        FROM grading_system t1 
                        LEFT JOIN studentdata t2 ON t1.student_id = t2.ID 
                        WHERE t1.student_id = $studentId
                        GROUP BY t1.ID,  t1.student_id";
        
                        $result = mysqli_query($conn, $query);
                        
                        if (mysqli_num_rows($result) > 0) { 
                            $gwa = 0; 
                            while($row = mysqli_fetch_array($result)){ 
                            $remarks = $row["Remarks"];
                            $color = ($remarks == 'Failed') ? 'red' : 'green';
                                
                            // Update GWA for each row
                            $gwa += $row['Average'];
                            
                            
                            // Calculate the final GWA outside the loop
                            $finalGWA = $gwa / mysqli_num_rows($result);  
                            
                            $overallRemarks = ($finalGWA >= 75) ? 'Passed' : 'Failed';
                    ?>
                    <tr>
                        <td class="ID hidden py-2 px-3 border-2 border-slate-900 font-semibold"><?php echo $row['ID'];?></td>
                        <td class="py-2 px-3 border-2 border-slate-900 font-semibold"><?php echo $row['Subject'];?></td>
                        <td class="py-2 px-3 border-2 border-slate-900"><?php echo $row['1st_Grading'];?></td>
                        <td class="py-2 px-3 border-2 border-slate-900"><?php echo $row['2nd_Grading'];?></td>
                        <td class="py-2 px-3 border-2 border-slate-900"><?php echo $row['3rd_Grading'];?></td>
                        <td class="py-2 px-3 border-2 border-slate-900"><?php echo $row['4th_Grading'];?></td>
                        <td class="py-2 px-3 border-2 border-slate-900 text-center"><?php echo number_format($row['Average'], 0);?></td>
                        <td class="py-2 px-3 border-2 border-slate-900 text-center" style="background-color: <?=$color?>"><?php echo $remarks ?></td>
                        <td class="status py-2 px-3 border-2 border-slate-900 text-center"><?php echo $row['Status'];?></td>
                        <td class="action py-2 px-3 border-2 border-slate-900 text-center">
                            

                            <?php
                                $isStatusPending = ($row['Status'] == 'pending' || $row['Status'] == 'denied');
                                $editLink = "../crud/update_grades.php?updateId={$row['ID']}";

                                // Check if the user is an administrator
                                if ($isAdmin) {
                                    echo '<a href="' . $editLink . '" class="cursor-pointer ml-2 lg:ml-0">';
                                    echo '<img src="../img/edit.png" class="inline-block w-6">';
                                    echo '</a>';
                                } else {
                                        if ($isStatusPending) {
                                            // If the status is pending or denied, don't disable the edit button
                                            echo '<a href="' . $editLink . '" class="cursor-pointer ml-2 lg:ml-0">';
                                            echo '<img src="../img/edit.png" class="inline-block w-6">';
                                            echo '</a>';
                                        } else {
                                            // If the status is not pending or denied,  disable the edit button   
                                            echo '<a href="' . $editLink . '" class="cursor-not-allowed ml-2 lg:ml-0">';
                                            echo '<img src="../img/edit.png" class="inline-block w-6">';
                                            echo '</a>';
                                           
                                        }
                                }
                                ?>
                            <a href="grades_1.php?deleteId=<?php echo $row['ID'];?>&viewGrades=<?php echo $studentId;?>" class="delete cursor-pointer ml-2 lg:ml-0">
                                <img src="../img/delete.png" class=" inline-block w-6">
                            </a>
                        </td>
                    </tr>
                </tbody>
                
                <?php 
                        }
                    } else {
                        // No records found
                        echo '<tr><td colspan="9" class="py-2 px-4 text-center">No records found</td></tr>';
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
            </table>
        </div>          
    </div>
    
        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row mt-4 ml-[325px] mb-4">
            <?php
                if ($isAdmin) {
                    echo '<a href="../crud/create_grades.php?insertId=' . $insert['ID'] . '" class="hidden bg-blue-500 text-white mx-2 py-2 px-4 rounded-md hover:bg-blue-600 mb-2 md:mb-0">Insert</a>';
                }else{
                    echo '<a href="../crud/create_grades.php?insertId=' . $insert['ID'] . '" class="bg-blue-500 text-white mx-2 py-2 px-4 rounded-md hover:bg-blue-600 mb-2 md:mb-0">Insert</a>';
                }
            ?>
 
            <?php
                if ($isAdmin) {
                    
                    if (!empty($insert) && isset($insert['student_id'])) {
                        // Check if there are pending grades for approval
                        $pendingQuery = "SELECT COUNT(*) as pendingCount FROM grading_system WHERE student_id = {$insert['student_id']} AND status = 'pending'";
                    
                        $pendingResult = mysqli_query($conn, $pendingQuery);
                    
                        if ($pendingResult) {
                            $pendingRow = mysqli_fetch_assoc($pendingResult);
                            $pendingCount = $pendingRow['pendingCount'];
                    
                            // Render the "Approval" button with or without a link based on pending grades
                            if ($pendingCount > 0) {
                                echo '<a href="tulip_approval.php?approvalId=' . $insert['student_id'] . '" class="bg-purple-500 text-white mx-2 py-2 px-4 rounded-md hover:bg-purple-600 mb-2 md:mb-0">Approval</a>';
                            } else {
                                echo '<span class="bg-gray-500 text-white mx-2 py-2 px-4 rounded-md mb-2 md:mb-0 cursor-not-allowed opacity-50">No Pending Approval</span>';
                            }
                        } else {
                            // Handle query error if needed
                            echo '<span class="bg-red-500 text-white mx-2 py-2 px-4 rounded-md mb-2 md:mb-0">Error querying the database</span>';
                        }
                    } else {
                        // Student grades is not available
                        echo '<span class="bg-yellow-500 text-white mx-2 py-2 px-4 rounded-md mb-2 md:mb-0">Student grades is not available</span>';
                    }
                }
            ?>

        <button class="bg-indigo-500 text-white mx-2 py-2 px-4 rounded-md hover:bg-indigo-700 mb-2 md:mb-0" onClick="window.location.replace('../tulip_profile.php');">Back</button>
        <button class="bg-green-500 text-white mx-2 py-2 px-4 rounded-md hover:bg-green-600" id="pdf">Print</button>
</div>
</body>


<script src="/dash/js/index.js"></script>
<script src="jquery-3.7.1.min.js"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-3.6.0.min.js"></script>

<script>
// #########start of alert for delete############
$('.delete').on('click',function(e) {
e.preventDefault();
const href = $(this).attr('href')

Swal.fire({
    title: 'Are you sure?',
    text: 'Record will be deleted!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
}).then((result) => {
    if(result.isConfirmed) {
    document.location.href = href;  
    }
})
})
// ############alert for delete##################
</script>
</html>
