<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
<?php
session_start();

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "se";

    public $conn;

    // database connection
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        return $this->conn;
    }



// ████████╗██╗░░░██╗██╗░░░░░██╗██████╗░  ░██████╗░██████╗░░█████╗░██████╗░███████╗
// ╚══██╔══╝██║░░░██║██║░░░░░██║██╔══██╗  ██╔════╝░██╔══██╗██╔══██╗██╔══██╗██╔════╝
// ░░░██║░░░██║░░░██║██║░░░░░██║██████╔╝  ██║░░██╗░██████╔╝███████║██║░░██║█████╗░░
// ░░░██║░░░██║░░░██║██║░░░░░██║██╔═══╝░  ██║░░╚██╗██╔══██╗██╔══██║██║░░██║██╔══╝░░
// ░░░██║░░░╚██████╔╝███████╗██║██║░░░░░  ╚██████╔╝██║░░██║██║░░██║██████╔╝███████╗
// ░░░╚═╝░░░░╚═════╝░╚══════╝╚═╝╚═╝░░░░░  ░╚═════╝░╚═╝░░╚═╝╚═╝░░╚═╝╚═════╝░╚══════╝



    //create_grades.php for tulip
    public function addGradesTulip()
    {

        if (isset($_POST['add_grade'])) {
            $student_id = $_POST['student_id'];
            $subject = $_POST['subs'];
            $first = $_POST['first'];
            $second = $_POST['second'];
            $third = $_POST['third'];
            $fourth = $_POST['fourth'];

            $average = ($first + $second + $third + $fourth) / 4;

            $insert = "INSERT INTO grading_system (student_id, Subject, 1st_Grading, 2nd_Grading, 3rd_Grading, 4th_Grading, Average , Status) VALUES ('$student_id','$subject', '$first', '$second', '$third', '$fourth', '$average', 'pending')";
            $query = $this->conn->query($insert);


            // Retrieve the last inserted ID
            $insertId = $student_id;

            if ($query) {
                echo "<script>
                  Swal.fire({
                      title: 'Success!',
                      text: 'Grades added successfully',
                      icon: 'success',
                      confirmButtonText: 'OK'
                  }).then(function() {
                      window.location.href = '../grades/grades_1.php?viewGrades=$insertId';
                  });
              </script>";
                exit(); 
            } else {
                echo "<script>
                  Swal.fire({
                      title: 'Error!',
                      text: 'Failed to add grades',
                      icon: 'error',
                      confirmButtonText: 'OK'
                  }).then(function() {
                      window.location.href = '../grades/grades_1.php?viewGrades=$insertId';
                  });
              </script>";
                exit(); 
            }
        }
    }


    //grades_1.php for tulip
    public function getSingleDataTulip()
    {

        $studentId = isset($_GET['viewGrades']) ? $_GET['viewGrades'] : null;
        $query = "SELECT t1.ID, t2.student_id, t1.Fullname, t1.Grade_level, t1.Teacher, t1.Section  FROM (SELECT * FROM studentdata WHERE studentdata.ID = '$studentId' ) t1 LEFT JOIN grading_system t2 ON t1.ID = t2.student_id";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    //create_grades.php for tulip
    public function getSingleDataCreateTulip()
    {

        $studentId = isset($_GET['insertId']) ? $_GET['insertId'] : null;
        $query = "SELECT t1.ID, t2.student_id, t1.Fullname, t1.Grade_level, t1.Teacher, t1.Section  FROM (SELECT * FROM studentdata WHERE studentdata.ID = '$studentId' ) t1 LEFT JOIN grading_system t2 ON t1.ID = t2.student_id";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }


    // DISPLAY GRADES BY DATA SECTION TULIP
    public function displayGradingByDataTulip($studentId)
    {

        $sql = "SELECT ID, student_id, Subject, 1st_Grading, 2nd_Grading, 3rd_Grading, 4th_Grading FROM grading_system WHERE ID = '$studentId'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "<div class='failed'>
                    No Record Found
                    </div>";
        }
    }

    //Update Grades Tulip
    public function updateGradesDataTulip($postData)
    {
        if (isset($_POST['update_grade'])) {

            $id = $this->conn->real_escape_string($_POST['ID']);
            $student_id = $this->conn->real_escape_string($_POST['student_id']); //$_POST used to collect form data after submitting an HTML form with method="post".
            $first = $this->conn->real_escape_string($_POST['first']);
            $second = $this->conn->real_escape_string($_POST['second']);
            $third = $this->conn->real_escape_string($_POST['third']);
            $fourth = $this->conn->real_escape_string($_POST['fourth']);


            if (!empty($id) && !empty($postData)) {
                // Compute the average
                $average = ($first + $second + $third + $fourth) / 4;

                $sql = "UPDATE grading_system SET  1st_Grading = '$first', 2nd_Grading = '$second', 3rd_Grading = '$third', 4th_Grading = '$fourth', Average = '$average' WHERE ID = '$id'";
                $query = $this->conn->query($sql);
                if ($query) {
                    echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Grades updated successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '../grades/grades_1.php?viewGrades=$student_id';
                        });
                    </script>";
                    exit(); 
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update grades',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '../grades/grades_1.php?viewGrades=$student_id';
                        });
                    </script>";
                    exit(); 
                }
            }
        }
    }
    
    public function deleteGradesTulip($delete, $viewGrades)
    {

        $sql = "DELETE FROM grading_system WHERE ID = '$delete'";

        $query = $this->conn->query($sql);
        if ($query == true) {
            echo "<script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Grades have been successfully deleted.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../grades/grades_1.php?viewGrades=$viewGrades';
                    });
                </script>";
            exit();        
        } else {
            echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error while attempting to delete the grades.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '../grades/grades_1.php?viewGrades=$viewGrades';
                        });
                </script>";
            exit();       
        }
    }




    // ░█████╗░██████╗░░█████╗░██╗░░██╗██╗██████╗░  ░██████╗░██████╗░░█████╗░██████╗░███████╗
    // ██╔══██╗██╔══██╗██╔══██╗██║░░██║██║██╔══██╗  ██╔════╝░██╔══██╗██╔══██╗██╔══██╗██╔════╝
    // ██║░░██║██████╔╝██║░░╚═╝███████║██║██║░░██║  ██║░░██╗░██████╔╝███████║██║░░██║█████╗░░
    // ██║░░██║██╔══██╗██║░░██╗██╔══██║██║██║░░██║  ██║░░╚██╗██╔══██╗██╔══██║██║░░██║██╔══╝░░
    // ╚█████╔╝██║░░██║╚█████╔╝██║░░██║██║██████╔╝  ╚██████╔╝██║░░██║██║░░██║██████╔╝███████╗
    // ░╚════╝░╚═╝░░╚═╝░╚════╝░╚═╝░░╚═╝╚═╝╚═════╝░  ░╚═════╝░╚═╝░░╚═╝╚═╝░░╚═╝╚═════╝░╚══════╝


    //create_grades_2.php for orchid
    public function addGradesOrchid()
    {

        if (isset($_POST['add_grade'])) {
            $student_id = $_POST['student_id'];
            $subject = $_POST['subs'];
            $first = $_POST['first'];
            $second = $_POST['second'];
            $third = $_POST['third'];
            $fourth = $_POST['fourth'];

            $average = ($first + $second + $third + $fourth) / 4;

            $insert = "INSERT INTO grading_system_2 (student_id, Subject, 1st_Grading, 2nd_Grading, 3rd_Grading, 4th_Grading, Average , Status) VALUES ('$student_id','$subject', '$first', '$second', '$third', '$fourth', '$average', 'pending')";
            $query = $this->conn->query($insert);


            // Retrieve the last inserted ID
            $insertId = $student_id;

            if ($query) {
                echo "<script>
                  Swal.fire({
                      title: 'Success!',
                      text: 'Grades added successfully',
                      icon: 'success',
                      confirmButtonText: 'OK'
                  }).then(function() {
                      window.location.href = '../grades/grades_2.php?viewGrades=$insertId';
                  });
              </script>";
                exit(); 
            } else {
                echo "<script>
                  Swal.fire({
                      title: 'Error!',
                      text: 'Failed to add grades',
                      icon: 'error',
                      confirmButtonText: 'OK'
                  }).then(function() {
                      window.location.href = '../grades/grades_2.php?viewGrades=$insertId';
                  });
              </script>";
                exit(); 
            }
        }
    }


    //grades_2.php for orchid
    public function getSingleDataOrchid()
    {

        $studentId = isset($_GET['viewGrades']) ? $_GET['viewGrades'] : null;
        $query = "SELECT t1.ID, t2.student_id, t1.Fullname, t1.Grade_level, t1.Teacher, t1.Section  FROM (SELECT * FROM studentdata2 WHERE studentdata2.ID = '$studentId' ) t1 LEFT JOIN grading_system_2 t2 ON t1.ID = t2.student_id";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    //create_grades_2.php for orchid
    public function getSingleDataCreateOrchid()
    {

        $studentId = isset($_GET['insertId']) ? $_GET['insertId'] : null;
        $query = "SELECT t1.ID, t2.student_id, t1.Fullname, t1.Grade_level, t1.Teacher, t1.Section  FROM (SELECT * FROM studentdata2 WHERE studentdata2.ID = '$studentId' ) t1 LEFT JOIN grading_system_2 t2 ON t1.ID = t2.student_id";
        // $queryStudentDetails = "SELECT t1.ID, t1.Fullname, t1.Grade_level FROM studentdata t1 LEFT JOIN grading_system t2 ON t1.ID = t2.student_id WHERE t1.ID = $studentId";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }


    
    // DISPLAY GRADES BY DATA SECTION ORCHID
    public function displayGradingByDataOrchid($studentId)
    {

        $sql = "SELECT ID, student_id, Subject, 1st_Grading, 2nd_Grading, 3rd_Grading, 4th_Grading FROM grading_system_2 WHERE ID = '$studentId'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "<div class='failed'>
                No Record Found
                </div>";
        }
    }

    //Update Grades Orchid
    public function updateGradesDataOrchid($postData)
    {
        if (isset($_POST['update_grade'])) {

            $id = $this->conn->real_escape_string($_POST['ID']);
            $student_id = $this->conn->real_escape_string($_POST['student_id']); //$_POST used to collect form data after submitting an HTML form with method="post".
            $first = $this->conn->real_escape_string($_POST['first']);
            $second = $this->conn->real_escape_string($_POST['second']);
            $third = $this->conn->real_escape_string($_POST['third']);
            $fourth = $this->conn->real_escape_string($_POST['fourth']);


            if (!empty($id) && !empty($postData)) {
                // Compute the average
                $average = ($first + $second + $third + $fourth) / 4;

                $sql = "UPDATE grading_system_2 SET  1st_Grading = '$first', 2nd_Grading = '$second', 3rd_Grading = '$third', 4th_Grading = '$fourth', Average = '$average' WHERE ID = '$id'";
                $query = $this->conn->query($sql);
                if ($query) {
                    echo "<script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Grades updated successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../grades/grades_2.php?viewGrades=$student_id';
                    });
                </script>";
                    exit();
                } else {
                    echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update grades',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../grades/grades_2.php?viewGrades=$student_id';
                    });
                </script>";
                    exit();
                }
            }
        }
    }

    //DELETE GRADES FOR ORCHID
    public function deleteGradesOrchid($delete, $viewGrades)
    {

        $sql = "DELETE FROM grading_system_2 WHERE ID = '$delete'";

        $query = $this->conn->query($sql);
        if ($query == true) {
            echo "<script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Grades have been successfully deleted.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../grades/grades_2.php?viewGrades=$viewGrades';
                    });
                </script>";
            exit();       
        } else {
            echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error while attempting to delete the grades.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '../grades/grades_2.php?viewGrades=$viewGrades';
                        });
                </script>";
            exit();       
        }
    }




