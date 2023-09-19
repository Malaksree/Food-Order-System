<?php include('part/menu.php');?>

<div class="main">
    <div class="wrapper">
        <h1>Add Food</h1><br/><br/>
        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['add']))
        {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
        <table class="tableadd">
            <tr><td>Title</td>
                <td><input type="text" name="title" placeholder="Title of the food"></td>
            </tr>
            <tr><td>Description</td>
                <td><textarea name="description" cols="30" rows="5" placeholder="Description of food"></textarea></td>
            </tr>
            <tr><td>Price</td>
                <td><input type="number" name="price" placeholder="Enter Price"></td>
            </tr>
            <tr><td>Select Image</td>
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
                            $id=$rows['id'];
                            $title=$rows['title'];
                            ?>
                             <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
            <tr><td>Featured</td>
                <td><input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr><td>Active</td>
                <td><input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No</td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Add FOOD" class="btn-second"></td>
            </tr>
            
        </table>
        </form>
    <?php
    //check button has clicked or not
    if(isset($_POST['submit']))
    {
        //data has inserted
        // echo "button has clicked";
        //1.get data from the form
        //$id=$_GET['id'];
        
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $category=$_POST['category'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];
        //check radio button featured and active
        if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else{
                $featured="No";
            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else{
                $active="No";
            }
          
        //2.upload the image if selected
            

          //echo $imagename;
              if(isset($_FILES['image']['name']))
                {
                    //Image upload successfully
                    $imagename=$_FILES['image']['name'];
                    if($imagename!=""){
                        $ex=explode('.',$imagename);
                        $ext=strtolower(end($ex));
                        $imagename="Food_Name_".rand(0000,9999).'.'.$ext;
                        $folder=$_FILES['image']['tmp_name'];
                        $src="../image/food/".$imagename;
                        //finally upload file
                        $upload=move_uploaded_file($folder,$src);
            
               if($upload==FALSE)
                        {

                            $_SESSION['upload']="<div class='error'>Failed to Upload image</div>";
                            header('location:'.SITEURL.'admin/addfood.php');
                            die();
                    
                        }

                    }
            
                }
                else{
                     //image not upload
                    $imagename="";

                }
           
         // //3.insert data
            $sql1="INSERT INTO food SET title='$title',description='$description',price='$price',imagename='$imagename',categoryid='$category',featured='$featured',active='$active'";
            $result=mysqli_query($mysqli,$sql1);
           //4.redirect page 
            if($result==TRUE)
            {
                //data has been stored
                $_SESSION['add']="<div class='success'>Add Food Successfully</div>"; 
                header('location:'.SITEURL.'admin/managefood.php');
            }
            else{
                //data inserted failed
                $_SESSION['add']="<div class='error'>Add Food Failed</div>"; 
                header('location:'.SITEURL.'admin/addfood.php');
            }
    }
    
    ?>
    </div>
</div>
<?php include('part/footer.php');