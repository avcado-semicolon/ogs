<?php
//connection
include '../connection/conn.php';
include '../connection/db_connection.php';

if(isset($_GET['deleteUsersById']) && !empty($_GET['deleteUsersById'])) {
    $deleteId = $_GET['deleteUsersById'];
    $dataObj->deleteUsersDataById($deleteId);

} 



$dataObj->updateAccount($_POST);
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cedarville+Cursive&display=swap" rel="stylesheet">
    <link href="output.css" rel="stylesheet">
    <title>MY ACCOUNT</title>

    <style>
        h3, h2 {
            font-family: 'Kanit', sans-serif; /* Add this line to set the font family */
        }
        h4{
            font-family: 'Cedarville Cursive', cursive;
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
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
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

                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="./orchid_profile.php">
                        <img src="./img/orchid.png" class="w-6 h-6">

                        <span class="mx-3">Orchids Profiles</span>
                    </a>
                <?php else: ?>

                <?php endif; ?>


                <?php if ($user['access'] == 'administrator'): ?>
                    <!-- Display only for administrators -->
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
                    href="./teacher_profile.php">
                        <img src="./img/teacher.png" class="w-6 h-6">
                        <span class="mx-3">Teacher Profiles</span>
                    </a>

                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="./user_approval.php">
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
                    <!-- PROFILEEEEEEEEEEEEE DROPDOWN-->
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = ! dropdownOpen" class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
                            <img src="/dash/dist/upload_img/<?php echo $user['image']; ?>">  
                        </button>
    
                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full" style="display: none;">
                        </div>
    
                        <div x-show="dropdownOpen" class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl" style="display: none;">
                            <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">My Profile</a>
                            <a href="/dash/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- TEACHERS DASHBOARD -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto ">
                <div class="container px-6 py-8 mx-auto">
                    <h3 class="text-3xl font-medium text-gray-700">My Profile</h3>
                    <!-- list of teacher -->
                    <div class="container mx-auto mt-8 p-4 sm:p-8 bg-zinc-50 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Manage Profile</h2>
                            <div class="flex flex-col mt-8">
                                <div class="">
                                    <div class="sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                                        <div class="sm:overflow-auto border-b border-gray-200 shadow-xl sm:rounded-lg bg-white">
                                            <!-- start of form -->
                                            <div class="rounded-t-lg h-32 overflow-hidden">
                                                <!-- Display the existing profile cover image -->
                                                <img class="object-cover object-top w-full" src='../image/cover.jpg' alt='Mountain'>
                                            </div>
                                            <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
                                                <!-- Display the existing profile image -->
                                                <img class="object-cover object-center h-32" src='/dash/dist/upload_img/<?php echo $user['image']; ?>' alt='YOU'>
                                            </div>
                                            <div class="text-center mt-2">
                                                <!-- Add id, fullname, and username -->
                                                <h2 id="user-id" class="font-semibold">ID: <?php echo $user['ID'];?></h2>
                                                <h2 id="user-fullname" class="font-semibold text-4xl"><?php echo $user['Fullname'];?></h2>
                                                <h4 id="user-username" class="font-semibold text-slate-600"><?php echo $user['Username'];?></h4>
                                            </div>
                                            
                                            <div class="p-4 border-t mx-8 mt-2">
                                                <!-- Add form elements for updating the profile -->
                                                <form action="profile.php" enctype="multipart/form-data" method="POST">
                                                    <!-- Input for updating the profile image -->
                                                    <label for="profile-image" class="block text-sm font-medium text-gray-700">Update Profile Image</label>
                                                    <input type="hidden"  name="old_image" value="/dash/dist/upload_img/<?php echo $user['image']; ?>" class="mt-1 mb-4">
                                                    <input type="file"  name="profile_image" accept="image/png, image/jpg, image/jpeg" class="mt-1 mb-4">

                                                    <!-- Input for updating the fullname -->
                                                    <label for="fullname" class="block text-sm font-medium text-gray-700">Fullname</label>
                                                    <input type="text"  name="fullname" value="<?php echo $user['Fullname'];?>" class="w-full px-4 py-2 rounded-md border bg-gray-100 focus:outline-none focus:border-gray-500" required>

                                                    <!-- Input for updating the username -->
                                                    <label for="username" class="block mt-4 text-sm font-medium text-gray-700">Username</label>
                                                    <input type="text"  name="username" value="<?php echo $user['Username'];?>" class="w-full px-4 py-2 rounded-md border bg-gray-100 focus:outline-none focus:border-gray-500" required>

                                                    <!-- Input for updating the id -->
                                                    <input type="hidden" name="id" value="<?php echo $user['ID'];?>">

                                                    <!-- Submit button -->
                                                    <button type="submit" name="profile_update" class="w-full block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white mt-5 px-6 py-2">Update Profile</button>
                                                </form>
                                            </div>
                                            <!-- end for form -->
                                        </div>
                                    </div>
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