// ████████╗██╗░░░██╗██╗░░░░░██╗██████╗░  ░█████╗░██████╗░██╗░░░██╗██████╗░
// ╚══██╔══╝██║░░░██║██║░░░░░██║██╔══██╗  ██╔══██╗██╔══██╗██║░░░██║██╔══██╗
// ░░░██║░░░██║░░░██║██║░░░░░██║██████╔╝  ██║░░╚═╝██████╔╝██║░░░██║██║░░██║
// ░░░██║░░░██║░░░██║██║░░░░░██║██╔═══╝░  ██║░░██╗██╔══██╗██║░░░██║██║░░██║
// ░░░██║░░░╚██████╔╝███████╗██║██║░░░░░  ╚█████╔╝██║░░██║╚██████╔╝██████╔╝
// ░░░╚═╝░░░░╚═════╝░╚══════╝╚═╝╚═╝░░░░░  ░╚════╝░╚═╝░░╚═╝░╚═════╝░╚═════╝░


    //insert student  in Tulip
    public function insertDataTulip()
    { // receive all input values from the form

        if (isset($_POST['btnSave'])) {

            $fullname = $this->conn->real_escape_string($_POST['fullname']); //function allows special characters in a string for use in an SQL query
            $age = $this->conn->real_escape_string($_POST['age']);
            $gender = $this->conn->real_escape_string($_POST['gender']);
            $grade = $this->conn->real_escape_string($_POST['grade']);
            $image = $_FILES['picture']['name'];
            $image_tmp_name = $_FILES['picture']['tmp_name'];
            $image_folder = 'upload_img/' . $image;

            if (!preg_match("/^[0-9]*$/", $age)) {
                echo "<script>
                        Swal.fire({
                            title: 'Oops...!',
                            text: 'The specified age is invalid; please provide a numerical value.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/tulip_profile.php';
                        });
                    </script>";
                exit(); 

            } elseif (!preg_match("/^([a-zA-Z' ]+)$/", $fullname)) {
                echo "<script>
                        Swal.fire({
                            title: 'Oops...!',
                            text: 'The provided full name is invalid; please include a character.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/tulip_profile.php';
                        });
                    </script>";
                exit(); 

            } else {
                $query = "INSERT INTO studentdata (Picture,Fullname,Age,Gender,Grade_level) VALUES ('$image','$fullname','$age','$gender','$grade')";
                mysqli_query($this->conn, $query);

                if ($query) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                }

                echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Student have been successfully added.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/tulip_profile.php';
                        });
                    </script>";
                exit();                   
            }
        }
    }


    //Update student profile in Tulip
    public function updateTulipDataById($postData)
    {
        if (isset($_POST['btnUpdate'])) {

            $id = $this->conn->real_escape_string($_POST['update_id']); //function allows special characters in a string for use in an SQL query
            $fullname = $this->conn->real_escape_string($_POST['update_fullname']); //$_POST used to collect form data after submitting an HTML form with method="post".
            $age = $this->conn->real_escape_string($_POST['update_age']);
            $gender = $this->conn->real_escape_string($_POST['update_gender']);
            $section = $this->conn->real_escape_string($_POST['update_section']);
            $grade = $this->conn->real_escape_string($_POST['update_yr_level']);


            if (!empty($id) && !empty($postData)) {
                $sql = "UPDATE studentdata SET Fullname = '$fullname',  Age = '$age', Gender = '$gender', Section = '$section', Grade_level = '$grade' WHERE ID = '$id'";
                $query = $this->conn->query($sql);
                if ($query) {
                    // Output SweetAlert using JavaScript
                    echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Updated successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                          window.location.href = '/dash/dist/tulip_profile.php';
                        });
                    </script>";
                    exit(); 
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(function() {
                          window.location.href = '/dash/dist/tulip_profile.php';
                        });
                    </script>";
                    exit(); 
                }
            }
        }
    }


    //delete student in tulip
    public function deleteTulipProfileById($id)
    {
        $sql = "DELETE FROM studentdata WHERE ID = '$id'";
        $query = $this->conn->query($sql);

        if ($query == true) {
            echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Student have been successfully deleted.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/tulip_profile.php';
                        });
                    </script>";
            exit();       
        } else {
            echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error while attempting to delete the grades.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/tulip_profile.php';
                        });
                    </script>";
            exit();     
        }
    }




    
