<?php
session_start();
include_once 'connection.php';

$email = $password = $passworderror = $emailerror = '';

if (isset($_POST['userlogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $query = "select * from users where email='$email'";
    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data) == 0) {
        $emailerror = 'Invalid Email';
    } else {
        $rowUser = mysqli_fetch_array($data);

        if ($rowUser['status'] == "inactive") {
            $emailerror = "This email is blocked by admin.";
        } elseif ($rowUser['password'] == $password) {
            $_SESSION['EmailUser'] = $email;
            header('location:user-dashboard.php');
        } else {
            $passworderror = "Invalid Password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>

    <?php
    include_once "linkFiles.php";
    ?>

    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

<!-- HEADER-->
<?php include "publicheader.php"; ?>
<!-- //HEADER-->

<div class="container my-5 py-5 alert-primary border">
    <h2 class="text-center text-underline mb-3">User Login</h2>

    <!-- LOGIN-->
    <div class="col-lg-6 offset-lg-3">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="loginForm">
            <div class="">
                <div class="form-group">
                    <input type="email" data-rule-required="true" name="email" id="email" class="form-control"
                           placeholder="Enter Email...">
                    <?php
                    if ($emailerror != '') {
                        ?>
                        <label for="email" class="text-danger"><?php echo $emailerror; ?></label>
                        <?php
                    }
                    ?>
                </div>

                <div class="form-group">
                    <input type="password" data-rule-required="true" name="password" id="password" class="form-control"
                           placeholder="Enter Password...">
                    <?php
                    if ($passworderror != '') {
                        ?>
                        <label for="email" class="text-danger"><?php echo $passworderror; ?></label>
                        <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <button type="submit" name="userlogin" class="btn btn-primary btn-block">Login</button>
                </div>
            </div>
        </form>
    </div>
    <!-- //LOGIN-->
</div>

<!-- Footer -->
<div class="fixed-bottom">
    <?php include "footer.php"; ?>
</div>
<!-- Footer -->

<script>
    $(document).ready(function () {
        $("#loginForm").validate();
    })
</script>

</body>
</html>
