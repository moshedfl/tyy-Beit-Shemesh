<script>
	$(document).ready(function(){
        $("#display-stutands").click(function(){
            $("#stops-list").find(".stutands-list").slideToggle("fast");
        });
        
        
    });
</script>

<?php
    if(isset($_POST[save])){
      $stops = $_POST[stops];
      $route_id = $_GET[routeid];
      foreach($stops as $key => $val){
        $stmt = $conn->prepare("UPDATE Stutands_routes SET stop_num=? WHERE route_id=? && stop_id=?");
        $stmt->bind_param('iii', $val, $route_id, $key);
        $stmt->execute();
        header("Location:./home.php");
        // echo $key.'=';
        // echo $val.'<br>';
      }
    }
?>
<form action="" method="post">

    <!-- Toolbar -->
    <div class="toolbar">
        <button type="button" id="display-stutands" class="btn btn-secondary button" >הצג תלמידים</button>
        <a href="home.php">
            <button type="button" class="btn btn-secondary button" >ביטול</button>
        </a>
        <button type="submit" name="save" id="save" class="btn btn-secondary button" >שמור</button>
    </div>

    <main >
        <section>
    <?php
        $route_id = $_GET['routeid'];
        $stmt = $conn->prepare("SELECT Routes.*,users.username, users.user_tel, COUNT(DISTINCT Stutands_routes.stop_id) AS stops, COUNT(Stutands_routes.route_id) AS Stutands
        FROM Routes 
        JOIN users ON Routes.route_attendant = users.user_id
        JOIN Stutands_routes ON Routes.route_id = Stutands_routes.route_id
        WHERE Routes.route_id = ? ");
        $stmt-> bind_param("i",$route_id);
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

            ?>
                <div class="route">
                    <div class="route-header active-header">
                        <div class="first-col">
                            <div class="line">
                                <span class="h6"><?= $route_id ?>#</span>
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
                        <div class="third-col">
                        
                        </div>
                    </div>
                    <div id="stops-list" class="stops-list">
                        <!-- header for table in desktop -->
                        <div class="table-header d-none d-md-block">
                            <div class="stop-row table-header-row">
                                <span class="h6 table-header-col">#</span> 
                                <span id="stop-name-col" class="t1 table-header-col">שם תחנה</span>
                                <div class="stutands-list">
                                    <div class="stutand-row">
                                        <span class="h7 table-header-col">משפחה</span> 
                                        <span class="t2 table-header-col">שם פרטי</span>
                                        <div class="stutand-info">
                                            <div class="line address">
                                                <span class="t3  table-header-col">כתובת</span>
                                            </div>
                                            <div class="line">
                                                <span class="t3 table-header-col">טלפון</span>
                                            </div>
                                            <div class="line">
                                                <span class="t3 table-header-col">נייד</span>
                                            </div> 
                                            <div class="line">
                                                <span class="t3 table-header-col">נייד נוסף</span>
                                            </div>
                                        </div>    
                                    </div>   
                                </div>
                            </div>  
                        </div>
                <?php
                        stops_list($route_id);
                    ?>
                    </div>
                </div>
            
            
            <?php
        }

            function stops_list($route_id){
                
                global $conn;
                                
                $stmt = $conn->prepare("SELECT DISTINCT stops.stop_id, stop_name, stop_number, stop_num FROM stops 
                INNER JOIN  Stutands_routes 
                ON stops.stop_id = Stutands_routes.stop_id WHERE route_id = ?
                ORDER BY stop_num ");
                $stmt-> bind_param("i",$route_id);
                $stmt-> execute();
                $result = $stmt-> get_result();
                
                while($row = $result ->fetch_assoc()){
                    $stop_id =  $row["stop_id"];
                    $stop_name =  $row["stop_name"];
                    $stop_number =  $row["stop_number"];
                    $stop_num =  $row["stop_num"];


                    ?>
                    <div class="stop-row">
                        <span class="stop-num transition-05 h6" contenteditable="true" onkeypress="numberOnly(event)"><?= $stop_num?></span> 
                        <input type="hidden" class="update-stop" name="stops[<?= $stop_id ?>]">
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
                        <span class="h7"><?= $last_name ?> </span> 
                        <span class="t2"><?= $first_name ?></span>
                        <div class="stutand-info">
                            <div class="line address">
                                <span class="h8 d-md-none">כתובת:</span>  
                                <span class="t3 "><?= $address ?></span>
                            </div>
                            <div class="line">
                                <span class="h8 d-md-none">טל':</span> 
                                <span class="t3"><?= $tel ?></span>
                            </div>
                            <div class="line">
                                <span class="h8 d-md-none"><?= $mobile_1 ? "נייד:" : "" ?></span> 
                                <span class="t3"><?= $mobile_1 ? $mobile_1 : "" ?></span>
                            </div> 
                            <div class="line">
                                <span class="h8 d-md-none"><?= $mobile_2 ? "נייד נוסף:" : "" ?></span> 
                                <span class="t3"><?= $mobile_2 ? $mobile_2 : "" ?></span>
                            </div>
                        </div>    
                    </div>     

                    <?php
                }

            }

    

        
    ?>

        </section>
    </main>
</form>

<script src="js/edroute.js"></script>