// ░█████╗░██████╗░░█████╗░██╗░░██╗██╗██████╗░  ░█████╗░██████╗░██╗░░░██╗██████╗░
// ██╔══██╗██╔══██╗██╔══██╗██║░░██║██║██╔══██╗  ██╔══██╗██╔══██╗██║░░░██║██╔══██╗
// ██║░░██║██████╔╝██║░░╚═╝███████║██║██║░░██║  ██║░░╚═╝██████╔╝██║░░░██║██║░░██║
// ██║░░██║██╔══██╗██║░░██╗██╔══██║██║██║░░██║  ██║░░██╗██╔══██╗██║░░░██║██║░░██║
// ╚█████╔╝██║░░██║╚█████╔╝██║░░██║██║██████╔╝  ╚█████╔╝██║░░██║╚██████╔╝██████╔╝
// ░╚════╝░╚═╝░░╚═╝░╚════╝░╚═╝░░╚═╝╚═╝╚═════╝░  ░╚════╝░╚═╝░░╚═╝░╚═════╝░╚═════╝░

    //insert student  in Orchid
    public function insertDataOrchid()
    {

        if (isset($_POST['btnSave'])) {

            $fullname = $this->conn->real_escape_string($_POST['fullname']); //function allows special characters in a string for use in an SQL query
            $age = $this->conn->real_escape_string($_POST['age']);
            $gender = $this->conn->real_escape_string($_POST['gender']);
            $grade = $this->conn->real_escape_string($_POST['grade']);            
            $image = $_FILES['picture']['name'];
            $image_tmp_name = $_FILES['picture']['tmp_name'];
            $image_folder = 'upload_img/' . $image;
            if (!preg_match("/^[0-9]*$/", $age)) {
                echo "<script>
                        Swal.fire({
                            title: 'Oops...!',
                            text: 'The specified age is invalid; please provide a numerical value.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/orchid_profile.php';
                        });
                    </script>";
                exit(); 

            } elseif (!preg_match("/^([a-zA-Z' ]+)$/", $fullname)) {
                echo "<script>
                        Swal.fire({
                            title: 'Oops...!',
                            text: 'The provided full name is invalid; please include a character.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/orchid_profile.php';
                        });
                    </script>";
                exit(); 

            } else {
                $query = "INSERT INTO studentdata2 (Picture,Fullname,Age,Gender,Grade_level) VALUES ('$image','$fullname','$age','$gender','$grade')";
                mysqli_query($this->conn, $query);

                if ($query) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                }
                echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Student have been successfully added.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/orchid_profile.php';
                        });
                    </script>";
                exit();                  
            }
        }
    }


    //Update student profile in Orchid
    public function updateOrchidDataById($postData)
    {
        if (isset($_POST['btnUpdate'])) {

            $id = $this->conn->real_escape_string($_POST['update_id']); //function allows special characters in a string for use in an SQL query
            $fullname = $this->conn->real_escape_string($_POST['update_fullname']); //$_POST used to collect form data after submitting an HTML form with method="post".
            $age = $this->conn->real_escape_string($_POST['update_age']);
            $gender = $this->conn->real_escape_string($_POST['update_gender']);
            $section = $this->conn->real_escape_string($_POST['update_section']);
            $grade = $this->conn->real_escape_string($_POST['update_yr_level']);


            if (!empty($id) && !empty($postData)) {
                $sql = "UPDATE studentdata2 SET Fullname = '$fullname',  Age = '$age', Gender = '$gender', Section = '$section', Grade_level = '$grade' WHERE ID = '$id'";
                $query = $this->conn->query($sql);
                if ($query) {
                    echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Updated successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                          window.location.href = '/dash/dist/orchid_profile.php';
                        });
                    </script>";
                    exit();
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(function() {
                          window.location.href = '/dash/dist/orchid_profile.php';
                        });
                    </script>";
                    exit(); 
                }
            }
        }
    }



    //delete student in Orchid
    public function deleteOrchidProfileById($id)
    {
        $sql = "DELETE FROM studentdata2 WHERE ID = '$id'";
        $query = $this->conn->query($sql);

        if ($query == true) {
            echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Student have been successfully deleted.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/orchid_profile.php';
                        });
                    </script>";
            exit();       
        } else {
            echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error while attempting to delete the grades.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/orchid_profile.php';
                        });
                    </script>";
            exit();       
        }
    }




    
