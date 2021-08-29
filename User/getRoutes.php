<?php

include '../config.php';
header("Content-Type: application/json; charset=UTF-8");



$sql ="SELECT * FROM `route_info`;";

$result = $conn->query($sql);

$x = $result->num_rows;


 echo "[\n";

if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        
                $myObj=new \stdClass();
                $myObj->route_id  =$row["route_id"];
                $myObj->start_point =$row["start_point"];
                $myObj->end_point =$row["end_point"];
            
       
                $myJSON = json_encode($myObj);
                echo $myJSON;
                if($x <= 1){
                      echo "\n";
                  }else{
                       echo ",\n"; 
                  }
                 $x--;
            }
    }



     echo "\n]";

    
     
    
mysqli_close($conn);
?>