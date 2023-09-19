<?php include('part/menu.php');?>
<div class="main">
    <div class="wrapper">
        <h1> Update Category </h1><br/><br/>
        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            //Select query 
            $sql="SELECT * FROM category WHERE id='$id'";
            $res=mysqli_query($mysqli,$sql);
            $count=mysqli_num_rows($res);
            if($count==1){
                //get all data
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $currentimage=$row['imagename'];
                $featured=$row['featured'];
                $active=$row['active'];

            }
            else{
                //redirect to manage category
                $_SESSION['no-category']="<div class='error'>Category not founded</div>";
                header('location:'.SITEURL.'admin/managecatogory.php');
            }

        }
        else{
            //redirect to manage category
            header('location:'.SITEURL.'admin/managecategory.php');
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
                <table class="tableadd">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td><?php
                            if($currentimage!=""){?>
                            <img src="<?php echo SITEURL;?>image/category/<?php echo $currentimage;?>" width="100px" height="100px">
                            <?php

                            }
                            else{
                                //Display error message
                                echo "<div class='error'>Image not added</div>";
                            }
                        ?></td>
                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td><input <?php if($featured=="Yes"){ echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){ echo "checked";}?> type="radio" name="featured" value="No">No</td>
                    </tr>
                    <tr>
                        <td>Actice</td>
                        <td><input <?php if($active=="Yes"){ echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){ echo "checked";}?> type="radio" name="active" value="No">No</td>
                    </tr>
                    
                    <tr>
                        <td colspan="5">
                            <input type="hidden" name="currentimage" value="<?php echo $currentimage;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update" class="btn-second">
                        </td>
                    </tr>
                </table>
                </form>
                <?php
                if(isset($_POST['submit'])){
                    //Button has be Clicked
                    //1.Get all values from form
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $currentimage=$_POST['currentimage'];
                    $featured=$_POST['featured'];
                    $active=$_POST['active'];
                    //update new image
                    if(isset($_FILES['image']['name'])){
                        $imagename=$_FILES['image']['name'];
                        //check image available or not
                        //upload image
                        if($imagename!=""){
                            //image available
                            $ex=explode('.',$imagename);
                            $ext=end($ex);
                            $imagename="Food_category_".rand(000,999).'.'.$ext;

                            $source_file=$_FILES['image']['tmp_name'];
                            $destination_path="../image/category/".$imagename;
                            //finally upload file
                            $upload=move_uploaded_file($source_file,$destination_path);
                            if($upload==false)
                            {

                                 $_SESSION['upload']="<div class='error'>Failed to Upload image</div>";
                                 header('location:'.SITEURL.'admin/managecategory.php');
                                die();
                    
                            }

                        }
                        //remove curremt image
                        if($currentimage!="")
                        {
                            
                            //remove current image
                            $removepath="../image/category/".$currentimage;
                            $remove=unlink($removepath);
                                //check image remove or not
                            //if image not remove display error message
                            if($remove==false){
                                $_SESSION['remove-failed']="<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/managecategory.php');
                                die(); 

                             }

                        }
                        else{
                                $imagename=$currentimage;
                            }
                        

                    }
                    else{
                        $imagename=$currentimage;

                    }
                    //3.update query
                    $update="UPDATE category SET title='$title',imagename='$imagename',featured='$featured',active='$active' WHERE id=$id";
                    //executed query
                    $result=mysqli_query($mysqli,$update);
                    //check execute query
                    if($result==TRUE){
                        //Update data successfully
                        $_SESSION['update']="<div class='success'>Update Category Successfully</div>";
                        header('location:'.SITEURL.'admin/managecategory.php');
                    }
                    else{
                        //Failed data update
                        $_SESSION['update']="<div class='error'>Failed Update Category </div>";
                        header('location:'.SITEURL.'admin/updatecategory.php');

                    }

                }
                ?>
    </div>
</div>
<?php include('part/footer.php');?>
