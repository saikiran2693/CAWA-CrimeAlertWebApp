<?php
include_once 'connection.php';

$email = $name = $gender = $password = $mobileno = $address = $msg = $error = $emailerror = '';

if (isset($_POST['usersignup'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];    
    $confirmpassword = $_POST['confirmpassword'];
    $mobileno = $_POST['mobileno'];
    $address = $_POST['address'];
    $tempPath = $_FILES['photo']['tmp_name'];
    $pathPhoto = '';

    if ($tempPath != '') {
        $filename = $_FILES['photo']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $fileSize = round($_FILES['photo']['size'] / 1024);
        if ($ext != 'png' && $ext != 'jpg') {
            $error = "Please select only jpg or png File only";
        } elseif ($fileSize > 100) {
            $error = "Please select Image Size under 100 KB";
        } else {
            $pathPhoto = 'userPhotos/' . $filename;
            move_uploaded_file($tempPath, $pathPhoto);
        }
    }
    if(preg_match("/[a-z]/i", $mobileno)){
        $error="alphabet are not allowed in phone number";
    }
    if ($password != '') {
        if (strlen($password)<6)
        {
            $error = 'Minimum length of password must be 6';
        }
        if ($password != $confirmpassword) {
            $error = 'password & confirm password not match';
        } else {
            $password=($password);
        }
    }
    if ($error == '')
    {
    $query = "select * from users where email='$email'";
    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data) == 0) {
        $insertQuery = "INSERT INTO `users`(`email`, `password`, `name`, `gender`, `mobileno`, `address`, `photo`, `status`) VALUES ('$email','$password','$name','$gender','$mobileno','$address','$pathPhoto','active')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>alert('Signup Success')</script>";
            header('location:user-login.php');
        } else {
            $error = "Signup Failed";
        }
    } else {
        $emailerror = "Email Already Exist";
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Signup</title>
    <?php
    include_once 'linkFiles.php';
    ?>

    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

<!-- HEADER-->
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand" href="index.php">
        <img src="img/logo/logo.jpeg" width="180" height="90" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!--        <ul class="navbar-nav mx-auto">-->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="text-white nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="view-all-reports.php">Crime Report's</a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="privacy-policy.php">Privacy Policy</a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="admin-login.php">Admin Login</a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="user-login.php">User Login</a>
            </li>
        </ul>
    </div>
</nav>
<!-- //HEADER-->

<div class="container my-5 py-5 alert-primary border">
    <h2 class="text-center text-underline mb-3">User Signup</h2>

    <!-- SIGNUP-->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" id="signupForm">
        <div class="row">
            <div class="col-6 offset-3">
            <div class="col-lg-12 form-group">
                <input data-rule-required="true" data-rule-email="true" type="email" name="email"
                       value="<?php echo $email; ?>" id="email"
                       class="form-control"
                       placeholder="Enter Email...">
                <?php
                if ($emailerror != '') {
                    ?>
                    <label for="email" class="text-danger"><?php echo $emailerror; ?></label>
                    <?php

                }
                ?>
            </div>

            <div class="col-lg-12 form-group">
                <input data-rule-required="true" type="text" name="name" id="name"
                       value="<?php echo $name; ?>" class="form-control" placeholder="Enter Name...">
            </div>

            <div class="col-lg-12 form-group">
                <input data-rule-required="true" type="password" name="password" id="password" class="form-control"
                       placeholder="Enter Password...">
            </div>

            <div class="col-lg-12 form-group">
                <input data-rule-required="true" type="password" name="confirmpassword" id="confirmpassword"
                       class="form-control"
                       placeholder="Enter Confirm Password...">
            </div>

            <div class="col-lg-12 form-group">
                <label>Gender</label>
                <input type="radio" name="gender" checked value="Male"> Male
                <input type="radio" name="gender" value="Female"  > Female
            </div>

            <div class="col-lg-12 form-group">
                <input data-rule-required="true" type="tel" id="mobileno" value="<?php echo $mobileno; ?>"
                       name="mobileno" class="form-control"
                       placeholder="Enter Mobile Number...">
            </div>

            <div class="col-lg-12 form-group">
                <input data-rule-required="true" type="file" class="form-control" name="photo" id="photo">
            </div>

            <div class="col-lg-12 form-group">
                <textarea data-rule-required="true" class="form-control" name="address" id="address"
                          placeholder="Enter Address..."><?php echo $address; ?></textarea>
            </div>

            <div class="col-lg-12 form-group text-center">
                <button type="submit" name="usersignup" class="btn btn-primary">Signup Now</button>
                <?php
                if ($error != '') {
                    ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php
                }
                ?>
            </div>
            </div>
        </div>
    </form>
    <!-- SIGNUP-->
</div>

<?php
include_once 'footer.php';
?>

<script>
    $(document).ready(function () {
        $("#signupForm").validate();
    })
</script>

</body>
</html>
