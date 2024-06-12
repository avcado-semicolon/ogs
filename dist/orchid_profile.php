<?php
//connection
include '../connection/conn.php';
include '../connection/db_connection.php';

$dataObj->insertDataOrchid();

$dataObj->updateOrchidDataById($_POST);

//##################include the name#######################
 //include image and name
if(isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $user = $dataObj->selectUserById($id);
}
else {
    header("Location:/login.php");
}
// ########end of fetching fname, id, pictures#############

// ####################delete record#######################
if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $dataObj->deleteOrchidProfileById($deleteId);

} 
// ####################end of delete record################

// ###################alert###############################
include '../dist/sweetalert/sweetalert_message.php'
// ##################alert################################
?>


<!doctype html>
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
    <title>Students Profile</title>
    <style>
        h3, h2 {
            font-family: 'Kanit', sans-serif; 
        }

    </style>
</head>
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
    
                <?php if ($user['access'] == 'administrator'): ?>
                    <!-- Display only for administrators -->
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
                    href="./Admin_Dashboard.php">
                        <img src="./img/dashboard.png" class="w-6 h-6">
                        <span class="mx-3">Dashboard</span>
                    </a>
                <?php elseif ($user['access'] == 'Teacher'): ?>
                    <!-- Display only for teachers -->
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
                    href="./Teacher_Dashboard.php">
                        <img src="./img/dashboard.png" class="w-6 h-6">
                        <span class="mx-3">Dashboard</span>
                    </a>
                <?php endif; ?>

                <?php if ($user['Fullname'] == 'Norie Redondo'): ?>
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="./tulip_profile.php">
                        <img src="./img/student.png" class="w-6 h-6">

                            <span class="mx-3">Tulips Profiles</span>
                    </a>
                <?php elseif ($user['Fullname'] == 'Fely Jarabe'): ?>
                    <!-- Display only for teachers -->
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                        href="./orchid_profile.php">
                    <img src="./img/orchid.png" class="w-6 h-6">

                        <span class="mx-3">Orchids Profiles</span>
                    </a>
                <?php elseif ($user['access'] == 'administrator'): ?>
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="./tulip_profile.php">
                        <img src="./img/student.png" class="w-6 h-6">

                        <span class="mx-3">Tulips Profiles</span>
                    </a>

                    <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                    href="./orchid_profile.php">
                        <img src="./img/orchid.png" class="w-6 h-6">

                        <span class="mx-3">Orchids Profiles</span>
                    </a>
                <?php endif; ?>

                <?php if ($user['access'] == 'administrator'): ?>
                    <!-- Display only for administrators -->
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="./teacher_profile.php">
                        <img src="./img/teacher.png" class="w-6 h-6">
                        <span class="mx-3">Teacher Profiles</span>
                    </a>

                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="./user_approval.php">
                        <img src="./img/user_account.png" class="w-6 h-6">
                        <span class="mx-3">User Accounts</span>
                    </a>
                <?php endif; ?>
            </nav>
            <!-- end navigation option -->

        </div>
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
                <div class="flex items-center">
                    <!-- side bar -->
                    <button @click="sidebarOpen = true" class="text-gray-500  focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
    
                <div class="flex items-center">
                    <!-- PROFILE DROPDOWN-->
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

            <!-- TEACHERS DASHBOARD -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto ">
                <div class="container px-6 py-8 mx-auto">
                    <h3 class="text-3xl font-medium text-gray-700">STUDENT PROFILES</h3>

                    <!--SEARCH BUTTON -->
                    <div class="flex flex-col mt-8">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                                <form action="" method="POST" class="min-w-full relative mb-4 flex w-full flex-wrap items-stretch text-center overflow-hidden align-middle sm:rounded-lg">
                                <input type="search" name="search_bar"  class="relative m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-white bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary" placeholder="search here........" required="">
                                <button class="relative flex items-center rounded-r px-6 py-2.5 bg-sky-500 hover:bg-sky-700 " type="submit" name="searchbtn" ><img src="../dist/img/search.png" class="w-6"></button>
                                </form>
                        </div>
                    </div>


                    <!-- ADD FORM OF STUDENT -->
                    <div class="container mx-auto mt-8 p-4 sm:p-8 bg-white rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Add Student Information</h2>
                        
                        <form method="POST" action="orchid_profile.php" id="myForm" class="max-w-6xl mx-auto" enctype="multipart/form-data">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <input type="text" name="fullname" class="w-full px-4 py-3 rounded-lg bg-blue-100 text-blue-800 placeholder-gray-600 placeholder-italic" placeholder="Fullname" required>
                                <input type="file" name="picture" class="w-full px-4 py-3 rounded-lg bg-blue-100 text-blue-800" required>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <input type="text" name="age" class="w-full px-4 py-3 rounded-lg bg-green-100 text-green-800 placeholder-gray-600 placeholder-italic" placeholder="Age" required>
                                <input type="text" name="gender" class="w-full px-4 py-3 rounded-lg bg-yellow-100 text-yellow-800 placeholder-gray-600 placeholder-italic" placeholder="Gender" required>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 mt-4"> 
                                <input type="text" name="grade" class="w-full px-4 py-3 rounded-lg bg-purple-100 text-purple-800 placeholder-gray-600 placeholder-italic" placeholder="Grade" required>
                            </div>

                            <div class="flex justify-end mt-8">
                                <button type="submit" name="btnSave" class="px-6 py-3 rounded-lg bg-blue-600 text-white">Save</button>
                                <button type="button" class="ml-4 px-6 py-3 rounded-lg bg-red-500 text-white" onclick="clearForm()">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- END OF ADD FORM -->

                    

                    <!-- LIST OF THE STUDENTS GRADES SECTION 1 -->
                    <div class="container mx-auto mt-8 p-4 sm:p-8 bg-white rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">LIST OF THE STUDENT IN SECTION ORCHIDS</h2>

                           <!-- Button for Bubble sort -->
                            <div class="mt-4 mb-2 flex justify-end">
                                <form method="get" action="">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Sort by their Fullname
                                    </button>
                                    <input type="hidden" name="sort" value="Fullname">
                                </form>
                            </div>                                     

                        <div class="flex flex-col mt-8">
                            <div class="">
                                <div class="sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                                    <div class="sm:overflow-auto border-b border-gray-200 shadow sm:rounded-lg">
                                        <table class="min-w-full">
                                            <!-- ... Header ... -->
                                            <thead>
                                                <tr class="bg-gray-900 text-white">
                                                    <th class="px-6 py-3 text-xs leading-4 tracking-wider text-center">STUDENT ID</th>
                                                    <th class="px-6 py-3 text-xs leading-4 tracking-wider text-center">PICTURE</th>
                                                    <th class="px-6 py-3 text-xs leading-4 tracking-wider text-center">FULLNAME</th>
                                                    <th class="px-6 py-3 text-xs leading-4 tracking-wider text-center">AGE</th>
                                                    <th class="px-6 py-3 text-xs leading-4 tracking-wider text-center">GENDER</th>
                                                    <th class="px-6 py-3 text-xs leading-4 tracking-wider text-center">SECTION</th>
                                                    <th class="px-6 py-3 text-xs leading-4 tracking-wider text-center">GRADE LEVEL</th>
                                                    <th class="px-6 py-3 text-xs leading-4 tracking-wider text-center">RECORD OF GRADES</th>
                                                    <th class="px-6 py-3 text-xs leading-4 tracking-wider text-center">ACTION</th>
                                                </tr>
                                            </thead>

                                                        <tbody class="bg-white ">
                                                            <?php
                                                                $total_records_per_page = 10;
                                                                $result_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM studentdata2"));
                                                                $total_no_of_pages = ceil($result_count / $total_records_per_page);
                                        
                                                                if(isset($_GET['page_no'])){
                                                                $page_no = $_GET['page_no'];
                                                                }else{
                                                                $page_no = 1;
                                                                }
                                        
                                                                //previous page 
                                                                $previous_page = $page_no - 1; 
                                        
                                                                //get the next page
                                                                $next_page = $page_no + 1;
                                        
                                                                $offset = ($page_no * $total_records_per_page) - $total_records_per_page;
                                                                // $result = mysqli_query($conn,"SELECT * FROM studentdata LIMIT $offset, $total_records_per_page");
                                        
                                                                //search
                                                                if(isset($_POST['searchbtn'])){
                                                                            $keyword = $_POST['search_bar'];
                                                                            $result = mysqli_query($conn,"SELECT * FROM studentdata2 WHERE 
                                                                            ID LIKE '%$keyword%' 
                                                                            OR Fullname LIKE '%$keyword%'
                                                                            OR Age LIKE '%$keyword%'  
                                                                            OR Gender LIKE '%$keyword%' 
                                                                            OR Section LIKE '%$keyword%' 
                                                                            OR Grade_level LIKE '%$keyword%'  
                                                                            LIMIT $offset, $total_records_per_page");
                                                                }else{
                                                                            $result = mysqli_query($conn,"SELECT * FROM studentdata2 LIMIT $offset, $total_records_per_page");
                                                                }
                                        
                                                                       
                                                                    // Bubble sort Function
                                                                    function bubbleSort(&$arr, $field)
                                                                    {
                                                                        $n = count($arr);
                                                                        for ($i = 0; $i < $n - 1; $i++)
                                                                            for ($j = 0; $j < $n - $i - 1; $j++)
                                                                                if ($arr[$j][$field] > $arr[$j + 1][$field]) {
                                                                                    // swap temp and arr[i]
                                                                                    $temp = $arr[$j];
                                                                                    $arr[$j] = $arr[$j + 1];
                                                                                    $arr[$j + 1] = $temp;
                                                                                }
                                                                    }

                                                                    // Function for the bubble sort button
                                                                    if (isset($_GET['sort'])) {
                                                                        $sort_field = $_GET['sort'];
                                                                        $sort_result = mysqli_query($conn, "SELECT * FROM studentdata2");
                                                                        $records = [];
                                                                        while ($row = mysqli_fetch_array($sort_result)) {
                                                                            $records[] = $row;
                                                                        }
                                                                        bubbleSort($records, $sort_field);
                                                                    } else {
                                                                        // Default sorting if not specified
                                                                        $records = [];
                                                                        while ($row = mysqli_fetch_array($result)) {
                                                                            $records[] = $row;
                                                                        }
                                                                    }

                                                                    // Display the sorted records
                                                                    foreach ($records as $rs) {
                                                            ?>
                                                            <tr>
                                                                <td class="px-6 py-4 text-sm text-center leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200  bg-gray-100">
                                                                    <?php echo $rs['ID']?>
                                                                </td>

                                                                <td class="px-6 py-4 text-sm text-center leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200  bg-gray-100">
                                                                    <img src="/dash/dist/upload_img/<?php echo $rs['Picture']?>" class=" w-10 rounded-full">
                                                                </td>

                                                                <td class="px-6 py-4 text-sm text-center leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-pink-400">
                                                                    <?php echo $rs['Fullname']?>
                                                                </td>

                                                                <td class="px-6 py-4 text-sm text-center leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                                                    <?php echo $rs['Age']?>
                                                                </td>

                                                                <td class="px-6 py-4 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                                                    <?php echo $rs['Gender']?>
                                                                </td>

                                                                <td class="px-6 py-4 text-sm  text-center  leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                                                    <?php echo $rs['Section']?>
                                                                </td>
                                                                
                                                                <td class="px-6 py-4 text-sm   text-center  text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                                                    <?php echo $rs['Grade_level']?>
                                                                </td>

                                                                <td class="px-5 py-6 text-sm flex items-center justify-center leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                                                    <a href="../dist/grades/grades_2.php?viewGrades=<?php echo $rs['ID']?>" >
                                                                        <img src="../dist/img/see_grades.png" class="w-6">
                                                                    </a>
                                                                </td>

                                                                <td class="px-6 py-4 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                                                    <div class="flex items-center justify-between">

                                                                        <!-- Edit button -->
                                                                        <button class="cursor-pointer" data-toggle="modal" type="button"
                                                                            data-target="#update_modal<?php echo $rs['ID']?>" name="btnEdit">
                                                                            <img src="img/edit.png" class="inline-block w-6"> 
                                                                        </button>

                                                                       <!-- Delete button -->
                                                                        <a href="orchid_profile.php?deleteId=<?php echo $rs['ID'];?>"
                                                                        class="btn-delete cursor-pointer ml-2 lg:ml-0">
                                                                            <img src="img/delete.png" class="inline-block w-6">
                                                                        </a>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                                <!-- start of edit modal button -->
                                                                
                                                                    <div  id="update_modal<?php echo $rs['ID'];?>"  class="hidden ml-[38%]  absolute md:inset-0 max-h-full">
                                                                        <div class="p-4 max-w-md max-h-full">
                                                                            <!-- Modal content -->
                                                                            <div class="pt-3 pl-8 pr-8 pb-3 bg-slate-300 rounded-lg">
                                                                                <!-- Modal header -->
                                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b-4 rounded-t  border-black">
                                                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                                        Edit Student Data
                                                                                    </h3>
                                                                                    <button type="button" class="rounded-lg ms-auto inline-flex justify-center items-center" data-dismiss="modal">
                                                                                        <img src="img/klose.png" class="w-5 ">
                                                                                    </button>
                                                                                </div>
                                                                                <!-- Modal body -->
                                                                                <form class="p-0 md:p-5 -mt-10" action="orchid_profile.php" method="POST">
                                                                                    <div class="grid mb-4 grid-cols-2">
                                                                                        <div class="col-span-2">
                                                                                            <input type="hidden" name="update_id" value="<?php echo $rs['ID'];?>">
                                                                                            <label for="name" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Fullname</label>
                                                                                            <input type="text" name="update_fullname" value="<?php echo $rs['Fullname'];?>" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600  w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 " placeholder="Type The Fullname" required="">
                                                                                        </div>

                                                                                        <div class="col-span-2">
                                                                                            <label for="name" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                                                                                            <input type="text" name="update_age" value="<?php echo $rs['Age'];?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type The Age" required="">
                                                                                        </div>

                                                                                        <div class="col-span-2">
                                                                                            <label for="name" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                                                                                            <input type="text" name="update_gender" value="<?php echo $rs['Gender'];?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type The Gender" required="">
                                                                                        </div>

                                                                                        <div class="col-span-2">
                                                                                            <label for="name" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Section</label>
                                                                                            <input type="text" name="update_section" value="<?php echo $rs['Section'];?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type The Section" required="">
                                                                                        </div>

                                                                                        <div class="col-span-2">
                                                                                            <label for="name" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Grade Level</label>
                                                                                            <input type="text" name="update_yr_level"  value="<?php echo $rs['Grade_level'];?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type The Year Level" required="">
                                                                                        </div>
                                                                                    
                                                                                    </div>
                                                                                    <button type="submit" name="btnUpdate" class="mt-2 mb-3 text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                                        Update
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <!-- END OF EDIT MODAL -->    
                                                                    <?php   
                                                                        }
                                                                    ?>
                                                                </table> 
                                                                <!-- end of table -->
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end of list form -->

                 
                                

                        <!-- start of pagination -->
                        <ul class=" list-none flex flex-col sm:flex-row sm:items-center mt-4">
                            <li class="mb-2 sm:mb-0 sm:mr-2">
                                <a class="cursor-pointer relative block rounded bg-primary-100 px-3 py-1.5 text-sm font-medium text-primary-700 transition-all duration-300 <?= ($page_no <= 1) ? 'disabled' : '';?>" <?= ($page_no > 1) ? 'href=?page_no='. $previous_page : '';?> >
                                    Previous
                                </a>
                            </li>

                            <?php for ($i = 1; $i <= $total_no_of_pages; $i++) : ?>
                                <li class="mb-2 sm:mb-0 sm:mr-2 <?= $page_no == $i ? 'active' : '' ?>">
                                    <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white"
                                    href="?page_no=<?= $i; ?>">
                                        <?= $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <li>
                                <a class="cursor-pointer relative block rounded bg-primary-100 px-3 py-1.5 text-sm font-medium text-primary-700 transition-all duration-300 <?= ($page_no >= $total_no_of_pages) ? 'disabled' : '';?>" <?= ($page_no < $total_no_of_pages) ? 'href=?page_no='. $next_page : '';?> >
                                    Next
                                </a>
                            </li>

                            <!-- Page Number -->
                            <li class="ml-[680px] text-center sm:text-right text-sm text-gray-600">
                                Page <?= $page_no; ?> of <?= $total_no_of_pages; ?>
                            </li>
                        </ul>
                        <!-- end of pagination -->
                   </div>
            </main>
        </div>
    </div>
</div>
</body>
</html>


<!-- jQuery -->
<script src="../js/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="../js/bootstrap.min.js"></script>

<script type="text/javascript" src="../js/index.js"></script>
<script src="./grades/jquery-3.7.1.min.js"></script>
<script src="./grades/sweetalert2.all.min.js"></script>




<script>
// #########start of alert for delete############
$('.btn-delete').on('click',function(e) {
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

<script>
// ##########Start of Clear Form##################
function clearForm() {
// Get the form element
var form = document.getElementById('myForm');

// Reset the form
form.reset();
}
// #########End of Clear Form####################
</script>
