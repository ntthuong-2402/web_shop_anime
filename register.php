<!DOCTYPE html>
<html lang="en">
<?php 
     // session_start();
     include("link.php") ;
     include("class/clshome.php");
     $p = new myhome();
     switch($_POST['button']){
          case 'REGISTER NOW':
          {
               $name_reg = $_REQUEST['name_reg'];
               $email_reg = $_REQUEST['email_reg'];
               $passreg = $_REQUEST['pass_reg'];
               $pass_reg = sha1($passreg);
               $repassreg = $_REQUEST['repass_reg'];
               $repass_reg = sha1($repassreg);
               if($pass_reg == $repass_reg){
                         
                         if($p->handle_db("insert into anime_db . user (email ,password,name)VALUES ( '$email_reg', '$pass_reg','$name_reg')")==1){
                              $p->handle_db("INSERT INTO anime_db.customer (userID ,fullname ,address ,phone ,email)VALUES ( NULL , '1', '1', '1', '1', '1')");
                              echo '<script type="text/javascript">alert("Bạn đã đăng ký tài khoản thành công");</script>';
                              echo '<meta http-equiv ="refresh" content ="0;url=login.php"/>';
                         }else {
                              echo '<script type="text/javascript">alert("Đăng ký tài khoản thất bại!!!");</script>';
                         }
                         
               }else {
                    echo "<script type='text/javascript'>alert('Mật khẩu không trùng khớp vui lòng nhập lại!');</script>";
               }
               break;
          }
     }
               

     
?>
<body>
<?php include("header.php") ?>
<div class="login-bottom" style="float:none ;margin: 40px auto;">
     <h3>Sign up for free</h3>
     <form method="POST">
          <div class="sign-up">
               <h4>User Name :</h4>
               <input name="name_reg" type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required>	
          </div>
          <div class="sign-up">
               <h4>Email :</h4>
               <input name="email_reg" type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required>	
          </div>
          <div class="sign-up">
               <h4>Password :</h4>
               <input name="pass_reg" type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required>
               
          </div>
          <div class="sign-up">
               <h4>Re-type Password :</h4>
               <input name="repass_reg" type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required>
               
          </div>
          <div class="sign-up">
               <input name="button" type="submit" value="REGISTER NOW" >
          </div>
          
     </form>
</div>
<?php include("footer.php") ?>
</body>
</html>