<?php

include 'config.php';


header("Content-Type: application/json; charset=UTF-8");

$uname= $_POST['uname'];
$pass= $_POST['pass'];



//-----------------encrpt password----------------------------
// $password = mysqli_real_escape_string($conn, $_POST["pass"]);  
// $pass = md5($password);


$sql = "SELECT * FROM `users` 

INNER join user_types on users.uid=user_types.uid

WHERE `uname`='$uname' and `password`='$pass' and `state`='active'

;";
//echo $sql;


$result = $conn->query($sql);
 //echo $sql;
 
//echo "[\n";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {


       // $role=$row["role"];
        $myObj=new \stdClass();
        $myObj->success = "true";
        $myObj->uid = $row["uid"];
        $myObj->bus_number = $row["bus_number"];
        $myObj->route_id = $row["route_id"];
        $myObj->usertype = $row["utype"];
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }
    }else
    {
        $myObj=new \stdClass();
        $myObj->success ="false";
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }
//echo "]\n";

mysqli_close($conn);
?>