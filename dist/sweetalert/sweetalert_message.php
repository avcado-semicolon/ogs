<!-- insert notify -->
<?php 
    if(isset($_GET['msg1']) == "insert") {
?>
    <script>
     Swal.fire({
        title: 'Success',
        text: 'Record has been saved!',
        icon: 'success',
        showConfirmButton: false
    })
    </script>
<?php
    }
    
?>

<!-- invalid age -->
<?php 
    if(isset($_GET['invalidage']) == "invalid_a") {
?>
    <script>
     Swal.fire({
        title: 'Oops...',
        text: 'Invalid Age, Please enter digits only',
        icon: 'warning',
        showConfirmButton: false
    })
    </script>
<?php
    }
    
?>
<!-- end of invalid age -->

<!-- invalid name -->
<?php 
    if(isset($_GET['invalidname']) == "invalid_f") {
?>
    <script>
     Swal.fire({
        title: 'Oops...',
        text: 'Invalid Name, Please enter alphabet only',
        icon: 'warning',
        showConfirmButton: false
    })
    </script>
<?php
    }
    
?>
<!-- end of invalid name-->


<!-- update notify -->
<?php 
    if(isset($_GET['msg2']) == "update") {
?>
    <script>
    Swal.fire({
        title: 'Success',
        text: 'Record has been update',
        icon: 'success',
        showConfirmButton: false
    })
    </script>
<?php
    }
    
?>

<!-- update no record found -->
<?php 
    if(isset($_GET['errormsg']) == "error") {
?>
    <script>
    Swal.fire({
        title: 'Oops...',
        text: 'Something went wrong!',
        icon: 'info',
        showConfirmButton: false
    })
    </script>
<?php
    }
    
?>
<!-- end of update -->


<!-- delete notify -->
<?php 
    if(isset($_GET['msg3']) == "delete") {
?>
    <script>
     Swal.fire({
        title: 'Deleted!',
        text: 'Record has been deleted',
        icon: 'success',
        showConfirmButton: false
    })
    </script>
<?php
    }
    
?>
<!-- end of delete notify -->

<!-- add grades -->
<?php 
    if(isset($_GET['msg4']) == "add_grades") {
?>
    <script>
     Swal.fire({
        title: 'Success',
        text: 'We will now wait for approval',
        icon: 'success',
        showConfirmButton: false
    })
    </script>
<?php
    }
    
?>
<!-- end of add grades alert -->

<!-- delete grades alert -->
<?php 
    if(isset($_GET['msg5'])) {
?>
    <script>
     Swal.fire({
        title: 'Success!',
        text: 'Grades deleted successfully',
        icon: 'success',
        confirmButtonText: 'OK'
    })
    </script>
<?php
    }
    
?>

<?php 
    if(isset($_GET['msg6'])) {
?>
    <script>
     Swal.fire({
        title: 'Error!',
        text: 'Failed to delete grades',
        icon: 'error',
        confirmButtonText: 'OK'
    })
    </script>
<?php
    }
    
?>
<!-- end of delete notify -->

<!-- approval -->
<?php 
    if(isset($_GET['approvedId'])) {
?>
    <script>
     Swal.fire({
        title: 'Approved!',
        text: 'Grades Approved!',
        icon: 'success',
        showConfirmButton: false
    })
    </script>
<?php
    }
    
?>
<!-- end -->

