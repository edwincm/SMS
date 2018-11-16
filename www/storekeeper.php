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
        <div id="middle_left">
            <div class="output">
                <label>#ID</label>
                <input type="integer" name="barcode" autofocus="" maxlength="8" required="">
                <?php
                    if(isset($_POST['enter'])){
                        $code=$_POST['barcode'];
                        echo $code;
                        //CREATE QUERY
                        $query="SELECT NAME,UNIT_PRICE FROM item where ID=$code;";
                        //GET RESULT
                        $result=mysqli_query($conn,$query);
                        //FETCH DATA 
                        $details=mysqli_fetch_all($result,MYSQLI_ASSOC);
                        //FREE RESULT
                        mysqli_free_result($result);  
                        
                        $_POST['name']=$details['NAME'];
                        $_POST['unitprice']=$details['UNIT_PRICE'];
                        echo $_POST['name'];
                        echo $_POST['unitprice'];
                    } r
                ?>
                <input type="submit" name="enter" value="Enter">
            </div>  
        </div>
        <?php
            if(isset($_POST['enter'])){
                $code=$_POST['barcode'];
                echo $code;
                //CREATE QUERY
                $query="SELECT NAME,UNIT_PRICE FROM item where ID=$code;";
                //GET RESULT
                $result=mysqli_query($conn,$query);
                //FETCH DATA 
                $details=mysqli_fetch_all($result,MYSQLI_ASSOC);
                //FREE RESULT
                mysqli_free_result($result);  
                
                $_POST['name']=$details['NAME'];
                $_POST['unitprice']=$details['UNIT_PRICE'];
                echo $_POST['name'];
                echo $_POST['unitprice'];
            }
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
            <div id="middle">
                <div id="details">
                    <div class="output">
                        <label>NAME</label>
                        <input type="text" name="name" value="" disabled="">
                    </div>
                    <div class="flex_class">
                        <div class="output">
                            <label>QUANTITY</label>
                            <input type="number" name="qty" required="">
                        </div>
                        <div class="output">
                            <label>UNIT PRICE</label>
                            <input type="integer" name="unitprice" value="" disabled="">
                        </div>
                    </div>
                    <?php     
                        //CLOSE CONNECTION 
                        mysqli_close($conn);
                    ?>
                </div>
            </div>
        </form>
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