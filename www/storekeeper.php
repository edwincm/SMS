<?php
    session_start();
    require("config.php");
?>
<html>
    <head>
        <meta charset="utf-8"/>
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
        <div id="middle">
            <div id="details">
                <div class="output">
                    <label>#ID</label>
                    <input type="integer" name="barcode" autofocus="" maxlength="8" required="">
                </div>
                <?php
                    if(isset($_POST['barcode'])){
                        $code=$_POST['barcode'];
                        //CREATE QUERY
                        $query="SELECT NAME,UNIT_PRICE FROM item where ID=$code;";
                        //GET RESULT
                        $result=mysqli_query($conn,$query);
                        //FETCH DATA 
                        $details=mysqli_fetch_all($result,MYSQLI_ASSOC);
                        echo $details;
                        //FREE RESULT
                        mysqli_free_result($result);
                ?>
                <script type="text/javascript" src="functions.js"></script>
                <?php        
                    }
                ?>
                <div class="output">
                    <label>NAME</label>
                    <input type="text" name="name" value="<?php echo $details['NAME'];?>" disabled="">
                </div>
                <div class="output">
                    <label>QUANTITY</label>
                    <input type="number" name="qty" required="">
                </div>
                <div class="output">
                    <label>UNIT PRICE</label>
                    <input type="integer" name="unitprice" value="<?php echo $details['UNIT_PRICE'];?>" disabled="">
                </div>
                <?php     
                    //CLOSE CONNECTION 
                    mysqli_close($conn);
                ?>
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