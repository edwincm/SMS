<?php
    session_start();
    require("config.php");
    //CREATE QUERY
    $query="SELECT l.U_ID,PASSWORD,NAME,PRIVILEGE FROM login l,user u where l.U_ID=u.U_ID;";
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
        <meta charset="utf-8"/>
        <title>STORE MANAGEMENT SYSTEM</title>
        <link rel="stylesheet" href="design.css"/>
    </head>

    <body>
        <div id="middle">
            <h2>LOGIN</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                    <div class="inputbox">
                        <label>ID</label>
                        <input type="text" name="username" autofocus="" required=""/>
                    </div>
                    <div class="inputbox">
                        <label>Password</label>
                        <input type="password" name="password" required=""/>
                    </div>
                    <input type="submit" name="log" value="Submit">
            </form>
        </div>
    </body>
</html>   

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
                        else{

                        }
                        break;
                    }
                }
            }
        }
    }
?>