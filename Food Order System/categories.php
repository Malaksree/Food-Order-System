<?php include('partfront/menu.php'); ?>
 <!-- fOOD sEARCH Section Starts Here -->
 <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php SITEURL; ?>category-foods.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    
<!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
        <?php
            $sql="SELECT * FROM category WHERE active='Yes'";
            $res=mysqli_query($mysqli,$sql);
            $count=mysqli_num_rows($res);
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id=$row['id'];
                    $title=$row['title'];
                    $imagename=$row['imagename'];
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

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
            <?php
                            }
                }
            }
            else{
                //display error message for category not found
                echo "<div class='error'>Categories Not Found</div>";
            }
        ?>
            
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
<?php include('partfront/footer.php'); ?>
