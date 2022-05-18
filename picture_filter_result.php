<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Travel In Taiwan</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen">
	<script src="https://kit.fontawesome.com/4967ac0f54.js" crossorigin="anonymous"></script>
</head>

<body>
	<div>
		<header>
			<h2>台灣旅遊景點網站</h2>
			<p>找一個適合的地方出去玩吧! <i class="fas fa-shoe-prints"></i></p>
		</header>
	</div>
	<div class="container">
		<section> 	
			<form action="dropdown_filter_result.php" method="post">
			<div class="choice">
				<div class="choice-item">旅遊地區: <br><select name="region">
					<option value="none">不限</option>
					<option value="基隆市">基隆市</option>
					<option value="臺北市">臺北市</option>
					<option value="新北市">新北市</option>
					<option value="桃園市">桃園市</option>
					<option value="新竹市">新竹市</option>
					<option value="新竹縣">新竹縣</option>
					<option value="苗栗縣">苗栗縣</option>
					<option value="臺中市">臺中市</option>
					<option value="南投縣">南投縣</option>
					<option value="彰化縣">彰化縣</option>
					<option value="雲林縣">雲林縣</option>
					<option value="嘉義市">嘉義市</option>
					<option value="嘉義縣">嘉義縣</option>
					<option value="臺南市">臺南市</option>
					<option value="高雄市">高雄市</option>
					<option value="屏東縣">屏東縣</option>
					<option value="宜蘭縣">宜蘭縣</option>
					<option value="花蓮縣">花蓮縣</option>
					<option value="臺東縣">臺東縣</option>
					<option value="澎湖縣">澎湖縣</option>
					<option value="金門縣">金門縣</option>
					<option value="連江縣">連江縣</option>
				</select></div>
				<div class="choice-item">旅遊時間: <br><select name="open_time">
					<option value="none">不限</option>
					<option value="週一">週一</option>
					<option value="週二">週二</option>
					<option value="週三">週三</option>
					<option value="週四">週四</option>
					<option value="週五">週五</option>
					<option value="週六">週六</option>
					<option value="週日">週日</option>
				</select></div>
				<div class="choice-item">停車地點: <br><select name="parking">
					<option value="none">不限</option>
					<option value="停車場">停車場</option>
					<option value="路邊">路邊</option>
				</select></div>
				<div class="choice-item">收費範圍: <br><select name="ticket">
					<option value="none">不限</option>
					<option value="免費">免費</option>
					<option value="1">1-100元</option>
					<option value="101">101-200元</option>
					<option value="201">201-400元</option>
					<option value="401">400元以上</option>
					<option value="請電洽">請電洽</option>
				</select></div>
				<div class="choice-item">景點類別: <br><select name="class">
					<option value="none">不限</option>
					<option value="公園綠地">公園綠地</option>
					<option value="主題遊樂園">主題遊樂園</option>
					<option value="觀光商圈">觀光商圈</option>
					<option value="藝術空間">藝術空間</option>
					<option value="歷史古蹟">歷史古蹟</option>
					<option value="觀光工廠">觀光工廠</option>
					<option value="戶外運動">戶外運動</option>
					<option value="花園農場">花園農場</option>
					<option value="自然之旅">自然之旅</option>
					<option value="教育資源">教育資源</option>
					<option value="特色館區">特色館區</option>
					<option value="休閒娛樂">休閒娛樂</option>
				</select></div>
				<div class="choice-item">排序方式: <br><select name="order">
					<option value="none">預設</option>
					<option value="south">南到北</option>
					<option value="north">北到南</option>
					<option value="east">東到西</option>
					<option value="west">西到東</option>
				</select></div>					
			</div>
			<div class="btn-area">
				<input class="btn" type="submit" value="搜尋">
			</div>
			</form>	
		</section>
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
	
	$city=$_POST["sub"];
	
	$sql = "select i.id, w.name 
			from( 
				select l.id as id
				from location as l, search as s
				where l.id=s.id ";
	
	if($city){
		$sql=$sql."and l.city='".$city."' ";
	}
		
	$sql=$sql.") as i, webpage as w
			where w.id=i.id	
			order by i.id";	
?>

<?php			
	$result = mysqli_query($con, $sql);
	
	if ($result) {	
		/* determine number of rows result set */
		$row_cnt = mysqli_num_rows($result);
		echo "<br>";
		printf("有%d筆符合條件的景點資料<br><br>", $row_cnt);
	
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
?>

<a href="attraction.php?data=<?=$row[0]?>">
<?php	
			echo $row[1],"<br>";
		}
		mysqli_free_result($result);
	}
	mysqli_close($con);
?></a>
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