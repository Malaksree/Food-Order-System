<?php include('part/menu.php'); ?>
<div class="main">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="post">
            <table class="tableadd">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Enter Your UserName"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="pwd" placeholder="Enter Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="ADD" class="btn-second">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('part/footer.php'); ?>
<?php 
//Processing for Database concept
//check the submit value
if(isset($_POST['submit']))
{
    //botton clicked
    $Name=$_POST['name'];
    $Username=$_POST['username'];
    $Password=md5($_POST['pwd']);   //password Encrypted with md5
    //SQL Query
    $result=mysqli_query($mysqli,"INSERT INTO admin SET name='$Name',username='$Username',password='$Password'") or die(mysqli_error($mysqli));
    
    //execute query to save data
   
    
    if($result==TRUE)
    {
        echo "Data is inserted";
        //session creation
        $_SESSION['add']="<div class='success'>Add Admin Successfully</div>";
        header("location:".SITEURL.'admin/manageadmin.php');
    }
    else{
        echo "Data is not inserted";
        $_SESSION['add']="<div class='error'>Failed to add Admin</div>";
        header("location:".SITEURL.'admin/addadmin.php');
    }
    
}
else{
    //botton not clicked
}
?>