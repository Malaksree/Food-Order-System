<?php include('part/menu.php'); ?>
<div class="main">
    <div class="wrapper">
        <h1>Manage Category</h1><br/><br/>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['nocategory']))
        {
            echo $_SESSION['nocategory'];
            unset($_SESSION['nocategory']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['remove-failed']))
        {
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }
        ?><br/><br/>
                <a href="<?php echo SITEURL;?>admin/addcategory.php" class="btn-add">Add Category</a><br/><br/>

                <table class="tablefull">
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>Image Name</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $sql="SELECT * FROM category";
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
                                $title=$row['title'];
                                $imagename=$row['imagename'];
                                $featured=$row['featured'];
                                $active=$row['active'];
                            ?>
                            
                    <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php 
                                if($imagename!=""){
                                    //Display image
                                    ?>
                                    <img src="<?php echo SITEURL;?>image/category/<?php echo $imagename;?>" width="100px" height="100px">
                                    <?php
                                }
                                else{
                                    //display not image only show error message
                                    echo "<div class='error'>Image not added.</div>";
                                }
                            ?></td>
                        
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/updatecategory.php?id=<?php echo $id;?>" class="btn-second">Update Category</a>
                            <a href="<?php echo SITEURL;?>admin/deletecategory.php?id=<?php echo $id;?>&imagename=<?php echo $imagename;?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                    
                    <?php
                            }
                        }
                        else{
                            //we do not data in the database
                            ?>
                            <tr>
                                <td colspan="6"><div class="error">No Category Added</div></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    
                    
                   
                </table>
    </div>
</div>
<?php include('part/footer.php'); ?>