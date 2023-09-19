<?php
//include database file
include('../database/database.php');

//get id to the category
$id=$_GET['id'];
$imagename=$_GET['imagename'];
if(isset($id) AND isset($imagename))
{
    if($imagename!=""){
        $path="../image/category/".$imagename;
        $remove=unlink($path);
        if($remove==false){
            $_SESSION['remove']="<div class='error'>Failed to remove category image</div>";
            header("location:".SITEURL.'admin/managecategory.php');
            die();
        }
    }
    //sql delete query
    $sql="DELETE FROM category WHERE id=$id";
    //execute sql Query
    $res=mysqli_query($mysqli,$sql);
    //check delete query execute or not
    if($res==TRUE)
    {
        //echo "Category Deleted";
        $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";
        header("location:".SITEURL.'admin/managecategory.php');
    }
    else{
        echo "Data is not inserted";
        $_SESSION['delete']="<div class='error'>Failed to Delete Category.Try Again Later</div>";
        header("location:".SITEURL.'admin/deletecategory.php');;
    }


}
else{
    //redirect file
    header('loaction:'.SITEURL.'admin/managecategory.php');

}


?>