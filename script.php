<?php
include_once "connection.php";

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];

    if ($action == "changestatus") {
        $email = $_REQUEST['email'];
        $status = $_REQUEST['status'];

        $update = "UPDATE users SET status='$status' WHERE email='$email'";
        $run = mysqli_query($conn, $update);

        if ($run) {
            echo "success";
        } else {
            echo "failed";
        }
    } elseif ($action == "changeaction") {
        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];

        $update = "UPDATE crime_report SET status='$status' WHERE crid='$id'";
        $run = mysqli_query($conn, $update);

        if ($run) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
