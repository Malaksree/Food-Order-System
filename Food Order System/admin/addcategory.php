<?php include('part/menu.php');?>

<div class="main">
    <div class="wrapper">
        <h1>Add Category</h1><br/><br/>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tableadd">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Enter Category Title"></td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                </td>
                </tr>              
                <tr>
                    <td>active</td>
                    <td><input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-second">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        //check whether submit button
        if(isset($_POST['submit']))
        {
            //button clicked 
            //echo "button clicked";
            //get the value from form
            $title=$_POST['title'];
            //radio button value to check 
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
            if(isset($_FILES['image']['name']))
            {
                //Image upload successfully
                $imagename=$_FILES['image']['name'];
                if($imagename!=""){
                    $ex=explode('.',$imagename);
                    $ext=end($ex);
                    $imagename="Food_category_".rand(000,999).'.'.$ext;

                    $source_file=$_FILES['image']['tmp_name'];
                    $destination_path="../image/category/".$imagename;
                    //finally upload file
                    $upload=move_uploaded_file($source_file,$destination_path);
                    if($upload==FALSE)
                    {

                        $_SESSION['upload']="<div class='error'>Failed to Upload image</div>";
                        header('location:'.SITEURL.'admin/addcategory.php');
                        die();
                    
                    }

                }
                

            }
            else{
                 //image not upload
                $imagename="";

            }
            //create sql query to insert category
            $sql="INSERT INTO  category SET title='$title',imagename='$imagename',
                                        featured='$featured',active='$active'
                                        ";

            $res=mysqli_query($mysqli,$sql);
            if($res==TRUE)
            {
                //Category to be added
                $_SESSION['add']="<div class='success'>Add Category Successfully</div>"; 
                header('location:'.SITEURL.'admin/managecategory.php');

            }
            else{
                //failed add category
                $_SESSION['add']="<div class='error'>Add Category Failed</div>"; 
                header('location:'.SITEURL.'admin/addcategory.php');

            }


        }
        
        ?>
    </div>
</div>

    
<?php include('part/footer.php'); ?>