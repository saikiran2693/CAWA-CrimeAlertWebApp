<?php
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Report's</title>

    <?php include_once "linkFiles.php"; ?>

    <style>
        .date-time {
            min-width: 130px;
        }
    </style>
</head>
<body>

<!-- HEADER-->
<?php include_once "adminheader.php" ?>
<!-- //HEADER-->

<div class="container-fluid my-5">
    <h2 class="text-center text-underline mb-3">View Crime Alerts</h2>

    <?php
    $srno = 1;
    include_once "connection.php";
    $userEmail = $_SESSION['admin_email'];

    $select = "SELECT `crid`, `user_email`, `dateofcrime`, TIME_FORMAT(timeofcrime,'%h:%i:%s %p') as timeofcrime, `typeofactivity`, `typeofcrime`, `crimedetails`, `reported_at`, `status` FROM `crime_report` where user_email!='$userEmail'";
    $run = mysqli_query($conn, $select);

    if (mysqli_num_rows($run) > 0) {
        ?>
        <!-- Table-->
        <div class="table-responsive">
            <table class="table table-striped border">
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Email</th>
                    <th>Type&nbsp;of&nbsp;Activity</th>
                    <th>Type&nbsp;of&nbsp;Crime</th>
                    <th>Description</th>
                    <th class="date-time">Date</th>
                    <th class="date-time">Time</th>
                    <th>Status</th>
                    <th class="text-center" colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($run)) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $srno; ?></td>
                        <td class="text-info"><?php echo $row['user_email'] ?></td>
                        <td><?php echo $row['typeofactivity'] ?></td>
                        <td><?php echo $row['typeofcrime'] ?></td>
                        <td><?php echo $row['crimedetails'] ?></td>
                        <td><?php echo $row['dateofcrime'] ?></td>
                        <td><?php echo $row['timeofcrime'] ?></td>

                        <td class="text-capitalize">
                            <?php
                            if ($row['status'] == "verified") {
                                ?>
                                <span class="text-success"><?php echo $row['status'] ?></span>
                                <?php
                            } elseif ($row['status'] == "discarded") {
                                ?>
                                <span class="text-danger"><?php echo $row['status'] ?></span>
                                <?php
                            } else {
                                ?>
                                <span><?php echo $row['status'] ?></span>
                                <?php
                            }
                            ?>
                        </td>

                        <?php
                        if ($row['status'] == "pending") {
                            ?>
                            <td>
                                <button onclick="changeAction('<?php echo $row['crid']; ?>','verified')"
                                        class="btn btn-success btn-sm">Verify
                                </button>
                            </td>

                            <td>
                                <button onclick="changeAction('<?php echo $row['crid']; ?>','discarded')"
                                        class="btn btn-danger btn-sm">Discard
                                </button>
                            </td>
                            <?php
                        }

                        if ($row['status'] == "verified") {
                            ?>
                            <td colspan="2">
                                <button onclick="changeAction('<?php echo $row['crid']; ?>','discard')"
                                        class="btn btn-danger btn-sm">Discard
                                </button>
                            </td>
                            <?php
                        }

                        if ($row['status'] == "discard") {
                            ?>
                            <td colspan="2">
                                <button onclick="changeAction('<?php echo $row['crid']; ?>','verified')"
                                        class="btn btn-success btn-sm">Verify
                                </button>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                    $srno++;
                }
                ?>
                </tbody>
            </table>
        </div>
        <!-- //Table-->
        <?php
    } else {
        ?>
        <div class="alert alert-danger">*No Data Found !!</div>
        <?php
    }
    ?>
</div>

<!-- Footer -->
<div class="">
    <?php include_once "footer.php" ?>
</div>
<!-- Footer -->

<script>
    //Change Status
    function changeAction(id, status) {
        // console.log(id);
        // console.log(status);
        if (confirm("You want to change Status ?")) {
            let request = new XMLHttpRequest();
            let formData = new FormData();

            formData.append("action", "changeaction");
            formData.append("id", id);
            formData.append("status", status);

            request.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    if (this.response === "success") {
                        alert("Status Updated.")
                        window.location.reload();
                    } else {
                        alert("Error Occurred.")
                    }
                }
            };

            request.open("POST", "script.php", true);
            request.send(formData);
        }
    }
</script>

</body>
</html>
