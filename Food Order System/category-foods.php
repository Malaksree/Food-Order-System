<?php include('partfront/menu.php'); ?>
<?php 
    if(isset($_GET['categoryid']))
    {
        $categoryid=$_GET['categoryid'];
        $sql="SELECT * FROM category WHERE id=$categoryid";
        $res=mysqli_query($mysqli,$sql);
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
    }
    else{
        header('location:'.SITEURL);
    }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql1="SELECT * FROM food WHERE categoryid=$categoryid";
                $result=mysqli_query($mysqli,$sql1);
                $count=mysqli_num_rows($result);
                if($count>0)
                {
                    //display  search data
                    while($rows=mysqli_fetch_assoc($result))
                    {
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $price=$rows['price'];
                        $description=$rows['description'];
                        $imagename=$rows['imagename'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php
                            if($imagename=="")
                            {
                                //image not found
                                echo "<div class='error'>Image not Found</div>";
                            }
                            else{
                                //image display
                                ?>
                                <img src="<?php echo SITEURL; ?>image/food/<?php echo $imagename; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">₹<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL;?>order.php?foodid=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else{
                    //display error message
                    echo "<div class='error'>Food Not Found</div>";
                }
            ?>

            

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partfront/footer.php'); ?>