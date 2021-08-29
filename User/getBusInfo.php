<?php

include '../config.php';
header("Content-Type: application/json; charset=UTF-8");


$route_id= $_POST['route_id'];

$sql ="SELECT  tb_id,bus_name,bus_no,bus_condtions,bus_contact_number,bus_avb_seats,bus_img_path,isCompleteRoute,
time_table.start_time,time_table.end_time,
route_info.start_point,route_info.end_point
From bus_info
INNER JOIN time_table on bus_info.time_id= time_table.time_id
INNER JOIN route_info on bus_info.route_id=route_info.route_id
WHERE (bus_info.isCompleteRoute='Not-Complete' AND bus_info.route_id='$route_id')
LIMIT 7

;";

$result = $conn->query($sql);

$x = $result->num_rows;


 echo "[\n";

if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        
                $myObj=new \stdClass();
                $myObj->tb_id =$row["tb_id"];
                $myObj->bus_name =$row["bus_name"];
                $myObj->bus_no =$row["bus_no"];
                $myObj->bus_condtions =$row["bus_condtions"];
                $myObj->bus_contact_number =$row["bus_contact_number"];
                $myObj->bus_avb_seats =$row["bus_avb_seats"];
                $myObj->bus_img_path =$row["bus_img_path"];
                $myObj->isCompleteRoute =$row["isCompleteRoute"];
                $myObj->start_time =$row["start_time"];
                $myObj->end_time =$row["end_time"];
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