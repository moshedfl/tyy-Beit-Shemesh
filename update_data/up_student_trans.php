<?php
	
	if(isset($_GET[update]) && $_GET[update] == "students_routes"){
		$students_routes = [];
		$i = 0;
		$file = fopen(dirname(__FILE__).'/csv/students_routes.csv', 'r');
		while (($line = fgetcsv($file)) !== FALSE) {
		
			$students_routes[$i]["last_name"] = $line[0];
			$students_routes[$i]["first_name"] = $line[1];
			$students_routes[$i]["route_id"] = $line[2];
			$students_routes[$i]["stop_address"] = $line[3];

			$i++;
		}
		foreach ($students_routes as $key => $value) {
		
			$last_name = $students_routes[$key]["last_name"];
			$first_name = $students_routes[$key]["first_name"];
			$route_id = $students_routes[$key]["route_id"];
			$stop_address = $students_routes[$key]["stop_address"];

			$stmt = $conn->prepare("SELECT student_id FROM Students WHERE last_name = ? && first_name = ?");
			$stmt-> bind_param("ss",$last_name, $first_name);
			$stmt-> execute();
			$result = $stmt-> get_result();
			$result_info = $result ->fetch_assoc();
			$student_id = $result_info[student_id];
			
			$stmt = $conn->prepare("SELECT stop_id FROM stops WHERE stop_name = ? ");
			$stmt-> bind_param("s", $stop_address );
			$stmt-> execute();
			$result = $stmt-> get_result();
			$result_info1 = $result ->fetch_assoc();
			$stop_id = $result_info1[stop_id];
			
			echo '<pre>';
			//print_r($result_info);
			//print_r($result_info1);

			 echo $student_id.'<br>';
			 echo $last_name.' ';
			 echo $first_name.'<br>';
			 echo $route_id.'<br>';
			 echo $stop_id.'<br>';
			 echo $stop_address.'<br>';
			echo '</pre>';
 
			//  $sql_route_info = $conn->prepare("INSERT INTO Students_routes (student_id, route_id, stop_id) VALUES (?,?,?)");
			//  $sql_route_info->bind_param("iii", $student_id, $route_id, $stop_id);
			//  $sql_route_info->execute();

		}
		$stmt->close();
		$conn->close();
	}
?>

<form style="width:300px">
	<select name="update" class="browser-default custom-select">
		<option value="">בחר</option>
		<option value="students_routes">נתוני הסעות תלמידים</option>
	</select>
	<button type="submit" class="btn btn-success" style="margin:10px;">עדכן</button>
</form>	

