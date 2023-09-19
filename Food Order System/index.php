  

<?php include('partfront/menu.php'); ?>
    <!---fOOD SEARCH Section Starts Here---->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!----fOOD sEARCH Section Ends Here -------->
    <?php
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>

    <!-----Categories Section Starts Here------> 
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            $sql="SELECT * FROM category WHERE active='Yes' and featured='Yes' LIMIT 3";
            $res=mysqli_query($mysqli,$sql);
            $count=mysqli_num_rows($res);
            if($count>0)
            {
                //category available
                while($rows=mysqli_fetch_assoc($res))
                {
                    $id=$rows['id'];
                    $title=$rows['title'];
                    $imagename=$rows['imagename'];
                    ?>
                    <a href="<?php echo SITEURL;?>category-foods.php?categoryid=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            if($imagename=="")
                            {
                                //display image not message
                                echo "<div class='error'>Image NOt Founded</div>";
                            }
                            else{
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>image/category/<?php echo $imagename; ?>" alt="Pizza" class="img-responsive img-curve">


                                <?php
                            }
                            ?>
                                
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

            
                   

                    <?php
                }

            }
            else{
                //category not available
                echo "<div class='error'>Category Not available</div>";
            }
            ?>
    <div class="clearfix"></div>
    </div>
</section>
            
    <!-----Categories Section Ends Here---->

    <!----fOOD MEnu Section Starts Here----->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            //sql query
            $sql1="SELECT * FROM food WHERE active='Yes' AND featured='Yes'LIMIT 6";
            $res1=mysqli_query($mysqli,$sql1);
            $count=mysqli_num_rows($res1);
            if($count>0)
            {
                //available food
                while($row=mysqli_fetch_assoc($res1))
                {
                    $id=$row['id'];
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $imagename=$row['imagename'];
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
                //not available message
                echo "<div class='error'>Food Not Available</div>";
            }
            ?>

            
            
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    
    

<?php include('partfront/footer.php'); ?>