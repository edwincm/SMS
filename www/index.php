<?php
    session_start();
    require("config.php");
    //CREATE QUERY
    $query="SELECT * FROM user;";
    //GET RESULT
    $result=mysqli_query($conn,$query);
    //FETCH DATA 
    $logins=mysqli_fetch_all($result,MYSQLI_ASSOC);
    //FREE RESULT
    mysqli_free_result($result);
    //CLOSE CONNECTION 
    mysqli_close($conn);
?>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1"/>
        
        <title>STORE MANAGEMENT SYSTEM</title>
        
        <link rel="stylesheet" href="design.css"/>
    </head>

    <body>
        <!-- Login section -->
        <div id="middle">
            <h2>LOGIN</h2>
            <form method="POST" action="#">
                    <div class="inputbox">
                        <input type="text" name="username" autofocus="" placeholder="ID" required=""/>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="password" placeholder="Password" required=""/>
                    </div>
                    <span><input type="submit" name="log" value="Submit"></span>
            </form>
        </div>
    </body>
</html>   

<!-- PHP to validate login credentials -->
<?php
    if(isset($_POST['log'])){ 
        if(isset($_POST['username'])){
            if(isset($_POST['password'])){
                $email=$_POST['username'];
                $pass=$_POST['password'];
                foreach($logins AS $login){
                    if($login['U_ID']==$email AND $login['PASSWORD']==$pass){
                        $_SESSION['name']=$login['NAME'];
                        if($login['PRIVILEGE']==1){
                            header('Location:management.php');
                        }
                        else if($login['PRIVILEGE']==2){
                            header('Location:storekeeper.php');
                        }
                    }
                }
            }
        }
    }
?>