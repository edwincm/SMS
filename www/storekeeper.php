<?php
    session_start();
    require("config.php");
    //CREATE QUERY
    $query="SELECT * FROM item;";
    //GET RESULT
    $result=mysqli_query($conn,$query);
    //FETCH DATA 
    $details=mysqli_fetch_all($result,MYSQLI_ASSOC);
    //FREE RESULT
    mysqli_free_result($result); 
    //CLOSE CONNECTION 
    mysqli_close($conn);
?>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1"/>
        <title>STOREKEEPER</title>
        <link rel="stylesheet" href="design.css"/>
    </head>
    <body>
        <nav class="navbar">
            <ul>
                <li><div id="name"><?php echo $_SESSION['name'];?></div></li>
                <li><a href="index.php" name="logout">Logout</a></li>
            </ul>
        </nav>
        <form method="POST" action="#">
            <div id="middle_left">
                <div>
                    <label>#ID</label>
                    <input type="integer" name="barcode" autofocus="" maxlength="8" required="">
                    <input type="submit" name="enter" value="Enter">
                </div>  
            </div>
        </form>
        <div id="table_position">
            <div>
                <table cellspacing="5px" cellpadding="5px" frame="border" rules="all">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>Unit Price</th>
                            <th>QUANTITY</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                            if(!isset($_POST['pay'])){
                               if(isset($_POST['enter'])){
                                    if(isset($_POST['barcode'])){
                                        $code=$_POST['barcode'];
                                        foreach($details AS $detail) {
                                            if($detail['ID']==$code){
                                                $name=$detail['NAME'];
                                                $unit=$detail['UNIT_PRICE'];
                            ?>
                        <tr>
                            <td><?php echo $_POST['barcode']?></td>
                            <td><?php echo $name?></td>
                            <td><?php echo $unit?></td>
                            <td><input type="number" name="qty" ></td>
                            <td>0.00</td>
                        </tr>
                        <?php
                                        }
                                    }
                                }
                            }
                        }
                        else{

                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td>Rs. 0.00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="middle_right">
            <input type="submit" name="Pay" value="pay">

        </div>
    </body>
    <footer>
        <p>&copy STORE MANAGEMENT SYSTEM</p>
    </footer>
</html>
<?php
    if(isset($_POST['logout'])){ 
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy(); 

        header('Location:index.php');
        
    }
?>