// ░█████╗░░█████╗░░█████╗░  ░█████╗░██████╗░██╗░░░██╗██████╗░
// ██╔══██╗██╔══██╗██╔══██╗  ██╔══██╗██╔══██╗██║░░░██║██╔══██╗
// ███████║██║░░╚═╝██║░░╚═╝  ██║░░╚═╝██████╔╝██║░░░██║██║░░██║
// ██╔══██║██║░░██╗██║░░██╗  ██║░░██╗██╔══██╗██║░░░██║██║░░██║
// ██║░░██║╚█████╔╝╚█████╔╝  ╚█████╔╝██║░░██║╚██████╔╝██████╔╝
// ╚═╝░░╚═╝░╚════╝░░╚════╝░  ░╚════╝░╚═╝░░╚═╝░╚═════╝░╚═════╝░


    public function deleteUsersDataById($id)
    {
        $sql = "DELETE FROM users WHERE ID = '$id'";
        $query = $this->conn->query($sql);

        if ($query == true) {
            echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Users have been successfully deleted.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/teacher_profile.php';
                        });
                    </script>";
            exit();     
        } else {
            echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error while attempting to delete the users.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/dash/dist/teacher_profile.php';
                        });
                    </script>";
            exit();      
        }
    }

    // Update data
    public function updateAccount($postData)
    {

        if (isset($_POST['profile_update'])) {

            $id = $_POST['id'];
            $name = $_POST['fullname'];
            $username = $_POST['username'];
            $image = $_FILES['profile_image']['name'];


            $sql = "UPDATE users SET Fullname = '$name',  Username = '$username', image = '$image' WHERE ID = '$id'";
            $query = $this->conn->query($sql);

            if ($query) {
                if ($_FILES['profile_image']['name'] != '') {
                    // Move the uploaded image to the destination folder
                    move_uploaded_file($_FILES['profile_image']['tmp_name'], "upload_img/" . $_FILES['profile_image']['name']);
                }
                echo "<script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Update Successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '/dash/dist/profile.php';
                    });
                </script>";
                exit();
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Oopss..!',
                        text: 'Failed to Update!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '/dash/dist/profile.php';
                    });
                </script>";
                exit();
            }
        }
    }




    
