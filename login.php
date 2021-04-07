<?php
include("library/mysql.inc.php");
session_start();
  
  //檢查帳號密碼

	if(isset($_POST['account']) and isset($_POST['password']))
	{
	    //檢查帳號是否有人
	    $sql = "SELECT * FROM employee Where emp_ac = '{$_POST['account']}'";
	    $result = mysqli_query($conn, $sql);

	    // 取得單行
	    $row = mysqli_fetch_assoc($result);
	    // echo $row['emp_name'];
	      if (mysqli_num_rows($result) == 0)
	      {

	      	echo "<script type='text/javascript'>";
	        echo "alert('帳號尚未註冊！！');";
	        echo "</script>";
	      }
	      else
	      { 
	         //用 session 變數紀錄使用者名稱
	        $_SESSION['name']=$row['emp_name'];
	        $_SESSION['e_no']=$row['emp_no'];
	        //登入成功就可以增加 1 次上線次數
	        $_SESSION['setCounter']=TRUE;
	        header('Location: card.php');   // 進入會員區
	        exit();        // 結束程式   
	      }
	}
	else
	{
		echo "<script type='text/javascript'>";
	    echo "alert('請輸入帳號密碼！！');";
	    echo "</script>";
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>簡易人員系統</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body onload="show_date();show_time()">
	<div class="whatsOn">
		<div class="container">
			<div class="col-md-12 ">
					<!-- 電腦顯示時鐘 -->
					<form id="clock" runat="server" >
						<div id = "show_date"></div>
						<div id = "show_time"></div>
					</form>
			</div>
			<div class="col-md-12" style="height: 100px;">
				<div class="title">
					<form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
						<h2>
							<input name="account"  type="text" placeholder="Enter your account"  required="" autofocus="">
							<br>
							<h2 title="密碼">
							<input name="password" type="password" placeholder="Enter your password" required="" autofocus="">
							<div class="proButton-top">
								<button type="button" onclick=location.href='add.php'>Sign up</button>
								<button name="login" type="submit">Log in</button>
								<button type="reset">Clear</button>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

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
