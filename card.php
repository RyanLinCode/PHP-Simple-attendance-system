<?php
	include("library/mysql.inc.php");
	session_start();
	$BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
	// datetime
	$datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y')));
	
	$time = date ("H:i:s" , mktime(date('H')+7, date('i'), date('s')));

	$date = date ("Y-m-d" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
	
	$dateup = date ("Y-m-d" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d')
	+1, date('Y')));
?>

<!DOCTYPE html>
<html>
<head>
    <title>首頁</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body onload="show_date();show_time()">
	<div class="card">
		
		<div class="container">
			<div class="col-md-1">
			<form action="<?php $_SERVER["PHP_SELF"] ?>"  method="post" name="myForm">
				<div class="proButton-botton">
					<div class="proButton-text">員工：<?php echo $_SESSION['name']; ?> </div>
					<br>
					<button name="star" type="submit">Punch in</button>
					<button name="end" type="submit" >Punch out</button>
					<button name="month" type="submit">Attendance this month</button>
					<button name="Logout" type="submit" value="true">Logout</button>
				</div>
			</form>
		</div>
		<div class="col-md-11 ">
					<!-- 電腦顯示時鐘 -->
					<form id="clock" runat="server" >
						<div id = "show_date"></div>
						<div id = "show_time"></div>
					</form>
			</div>
		</div>
			
		<div class="col-md-12">
			<div class="test">
			    <?php
				// 使用【打卡日期】排序, 查詢 card_record 資料表的所有資料
				
				$sql5="SELECT * FROM card_record  where emp_no='{$_SESSION['e_no']}' and card_date>='$BeginDate' and card_date<='$date' ORDER BY card_date ASC";
				$result5=mysqli_query($conn, $sql5);

				//如果查到的記錄筆數大於 0, 便使用迴圈顯示所有資料
				if (mysqli_num_rows($result5) >0)
				{	
					
					echo '<div class="text1">　　'.date('Y年m月') .'簽到表</div>';
					echo '<div class="text">';
					echo "<table border='1'>";
					echo "<tr> <td>打卡日期</td><td>星期</td><td>員工名字</td><td>打卡班別</td></td><td>打卡時間</td><tr>";

					$i=0;
				  	while ($row5 = mysqli_fetch_array($result5)) 
				  	{
				  		if($i%2==0){
				  			echo "<tr class='td1'> <td>{$row5['card_date']}</td><td>{$row5['card_week']}</td><td>{$row5['card_name']}</td><td>{$row5['begin_time']}</td></td><td>{$row5['end_time']}</td><tr>";
				  		}else{
				  			echo "<tr class='td2'> <td>{$row5['card_date']}</td><td>{$row5['card_week']}</td><td>{$row5['card_name']}</td><td>{$row5['begin_time']}</td></td><td>{$row5['end_time']}</td><tr>";
				  		}
				  		$i++;
				  		
				  	}
					echo '</table>';
					echo '</div>';
				}

			?>
			</div>
		</div>
	</div>
	
	<!-- 電腦顯示時鐘 -->
	<script language="JavaScript">
		function show_time(){
		　var NowDate=new Date();
		　var h=NowDate.getHours();
		　var m=NowDate.getUTCMinutes();
		　var s=NowDate.getSeconds();
		  m = checkTime(m);
	      s = checkTime(s);　
		　document.getElementById('show_time').innerHTML = h+':'+m+':'+s;
		　setTimeout('show_time()',1000);
		}
		function checkTime(i) {
		  if (i < 10) {
		    i = "0" + i;
		  }
		  return i;
		}
		function show_date(){
			var today = new Date();
			var y=today.getFullYear();
			var m=(today.getMonth()+1);
			//var m=('0'+(today.getMonth()+1)).slice(-2)
			var d=today.getDate();
			document.getElementById('show_date').innerHTML = y+'.'+m+'.'+d;
		}
	</script>
	