// ░██████╗██╗░██████╗░███╗░░██╗  ██╗███╗░░██╗  ░█████╗░███╗░░██╗██████╗░  ██╗░░░██╗██████╗░
// ██╔════╝██║██╔════╝░████╗░██║  ██║████╗░██║  ██╔══██╗████╗░██║██╔══██╗  ██║░░░██║██╔══██╗
// ╚█████╗░██║██║░░██╗░██╔██╗██║  ██║██╔██╗██║  ███████║██╔██╗██║██║░░██║  ██║░░░██║██████╔╝
// ░╚═══██╗██║██║░░╚██╗██║╚████║  ██║██║╚████║  ██╔══██║██║╚████║██║░░██║  ██║░░░██║██╔═══╝░
// ██████╔╝██║╚██████╔╝██║░╚███║  ██║██║░╚███║  ██║░░██║██║░╚███║██████╔╝  ╚██████╔╝██║░░░░░
// ╚═════╝░╚═╝░╚═════╝░╚═╝░░╚══╝  ╚═╝╚═╝░░╚══╝  ╚═╝░░╚═╝╚═╝░░╚══╝╚═════╝░  ░╚═════╝░╚═╝░░░░░




    //Register function
    public function register()
    {

        if (isset($_POST['btnregister'])) {

            $name = $_POST['fullname'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $cpass = md5($_POST['confirmpassword']);
            $role = $_POST['role'];
            $image = $_FILES['images']['name'];
            $image_tmp_name = $_FILES['images']['tmp_name'];
            $image_folder = 'dist/upload_img/' . $image;

            $duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE Username = '$username'");
            if (mysqli_num_rows($duplicate) > 0) {

                echo "<script>
                        Swal.fire({
                            title: 'Oopss..!',
                            text: 'Username is already exists!',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'login.php';
                        });
                    </script>";
                exit(); 

            } elseif ($password !== $cpass) {
                echo "<script>
                        Swal.fire({
                            title: 'Oopss..!',
                            text: 'Password does not match!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'login.php';
                        });
                    </script>";
                exit();

            } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                echo "<script>
                        Swal.fire({
                            title: 'Oopss..!',
                            text: 'Invalid email format!',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'login.php';
                        });
                    </script>";
                exit();
            } elseif (!preg_match("/^([a-zA-Z' ]+)$/", $name)) {
                echo "<script>
                            Swal.fire({
                                title: 'Oopss..!',
                                text: 'Invalid Fullname!',
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.href = 'login.php';
                            });
                    </script>";
                exit(); 
            } else {
                $query = "INSERT INTO users (Fullname, Username, Password, access, Status, image)VALUES('$name', '$username', '$password', '$role', 'pending', '$image')";
                mysqli_query($this->conn, $query);

                if ($query) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                }
                echo "<script>
                            Swal.fire({
                                title: 'Success!',
                                text: 'You have successfully completed the registration process. Please await approval from the administrator.!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.href = 'login.php';
                            });
                        </script>";
                exit(); 
            }
        }
    }

    public $id;
    public function idUser()
    {
        return $this->id;
    }


    

    public function login()
    {
        if (isset($_POST['btnlogin'])) {
            $username = $_POST['email'];
            $password = md5($_POST['password']);

            $result = mysqli_query($this->conn, "SELECT * FROM users WHERE Username = '$username' AND Password = '$password'");
            $row = mysqli_fetch_assoc($result);

            if (mysqli_num_rows($result) == 1) {
                $approved = $row['Status']; 

                $this->id = $row["ID"];
                $_SESSION["login"] = true;
                $_SESSION["id"] = $this->idUser();

                if ($approved == 'approved') {

                    $role = $row['access']; 

                    if ($role == 'administrator') {
                        echo "<script>
                            Swal.fire({
                                title: 'Success!',
                                text: 'Admin Login Success!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.href = '/dash/dist/Admin_Dashboard.php';
                            });
                            </script>";
                        exit(); 
                    } elseif ($role == 'Teacher') {
                        echo "<script>
                            Swal.fire({
                                title: 'Success!',
                                text: 'Teacher Login Success!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.href = '/dash/dist/Teacher_Dashboard.php';
                            });
                            </script>";
                        exit(); 
                    } else {
                        echo "<script>
                            Swal.fire({
                                title: 'Error!',
                                text: 'Unknown Role!',
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.href = 'login.php';
                            });
                            </script>";
                        exit(); 
                    }
                } elseif ($approved == 'pending') {
                    echo "<script>
                        Swal.fire({
                            title: 'Oppss...!',
                            text: 'Account not yet approved. Await administrator authorization, please.',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'login.php';
                        });
                        </script>";
                    exit();
                    // User Account is pending
                }elseif ($approved == 'denied') {
                    echo "<script>
                        Swal.fire({
                            title: 'Oppss...!',
                            text: 'Account is Denied.',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'login.php';
                        });
                        </script>";
                    exit();
                    // User Account is pending
                }else {
                    echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Empty Role!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'login.php';
                        });
                        </script>";
                    exit(); 
                    //Role is empty
                }
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Invalid Username or Password!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = 'login.php';
                    });
                    </script>";
                exit(); 
                // Invalid username or password
            }
        }
    }

    public function selectUserById($id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM users WHERE ID = $id");
        return mysqli_fetch_assoc($result);
    }

    public function selectTulipById()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM studentdata");
        return mysqli_fetch_assoc($result);
    }
    public function selectOrchidById()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM studentdata2");
        return mysqli_fetch_assoc($result);
    }
}
$dataObj = new Database();
?>
<a href=""></a>