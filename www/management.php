<?php
    session_start();
    require("config.php");
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>MANAGEMENT</title>
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
            <p><?php
                echo "Hello ".$_SESSION['name'];
            ?></p>
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