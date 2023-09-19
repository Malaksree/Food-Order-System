<?php
//authontication checked
if(!isset($_SESSION['user']))
{
    //user is not login 
    $_SESSION['no-loginmsg']="<div class='error'>Please login to access Admin panel</div>";
    header('location:'.SITEURL.'admin/login.php');
}
?>