<?php

	
	// echo "當月第一天".$BeginDate;
	// echo "當月最後一天".date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));

	$counter=1;  // 上線次數

	//如果 Cookie 的 myCounter 變數不存在, 表示使用者第 1 次上站
	// if( !isset($_COOKIE['myCounter']) ){
	//   //設定 Cookie 的 myCounter 變數值為 1, 30 天之後到期
	//   setcookie("myCounter", $counter, time()+30*24*3600 );
	// }
	// else{
	//   // 讀取 Cookie 中的計數器值
	//   $counter = (int)$_COOKIE['myCounter']; 
	  
	//   if ( $_SESSION['setCounter'] == TRUE ) 
	//     //將計數器值加 1, 並寫入 Cookie
	//     setcookie("myCounter", ++$counter, time()+30*24*3600);  
	// }

	
	
	// 日期中文化
	function get_chinese_weekday($datetime)
	{
	    $weekday = date('w', strtotime($datetime));
	    return '星期' . ['日', '一', '二', '三', '四', '五', '六'][$weekday];
	}
	$weekday = get_chinese_weekday($datetime);

	//上班
    if(isset($_POST['star']))
    {
    	$sql2 ="SELECT * FROM card_record Where card_date >='$date' and card_date <='$dateup' and card_name = '{$_SESSION['name']}'";
    	$result2 = mysqli_query($conn, $sql2);

    	if (mysqli_num_rows($result2) == 0)
    	{
		$sql3="INSERT card_record(emp_no,card_name,card_date,card_week,begin_time)
			VALUES ('{$_SESSION['e_no']}','{$_SESSION['name']}','{$date}','$weekday','{$time}')";
			//關閉資料連接
			mysqli_query($conn, $sql3);
			echo "<script type='text/javascript'>";
			echo "alert('打卡成功！！');";
			echo "</script>";
		}
		else
		{
			echo "<script type='text/javascript'>";
			echo "alert('今天上班打卡過了哦！！');";
			echo "</script>";
		}
		  	
     	
   }else if (isset($_POST['end'])) 
   {
   		$sql2 ="SELECT * FROM card_record Where card_date>='$date' and card_date<='$dateup' and card_name = '{$_SESSION['name']}'";
   		$result2 = mysqli_query($conn, $sql2);
   		$row2 = mysqli_fetch_assoc($result2);
   		if (mysqli_num_rows($result2) != 0)
   		{
	   		//下班打卡滿八小時
	   		$offtime = (strtotime($time) - strtotime($row2['begin_time']))/ (60*60);
	   		$offtime_out = 9-$offtime;
	   		echo "<script type='text/javascript'>";
			echo "alert('離下班只剩下：" . $offtime_out ."小時');";
			echo "</script>";
	   		if($offtime >9)
	   		{
	   			$sql3 ="SELECT * FROM card_record Where card_date>='$date' and card_date<='$dateup' and card_name = '{$_SESSION['name']}' ";
	   			$result3 = mysqli_query($conn, $sql3);
	   			$row3 = mysqli_fetch_assoc($result3);
	   			if ($row2['end_time'] == null)
	   			{
	   				$sql5="UPDATE card_record SET end_time='$time'";
	   				//關閉資料連接
	   				mysqli_query($conn, $sql5);
	   				echo "<script type='text/javascript'>";
	   				echo "alert('打卡成功！！');";
	   				echo "</script>";
	   			}else
	   			{
	   				echo "<script type='text/javascript'>";
	   				echo "alert('今天下班打卡過了哦！！');";
	   				echo "</script>";
	   			}
	   		}else
	   		{
	   			echo "<script type='text/javascript'>";
	   			echo "alert('今天下班時間還沒到哦！！');";
	   			echo "</script>";
	   		}
	   	}else{
	   		echo "<script type='text/javascript'>";
	   		echo "alert('今天上班打卡還沒打哦！！');";
	   		echo "</script>";
	   	}
   }else if(isset($_POST['month'])){
   	header('Location: TCPDF/pdf.php');
   }else if (isset($_POST['Logout']) && $_POST['Logout'] == "true") {
   	//銷毀
    unset($_SESSION['name']);
    unset($_SESSION['e_no']);
    unset($_SESSION['setCounter']);
    header("Location: index.php");
    exit;
	}
?>

</body>
</html>
