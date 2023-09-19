<?php include('part/menu.php');?>
<div class="main">
    <div class="wrapper">
        <h1> Update Food </h1><br/><br/>
        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            //Select query 
            $sql="SELECT * FROM food WHERE id=$id";
            $res=mysqli_query($mysqli,$sql);
            $count=mysqli_num_rows($res);
            if($count>0){
                //get all data
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $description=$row['description'];
                $price=$row['price'];
                $currentimage=$row['imagename'];
                $categoryid=$row['categoryid'];
                $featured=$row['featured'];
                $active=$row['active'];

            }
            else{
                //redirect to manage category
                $_SESSION['no-food']="<div class='error'>Food not founded</div>";
                header('location:'.SITEURL.'admin/managefood.php');
            }

        }
        else{
            //redirect to manage category
            header('location:'.SITEURL.'admin/managefood.php');
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
                <table class="tableadd">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="number" name="price" value="<?php echo $price;?>"></td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td><?php
                            if($currentimage!=""){?>
                            <img src="<?php echo SITEURL;?>image/food/<?php echo $currentimage;?>" width="100px" height="100px">
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
                    <tr><td>Category</td>
                <td><select name="category">
                    <?php
                    //1.create sql to get all active data
                    $sql="SELECT * FROM category WHERE active='Yes'";
                    $res=mysqli_query($mysqli,$sql);
                    $count=mysqli_num_rows($res);
                    if($count>0){
                        //Available category
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $categoryid=$rows['id'];
                            $categorytitle=$rows['title'];
                            ?>
                             <option value="<?php echo $categoryid; ?>"><?php echo $categorytitle; ?></option>
                            <?php
                        }
                    }
                    else{
                        //category is not available
                        ?>
                        <option value="0">No category Founded</option>
                        <?php
                    }
                    //2.display on the dropdownbox
                    ?>
                   
                    </select></td>
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
                            $imagename="Food_Name_".rand(0000,9999).'.'.$ext;

                            $source_file=$_FILES['image']['tmp_name'];
                            $destination_path="../image/food/".$imagename;
                            //finally upload file
                            $upload=move_uploaded_file($source_file,$destination_path);
                            if($upload==false)
                            {

                                 $_SESSION['upload']="<div class='error'>Failed to Upload image</div>";
                                 header('location:'.SITEURL.'admin/managefood.php');
                                die();
                    
                            }

                        }
                            //remove curremt image
                            if($currentimage!="")
                            {
                            
                                 //remove current image
                                $removepath="../image/food/".$currentimage;
                                $remove=unlink($removepath);
                                //check image remove or not
                                //if image not remove display error message
                                if($remove==false){
                                    $_SESSION['remove-failed']="<div class='error'>Failed to remove current image</div>";
                                    header('location:'.SITEURL.'admin/managefood.php');
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
                    $update="UPDATE food SET title='$title',description='$description',price='$price',imagename='$imagename',categoryid='$categoryid',featured='$featured',active='$active' WHERE id=$id";
                    //executed query
                    $result=mysqli_query($mysqli,$update);
                    //check execute query
                    if($result==TRUE){
                        //Update data successfully
                        $_SESSION['update']="<div class='success'>Update Food Successfully</div>";
                        header('location:'.SITEURL.'admin/managefood.php');
                    }
                    else{
                        //Failed data update
                        $_SESSION['update']="<div class='error'>Failed Update Food </div>";
                        header('location:'.SITEURL.'admin/updatefood.php');

                    }

                }
                ?>
    </div>
</div>
<?php include('part/footer.php');?>
