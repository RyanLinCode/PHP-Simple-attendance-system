<?php
include("library/mysql.inc.php");

//如果網頁表單的 account 與 password 欄位都不是空字串
if (!empty($_POST['account']) && !empty($_POST['password']) && !empty($_POST['name'])){

  //檢查帳號是否有人申請
  $sql2 = "SELECT * FROM employee Where emp_ac = '{$_POST['account']}'";
  $result = mysqli_query($conn, $sql2);
  //如果帳號已經有人使用
  if (mysqli_num_rows($result) != 0)
  {
    //顯示訊息要求使用者更換帳號名稱
    echo "<script type='text/javascript'>";
    echo "alert('您所指定的帳號已經有人使用，請使用其它帳號');";
    echo "history.back();";
    echo "</script>";
  }
  //如果帳號沒人使用
  else
  {
      //字元長度不能超過10
      if(strlen($_POST['account'])>=10 ||strlen($_POST['password'])>=10)
      {
      }
      else
      {
        //將 name 與 qty 欄位值新增至 【inventory】 資料表
        $sql="INSERT employee (emp_ac, emp_pw,emp_name,emp_del)
              VALUES ('{$_POST['account']}','{$_POST['password']}','{$_POST['name']}',0)";
        //關閉資料連接  
        mysqli_query($conn, $sql);

        echo "<script type='text/javascript'>";
        echo "alert('帳號註冊成功');";
        echo "window.location.href='index.php';";
        echo "</script>";
      }
  }
}
?>
<html>
  <head>
    <title>Sign up</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.name.value.length == 0)
        {
          alert("We need your name");
          return false;
        } 
        if (document.myForm.account.value.length == 0)
        {
          alert("You need to type your account here");
          return false;
        }
        if (document.myForm.account.value.length > 10)
        {
          alert("Your account is too long. Less than 10 characters please");
          return false;
        }
        if (document.myForm.password.value.length == 0)
        {
          alert("You need to type your password here");
          return false;
        }
        if (document.myForm.password.value.length > 10)
        {
          alert("Your password is too long. Less than 10 characters please");
          return false;
        }
        if (document.myForm.re_password.value.length == 0)
        {
          alert("Hey, we need a password confirmation here");
          return false;
        }
        if (document.myForm.password.value != document.myForm.re_password.value)
        {
          alert("「密碼確認」欄位與「使用者密碼」欄位一定要相同...");
          return false;
        }
        myForm.submit();					
      }
    </script>		
  </head>
  <body>
      <div class="addTable">
        <div class="container">
          <div class="col-md-12 ">
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" name="myForm">

              <font class="font">Create your account
              </font>
              <br>
              <br>
              <label name="user[login]" autocapitalize="off" autofocus="autofocus" required="required" for="user_login">Username
              </label>
              <br>
              <input name="name" type="text" placeholder="Enter your name" required="" autofocus="">
              <br>

              <label name="acc[login]" autocapitalize="off" autofocus="autofocus" required="required" for="acc_login">Account
              </label>
              <br>
              <input name="account"  type="text" placeholder="Enter your account"  required="" autofocus="">
              <br>

              <label name="pass[login]" autocapitalize="off" autofocus="autofocus" required="required" for="pass_login">Password
              </label>
              <br>
              <input name="password" type="password" placeholder="Enter your password" required="" autofocus="">
              <br>

              <label name="pass _con[login]" autocapitalize="off" autofocus="autofocus" required="required" for="pass_con_login">Password confirmation
              </label>
              <br>
              <input name="re_password" type="password" placeholder="Password confirmation" required="" autofocus="">
              <br>
              <br>

              <button name="login" type="submit" onClick="check_data()">Log in</button>
              <button name="login" type="submit"  
              onclick="window.location.href='index.php'"
              >Sing in</button>
            </form>
          </div>
        </div>
      </div>
  </body>
</html>