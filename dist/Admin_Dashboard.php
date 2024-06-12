<?php 
include '/xampp/htdocs/dash/connection/conn.php';
include '../connection/db_connection.php';

//include the name
if(isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $user = $dataObj->selectUserById($id);
}
else {
    header("Location:../login.php");
}



?>

<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../image/logotab.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@700&display=swap" rel="stylesheet">
    <link href="output.css" rel="stylesheet">
    <title>Administrator Dashboard</title>
</head>
    <style>
        h3 {
            font-family: 'Kanit', sans-serif; /* Add this line to set the font family */
        }
    </style>
<body>
    <div>
    <script src="../js/alpine.min.js"></script>

    <!-- close navigation bar -->
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
            
            <!-- navigation logo -->
            <div class="flex items-center justify-center my-10"> 
                <img class="w-[110px] rounded-full" src="/dash/dist/upload_img/<?php echo $user['image']; ?>">
            </div>
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <span class="mx-2 text-2xl font-semibold text-white"><?php echo $user['Fullname'];?></span>
                </div>
            </div>
            <!-- end navigation logo -->

            <!-- navigation option -->
            <nav class="mt-10">
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25" href="./Admin_Dashboard.php">
                    <img src="./img/dashboard.png" class="w-6 h-6">

                    <span class="mx-3">Dashboard</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="./tulip_profile.php">
                   <img src="./img/student.png" class="w-6 h-6">

                    <span class="mx-3">Tulips Profiles</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="./orchid_profile.php">
                   <img src="./img/orchid.png" class="w-6 h-6">

                    <span class="mx-3">Orchids Profiles</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="./teacher_profile.php">
                    <img src="./img/teacher.png" class="w-6 h-6">
                    <span class="mx-3">Teacher Profiles</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="./user_approval.php">
                    <img src="./img/user_account.png" class="w-6 h-6">
                    <span class="mx-3">User Accounts</span>
                </a>

            </nav>
            <!-- end navigation option -->

        </div>
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
                <div class="flex items-center">
                    <!-- unknown -->
                    <button @click="sidebarOpen = true" class="text-gray-500  focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
    
                <div class="flex items-center">
                    <!-- PROFILEEEEEEEEEEEEE DROPDOWN-->
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = ! dropdownOpen" class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
                            <img src="/dash/dist/upload_img/<?php echo $user['image']; ?>">  
                        </button>
    
                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full" style="display: none;">
                        </div>
    
                        <div x-show="dropdownOpen" class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl" style="display: none;">
                            <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                            <a href="/dash/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- DASHBOARD -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto ">
                <div class="container px-6 py-8 mx-auto">
                    <h3 class="text-3xl font-medium text-neutral-900">Administrator Dashboard</h3>
                    <div class="mt-4 bg-gradient-to-r from-pink-300 via-purple-300 to-blue-300 p-5 rounded-lg">
                        <div class="flex flex-wrap -mx-6">

                            <!-- #1 -->
                            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-3">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-pink-400 bg-opacity-75 rounded-full">
                                        <img src="./img/child.png" class="w-9">
                                    </div>

                                    <div class="mx-5">
                                        <p class="text-lg font-semibold text-gray-700">
                                            <?php 
                                                $query = "SELECT ID FROM studentdata ORDER BY ID";
                                                $result = mysqli_query($conn, $query);
                                                $row = mysqli_num_rows($result);
                                                echo '<h1 class="text-3xl font-bold text-center">'.$row.'</h1>';
                                            ?>
                                        </p>
                                        <div class="text-gray-500 text-left font-normal">Total Student in Tulip</div>
                                    </div>
                                </div>
                            </div>

                            <!-- #2 -->
                            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-3">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-yellow-400 bg-opacity-75 rounded-full">
                                        <img src="./img/grade.png" class="w-9">
                                    </div>

                                    <div class="mx-5">
                                        <p class="text-2xl font-semibold text-gray-700">
                                            <?php   
                                                $query = "SELECT ID FROM studentdata2 ORDER BY ID";
                                                $result = mysqli_query($conn, $query);
                                                $row = mysqli_num_rows($result);
                                                echo '<h1 class="text-3xl font-bold text-center">'.$row.'</h1>';
                                            ?>
                                        </p>
                                        <div class="text-gray-500 text-left font-normal">Total Student in Orchid</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- #3 -->
                            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-3">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-blue-500 bg-opacity-75 rounded-full">
                                        <img src="./img/pending_ac.png" class="w-9">
                                    </div>

                                    <div class="mx-5">
                                        <p class="text-2xl font-semibold text-gray-700">
                                            <?php 
                                                $query = "SELECT Status FROM users WHERE Status = 'pending'";
                                                $result = mysqli_query($conn, $query);
                                                $row = mysqli_num_rows($result);
                                                echo '<h1 class="text-3xl font-bold text-center">'.$row.'</h1>';
                                            ?>
                                        </p>
                                        <div class="text-gray-500 text-left font-normal">Pending Accounts</div>
                                    </div>
                                </div>
                            </div>

                            <!-- #4 -->
                            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-3">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-green-400 bg-opacity-75 rounded-full">
                                        <img src="./img/approved.png" class="w-9">
                                    </div>

                                    <div class="mx-5">
                                        <p class="text-2xl font-semibold text-gray-700">
                                            <?php
                                                $query = "SELECT Status FROM users WHERE Status = 'approved'";
                                                $result = mysqli_query($conn, $query);
                                                $row = mysqli_num_rows($result);
                                                echo '<h1 class="text-3xl font-bold text-center">'.$row.'</h1>';
                                            ?>
                                        </p>
                                        <div class="text-gray-500 text-left font-normal">Approved Accounts</div>
                                    </div>
                                </div>
                            </div>

                            <!-- #5 -->
                            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-3">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-cyan-400 bg-opacity-75 rounded-full">
                                        <img src="./img/1.png" class="w-9">
                                    </div>

                                    <div class="mx-5">
                                        <p class="text-2xl font-semibold text-gray-700">
                                            <?php
                                                $query = "SELECT Status FROM grading_system WHERE Status = 'pending'";
                                                $result = mysqli_query($conn, $query);
                                                $row = mysqli_num_rows($result);
                                                echo '<h1 class="text-3xl font-bold text-center">'.$row.'</h1>';
                                            ?>
                                        </p>
                                        <div class="text-gray-500 font-normal text-center">Pending Grades</div>
                                    </div>
                                </div>
                            </div>

                            <!-- #6 -->
                            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-3">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-orange-400 bg-opacity-75 rounded-full">
                                        <img src="./img/2.png" class="w-9">  
                                    </div>

                                    <div class="mx-5">
                                        <p class="text-2xl font-semibold text-gray-700">
                                            <?php
                                                $query = "SELECT Status FROM grading_system WHERE Status = 'pending'";
                                                $result = mysqli_query($conn, $query);
                                                $row = mysqli_num_rows($result);
                                                echo '<h1 class="text-3xl font-bold text-center">'.$row.'</h1>';
                                            ?>
                                        </p>
                                        <div class="text-gray-500 text-center font-normal"> Pending Grades</div>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF BOXES -->
                        </div>
                    </div>
                </div>
                    <!-- pie -->
                    <div class="container px-8 py-10 mx-auto">
                        <h3 class="text-3xl font-semibold ">Pie Charts</h3>
                        <div class="mt-8 h-[440px] bg-gradient-to-br from-pink-200 via-purple-200 to-blue-200 p-10 rounded-lg sm:overflow-auto sm:overflow-y-hidden">
                            <div class="flex flex-wrap -mx-8">
                                <div class="w-full sm:w-1/2 px-8">
                                    <div id="piechart" class="w-[500px] h-[350]"></div>
                                </div>
                                <div class="w-full sm:w-1/2 px-8">
                                    <div id="piechart2" class="w-[500px] h-[350]"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
    </div>
