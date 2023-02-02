<?php 
     include("./class/login_user.php");
     include("link.php");
     include("header.php"); 
     $sql = 'select u.password,u.name, c.fullname, c.address, c.phone , c.email from customer c join user u on c.userID = u.id where userID = '.$_SESSION['user_id'].'';
     $con = $p->connect();
     $result = mysql_query($sql,$con);
     $row = mysql_fetch_assoc($result);
?>
<div class="container container_user_info">
     <div class="col-md-4 user_info_left">
          <img class="user_avatar" src="./images/user.jpg" alt="">
          <div class="user_name"><p><?php echo $row['name'] ?></p></div>
          <ul class="info_list">
               <li class="info_item "><a class="info_link item_primary" href="info_user.php">
                    <span><i class='icon_item  bx bxs-user'></i></span>
                    <p>Tài Khoản Của Tôi</p>
               </a></li>
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
          <table class="table table-striped table_info_user">
               <thead>
               </thead>
               <tbody>
                    <tr>
                         <th scope="row row_user">Full Name</th>
                         <td><?php echo $row['fullname'] ?></td>
                    </tr>
                    <tr>
                         <th scope="row row_user">Password</th>
                         <td><?php echo $row['password'] ?><td>
                    </tr>
                    <tr>
                         <th scope="row row_user">Email</th>
                         <td><?php echo $row['email'] ?></td>
                    </tr>
                    <tr>
                         <th scope="row row_user">Phone</th>
                         <td><?php echo $row['phone'] ?></td>
                    </tr>
                    <tr>
                         <th scope="row row_user">Address</th>
                         <td><?php echo $row['address'] ?></td>
                    </tr>
               </tbody>
          </table>
          <button><a href="editUser.php">Sửa</a></button>
 
     </div>
</div>

<?php include("footer.php"); ?>