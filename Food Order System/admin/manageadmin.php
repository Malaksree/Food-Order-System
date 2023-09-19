<?php include('part/menu.php'); ?>
<!-----Main session start---->
        <div class="main">
            <div class="wrapper">
                <h1>Manage Admin</h1><br/>
                <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['not-found']))
                {
                    echo $_SESSION['not-found'];
                    unset($_SESSION['not-found']);
                }
                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
                ?>
                <br/><br/><br/>



                <a href="addadmin.php" class="btn-add">Add Admin</a><br/><br/>

                <table class="tablefull">
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $sql="SELECT * FROM admin";
                    $result=mysqli_query($mysqli,$sql);
                    $sno=1;
                    if($result==TRUE)
                    {
                        $count=mysqli_num_rows($result);
                        if($count>0)
                        {
                            //we have data in the database
                            while($row=mysqli_fetch_assoc($result))
                            {
                                $id=$row['id'];
                                $name=$row['name'];
                                $username=$row['username'];
                            ?>
                            <tr>
                                <td><?php echo $sno++;?></td>
                                <td><?php echo $name;?></td>
                                <td><?php echo $username;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/updatepassword.php?id=<?php echo $id;?>" class="btn-add">Change Password</a>
                                    <a href="<?php echo SITEURL;?>admin/updateadmin.php?id=<?php echo $id;?>" class="btn-second">Update Admin</a>
                                    <a href="<?php echo SITEURL;?>admin/deleteadmin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>



                            <?php
                            }
                        }
                        else{
                            //we do not data in the database
                        }
                    }
                    ?>
                    
                    </table>
                
            </div>
        </div>
        <!-----Main session end---->
<?php include('part/footer.php'); ?>