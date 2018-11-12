<?php
    $servername = "localhost";
    $username = "root";
    $password = "pass@root";
    $db = "sms";

    //Creating connection to MYSQL 
    $conn=mysqli_connect($servername,$username,$password,$db);

    //Check connection 
    if(mysqli_connect_errno()){
            //Connection Failed 
            echo 'Failed to Connect MySQL'.mysqli_connect_errno();
    }
