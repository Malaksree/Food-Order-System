<html>
    <head>
        <title>Online Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <?php include('part/menu.php'); ?>
        <!-----Main session start---->
        <div class="main">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);

            }
            ?>
            <br/><br/>
                <div class="cols-4 text-content">
                    <?php
                    $sql1="SELECT * FROM `category`";
                    $res1=mysqli_query($mysqli,$sql1);
                    $count1=mysqli_num_rows($res1);?>
                    <h1><?php echo $count1;?></h1><br>
                    Catagories
                </div>
                <div class="cols-4 text-content">
                    <?php
                    $sql2="SELECT * FROM `food`";
                    $res2=mysqli_query($mysqli,$sql2);
                    $count2=mysqli_num_rows($res2);?>
                    <h1><?php echo $count2;?></h1><br>
                    Foods
                </div>
                <div class="cols-4 text-content">
                    <?php 
                    $sql3="SELECT *FROM `order`";
                    $res3=mysqli_query($mysqli,$sql3);
                    $count3=mysqli_num_rows($res3);?>
                    
                    <h1><?php echo $count3;?></h1><br/>
                    Total Order
                </div>
                <div class="cols-4 text-content">
                    <?php
                        //aggregate funtion to sql
                        $sql4="SELECT sum(total) AS Total FROM `order` WHERE status='Delivered'";
                        $res4=mysqli_query($mysqli,$sql4);
                        $row4=mysqli_fetch_assoc($res4);
                        $total=$row4['Total'];
                    ?>
                    <h1>₹<?php echo $total;?></h1>
                    <br/>
                    Revenue Generated
                </div>
                <div class="clear-fix">
                </div>
            </div>
        </div>
        <!-----Main session end---->
       <?php include('part/footer.php'); ?>
</body>
</html>