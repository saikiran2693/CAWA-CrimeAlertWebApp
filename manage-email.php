<?php
session_start();
include_once 'connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Email</title>
    <?php
    include_once 'linkFiles.php';
    ?>
</head>
<body>

<!-- HEADER-->
<?php include_once "userheader.php" ?>

<?php
$msg = '';
$msgNew = '';
$error = '';
if (isset($_POST['newEamil'])) {
    $newemail = $_POST['contactemail'];
    $userEmail = $_SESSION['EmailUser'];


    $query = "select * from user_emails where user_email='$userEmail' and contact_email='$newemail'";
    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data) == 0) {
        $query2 = "select * from user_emails where user_email='$userEmail'";
        $run2 = mysqli_query($conn, $query2);
        if (mysqli_num_rows($run2) < 5) {

            $insert = "INSERT INTO `user_emails`( `user_email`, `contact_email`) VALUES ('$userEmail','$newemail')";
            if (mysqli_query($conn, $insert)) {
                $msgNew = "Contact Email Added";
            }
        } else {
            $error = "Each user can save maximum 5 emails.";
        }
    } else {
        $error = "Emailid $newemail is Already added";
    }
}
if (isset($_POST['eid'])) {
    $eid = $_POST['eid'];
    $deleteQuery = "delete from user_emails where id=$eid";
    if (mysqli_query($conn, $deleteQuery)) {
        $msg = 'Contact Email Deleted';

    }
}
?>
<!-- //HEADER-->

<div class="container-fluid">
    <div class="container my-5">
        <h2 class="text-center text-underline mb-3">Manage Email</h2>

        <div class="alert-primary py-5 px-3">
            <!-- SIGNUP-->
            <form
                    action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="col-lg-8 offset-lg-2">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="email" required name="contactemail" id="contactemail" class="form-control"
                                       placeholder="Enter Email...">
                                <?php
                                if ($error != '') {
                                    echo "<label class='text-danger' for='contactemail'>$error</label>";
                                }
                                ?>
                                <?php
                                if ($msgNew != '') {
                                    echo "<div class='alert alert-success'>$msgNew</div>";
                                }
                                ?>
                            </div>

                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <button type="submit" name="newEamil" class="btn btn-success"><i
                                            class="fa fa-plus-circle"></i></button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- SIGNUP-->
        </div>

        <div class="table-responsive mt-5">
            <?php
            if ($msg != '') {
                echo "<div class='alert alert-danger'>$msg</div>";
            }
            ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $select = "SELECT * FROM `user_emails` where user_email='" . $_SESSION['EmailUser'] . "'";
                $data = mysqli_query($conn, $select);
                $srno = 1;
                while ($row = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                    <td><?php echo $srno; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td>
                        <form onsubmit="return confirm('Are you sure to delete ?')"
                              action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="hidden" name="eid" id="eid" value="<?php echo $row[0]; ?>">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                        </form>
                    </td>
                    </tr><?php
                    $srno++;
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once "footer.php" ?>

</body>
</html>
