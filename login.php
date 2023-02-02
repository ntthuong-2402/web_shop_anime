<?php
          include("class/clshome.php");
          $p =  new myhome();
          switch($_POST['button']){
               case 'SIGN IN':
               {
                    $name_login = $_REQUEST['name_login'];
                    $passlogin = $_REQUEST['pass_login'];
                    $pass_login = sha1($passlogin);
                    if($p->handle_login("select * from user where name ='$name_login' and password = '$pass_login'",$name_login,$pass_login)!=0){
                         echo "<script type='text/javascript'>alert('Bạn đã đăng nhập thành công');</script>";
                    }
               }
          }
?>
<!-- header -->
<?php include("header.php") ?>
<div class="login-bottom" style="float:none ;margin: 40px auto;">
     <h3>Sign in with your account</h3>
     <form method="POST">
          <div class="sign-in">
               <h4>User name :</h4>
               <input type="text" name="name_login" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
          </div>
          <div class="sign-in">
               <h4>Password :</h4>
               <input type="password" name="pass_login" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
               <a href="#">Forgot password?</a>
          </div>
          <div class="single-bottom">
               <input type="checkbox"  id="brand" value="">
               <label for="brand"><span></span>Remember Me.</label>
          </div>
          <div class="sign-in">
               <input name="button" type="submit" value="SIGN IN" >
          </div>
         
     </form>

</div>
<?php include("footer.php") ?>
</body>
</html>