<?php include('../database/database.php');
include('logincheck.php'); ?>

<html>
    <head>
        <title>Online Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <!-----Menu session start---->
        <div class="menu text-content">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manageadmin.php">Admin</a></li>
                    <li><a href="managecategory.php">Category</a></li>
                    <li><a href="managefood.php">Food</a></li>
                    <li><a href="manageorder.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>