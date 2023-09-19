<?php
include('part/menu.php');?>
<div class="main">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br/><br/>
        <?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];

        }
        ?>
        <form action="" method="post">
            <table class="tableadd">
                <tr>
                    <td>Current Password</td>
                    <td><input type="text" name="current" placeholder="Old Password"></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="text" name="new" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <input type="submit" name="submit" value="Change Password" class="btn-second">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['submit']))
{
    //get data from form
    $id=$_POST['id'];
    $current=md5($_POST['current']);
    $new=md5($_POST['new']);
    $confirm=md5($_POST['confirm']);
    $sql="SELECT * FROM admin WHERE id=$id AND password='$current'";
    $res=mysqli_query($mysqli,$sql);
    if($res==TRUE){
        $count=mysqli_num_rows($res);
        if($count>0)
        {
            //Admin can change Password
            //echo "Üser Found";
            if($new==$confirm){
                //password updated
                $update="UPDATE admin SET password='$new' WHERE id=$id";
                //query execute
                $result=mysqli_query($mysqli,$update);
                //check query
                if($result==TRUE)
                {
                    //display password change message
                   
                    $_SESSION['change-pwd']="<div class='success'>Password change Successfully</div>";
                    header("location:".SITEURL.'admin/manageadmin.php');
                }
                else{
                    //display error message
                    $_SESSION['change-pwd']="<div class='error'>Failed Password Change</div>";
                    header("location:".SITEURL.'admin/manageadmin.php');
                    
                }

            }
            else{
                //password not updated
                $_SESSION['pwd-not-match']="<div class='error'>Password does not match</div>";
                header("location:".SITEURL.'admin/manageadmin.php');

                }
        }
        else{
            //Does not change Password
            $_SESSION['not-found']="<div class='error'>User not Found</div>";
            header("location:".SITEURL.'admin/manageadmin.php');
            }
    }
}
?>
<?php include('part/footer.php');?>