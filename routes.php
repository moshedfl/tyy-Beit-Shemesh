<!--routes screen-->

<!--mein content-->
<main>
    
    <!--forth routes section-->
    <section dir="rtl" id="forth">
        <h4 class="h4">הלוך</h4>
    </section>

    <!--back routes section-->
    <section id="back">
        <h4 dir="rtl" class="h4">חזור</h4>

<?php
    
    // get all routes data from database
    $stmt = $conn->prepare(
        "SELECT Routes.*,users.username, users.user_tel, 
        COUNT(DISTINCT Students_routes.stop_id) AS stops, 
        COUNT(Students_routes.route_id) AS Students
        FROM Routes
        LEFT JOIN users ON Routes.route_attendant = users.user_id
        LEFT JOIN Students_routes ON Routes.route_id = Students_routes.route_id
        GROUP BY route_id "
    );
    $stmt-> execute();
    $result = $stmt-> get_result();
    while ($row = $result ->fetch_assoc()) {
        
        // Put the route data into variables
        $route_id =  $row["route_id"];
        $route_direction =  $row["route_direction"];
        $route_Days =  $row["route_Days"];
        $db_time =  date_create($row["route_time"]);
        $route_time = date_format($db_time, "H:i");
        $route_vehicle =  $row["route_vehicle"];
        $route_attendant =  $row["username"];
        $attendant_tel =  $row["user_tel"];
        $sum_stops =  $row["stops"];
        $sum_Students =  $row["Students"];

        // get route direction for custom data attribute
        if ($route_direction == "הלוך") {
            $data_direction = "forth";
        } else {
            $data_direction = "back";
        }
        
        
        ?>
            <!--route content-->
            <div class="route" data-route-id="<?= $route_id ?>" data-direction="<?= $data_direction ?>">
                <!--header for route main details-->
                <div class="route-header display-route">
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
                            <span class="t1"><?= $sum_Students ?></span>
                        </div>
                    </div>

                    <!--icons-->
                    <div class="third-col">
                        <div class="icons d-print-none" >

                        <!--edit button-->
                        <?php
                            //Checks whether the user has edit permission
                        if ($_SESSION['tyy_User']['user_permissions'] > 8) {
                            ?>
                            <a class="edit-route" href="edit.php?routeid=<?=$route_id?>">
                                <i class="fas fa-edit spinner-on" title="ערוך"></i>
                            </a>
                            <?php
                        }
                        ?>
                        
                        <!--print button-->
                            <i class="fas fa-print d-none d-md-block" title="הדפס"></i>
                        </div>

                        <!--up and down icons-->
                        <div class="angles">
                            <i class="fas fa-angle-down"></i>
                            <i class="fas fa-angle-up"></i>
                        </div>

                    </div>
                </div>
                
                <!--table for all route information-->
                <div class="stops-list">
                    
                    <!-- header for table in desktop -->
                    <div class="table-header d-none d-md-block d-print-block">
                        <div class="stop-row table-header-row">
                            <span class="h6 table-header-col">#</span> 
                            <span class="t1 table-header-col">שם תחנה</span>
                            <div class="students-list">
                                <div class="student-row">
                                    <span class="h7 table-header-col">משפחה</span> 
                                    <span class="t2 table-header-col">שם פרטי</span>
                                    <div class="student-info">
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
                
                <!--table body with stop and students information-->
                <?php
                    stops_list($route_id);
                ?>
                </div>
            </div>
   
        <?php
    }
    /**
     * Get stops data from database
     * 
     * @param number $route_id the route id number
     * 
     * @return any
     */
    function Stops_list($route_id)
    {
            
            global $conn; // import database connection to the function
                          
            $stmt = $conn->prepare(
                "SELECT DISTINCT stops.stop_id, stop_name, stop_number, Students_routes.stop_num
                FROM stops 
                INNER JOIN  Students_routes 
                ON stops.stop_id = Students_routes.stop_id WHERE route_id = ?
                ORDER BY stop_num  "
            );
            $stmt-> bind_param("i", $route_id);
            $stmt-> execute();
            $result = $stmt-> get_result();
            
        while ($row = $result ->fetch_assoc()) {
                $stop_id =  $row["stop_id"];
                $stop_name =  $row["stop_name"];
                $stop_num =  $row["stop_num"];

            ?>
                <!--table row with stops content-->
                <div class="stop-row">
                    <span class="h6"><?= $stop_num ?></span> 
                    <span class="t1"><?= $stop_name ?></span>

                    <!--students content-->
                    <?php
                        //if the user is the driver don't show students information 
                    if ($_SESSION['tyy_User']['user_role'] != 'נהג') {
                        ?>
                        <div class="students-list">
                        <?php
                        Students_list($route_id, $stop_id);
                        ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>   

                <?php
        }

    }

    /**
     * Get students data from database
     * 
     * @param number $route_id route id number
     * @param number $stop_id  stop id number
     * 
     * @return any  
     */ 
    function Students_list($route_id, $stop_id) 
    {
            global $conn;

            $stmt = $conn->prepare(
                "SELECT Students.student_id, first_name, last_name, Students.address, tel, mobile_1, mobile_2 
                FROM Students 
                INNER JOIN  Students_routes 
                ON Students.student_id = Students_routes.student_id WHERE route_id = ? && stop_id = ?
                ORDER BY last_name "
            );
            $stmt-> bind_param("ii", $route_id, $stop_id);
            $stmt-> execute();
            $result = $stmt-> get_result();
            
        while ($row = $result ->fetch_assoc()) {
                $first_name =  $row["first_name"];
                $last_name =  $row["last_name"];
                $address =  $row["address"];
                $tel =  $row["tel"];
                $mobile_1 =  $row["mobile_1"];
                $mobile_2 =  $row["mobile_2"];

            ?>
                <!--student row-->
                <div class="student-row">
                    <span class="h7"><?= $last_name ?> </span> 
                    <span class="t2"><?= $first_name ?></span>
                    <div class="student-info">
                        <div class="line address">
                            <span class="h8 d-md-none d-print-none">כתובת:</span>  
                            <span class="t3 "><?= $address ?></span>
                        </div>
                        <div class="line">
                            <span class="h8 d-md-none d-print-none">טל':</span> 
                            <span class="t3"><?= $tel ?></span>
                        </div>
                        <div class="line">
                            <span class="h8 d-md-none d-print-none"><?= $mobile_1 ? "נייד:" : "" ?></span> 
                            <span class="t3"><?= $mobile_1 ? $mobile_1 : "" ?></span>
                        </div> 
                        <div class="line">
                            <span class="h8 d-md-none d-print-none"><?= $mobile_2 ? "נייד נוסף:" : "" ?></span> 
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

