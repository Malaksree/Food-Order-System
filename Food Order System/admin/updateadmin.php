<?php include('part/menu.php');
error_reporting(0);?>
<div class="main">
            <div class="wrapper">
                <h1> Update Admin </h1><br/><br/>
                <?php
                //get selected Admin id
                $id=$_GET['id'];
                //select sql query
                $sql="SELECT * FROM admin WHERE id=$id";
                //execute query
                $res=mysqli_query($mysqli,$sql);
                //check Query
                if($res==TRUE)
                {
                    //we have data in the database
                    $count=mysqli_num_rows($res);
                    if($count==1)
                    {
                       
                        $row=mysqli_fetch_assoc($res);
                        
                            $name=$row['name'];
                            $username=$row['username'];

                        
                       
                    }
                    else{
                        header("location:".SITEURL.'admin/manageadmin.php');
                    }

                }
                else{
                    //we do not data in the database
                }

                ?>
                <form action="" method="post">
                <table class="tableadd">
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name" value="<?php echo $name;?>"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" value="<?php echo $username;?>"></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="hidden" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update" class="btn-second">
                        </td>
                    </tr>
                </table>
                </form>
            </div>
</div>
<?php
if(isset($_POST['submit'])){
    $id=$_GET['id'];
    $name=$_POST['name'];
    $username=$_POST['username'];
    //create to update query
    $sql="UPDATE admin SET name='$name',username='$username' WHERE id='$id'
    ";
    $result=mysqli_query($mysqli,$sql);
    echo $sql;
    if($result==TRUE)
    {
        //data to be successfully updated 
        echo $result;
        $_SESSION['update']="<div class='success'>Update Admin Successfully</div>";
        header("location:".SITEURL.'admin/manageadmin.php');
    }
    else{
        //data not updated query
        $_SESSION['update']="<div class='error'>Failed to add Admin</div>";
        header("location:".SITEURL.'admin/updateadmin.php');
    }

}
else{
    //some error in submit
}
?>
<?php include('part/footer.php');?>
