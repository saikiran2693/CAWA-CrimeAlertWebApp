<?php
@session_start();

$userEmail = $activity = $description = $time = $date = $typeofcrime = $erro = $msg = '';

if (isset($_POST['submit'])) {
    include_once 'connection.php';

    $userEmail = $_SESSION['admin_email'];
    $activity = $_POST['activity'];
    $description = $_POST['description'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $typeofcrime = $_POST['typeofcrime'];

    $insertQuery = "INSERT INTO `crime_report`(`crid`, `user_email`, `dateofcrime`, `timeofcrime`, `typeofactivity`, `typeofcrime`, `crimedetails`,`status`) VALUES (null,'$userEmail','$date','$time','$activity','$typeofcrime','$description','verified')";
    if (mysqli_query($conn, $insertQuery)) {
        $msg = "Crime Report Submitted";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crime Report</title>

    <style>
        form {
            color: #000;
        }

        label {
            font-size: 1.3rem;
            color: #030377;
        }

        .d-info {
            color: #797272;
            font-size: 1rem;
        }

        .error {
            color: red !important;
            font-size: .9rem;
        }
    </style>

    <?php include_once "linkFiles.php"; ?>
</head>

<body>

    <!-- HEADER-->
    <?php include_once "adminheader.php" ?>
    <!-- //HEADER-->

    <div class="container my-5 py-5 alert-primary border">
        <h2 class="text-center text-underline mb-3">Report Activity</h2>

        <!-- LOGIN-->
        <div class="col-lg-6 offset-lg-3">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="addForm">
                <div class="">
                    <div class="form-group">
                        <label for="activity">Type of Activity</label> <br>
                        <input checked type="radio" name="activity" id="actual" value="Actual Crime"> Actual Crime
                        <input type="radio" name="activity" id="suspicious" value="Suspicious Activity"> Suspicious Activity
                    </div>

                    <div class="form-group">
                        <label for="typeofcrime">Type of Crime</label> <br>
                        <select data-rule-required="true" name="typeofcrime" required id="typeofcrime" class="form-control">
                            <option value="">-- Select Crime --</option>
                            <option value="Child Abuse">Child Abuse</option>
                            <option value="Domestic Abuse">Domestic Abuse</option>
                            <option value="Fraud">Fraud</option>
                            <option value="Robbery">Robbery</option>
                            <option value="Stalking and Harassment">Stalking and Harassment</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description of Crime</label> <br>
                        <textarea data-rule-required="true" name="description" required id="description" class="form-control" placeholder="Enter Description"></textarea>
                        <p class="d-info">(Please enter as many details as possible, including a description of
                            the individual's height, age, skin colour, clothes and any other useful information such as
                            vehical
                            colour, registration and model. The more detail the better.)</p>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="time">Time</label>
                            <input data-rule-required="true" type="time" required class="form-control" name="time">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="date">Date</label>
                            <input data-rule-required="true" type="date" required class="form-control" name="date">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Submit Report</button>
                        <?php
                        if ($msg != '') {
                            echo "<div class='alert alert-success mt-3'>$msg</div>";
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
        <!-- //LOGIN-->
    </div>

    <!-- Footer -->
    <?php include_once "footer.php" ?>
    <!-- Footer -->

    <script>
        $(document).ready(function() {
            $("#addForm").validate();
        })
    </script>

</body>

</html>