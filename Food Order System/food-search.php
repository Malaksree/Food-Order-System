<?php include('partfront/menu.php'); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                    $search=mysqli_real_escape_string($mysqli,$_POST['search']);
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                
                $sql="SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                $result=mysqli_query($mysqli,$sql);
                $count=mysqli_num_rows($result);
                if($count>0)
                {
                    //available food
                    while($row=mysqli_fetch_assoc($result))
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
                                //display image not message
                                echo "<div class='error'>Image NOt Founded</div>";
                            }
                            else{
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>image/food/<?php echo $imagename; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">₹<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>.
                                </p>
                                <br>

                                <a href="" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                            }
                    }
                }
                else{
                    //search food not available
                    echo "<div class='error'>Search Food Not Available</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partfront/footer.php'); ?>