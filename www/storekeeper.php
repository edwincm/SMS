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
        <script type="text/javascript" src="js/storekeeper.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
           $(document).ready(function(e){
                /*$("input[name=barcode]").change(function(){
                    var code=$(this).val();
                    $("input[name=total]").val(0);
                });*/ 

                $("input[name=qty]").change(function(){
                    var total=0,t;
                    var sum=0;
                    var qty=parseInt($(this).val());
                    var unit=parseInt($("input[name=unit]").val());
                    sum = qty*unit;
                    total = total + sum; 
                    $("input[name=sum]").val(sum); 
                    $("input[name=total]").val(total);
                });
                
            });
        </script>
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
                    <input type="integer" name="barcode" autofocus="" autocomplete="off" maxlength="8" required="">
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
                            <th>UNIT PRICE</th>
                            <th>QUANTITY</th>
                            <th>PRICE</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                            $q=0;
                            if(isset($_POST['enter'])){
                                if(isset($_POST['barcode'])){
                                    $code=$_POST['barcode'];
                                    foreach($details AS $detail) {
                                        if($detail['ID']==$code){
                                            $name=$detail['NAME'];
                                            $unit=$detail['UNIT_PRICE'];
                                            $Q=$detail['QUANTITY'];
                                            
                        ?>
                        <form method="POST" action="#">
                        <tr>
                            <td><input type="text" name="code" size="8" readonly="readonly" value="<?php echo $code;?>"></td>
                            <td><input type="text" name="name" readonly="readonly" value="<?php echo $name;?>"></td>
                            <td><input type="text" name="unit" readonly="readonly" value="<?php echo $unit;?>"></td>
                            <td><input type="text" name="qty"></td>
                            <td><input type="text" readonly="readonly" name="sum" ></td>
                        </tr>
                        <input type="hidden" name="t_qty" value="<?php echo $Q;?>">
                        <?php
                                            }
                                        }
                                    }
                                }
                                else{
                        ?>
                        <tr>
                            <td><input type="text"readonly="readonly" value=""></td>
                            <td><input type="text"readonly="readonly" value=""></td>
                            <td><input type="text"readonly="readonly" value=""></td>
                            <td><input type="text"value=""></td>
                            <td><input type="text" readonly="readonly"value=""></td>
                        </tr>
                        <?php
                                }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <input type="submit" name="pay" value="PAY">
        </form>
        <?php    
            if(isset($_POST['pay'])){
                $qty=$_POST['t_qty']-$_POST['qty']; 
                $code=$_POST['code'];
                $total=$_POST['sum'];
                require("config.php");
                //CREATE QUERY
                $query="UPDATE item SET QUANTITY='$qty' WHERE ID='$code'";
                if(mysqli_query($conn,$query)){
                    echo "<b>".'<script type="text/javascript">alert("Total: Rs. '.$total.'\nPurchase successful!")</script>.'."</b>";
                }
                else{
                    echo "<script type='text/javascript'>alert('Purchase failed!');</script>";
                }
                //CLOSE CONNECTION 
                mysqli_close($conn);
            }
        ?>
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
