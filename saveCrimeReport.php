<?php
session_start();
if(!isset($_SESSION['EmailUser'])){
    header('location:user-login.php');
    exit();
}