</div>


</body>
</html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Check screen width and execute code if it's greater than or equal to 640px

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Gender', 'Number'],
                <?php 
                    $result = "SELECT Gender, Count(*) as number FROM studentdata Group by Gender";
                    $rs = mysqli_query($conn, $result);
                    while($data = mysqli_fetch_array($rs)){
                        echo "['".$data['Gender']."',".$data['number']."],";
                    }
                ?>
            ]);

            var options = {
                title: 'Gender Pie Chart Analysis in Tulip',
                titleTextStyle: {
                    color: "#333",
                    fontName: "Arial",
                    fontSize: 20,
                    bold: true,
                },
                pieSliceText: 'value',
                pieSliceTextStyle: {
                    color: 'white',
                    fontSize: 14,
                },
                is3D: true,
                backgroundColor: 'transparent',
                colors: ['#FFC0CB', '#E6E6FA', '#ADD8E6'],
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Gender', 'Number'],
                <?php 
                    $result = "SELECT Gender, Count(*) as number FROM studentdata2 Group by Gender";
                    $rs = mysqli_query($conn, $result);
                    while($data = mysqli_fetch_array($rs)){
                        echo "['".$data['Gender']."',".$data['number']."],";
                    }
                ?>
            ]);

            var options = {
                title: 'Gender Pie Chart Analysis in Orchid',
                titleTextStyle: {
                    color: "#333",
                    fontName: "Arial",
                    fontSize: 20,
                    bold: true,
                },
                pieSliceText: 'value',
                pieSliceTextStyle: {
                    color: 'white',
                    fontSize: 14,
                },
                is3D: true,
                backgroundColor: 'transparent',
                colors: ['#FFC0CB', '#E6E6FA', '#ADD8E6'],
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

            chart.draw(data, options);
        }
    
</script>