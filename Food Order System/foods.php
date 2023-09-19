<?php include('partfront/menu.php'); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <section class="food-menu">
                <div class="container">
                     <h2 class="text-center">Food Menu</h2>
    <?php
    $sql="SELECT * FROM food WHERE active='yes'";
    $res=mysqli_query($mysqli,$sql);
    $count=mysqli_num_rows($res);
    if($count>0)
    {
        //foods diplay
        while($row=mysqli_fetch_assoc($res))
        {
            $id=$row['id'];
            $title=$row['title'];
            $description=$row['description'];
            $price=$row['price'];
            $imagename=$row['imagename'];
            ?>
             <!-- fOOD MEnu Section Starts Here -->
            
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
        echo "<div class='error'>Foods Not Found</div>";
    }

    ?>
   

            

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partfront/footer.php'); ?>