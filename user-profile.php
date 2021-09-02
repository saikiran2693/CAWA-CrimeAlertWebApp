<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <?php
    include_once 'linkFiles.php';
    ?>
</head>
<body>
<!-- HEADER-->
<?php include_once "userheader.php";
include_once 'connection.php';
$email = $_SESSION['EmailUser'];
$errormsg = $msg = '';
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $mobileno = $_POST['mobileno'];
    $address = $_POST['address'];
    $password = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    $subquery = "";
    if ($password != '') {
        if ($password != $confirmpassword) {
            $errormsg = 'password & confirm password not match';
        } else {
            $password=md5($password);
            $subquery = ",password='$password'";
        }
    }
    $tempPath = $_FILES['photo']['tmp_name'];
    $pathPhoto = '';
    if ($tempPath != '') {
        $filename = $_FILES['photo']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $fileSize = round($_FILES['photo']['size'] / 1024);
        if ($ext != 'png' && $ext != 'jpg') {
            $errormsg = "Please select only jpg or png File only";
        } elseif ($fileSize > 100) {
            $errormsg = "Please select Image Size under 100 KB";
        } else {
            $pathPhoto = 'userPhotos/' . $filename;
            move_uploaded_file($tempPath, $pathPhoto);
            $subquery .= ",photo='$pathPhoto'";
        }


    }
    if ($errormsg == '') {
        $update = "UPDATE `users` SET `name`='$name',`gender`='$gender',`mobileno`='$mobileno',`address`='$address' $subquery WHERE `email`='$email'";
//        echo $update;
        if (mysqli_query($conn, $update)) {
            $msg = "Profile Updated";
        }


    }


}

$query = "select * from users where email='$email'";
$data = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($data);

?>
<!-- //HEADER-->

<div class="container my-5 py-5 alert-primary border">
    <h2 class="text-center text-underline mb-3">My Profile</h2>
    <!-- SIGNUP-->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <img src="<?php echo $row['photo']; ?>" alt="Profile Image" width="150" height="150" class="mb-3">

        <div class="row">
            <div class="col-lg-6 form-group">
                <input readonly type="email" name="email" class="form-control" placeholder="Enter Email..."
                       value="<?php echo $email; ?>">
            </div>

            <div class="col-lg-6 form-group">
                <input type="text" class="form-control" name="name" placeholder="Enter Name..."
                       value="<?php echo $row['name']; ?>">
            </div>

            <div class="col-lg-6 form-group">
                <input type="password" name="newpassword" class="form-control" placeholder="Enter  Password...">
            </div>

            <div class="col-lg-6 form-group">
                <input type="password" name="confirmpassword" class="form-control"
                       placeholder="Enter Confirm Password...">
            </div>

            <div class="col-lg-4 form-group">
                <label>Gender</label>
                <input type="radio" <?php if ($row['gender'] == 'Male') {
                    echo 'checked';
                } ?> value="Male" name="gender"> Male
                <input type="radio" <?php if ($row['gender'] == 'Female') {
                    echo 'checked';
                } ?> value="Female" name="gender"> Female
            </div>

            <div class="col-lg-4 form-group">
                <input type="tel" class="form-control" required name="mobileno" value="<?php echo $row['mobileno']; ?>"
                       placeholder="Enter Mobile Number...">
            </div>

            <div class="col-lg-4 form-group">
                <input type="file" class="form-control" name="photo">
            </div>

            <div class="col-lg-12 form-group">
                <textarea class="form-control" name="address" required
                          placeholder="Enter Address..."><?php echo $row['address']; ?></textarea>
            </div>

            <div class="col-lg-12 form-group text-center">
                <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                <?php
                if ($msg != '') {
                    echo "<div class='alert alert-success'>$msg</div>";
                }
                if ($errormsg != '') {
                    echo "<div class='alert alert-danger'>$errormsg</div>";
                }
                ?>
            </div>
        </div>
    </form>
    <!-- SIGNUP-->
</div>

<!--<div class="fixed-bottom">-->
<?php include_once "footer.php" ?>
<!--</div>-->

</body>
</html>
