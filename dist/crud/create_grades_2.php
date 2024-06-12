<?php
include '/xampp/htdocs/dash/connection/conn.php';
include '/xampp/htdocs/dash/connection/db_connection.php';

if(isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $user = $dataObj->selectUserById($id);
}else {
    header("Location:/login.php");
}

$insert = $dataObj->getSingleDataCreateOrchid();
$dataObj->addGradesOrchid();


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

<body class="bg-gray-100 font-sans">
<form  method="POST" action="create_grades_2.php" id="myForm">
    <div class="max-w-2xl mx-auto bg-teal-200 p-6 rounded-md shadow-md mt-8">

        <h1 class="text-4xl font-extrabold text-center mb-6">Create Student Grades</h1>
        <h2 class="text-lg font-bold mb-2">Student Details</h2>
        <!-- Student Details Grid -->
        <div class="student_d grid grid-cols-1 border-collapse md:grid-cols-2 border-black mb-4 border-2">
            <div class="f_name border-b-2 border-r-2 p-2 border-black">
                <p class="font-semibold"><span class="font-bold">Name:</span> <?php echo $insert['Fullname'];?></p>
            </div>
            <div class="st_id border-b-2 p-2 border-black">
                <p class="font-semibold"><span class="font-bold">Student Id:</span> <?php echo $insert['ID'];?></p>
            </div>
            <div class="grade border-r-2 p-2 border-black">
                <p class="font-semibold"><span class="font-bold">Section:</span> <?php echo $insert['Section'];?></p>
            </div>
            <div class="f_name p-2">
                <p class="font-semibold"><span class="font-bold">Teacher:</span> <?php echo $insert['Teacher'];?></p>
            </div>
        </div>

        <!-- Insert Grades Table -->
        
        <div>
            <h2 class="text-lg font-bold mb-2">Grades</h2>
                <table class="w-full border-collapse  mb-2">
                    <thead>
                        <tr class="thead bg-slate-900 text-white">
                            <th class="py-2 px-4 border-b-2 border-l-2 border-t-2 border-slate-900">Subject</th>
                            <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q1</th>
                            <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q2</th>
                            <th class="py-2 px-4 border-b-2 border-t-2 border-slate-900">Q3</th>
                            <th class="py-2 px-4 border-b-2 border-r-2 border-t-2 border-slate-900">Q4</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>
                            
                            <td class="py-2 px-2 border-2 border-slate-900 text-center">
                                <input type="hidden" name="student_id" value="<?php echo $insert['ID']; ?>">
                                <select name="subs" class="w-full p-2 border border-slate-900 rounded font-bold" style="background-color: #e2f0cb; color: #3b3b3b;">
                                    <option value="Subjects" selected>Subjects</option>
                                    <option value="English">English</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Science">Science</option>
                                    <option value="Mother tongue">Mother Tongue</option>
                                    <option value="Filipino">Filipino</option>
                                    <option value="AP">AP</option>
                                    <option value="ESP">ESP</option>
                                    <option value="MAPEH">MAPEH</option>
                                </select>
                            </td>
                            <td class="py-2 px-4 border-2 border-slate-900 text-center">
                                <input type="text" name="first" placeholder="Q1" class="w-full p-2 border border-slate-900 rounded text-center" style="background-color: #ffe6e6; color: #3b3b3b;">
                            </td>
                            <td class="py-2 px-4 border-2 border-slate-900 text-center">
                                <input type="text" name="second" placeholder="Q2" class="w-full p-2 border border-slate-900 rounded text-center" style="background-color: #ffd699; color: #3b3b3b;">
                            </td>
                            <td class="py-2 px-4 border-2 border-slate-900 text-center">
                                <input type="text" name="third" placeholder="Q3" class="w-full p-2 border border-slate-900 rounded text-center" style="background-color: #ccffcc; color: #3b3b3b;">
                            </td>
                            <td class="py-2 px-4 border-2 border-slate-900 text-center">
                                <input type="text" name="fourth" placeholder="Q4" class="w-full p-2 border border-slate-900 rounded text-center" style="background-color: #b3e0ff; color: #3b3b3b;">
                            </td>
                        </tr>
                    </tbody>

                
                </table>
               
        </div>          
    </div>
    
        <!-- Action Buttons --> 
        <?php 
            $personalId = isset($_GET['insertId']) ? $_GET['insertId'] : null;
        ?>
        <div class="flex flex-col md:flex-row mt-4 ml-[365px] mb-4">
        <button type="submit" name="add_grade" class="cursor-pointer bg-purple-500 text-white mx-2 py-2 px-4 rounded-md hover:bg-purple-600 mb-2 md:mb-0">Save</button>
            <a href="../grades/grades_2.php?viewGrades=<?php echo $personalId; ?>" class="cursor-pointer bg-indigo-500 text-white mx-2 py-2 px-4 rounded-md hover:bg-indigo-700 mb-2 md:mb-0">Back</a>
        </div>
    </form>
</body>
<script src="/dash/js/index.js"></script>

</html>
