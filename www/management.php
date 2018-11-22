<?php
    session_start();
    require("config.php");
    //CREATE QUERY
    $query="SELECT * FROM m_view;";
    //GET RESULT
    $result=mysqli_query($conn,$query);
    //FETCH DATA 
    $details=mysqli_fetch_all($result,MYSQLI_ASSOC);
    //FREE RESULT
    mysqli_free_result($result); 
    //CLOSE CONNECTION 
    mysqli_close($conn);
?>

<!-- PHP to place order and update database -->
<?php
    if(isset($_POST['order'])){
        $qty=$_POST['qty'];
        $code=$_POST['items'];
        require("config.php");
        //CREATE QUERY
        $query="UPDATE item SET QUANTITY=QUANTITY+'$qty' WHERE ID='$code'";
        if(mysqli_query($conn,$query)){
            header('Location:management.php');
        }
        else{
            echo "<script type='text/javascript'>alert('Order placement failed!');</script>";
        }
        //CLOSE CONNECTION 
        mysqli_close($conn);
    }
?>

<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1"/>
        
        <title>MANAGEMENT</title>
        
        <link rel="stylesheet" href="design.css"/>
        
        <script type="text/javascript" src="js/management.js"></script>
    </head>

    <body>
        <!-- Navigation Bar -->
        <nav class="navbar">
            <ul>
                <!-- Name of user -->
                <li><div id="name"><?php echo $_SESSION['name'];?></div></li>   
                <!-- LOGOUT button -->
                <li><a href="index.php" name="logout">Logout</a></li>
            </ul>
        </nav>

        <!-- Tab links -->
        <div class="tab">
            <button class="tablinks" onclick="openView(event, 'view')" id="defaultOpen">Inventory</button>
            <button class="tablinks" onclick="openView(event, 'order')">Order</button>
        </div>

        <!-- Tab content - Inventory -->
        <div id="view" class="tabcontent">
            <div class="manage">
                <!-- Table -->
                <table  cellspacing="5px" cellpadding="5px" frame="border" rules="all">
                    <!-- Table Headers -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>QUANTITY</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                            foreach($details AS $detail){   //Iterate through every value in $details array
                        ?>
                            <tr>
                                <td><?php echo $detail['ID']?></td>
                                <td><?php echo $detail['NAME']?></td>
                                <td><?php echo $detail['QUANTITY']?></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab content - Order -->
        <div id="order" class="tabcontent">
            <div id="middle">
                <form method="POST" action="#">
                    <!-- dropdown menu of items in database -->
                    <select name="items">
                        <?php foreach($details AS $option):?>
                            <option id="item_value" value="<?php echo $option['ID'];?>"><?php echo $option['NAME'];?></option>
                        <?php endforeach;?>
                    </select>
                    <input style="text-align:center;" type="text" name="qty">
                    <input type="submit" name="order" value="Order">
                </form>
            </div>
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
<script>
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>