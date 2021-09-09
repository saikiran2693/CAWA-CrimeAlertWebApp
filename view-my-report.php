<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Reports</title>

    <?php
    include_once 'linkFiles.php';
    ?>
</head>
<body>

<!-- HEADER-->
<?php include_once "userheader.php" ?>
<!-- //HEADER-->

<div class="container my-5">
    <h2 class="text-center text-underline mb-3">View Crime Alerts</h2>

    <!-- Table-->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Type&nbsp;of&nbsp;Activity</th>
                <th>Type&nbsp;of&nbsp;Crime</th>
                <th>Description</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include_once 'connection.php';
            $userEmail = $_SESSION['EmailUser'];
            $select = "select * from crime_report where user_email='$userEmail'";
            $data = mysqli_query($conn, $select);
            $srno = 1;
            while ($row = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $srno; ?></td>
                    <td><?php echo $row['typeofactivity'] ?></td>
                    <td><?php echo $row['typeofcrime'] ?></td>
                    <td><?php echo $row['crimedetails'] ?></td>
                    <td><?php echo $row['dateofcrime'] ?></td>
                    <td><?php echo $row['timeofcrime'] ?></td>
                    <td class="text-capitalize">
                        <?php
                        if ($row['status'] == "verified") {
                            ?>
                            <span class="text-success font-weight-bold"><?php echo $row['status']; ?></span>
                            <?php
                        } else {
                            echo $row['status'];
                        }
                        ?>
                    </td>

                </tr>
                <?php
                $srno++;
            }
            ?>

            </tbody>
        </table>
    </div>
    <!-- //Table-->
</div>

<div class="fixed-bottom">
    <?php include_once "footer.php" ?>
</div>

</body>
</html>
