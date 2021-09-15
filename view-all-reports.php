<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crime Report's</title>

    <style>
        .card {
            border: 1px solid #ffdada !important;
            transition: box-shadow 400ms;
        }

        .card:hover {
            box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.5);
        }

        .card-body {
            min-height: 150px !important;
        }

        .card-body div a {
            cursor: default;
        }
    </style>

    <?php include_once "linkFiles.php"; ?>
</head>

<body>

    <!-- HEADER-->
    <?php include "publicheader.php"; ?>
    <!-- //HEADER-->

    <div class="container my-5">
        <h2 class="text-center text-underline mb-3 text-info">Crime Report's</h2>

        <div class="row">
            <?php
            include_once "connection.php";

            $select = "SELECT * FROM `crime_report` WHERE status='verified'";
            $run = mysqli_query($conn, $select);

            if (mysqli_num_rows($run) > 0) {
                while ($row = mysqli_fetch_assoc($run)) {
            ?>
                    <div class="col-lg-4 mb-3">
                        <div class="card" style="width: 100%;">
                            <div class="card-header alert-warning">
                                <h6 class="text-capitalize" style="color: #030377">
                                    <?php echo $row['typeofcrime']; ?> (<?php echo $row['typeofactivity']; ?>)
                                </h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $row['crimedetails']; ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0);" class="card-link float-left"><?php echo $row['reported_at']; ?></a>
                                <a href="javascript:void(0);" class="card-link float-right"><img style="max-width: 70px;" src="img/verified.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger">*No Data Found !!</div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>

    <?php
    include_once 'footer.php';
    ?>

</body>

</html>