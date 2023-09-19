<?php include('partfront/menu.php'); ?>
<?php
//check id get or not 
if(isset($_GET['foodid']))
{
    $footid=$_GET['foodid'];
    $sql="SELECT * FROM food WHERE id='$footid'";
    $res=mysqli_query($mysqli,$sql);
    $count=mysqli_num_rows($res);
    if($count==1)
    {
        //data have done
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $imagename=$row['imagename'];
    }
    else{
        //redirect home page
        header('location:'.SITEURL);
    }
}
else{
    //redirect to home page
    header('location:'.SITEURL);
}
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if($imagename=="")
                        {
                            //image not available
                            echo "<div class='error'>Image not found</div>";
                        }
                        else{
                            //image available image display?>
                            <img src="<?php echo SITEURL;?>image/food/<?php echo $imagename; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">₹<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Name</div>
                    <input type="text" name="name" placeholder="E.g. Mala" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@mala.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            if(isset($_POST['submit']))
            {
                $food=$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price*$qty;
                $orderdate=date("Y-m-d h:i:s");
                $status="Ordered";//to maintain status for Ordered,Delivery,Cancelled
                $cname=$_POST['name'];
                $ccontact=$_POST['contact'];  
                $email=$_POST['email'];
                $address=$_POST['address'];
                //get data to save on databae
                $sql2="INSERT INTO `order` SET `food`='$food',
                                            `price`='$price',
                                            `qty`='$qty',
                                            `total`='$total',
                                            `orderdate`='$orderdate',
                                            `status`='$status',
                                            `customername`='$cname',
                                            `customercontact`='$ccontact',
                                            `customeremail`='$email',
                                            `customeraddress`='$address'";
                //echo $sql2;
                //execute the query
                $results=mysqli_query($mysqli,$sql2) or die(mysqli_error($mysqli));
                 //print_r($results) ;
                
                 //query execute checking process
                  if($results==true)
                   {
                       //orader hasbeen saved on database
                       $_SESSION['order']="<div class='success text-center'>Order Placed Successfully</div>";
                       header('location:'.SITEURL);
                   }
                   else{
                     //failed order
                        $_SESSION['order']="<div class='error'>Failed Food Order</div> ";
                        header('location:'.SITEURL);
                    }
              }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php include('partfront/footer.php'); ?>
   