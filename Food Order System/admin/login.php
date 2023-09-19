<?php include('../database/database.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Food Order Login System</title>
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
        <div class="login">
            <h1>Login</h1>
            <br/><br/>
            <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);

            }
            if(isset($_SESSION['no-loginmsg'])){
                echo $_SESSION['no-loginmsg'];
                unset($_SESSION['no-loginmsg']);

            }
            ?>
            <div class="logincontent">
                <form action="" method="post" class="forms">

                    <input type="text" name="username" placeholder="Enter UserName">
                    
                    <input type="password" name="password" placeholder="Enter Password">
                    <input type="submit" name="submit" value="LOGIN" class="button">

                </form>
            </div>
        </div>
        <?php
        //check click button yes or not
        if(isset($_POST['submit']))
        {
            $username=mysqli_real_escape_string($mysqli,$_POST['username']);
            $password=md5($_POST['password']);
            //check username and password sql query
            $sql="SELECT * FROM admin WHERE username='$username' AND password='$password'";
            $res=mysqli_query($mysqli,$sql);
            $count=mysqli_num_rows($res);
            echo $count;
            if($count==1){
                //user available
                $_SESSION['login']="<div class='success'>Login Successful</div>";
                $_SESSION['user']=$username;
                header('location:'.SITEURL.'admin/');
            }
            else{
                //user not available
                $_SESSION['login']="<div class='error'>Username or password did not matched,try again</div>";
                header('location:'.SITEURL.'admin/login.php');
            }

        }
        ?>
    </body>
</html>