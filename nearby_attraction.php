<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Travel In Taiwan</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen">
	<script src="https://kit.fontawesome.com/4967ac0f54.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="result">
<?php
	$user = 'root';
	$password = 'root';
	$db = 'attraction';
	$host = 'localhost';
	$port = 3306;

	
	$con = mysqli_connect($host, $user, $password, $db, $port);
	if(!$con){
		die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
	}
	
	$x=$_POST["x_data"];
	$y=$_POST["y_data"];
	$dis=$_POST["num"];
	
	
	$sql= "select w.id, w.name, 2*asin(sqrt(power( sin( (radians(l.y)-radians('".$y."'))/2), 2)+cos(radians(l.y))*cos(radians('".$y."'))*power( sin((radians(l.x)-radians('".$x."'))/2), 2)))*6378.137 as dis
			from location as l, webpage as w 
			where l.id=w.id 
			and 2*asin(sqrt(power( sin( (radians(l.y)-radians('".$y."'))/2), 2)+cos(radians(l.y))*cos(radians('".$y."'))*power( sin((radians(l.x)-radians('".$x."'))/2), 2)))*6378.137<='".$dis."'
			and 2*asin(sqrt(power( sin( (radians(l.y)-radians('".$y."'))/2), 2)+cos(radians(l.y))*cos(radians('".$y."'))*power( sin((radians(l.x)-radians('".$x."'))/2), 2)))*6378.137!=0
			order by 2*asin(sqrt(power( sin( (radians(l.y)-radians('".$y."'))/2), 2)+cos(radians(l.y))*cos(radians('".$y."'))*power( sin((radians(l.x)-radians('".$x."'))/2), 2)))*6378.137 asc";
	
	//echo "$sql1<br>";
	
	$result = mysqli_query($con, $sql);
	
	if ($result) {	
		/* determine number of rows result set */
		//$col_cnt = mysqli_num_fields($result);
		$row_cnt = mysqli_num_rows($result);
		//printf("Result set has %d columns.<br>", $col_cnt);
		echo "<br>";
		printf("有%d筆符合條件的景點資料<br><br>", $row_cnt);
	
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
			
?>


<a href="attraction.php?data=<?=$row[0]?>">
<?php
			echo $row[1];
?></a>
<?php
			echo "-----",round($row[2], 2),"公里<br>";
			//echo $row[1],"<br>";
			//print_r( $row);
		}
		
		/* close result set */
		mysqli_free_result($result);
	}
	mysqli_close($con);
?>
</div>
</div>
	<div>
		<footer>
				<p>聯絡方式: <br>
				<a title="Email" href="mailto:alberta410476@gmail.com"><i class="fas fa-envelope"></i></a>
				<a title="Github" href="https://github.com/scod0401" target="_blank"><i class="fab fa-github-square"></i></a>
				</p>
		</footer>
	</div>	

</body>
</html>