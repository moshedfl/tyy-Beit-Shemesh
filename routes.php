<script>
	$(document).ready(function(){
        
        $(".route-header").click(function(){
            $(this).siblings(".stops-list").slideToggle("fast");
        });
        
        $(".stutand-row").click(function(){
            $(this).find(".stutand-info").slideToggle("fast");
		});
	});
</script>

<main>
    <section>

<?php
    $stmt = $conn->prepare("SELECT Routes.*,users.username, users.user_tel, COUNT(DISTINCT Stutands_routes.stop_id) AS stops, COUNT(Stutands_routes.route_id) AS Stutands
    FROM Routes
    LEFT JOIN users ON Routes.route_attendant = users.user_id
    LEFT JOIN Stutands_routes ON Routes.route_id = Stutands_routes.route_id
    GROUP BY route_id ");
	$stmt-> execute();
	$result = $stmt-> get_result();
    while($row = $result ->fetch_assoc()){
        
        $route_id =  $row["route_id"];
        $route_direction =  $row["route_direction"];
        $route_Days =  $row["route_Days"];
        $db_time =  date_create($row["route_time"]);
        $route_time = date_format($db_time,"H:i");
        $route_vehicle =  $row["route_vehicle"];
        $route_attendant =  $row["username"];
        $attendant_tel =  $row["user_tel"];
        $sum_stops =  $row["stops"];
        $sum_Stutands =  $row["Stutands"];


       // echo '<pre>';
       // print_r($row);
       // echo '</pre>';
        
        ?>
            <div class="route">
                <div class="route-header">
                    <div class="first-col">
                        <div class="line">
                            <span class="h6"><?= $route_direction ?></span>
                        </div>
                        <div class="line">
                            <span class="h6"> ימים:</span>
                            <span class="t1"> <?= $route_Days ?></span>
                        </div>
                        <div class="line">
                            <span class="h6"> בשעה:</span>
                            <span class="t1"> <?= $route_time ?></span>
                        </div>
                        <div class="line">
                            <span class="h6">רכב:</span>
                            <span class="t1"> <?= $route_vehicle ?></span>
                        </div>
                    </div>
                    <div class="second-col">
                        <div class="line">
                            <span class="h6">מלוה:</span>  
                            <span class="t1"><?= $route_attendant ?></span>
                        </div>
                        <div class="line">
                            <span class="h6">טל' מלוה:</span> 
                            <span class="t1"><?= $attendant_tel ?></span>
                        </div>
                        <div class="line">
                            <span class="h6">מס' תחנות:</span>
                            <span class="t1"><?= $sum_stops ?></span>
                        </div> 
                        <div class="line">
                            <span class="h6">מס' תלמידים:</span> 
                            <span class="t1"><?= $sum_Stutands ?></span>
                        </div>
                    </div>
                </div>
                <div class="stops-list">
               <?php
        
                    stops_list($route_id,$route_direction);

                ?>
                </div>
            </div>
        
        
        <?php
    }

        function stops_list($route_id,$route_direction){
            
            global $conn;
            if($route_direction == "הלוך"){
                $order = "ASC";
            }else{
                $order = "DESC";
            }
               
            $stmt = $conn->prepare("SELECT DISTINCT stops.stop_id, stop_name, stop_number FROM stops 
            INNER JOIN  Stutands_routes 
            ON stops.stop_id = Stutands_routes.stop_id WHERE route_id = ?
            ORDER BY stop_number  $order");
            $stmt-> bind_param("i",$route_id);
            $stmt-> execute();
            $result = $stmt-> get_result();
            
            while($row = $result ->fetch_assoc()){
                $stop_id =  $row["stop_id"];
                $stop_name =  $row["stop_name"];
                $stop_number =  $row["stop_number"];

                ?>
                 <div class="stop-row">
                    <span class="h6"><?= $stop_number ?></span> 
                    <span class="t1"><?= $stop_name ?></span>
                    <div class="stutands-list">
                        <?php
                            stutands_list($route_id,$stop_id);
                        ?>

                    </div>
                 </div>   

                <?php
            }

        }

        function stutands_list($route_id,$stop_id){
            global $conn;

            $stmt = $conn->prepare("SELECT Stutands.stutand_id, first_name, last_name, Stutands.address, tel, mobile_1, mobile_2 FROM Stutands 
            INNER JOIN  Stutands_routes 
            ON Stutands.stutand_id = Stutands_routes.stutand_id WHERE route_id = ? && stop_id = ?
            ORDER BY last_name ");
            $stmt-> bind_param("ii",$route_id, $stop_id);
            $stmt-> execute();
            $result = $stmt-> get_result();
            
            while($row = $result ->fetch_assoc()){
                $first_name =  $row["first_name"];
                $last_name =  $row["last_name"];
                $address =  $row["address"];
                $tel =  $row["tel"];
                $mobile_1 =  $row["mobile_1"];
                $mobile_2 =  $row["mobile_2"];


                ?>
                 <div class="stutand-row">
                    <span class="h6"><?= $last_name ?></span> 
                    <span class="t1"><?= $first_name ?></span>
                    <div class="stutand-info">
                        <div class="line">
                            <span class="h6">כתובת:</span>  
                            <span class="t1"><?= $address ?></span>
                        </div>
                        <div class="line">
                            <span class="h6">טל':</span> 
                            <span class="t1"><?= $tel ?></span>
                        </div>
                        <div class="line">
                            <span class="h6"><?= $mobile_1 ? "נייד:" : "" ?></span> 
                            <span class="t1"><?= $mobile_1 ? $mobile_1 : "" ?></span>
                        </div> 
                        <div class="line">
                            <span class="h6"><?= $mobile_2 ? "נייד נוסף:" : "" ?></span> 
                            <span class="t1"><?= $mobile_2 ? $mobile_2 : "" ?></span>
                        </div>
                    </div>    
                 </div>   

                <?php
            }

        }

   

    
?>

</section>
</main>

