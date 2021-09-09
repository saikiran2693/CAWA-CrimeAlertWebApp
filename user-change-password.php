<?php
session_start();
include_once 'connection.php';
$email = $password = $passworderror = $emailerror = $msg = '';
if (isset($_POST['userchangepassword'])) {
    $email = $_POST['email'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    if ($newpassword == $confirmpassword) {
        $oldpassword = ($oldpassword);
        $newpassword = ($newpassword);
        $query = "select * from users where email='$email'";
        $data = mysqli_query($conn, $query);

        if (mysqli_num_rows($data) == 0) {
            $emailerror = 'Invalid Email';

        } else {
            $rowUser = mysqli_fetch_array($data);
            if ($rowUser['password'] == $oldpassword) {
                $update = "update users set password='$newpassword' where email='$email'";
                if (mysqli_query($conn, $update)) {
                    $msg = "Password Updated";
                }
            } else {
                $passworderror = "invalid Old Password";
            }

        }
    } else {
        $passworderror = "New Password && Confirm Password not match";
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Change Password</title>
    <?php
    include_once 'linkFiles.php';
    ?>
</head>
<body>

<!-- HEADER-->
<?php include_once "userheader.php" ?>
<!-- //HEADER-->

<div class="container my-5 py-5 alert-primary border">
    <h2 class="text-center text-underline mb-3">User Change Password</h2>

    <!-- SIGNUP-->
    <div class="col-lg-6 offset-lg-3">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="">

                <input type="hidden" name="email" id="email" value="<?php echo $_SESSION['EmailUser']; ?>">


                <div class="form-group">
                    <input type="password" required name="oldpassword" id="oldpassword" class="form-control"
                           placeholder="Enter Old Password...">
                    <?php
                    if ($emailerror != '') {
                        ?>
                        <label for="email" class="text-danger"><?php echo $emailerror; ?></label>
                        <?php
                    }
                    ?>
                </div>

                <div class="form-group">
                    <input type="password" required name="newpassword" id="newpassword" class="form-control"
                           placeholder="Enter New Password...">
                </div>
                <div class="form-group">
                    <input type="password" required name="confirmpassword" id="confirmpassword" class="form-control"
                           placeholder="Enter Confirm Password...">
                    <?php
                    if ($passworderror != '') {
                        ?>
                        <label for="email" class="text-danger"><?php echo $passworderror; ?></label>
                        <?php
                    }
                    ?>
                </div>

                <div class="form-group">
                    <button type="submit" name="userchangepassword" class="btn btn-primary btn-block">Update</button>
                    <?php
                    if($msg!=''){
                        ?>
                        <div class="alert alert-success"><?php echo $msg ;?></div>
                        <?php

                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
    <!-- SIGNUP-->
</div>

<div class="fixed-bottom">
    <?php include_once "footer.php" ?>
</div>

</body>
</html>
