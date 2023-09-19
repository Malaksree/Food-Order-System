<?php include('part/menu.php'); ?>
<!-----Main session start---->
        <div class="main">
            <div class="wrapper">
                <h1> Manage Order </h1><br><br>
                <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                ?>
                <br><br>
                

                <table class="tablefull">
                    <tr>
                        <th>S.No</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order date</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $sno=1;
                    //get data from database
                    $sql="SELECT * FROM `order`";
                    $res=mysqli_query($mysqli,$sql);
                    $count=mysqli_num_rows($res);
                    if($count>0)
                    {
                        //order available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $food=$row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $total=$row['total'];
                            $orderdate=$row['orderdate'];
                            $status=$row['status'];
                            $name=$row['customername'];
                            $contact=$row['customercontact'];
                            $email=$row['customeremail'];
                            $address=$row['customeraddress'];
                            ?>
                            <tr>
                                <td><?php echo $sno++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $orderdate; ?></td>
                                <td><?php
                                        if($status=="Ordered"){
                                            echo "<label>$status</label>";
                                        }
                                        elseif($status=="On delivery")
                                        {
                                            echo "<label style='color:blue;'>$status</label>";
                                        } 
                                        elseif($status=="Delivered")
                                        {
                                            echo "<label style='color:Green;'>$status</label>";
                                        }
                                        elseif($status=="Cancelled"){
                                            echo "<label style='color:red;'>$status</label>";
                                        }?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $contact; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $address; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/updateorder.php?id=<?php echo $id; ?>" class="btn-second">Update Order</a>

                                </td>
                            </tr>
                    <?php
                        }
                    }
                    else{
                        //order not available
                        echo "<tr><td colspan='12' class='error'>Order Not Available</tr>";
                    }
                    ?>
                    
                    
                </table>
                
            </div>
        </div>
        <!-----Main session end---->
<?php include('part/footer.php'); ?>