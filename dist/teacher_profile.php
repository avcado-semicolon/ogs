<?php
//connection
include '../connection/conn.php';
include '../connection/db_connection.php';

if(isset($_GET['deleteUsersById']) && !empty($_GET['deleteUsersById'])) {
    $deleteId = $_GET['deleteUsersById'];
    $dataObj->deleteUsersDataById($deleteId);

} 

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

?>


<a href=""></a>

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
    <title>Teacher Profile</title>

    <style>
        h3, h2 {
            font-family: 'Kanit', sans-serif; /* Add this line to set the font family */
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
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="./Admin_Dashboard.php">
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

                    <!-- Display only for administrators -->
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25" href="./teacher_profile.php">
                        <img src="./img/teacher.png" class="w-6 h-6">
                        <span class="mx-3">Teacher Profiles</span>
                    </a>

                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                     href="./user_approval.php">
                        <img src="./img/user_account.png" class="w-6 h-6">
                        <span class="mx-3">User Accounts</span>
                    </a>
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

            <!-- TEACHERS DASHBOARD -->
<main class="flex-1 overflow-x-hidden overflow-y-auto ">
    <div class="container px-6 py-8 mx-auto">
        <h3 class="text-3xl font-medium text-gray-700">TEACHER PROFILES</h3>

        

    <!-- list of teacher -->
    <div class="container mx-auto mt-8 p-4 sm:p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Listing of Teachers</h2>

            <!--SEARCH BUTTON -->
        <div class="flex flex-col mt-8">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <form action="" method="POST" class="min-w-full relative mb-4 flex w-full flex-wrap items-stretch text-center overflow-hidden align-middle sm:rounded-lg">
                    <input type="search" name="search_bar_1"  class="relative m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-white bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary" placeholder="search here........" required="">
                    <button class="relative flex items-center rounded-r px-6 py-2.5 bg-sky-500 hover:bg-sky-700 " type="submit" name="searchbtn_1" ><img src="../dist/img/search.png" class="w-6"></button>
                    </form>
            </div>
        </div>

        <div class="flex flex-col mt-8">
            <div class="">
                <div class="sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="sm:overflow-auto border-b border-gray-200 shadow sm:rounded-lg">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-900 text-white">
                                    <th class="px-4 py-3 text-sm leading-4 tracking-wider text-center">TEACHER ID</th>
                                    <th class="px-7 py-3 text-sm leading-4 tracking-wider text-center">IMAGE</th>
                                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center">FULLNAME</th>
                                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center">USERNAME</th>
                                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center">ROLE</th>
                                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center">STATUS</th>
                                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white ">
                                <?php
                                    $total_records_per_page = 10;
                                    $result_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE access = 'Teacher'"));
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
                                    if(isset($_POST['searchbtn_1'])){
                                    $keyword = $_POST['search_bar_1'];
                                    $result = mysqli_query($conn,"SELECT * FROM users WHERE 
                                    ID LIKE '%$keyword%' 
                                    OR Fullname LIKE '%$keyword%'
                                    OR Username LIKE '%$keyword%'  
                                    OR access LIKE '%$keyword%'
                                    OR Status LIKE '%$keyword%' 
                                    OR image LIKE '%$keyword%'  
                                    LIMIT $offset, $total_records_per_page");
                                    }else{
                                    $result = mysqli_query($conn,"SELECT * FROM users WHERE access = 'Teacher' LIMIT $offset, $total_records_per_page");
                                    }
            
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($rs = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td class="px-4 py-4 text-sm text-center font-bold leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200  bg-gray-100">
                                        <?php echo $rs['ID']?>
                                    </td>

                                    <td class="px-7 py-6 text-sm flex items-center justify-center font-bold leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                        <img src="/dash/dist/upload_img/<?php echo $rs['image']?>" class=" w-10 rounded-full">
                                    </td>

                                    <td class="px-6 py-4 text-sm text-center font-bold leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-20 bg-cyan-300">
                                        <?php echo $rs['Fullname']?>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-center font-bold leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                        <?php echo $rs['Username']?>
                                    </td>

                                    <td class="px-6 py-4 text-sm  text-center font-bold  leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100 ">
                                        <?php echo $rs['access']?>
                                    </td>
                                    
                                    <td class="px-6 py-4 text-sm   text-center font-bold  text-gray-800 whitespace-no-wrap border-b border-gray-200  <?php
                                        if ($rs['Status'] === 'denied') {
                                            echo 'bg-red-500';
                                        } elseif ($rs['Status'] === 'pending') {
                                            echo 'bg-yellow-300';
                                        } else {
                                            echo 'bg-emerald-500';
                                        }
                                        ?>">
                                        <?php echo $rs['Status']?>
                                    </td> 
                                        
                                    <td class="px-6 py-4 text-sm  text-center font-bold  leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                        <a href="teacher_profile.php?deleteUsersById=<?php echo $rs['ID'];?>"
                                            class="btn-delete cursor-pointer ml-2 lg:ml-0">
                                            <img src="img/delete.png" class="inline-block w-6">
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="7" class="text-center  bg-orange-300">No teacher found.</td>
                                </tr>
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
                            <li class="ml-[750px] text-center sm:text-right text-sm text-gray-600">
                                Page <?= $page_no; ?> of <?= $total_no_of_pages; ?>
                            </li>
                        </ul>
                        <!-- end of pagination -->
                   </div>
    </div>
    <!-- end of teacher list -->

    <!-- list of administrator -->
    <div class="container mx-auto mt-8 p-4 sm:p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Listing of Administrator</h2>

        <!--SEARCH BUTTON -->
        <div class="flex flex-col mt-8">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <form action="" method="POST" class="min-w-full relative mb-4 flex w-full flex-wrap items-stretch text-center overflow-hidden align-middle sm:rounded-lg">
                    <input type="search" name="search_bar_2"  class="relative m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-white bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary" placeholder="search here........" required="">
                    <button class="relative flex items-center rounded-r px-6 py-2.5 bg-sky-500 hover:bg-sky-700 " type="submit" name="searchbtn_2" ><img src="../dist/img/search.png" class="w-6"></button>
                    </form>
            </div>
        </div>

        <div class="flex flex-col mt-8">
            <div class="">
                <div class="sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="sm:overflow-auto border-b border-gray-200 shadow sm:rounded-lg">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-900 text-white">
                                    <th class="px-4 py-3 text-sm leading-4 tracking-wider text-center">ADMINISTRATOR ID</th>
                                    <th class="px-11 py-3 text-sm leading-4 tracking-wider text-center">IMAGE</th>
                                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center">FULLNAME</th>
                                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center">USERNAME</th>
                                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center">ROLE</th>
                                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center">STATUS</th>
                                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white ">
                                <?php
                                    $total_records_per_page = 10;
                                    $result_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE access = 'administrator' "));
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
                                    if(isset($_POST['searchbtn_2'])){
                                    $keyword = $_POST['search_bar_2'];
                                    $result = mysqli_query($conn,"SELECT * FROM users WHERE 
                                    ID LIKE '%$keyword%' 
                                    OR Fullname LIKE '%$keyword%'
                                    OR Username LIKE '%$keyword%'  
                                    OR access LIKE '%$keyword%'
                                    OR Status LIKE '%$keyword%' 
                                    OR image LIKE '%$keyword%'  
                                    LIMIT $offset, $total_records_per_page");
                                    }else{
                                    $result = mysqli_query($conn,"SELECT * FROM users WHERE access = 'administrator' LIMIT $offset, $total_records_per_page");
                                    }
            
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($rs = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td class="px-4 py-4 text-sm text-center font-bold leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200  bg-gray-100">
                                        <?php echo $rs['ID']?>
                                    </td>

                                    <td class="px-11 py-6 text-sm flex items-center justify-center font-bold leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                        <img src="/dash/dist/upload_img/<?php echo $rs['image']?>" class=" w-10 rounded-full">
                                    </td>

                                    <td class="px-7 py-4 text-sm text-center font-bold leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-20 bg-violet-300">
                                        <?php echo $rs['Fullname']?>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-center font-bold leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                        <?php echo $rs['Username']?>
                                    </td>

                                    <td class="px-6 py-4 text-sm  text-center font-bold  leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                        <?php echo $rs['access']?>
                                    </td>
                                    
                                    <td class="px-6 py-4 text-sm bg- text-center font-bold  text-gray-800 whitespace-no-wrap border-b border-gray-200 <?php 
                                        if ($rs['Status'] === 'denied') {
                                            echo 'bg-red-500';
                                        } elseif ($rs['Status'] === 'pending') {
                                            echo 'bg-yellow-300';
                                        } else {
                                            echo 'bg-emerald-500';
                                        }
                                        ?>">
                                        <?php echo $rs['Status']?>
                                    </td> 
                                    
                                    <td class="px-6 py-4 text-sm  text-center font-bold  leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200 bg-gray-100">
                                        <a href="teacher_profile.php?deleteUsersById=<?php echo $rs['ID'];?>"
                                            class="btn-delete cursor-pointer ml-2 lg:ml-0">
                                            <img src="img/delete.png" class="inline-block w-6">
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="7" class="text-center  bg-orange-300">No administrator found.</td>
                                </tr>
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
                            <li class="ml-[750px] text-center sm:text-right text-sm text-gray-600">
                                Page <?= $page_no; ?> of <?= $total_no_of_pages; ?>
                            </li>
                        </ul>
                        <!-- end of pagination -->
                   </div>
    </div>
    <!-- end of administrator list -->
            </main>
        </div>
    </div>
</div>

</body>
</html>
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

