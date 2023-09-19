<?php include('part/menu.php');?>
<div class="main">
    <div class="wrapper">
        <h1> Update Order </h1><br/><br/>
        <?php
        //get id to set or not
        if(isset($_GET['id']))
        {
            //get order details
            $id=$_GET['id'];
            //get all order details
            //sql query
            $sql="SELECT * FROM `order` WHERE `id`=$id";
            $res=mysqli_query($mysqli,$sql);
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                //data is available
                $row=mysqli_fetch_assoc($res);
                $food=$row['food'];
                $price=$row['price'];
                $qty=$row['qty'];
                $status=$row['status'];
                $name=$row['customername'];
                $contact=$row['customercontact'];
                $email=$row['customeremail'];
                $address=$row['customeraddress'];
              
            }
            else{
                //data not founded
                //redirect to manage order page
                header('location:'.SITEURL.'admin/manageorder.php');
            }
        }
        else{
            //redirect manage order
            header('location:'.SITEURL.'admin/manageorder.php');
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
                <table class="tableadd">
                    <tr>
                        <td>Food Name</td>
                        <td><b><?php echo $food;?></b></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><b>₹<?php echo $price;?></b></td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td><input type="number" name="qty" value="<?php echo $qty;?>"></td>
                    </tr>
                    
                    <tr>
                        <td>Status</td>
                        <td><select name="status">
                            <option  <?php if($status=="Ordered"){ echo "selected";}?>value="Ordered">Ordered</option>
                            <option <?php if($status=="On delivery"){ echo "selected";}?>value="On delivery">On delivery</option>
                            <option <?php if($status=="Delivered"){ echo "selected";}?>value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){ echo "selected";}?>value="Cancelled">Cancelled</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td><input type="text" name="name" value="<?php echo $name;?>"></td>
                    </tr>
                    <tr>
                        <td>Customer Contact</td>
                        <td><input type="number" name="contact" value="<?php echo $contact;?>"></td>
                    </tr>
                    <tr>
                        <td>Customer Email</td>
                        <td><input type="text" name="email" value="<?php echo $email;?>"></td>
                    </tr>
                    <tr>
                        <td>Customer Address</td>
                        <td><textarea name="address" cols="30" rows="5"><?php echo $address;?></textarea></td>
                    </tr>
                    
                    <tr>
                        
                        <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">    
                        <input type="submit" name="submit" value="Update Order" class="btn-second"></td>
                    </tr>
                </table>
                <?php
                //check whether button has clicked or not
                if(isset($_POST['submit']))
                {
                    //button clicked
                    //echo "button clicked";
                    $id=$_POST['id'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $total=$price*$qty;
                    $status=$_POST['status'];
                    $name=$_POST['name'];
                    $contact=$_POST['contact'];
                    $email=$_POST['email'];
                    $address=$_POST['address'];
                    //sql query
                    $sqls="UPDATE `order` SET `qty`=$qty,`total`=$total,`status`='$status',`customername`='$name',`customercontact`=$contact,`customeremail`='$email',`customeraddress`='$address' WHERE `id`=$id";
                    $result=mysqli_query($mysqli,$sqls);
                    if($result==true)
                    {
                        //update
                        $_SESSION['update']="<div class='success'>Update order successfully</div>";
                        header('location:'.SITEURL.'admin/manageorder.php');

                    }
                    else{
                        //not update
                        $_SESSION['update']="<div class='error'>Failed Update order </div>";
                        header('location:'.SITEURL.'admin/manageorder.php');
                    }

                }
                
                ?>
        </form>
    </div>
</div>
<?php include('part/footer.php');?>