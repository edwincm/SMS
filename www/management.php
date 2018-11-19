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
<html>
    <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1"/>
        <title>MANAGEMENT</title>
        <link rel="stylesheet" href="design.css"/>
        <script type="text/javascript" src="functions.js"></script>
    </head>
    <body>
        <nav class="navbar">
            <ul>
                <li><div id="name"><?php echo $_SESSION['name'];?></div></li>
                <li><a href="index.php" name="logout">Logout</a></li>
            </ul>
        </nav>

        <!-- Tab links -->
        <div class="tab">
            <button class="tablinks" onclick="openView(event, 'view')" id="defaultOpen">Inventory</button>
            <button class="tablinks" onclick="openView(event, 'order')">Order</button>
        </div>

        <!-- Tab content -->
        <div id="view" class="tabcontent">
            <div class="manage">
                <table  cellspacing="5px" cellpadding="5px" frame="border" rules="all">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>QUANTITY</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                            foreach($details AS $detail){
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

        <div id="order" class="tabcontent">
            <h3>ORDER</h3>
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