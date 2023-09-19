<?php
//include database file
include('../database/database.php');

//get id to the admin
$id=$_GET['id'];
//sql delete query
$sql="DELETE FROM admin WHERE id=$id";
//execute sql Query
$res=mysqli_query($mysqli,$sql);
//check delete query execute or not
if($res==TRUE)
{
    //echo "Admin Deleted";
    $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
    header("location:".SITEURL.'admin/manageadmin.php');
    }
else{
        echo "Data is not inserted";
        $_SESSION['delete']="<div class='error'>Failed to Delete Admin.Try Again Later</div>";
        header("location:".SITEURL.'admin/deleteadmin.php');;
}

?>