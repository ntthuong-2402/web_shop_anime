<?php 
     include("./class/login_user.php");

     $con = $p->connect();
     $sql = 'select u.password, u.name , c.fullname, c.address, c.phone , c.email from customer c join user u on c.userID = u.id where userID = '.$_SESSION['user_id'].'';
     $result = mysql_query($sql,$con);
     $row = mysql_fetch_assoc($result);

     $name = $_REQUEST['txtname'];
     $pass = sha1($_REQUEST['txtpass']);
     $re_pass = sha1($_REQUEST['txtrepass']);
     $email = $_REQUEST['txtemail'];
     $phone = $_REQUEST['txtphone'];
     $address = $_REQUEST['txtaddress'];
     $user_id = $_SESSION['user_id'];
     // $p->handle_db('INSERT INTO anime_db.customer ( userID, fullname, address, phone, email) VALUES ( '.$_SESSION['user_id'].', '.$name.', '.$address.', '.$phone.', '.$email.')');

     switch($_POST['button']){
          case 'Lưu':{
               $sql_user = 'select * from customer where userID ='.$user_id.'';
               $ketqua_user = mysql_query($sql_user,$con);
               $s = mysql_num_rows($ketqua_user);
               if($s>0){
                    if( $email !='' && $phone !='' && $address !='' && $pass !='' && $re_pass !=''){
                         if($p->handle_db('UPDATE customer SET fullname="'.$name.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'" where userID="'.$user_id.'"')==1){
                              if($pass ==$re_pass){
                                   $p->handle_db('UPDATE user SET password = "'.$pass.'", email="'.$email.'" ');
                                   echo '<script type="text/javascript">alert("Sửa thông tin thành công!")</script>';
                                   echo "<meta http-equiv='refresh' content= '0;url=info_user.php'/>";
                                   // exit();
                              }else{
                                   echo '<script type="text/javascript">alert("Mật khẩu không trùng khớp!Vui Lòng Nhập Lại")</script>';
                              }
                         }

                    }else {
                         echo '<script type="text/javascript">alert("Bạn cần nhập đầy đủ thông tin!")</script>';
                    }
               }else {
                    if( $p->handle_db("INSERT INTO anime_db.customer ( userID, fullname, address, phone, email) VALUES ( '$user_id', '$name', '$address', '$phone', '$email')")==1){
                         $p->handle_db('UPDATE user SET password = "'.$pass.'", email="'.$email.'"');
                         echo '<script type="text/javascript">alert("Thêm thông tin thành công!")</script>';
                         echo "<meta http-equiv='refresh' content= '0;url=info_user.php'/>";
                         // exit();
                    }
               }

               break;
          }
     }

     include("link.php");
     include("header.php"); 
?>
<div class="container container_user_info">
     <div class="col-md-4 user_info_left">
          <img class="user_avatar" src="./images/user.jpg" alt="">
          <div class="user_name"><p><?php echo $row['name'] ?></p></div>
          <ul class="info_list">
               <li class="info_item"><a class="info_link" href="">
                    <span><i class=' icon_item bx bx-notepad'></i></span>
                    <p>Đơn Mua</p>
               </a></li>
               <li class="info_item"><a class="info_link" href="">
                    <span><i class=' icon_item bx bx-bell'></i></span>
                    <p>Thông Báo</p>
               </a></li>
               <li class="info_item"><a class="info_link" href="">
                    <span><i class=" icon_item bx bx-joystick-button"></i></span>
                    <p>Kho Voucher</p>
               </a></li>
               <li class="info_item"><a class="info_link" href="">
                    <span><i class=" icon_item bx bxl-bitcoin"></i></span>
                    <p>Anime xu</p>
               </a></li>
          </ul>
     </div>
     <div class="col-md-8">
          <div class="header_user_info">HỒ SƠ CỦA TÔI</div>
          <p class="noti">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
         
          <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
               <table>
                    <tr>
                         <th scope="row">Full Name</th>
                         <td><input class="txt_info" type="text" name="txtname" id="textfield" value="<?php echo $row['fullname'] ?>"/></td>
                    </tr>
                    <tr>
                         <th scope="row">Password</th>
                         <td><input class="txt_info" type="password" value="<?php echo $row['password'] ?>" name="txtpass" id="textfield" /></td>
                    </tr>
                    <tr>
                         <th scope="row">Re_Password</th>
                         <td><input class="txt_info" type="password" value="<?php echo $row['password'] ?>"   name="txtrepass" id="textfield" /></td>
                    </tr>
                    <tr>
                         <th scope="row">Email</th>
                         <td><input class="txt_info" type="text" value="<?php echo $row['email'] ?>"  name="txtemail" id="textfield" /></td>
                    </tr>
                    <tr>
                         <th scope="row">Phone</th>
                         <td><input class="txt_info" type="text" value="<?php echo $row['phone'] ?>"  name="txtphone" id="textfield" /></td>
                    </tr>
                    <tr>
                         <th scope="row">Address</th>
                         <td><input class="txt_info" type="text" value="<?php echo $row['address'] ?>"  name="txtaddress" id="textfield" /></td>
                    </tr>
               </table>
               <input class="btn_info" name="button" type="submit" value="Lưu">
          </form>
          
     </div>
</div>

<?php include("footer.php"); ?>