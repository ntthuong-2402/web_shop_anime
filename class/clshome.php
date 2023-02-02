<?php 
     session_start();
     class myhome 
     {
          function connect () {
               $con = mysql_connect("localhost","admin","123");
               if(!$con)
			{
				echo 'Không thể connect được';
				exit();
			}else{
				mysql_select_db("anime_db");// dùng để chọn csdl hoạt động trên trang website.
				mysql_query("SET NAMES UTF8");// gửi câu lệnh cài đặt tiếng ziệt tới máy chủ sql
				return($con);
			}
          }
          
          function handle_db ($sql) {
               $link = $this->connect();
               $result = mysql_query($sql,$link);
               if($result){
                    return 1;
               }else {
                    return 0;
               }
          }

          function handle_login ($sql,$txt_name,$txt_pass){
               $link = $this->connect();
			$ketqua = mysql_query($sql,$link);
			$n = mysql_num_rows($ketqua);
              
			if($n > 0 ) {
				while($row = mysql_fetch_array($ketqua)){
					// $email = $row['email'];
                         $user_id = $row['id'];
                         $user_name = $row['name'];
					$password = $row['password'];
                         $permission=$row['permission'];
					if($txt_name == $user_name && $txt_pass == $password && $permission==1)
                         {    
                              $_SESSION['role']=$row['permission'];
                              $_SESSION['nameAdmin'] = $txt_name;
                              $_SESSION['passAdmin'] = $txt_pass;
                              header('location:./admin/admin.php');
                         }elseif($txt_name == $user_name && $txt_pass == $password)
                         {     
                              $_SESSION['user_id'] = $user_id;
						$_SESSION['myname'] = $txt_name;
						$_SESSION['mypass'] = $txt_pass;
                              $_SESSION['user_name'] = $user_name;
						header("location:./index.php?page=1");
                         }
						
					else{
						return 0;
					}
				}
			}else {
                    echo '<script type="text/javascript">alert("Sai tài khoản hoặc mật khẩu. Vui lòng nhập lại!!!")</script>';
               }
			mysql_close($link);
          }

          function confirmLogin ($sql,$myname,$mypass){
			$link = $this->connect();
			$ketqua = mysql_query($sql,$link);
			$n = mysql_num_rows($ketqua);
			if($n > 0 ) {
				while($row = mysql_fetch_array($ketqua)){
					$db_name = $row['name'];
					$db_pass = $row['password'];
					if($myname !=$db_name || $mypass != $db_pass ){
						header('location:./login.php');
					}
				}
			}
			mysql_close($link);
		}

          // function confirmLogin2 ($sql,$adminnam,$adminpass){
		// 	$link = $this->connect();
		// 	$ketqua = mysql_query($sql,$link);
		// 	$n = mysql_num_rows($ketqua);
		// 	if($n > 0 ) {
		// 		while($row = mysql_fetch_array($ketqua)){
		// 			$db_name = $row['name'];
		// 			$db_pass = $row['password'];
		// 			if($adminnam !=$db_name || $adminpass != $db_pass ){
		// 				header('location:./login.php');
		// 			}
		// 		}
		// 	}
		// 	mysql_close($link);
		// }

          function listProduct($sql) {
			$link = $this->connect();
			$result = mysql_query($sql,$link);
			$n = mysql_num_rows($result);
			$brand = $_REQUEST['idBrand'];
			// $brand = $_REQUEST['brand'];
			if(isset($brand)) {
                    $results_per_page = 8;
               }else {
                    $results_per_page = 12;
               }
			$totalPage = ceil($n / $results_per_page);
			if($totalPage > 0 ){
				if(!isset($_REQUEST['page'])){
					$page =1;
				}
				else {
					$page = $_REQUEST['page'];
				}
				$page_first = ($page - 1) * $results_per_page;
				$query = $sql . " limit ".$page_first.",".$results_per_page;
				$result = mysql_query($query,$link);
				while($row = mysql_fetch_array($result))
				{
					$id = $row['id'];
					$name = $row['name'];
					$price = $row['price'];
					$lastPrice = $row['lastPrice'];
					$img = $row['image'];
					$desc = $row['desc'];
                              echo '<div class="col-md-3 product-men yes-marg">
                                   <div class="men-pro-item simpleCart_shelfItem">
                                        <div class="men-thumb-item">
                                             <img src="images/'.$img.'" alt="" class="pro-image-front">
                                             <img src="images/'.$img.'" alt="" class="pro-image-back">
                                                  <div class="men-cart-pro">
                                                       <div class="inner-men-cart-pro">
                                                            <a href="productdetail.php?id='.$id.'" class="link-product-add-cart">Quick View</a>
                                                       </div>
                                                  </div>
                                                  <span class="product-new-top">New</span>
                                                  
                                        </div>
                                        <div class="item-info-product ">
                                             <h4><a class="name_product" href="productdetail.php?id='.$id.'">'.$name.'</a></h4>
                                             <div class="info-product-price">
                                                  <span class="item_price">$'.$price.'</span>
                                                  <del>$'.$lastPrice.'</del>
                                             </div>';
                                             if(isset($_SESSION["myname"]) && isset($_SESSION["mypass"])){
                                                 echo ' <a href="index.php?pages=products&action=add&id='.$id.'" class="item_add single-item hvr-outline-out button2">Add to cart</a>';
                                             }else{
                                                  echo'<a href="login.php" class="item_add single-item hvr-outline-out button2">Add to cart</a>';
                                             }
								echo'			
                                        </div>
                                   </div>
                              </div>';
                    }
				// phan trang
				echo '<div class="col-3 mx-auto trang">';
                    echo '<i class="bx bxs-chevron-left"></i>';
				for($i=1; $i <= $totalPage; $i++){
					if(isset($brand)){
                              if(isset($_REQUEST['page'])){
                                   if($_REQUEST['page'] == $i){
                                        echo '<a class="pageNum page_primary" href="brand.php?idBrand='.$brand.'&page='.$i.'">'.$i.'</a>';
                                   }else{
                                        echo '<a class="pageNum" href="brand.php?idBrand='.$brand.'&page='.$i.'">'.$i.'</a>';
                                   }
                              }
                         }else{
                              if($_REQUEST['page'] == $i){
                                   echo '<a  class="pageNum page_primary" href="index.php?page='.$i.'">'.$i.'</a>';
                              }else {
                                   echo '<a class="pageNum" href="index.php?page='.$i.'">'.$i.'</a>';
                              }
					}
				}
                    echo '<i class="bx bxs-chevron-right"></i>';
				echo '</div>';
				
			}
			else {
				echo '<div class="container" style="height: 720px; margin: 48px">
				<h2 class ="text-center" style="margin-bottom: 48px">Oops Hình như bạn tìm cái gì đó mà không có ở đây nhỉ :?)!!!??</h2> 	
				<img class="duck" src ="../images/opps.jpg" width="100%">';
				echo '</div>';
			}
		}

          function productDetail ($sql) {
               $link = $this->connect();
               $result = mysql_query($sql,$link);
               $n = mysql_num_rows($result);
               if($n > 0) {
                    
                    while($row = mysql_fetch_array($result)){
                         $id = $row['id'];
                         $name = $row['name'];
                         $price = $row['price'];
                         $lastPrice = $row['lastPrice'];
                         $img = $row['image'];
                         $des = $row['des'];
                         echo '
                         <div class="col-md-6 single-right-left animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
                              <div class="grid images_3_of_2">
                                   <div class="flexslider">
                                        <!-- FlexSlider -->
                                        <!-- //FlexSlider-->
                                        
                                        
                                        <div class="flexslider">
                                        <!-- FlexSlider -->
                                             <script type="text/javascript">
                                                  $(window).load(function() {
                                                       $(".flexslider").flexslider({
                                                       animation: "slide",
                                                       controlNav: "thumbnails"
                                                       });
                                                  });
                                             </script>
                                             
                                             <ul class="slides">
                                                  <li  >
                                                       <div class="thumb-image" style="margin-right: 42px;"> 
                                                            <img src="images/'.$img.'" data-imagezoom="true" class="img-responsive" style = "height: 508px;">
                                                        </div>
                                                  </li>
                                             </ul>
                                             <div class="clearfix"></div>
                                        </div>	
                                        <div class="clearfix"></div>
                                   </div>	
                              </div>
                         </div>
                         <div class="col-md-6 single-right-left simpleCart_shelfItem animated wow slideInRight animated" data-wow-delay=".5s" style="margin-top:24px; visibility: visible; animation-delay: 0.5s; animation-name: slideInRight;">
                                        <h3>'.$name.'</h3>
                                        <p><span class="item_price">$'.$price.'</span> <del style="font-size: 18px;">- $'.$lastPrice.'</del></p>
                                        <div class="rating1">
                                             <span class="starRating">
                                                  <input id="rating5" type="radio" name="rating" value="5">
                                                  <label for="rating5">5</label>
                                                  <input id="rating4" type="radio" name="rating" value="4">
                                                  <label for="rating4">4</label>
                                                  <input id="rating3" type="radio" name="rating" value="3" checked="">
                                                  <label for="rating3">3</label>
                                                  <input id="rating2" type="radio" name="rating" value="2">
                                                  <label for="rating2">2</label>
                                                  <input id="rating1" type="radio" name="rating" value="1">
                                                  <label for="rating1">1</label>
                                             </span>
                                        </div>
                                        
                                       
                                        <div class="occasional">
                                             <h5>Types :</h5>
                                             <div class="colr ert">
                                                  <label class="radio"><input type="radio" name="radio" checked=""><i></i>10x10</label>
                                             </div>
                                             <div class="colr">
                                                  <label class="radio"><input type="radio" name="radio"><i></i>24x24</label>
                                             </div>
                                             <div class="colr">
                                                  <label class="radio"><input type="radio" name="radio"><i></i>32x32</label>
                                             </div>
                                             <div class="clearfix"> </div>
                                        </div>

                                        <div class="description " style = "display: flex ;">
                                             <h4>Shipping : </h4>
                                                  <select style="margin-left: 63px;" id="country1" class="option-pay" onchange="change_country(this.value)" class="frm-field required sect">
                                                       <option value="null">Viettel Post</option>
                                                       <option value="null">Giao Hàng Nhanh (GHN)</option> 
                                                       <option value="null">Giao Hàng Tiết Kiệm (GHTK)</option>            
                                                  </select>
                                        </div>

                                        <div class="color-quality" style="    margin-top: 16px;">
                                             <div class="color-quality-right">
                                                  <h5>Quantity :</h5>
                                                  <input style ="width: 34px ; margin-left: 30px;" type="number" value="0" min="0" >
                                             </div>
                                        </div>
                                        <div class="description" style = "display: flex;" >
                                             <h4 style="margin-bottom: 12px;">Payment options : </h4>
                                                  <select  id="country1" class="option-pay" onchange="change_country(this.value)" class="frm-field required sect">
                                                       <option value="null">Thanh toán bằng tiền mặt</option>
                                                       <option value="null">Mobile Banking</option> 
                                                       <option value="null">Visa/ Mastercard</option>            
                                                  </select>
                                        </div>

                                        <div class="occasion-cart">
                                             
                                             ';
                                             if(isset($_SESSION["myname"]) && isset($_SESSION["mypass"])){
                                                 echo ' <a href="index.php?page=products&action=add&id='.$id.'" class="item_add hvr-outline-out button2">Add to cart</a>';
                                             }else{
                                                  echo'<a href="login.php" class="item_add hvr-outline-out button2">Add to cart</a>';
                                             }
								echo'
                                        </div>
                                        
                         </div>
                         <div class="clearfix"> </div>
                         <div class="bootstrap-tab animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
                              <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                                   <ul id="myTab" class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Description</a></li>
                                        <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Reviews(1)</a></li>
                                        <li role="presentation" class="dropdown">
                                             <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Information <span class="caret"></span></a>
                                             <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                                                  <li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">cleanse</a></li>
                                                  <li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">fanny</a></li>
                                             </ul>
                                        </li>
                                   </ul>
                                   <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
                                             <h5>Product Brief Description</h5>
                                             <h4>'.$des.'</h4>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="profile" aria-labelledby="profile-tab">
                                             <div class="bootstrap-tab-text-grids">
                                                  <div class="bootstrap-tab-text-grid">
                                                       <div class="bootstrap-tab-text-grid-left">
                                                            <img src="images/user.jpg" alt=" " class="img-responsive">
                                                       </div>
                                                       <div class="bootstrap-tab-text-grid-right">
                                                            <ul>
                                                                 <li><a href="#">Admin</a></li>
                                                                 <li><a href="#"><span class="glyphicon glyphicon-share" aria-hidden="true"></span>Reply</a></li>
                                                            </ul>
                                                            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis 
                                                                 suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem 
                                                                 vel eum iure reprehenderit.</p>
                                                       </div>
                                                       <div class="clearfix"> </div>
                                                  </div>
                                                  
                                                  <div class="add-review">
                                                       <h4>add a review</h4>
                                                       <form>
                                                            <input type="text" value="Name" onfocus="this.value = ""; " onblur="if (this.value == "") {this.value = "Name"}" required="" >
                                                            <input type="email" value="Email" onfocus="this.value = "";" onblur="if (this.value =="") {this.value = "Email";}" required="">
                                                            
                                                            <textarea type="text" onfocus="this.value = "";" onblur="if (this.value == "") {this.value = "Message...";}" required="">Message...</textarea>
                                                            <input type="submit" value="SEND">
                                                       </form>
                                                  </div>
                                             </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown1" aria-labelledby="dropdown1-tab">
                                             <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeneys organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably  heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown2" aria-labelledby="dropdown2-tab">
                                             <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                                        </div>
                                   </div>
                              </div>
				     </div>

                         ';
                    }
               }else {
                    echo 'Không có dữ liệu db';
               }
          }

          function listProductSearch($sql) {
			$link = $this->connect();
			$result = mysql_query($sql,$link);
			$n = mysql_num_rows($result);
               while($row = mysql_fetch_array($result))
				{
					$id = $row['id'];
					$name = $row['name'];
					$price = $row['price'];
					$lastPrice = $row['lastPrice'];
					$img = $row['image'];
					$desc = $row['desc'];
                              echo '<div class="col-md-3 product-men yes-marg">
                                   <div class="men-pro-item simpleCart_shelfItem">
                                        <div class="men-thumb-item">
                                             <img src="images/'.$img.'" alt="" class="pro-image-front">
                                             <img src="images/'.$img.'" alt="" class="pro-image-back">
                                                  <div class="men-cart-pro">
                                                       <div class="inner-men-cart-pro">
                                                            <a href="productdetail.php?id='.$id.'" class="link-product-add-cart">Quick View</a>
                                                       </div>
                                                  </div>
                                                  <span class="product-new-top">New</span>
                                                  
                                        </div>
                                        <div class="item-info-product ">
                                             <h4><a class="name_product" href="productdetail.php?id='.$id.'">'.$name.'</a></h4>
                                             <div class="info-product-price">
                                                  <span class="item_price">$'.$price.'</span>
                                                  <del>$'.$lastPrice.'</del>
                                             </div>
                                             <a href="index.php?pages=products&action=add&id='.$id.'" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
                                        </div>
                                   </div>
                              </div>';
                    }
		
			
		}

          function search(){
               if(isset($_REQUEST['ok'])){
                    switch ($_REQUEST['ok']) {
                         case ' ':
                            $search = addslashes($_POST['search']);
                            if(empty($search)){
                                 echo '<div class="container" style="height: 720px; margin: 48px">
                                 <h2 class ="text-center" style="margin-bottom: 48px">Bạn cần tìm kiếm gì ?</h2> 	
                                 <img class="duck" src ="images/giphy_s.gif" width="100%">';
                                 echo '</div>';
                            }
                            else {
                              echo'<ul class="resp-tabs-list" >
                                        <li class="resp-tab-item" style="margin-left:260px" aria-controls="tab_item-0" role="tab"><span>SEARCH PRODUCTS</span></li> 
                                   </ul>	';
                              $sql = "select * from product where name like '%$search%'";
                              echo '<div class="container" style="margin-left:100px;position: relative;">';
                                        
                                        $this->listProductSearch($sql);
                              echo ' </div>';
                            }
                            break;
                       }
               }

          }

          function renderBrand($sql){
               $link = $this->connect();
			$result = mysql_query($sql,$link);
			$n = mysql_num_rows($result);
               // $m  = "brand.php?idBrand='.$id.'";
               // $url_encode = url_encode($m);
			if($n>0)
			{
				while($row = mysql_fetch_array($result)){
					$brand = ($row['name']);
                         $id = $row['id'];
					echo '
                        <li class=" menu__item"><a class="menu__link"  href="brand.php?idBrand='.$id.'&page=1">'.Strtoupper($brand).'<span class="sr-only">(current)</span></a></li>';
				}
			}
          }

          // function product_filter ($sql) {
          //      $link = $this->connect();
          //      $result = mysql_query($sql,$this);
          //      $n = mysql_num_rows($result);
          //      if($n >0){
          //           while($row = mysql_fetch_array($result)){
          //                $origin = $row['origin'];
          //                $size = $row['size'];
          //                $meterial = $row['meterial'];
          //           }
          //      }
          // }
          // echo ' <li><input type="checkbox"  id="item-2-0" /><a href="brand.php?idBrand='.$id.'&origin='.$item['origin'].'">'.$item['origin'].'</a></li>';
          
          // function product_selling ($sql){
          //      $link = $this->connect();
          //      $result = mysql_query($sql,$link);
          //      $n = mysql_num_rows($result);
          //      if($n>0){
          //           for($i=0;$i<$n;$i++){
                         
          //           }
          //      }else{
          //           echo '<script type="text/javascript">alert("Không có dữ liệu db")</script>';
          //      }
          // }

           //đếm rồi xuất ra trang admin.php
          function totalProduct($sql)
          {
               $link=$this->connect(); 
               $result=mysql_query($sql,$link);
               $row=mysql_num_rows($result);
               $count=0;
               if ($row > 0){
               while ($row=mysql_fetch_array($result)) 
               {
                    $count=$count+1;
               }
               }
               echo $count;  
          }

          function totalUser($sql)
          {
               $link=$this->connect(); 
               $result=mysql_query($sql,$link);
               $row=mysql_num_rows($result);
               $count=0;
               if ($row > 0){
               while ($row=mysql_fetch_array($result)) 
               {
                    $permission=$row['permission'];
                    if($permission!=1)// admin không tính vào tổng users
                    {
                         $count=$count+1;
                    }
               }
               }
               echo $count;  
          }
          
          function totalOrders($sql)
          {
               $link=$this->connect(); 
               $result=mysql_query($sql,$link);
               $row=mysql_num_rows($result);
               $count=0;
               if ($row > 0){
               while ($row=mysql_fetch_array($result)) 
               {
                    $count=$count+1;
               }
               }
               echo $count;  
          }

          function totalBrand($sql)
          {
               $link=$this->connect(); 
               $result=mysql_query($sql,$link);
               $row=mysql_num_rows($result);
               $count=0;
               if ($row > 0){
               while ($row=mysql_fetch_array($result)) 
               {
                    $count=$count+1;
               }
               }
               echo $count;  
          }
      
          function productAdmin ($sql) {
               $link = $this->connect();
               $result = mysql_query($sql,$link);
               $n = mysql_num_rows($result);
               
               if($n>0)
               {
                    echo '
                         <table class="table table-striped table-hover">
                         <tbody>
                              <tr>
                                   <td width="70" align="center" valign="middle"> STT </td>
                                   <td width="140" align="center" valign="middle"> TÊN SẢN PHẨM </td>
                                   <td width="100" align="center" valign="middle"> GIÁ </td>
                                   <td width="250" align="center" valign="middle"> MÔ TẢ </td>
                                   <td width="200" align="center" valign="middle"> HÌNH ẢNH </td>
                                   <td width="136" align="center" valign="middle"> HÀNH ĐỘNG </td>
                         </tr>';
                    $dem=1;	
                    while($row=mysql_fetch_array($result))
                    {
                         $id = $row['id'];
                         $name = $row['name'];
                         $price = $row['price'];
                         $img = $row['image'];
                         $mota= $row['des'];
                         
                         #$delSql= "DELETE FROM product where id = $id";
                         #$queryDel= mysql_query($sql,$delSql);
                         echo ' <tr>
                                        <td align="center" valign="middle">'.$dem.'</td>
                                        <td align="left" valign="middle">'.$name.'</td>
                                        <td align="center" valign="middle">'.'$'.$price.'</td>
                                        <td align="center" valign="middle">'.$mota.'</td>
                                        <td><img src="../images/'.$img.'" width="150px" height="210px"></td>
                                        <td align="center" valign="middle"> 
                                            
                                             <p>
                                             <a href="../admin/editProduct.php?id='.$id.'"class="btn btn-success"> Sửa </a>
                                             <p>
                                             <p>
     
                                             <a href="../admin/productAdmin.php?del_id='.$id.'" class="btn btn-danger"> Xóa </a> 
                                             </p>
                                        </td>
                                        
                                        </tr>';
                              $dem++;
                                
                    }
                    echo ' </tbody>
                    </table>';
               }
               else
               {
                    echo "Khong co du lieu";	
               }
          }
          function uploadIMG($tmpname, $folder, $name)
          {
               $name= $folder.'/'.$name;
               if(move_uploaded_file($tmpname,$name))
               {
                    return 1;
     
               }
               else{
                    return 0;
               }
          }
          function brandAdmin ($sql) {
               $link = $this->connect();
               $result = mysql_query($sql,$link);
               $n = mysql_num_rows($result);
               
               if($n>0)
               {
                    echo '
                         <table class="table table-striped table-hover ">
                         <tbody>
                              <tr>
                                   <td width="20" align="center" valign="middle"> STT </td>
                                   <td width="20" align="center" valign="middle"> Mã THƯƠNG HIỆU </td>
                                   <td width="70" align="center" valign="middle"> TÊN THƯƠNG HIỆU </td>
                                   <td width="70" align="center" valign="middle"> LOGO </td>
                                   <td width="70" align="center" valign="middle"> HÀNH ĐỘNG </td>
                                   
                              </tr>';
                    $dem=1;	
                    while($row=mysql_fetch_array($result))
                    {
                         $id = $row['id'];
                         $name = $row['name'];
                         $img = $row['banner'];
                         
                         #$delSql= "DELETE FROM product where id = $id";
                         #$queryDel= mysql_query($sql,$delSql);
                         echo ' <tr>
                                        <td align="center" valign="middle">'.$dem.'</td>
                                        <td align="center" valign="middle">'.$id.'</td>
                                        <td align="center" valign="middle">'.$name.'</td>
                                        <td align="center" valign="middle"><img src="../images/'.$img.'" width="220px" height="210px"></td>
                                        <td align="center" valign="middle"> 
                                            
                                             <p>
                                             <a href="../admin/editBrand.php?id='.$id.'"class="btn btn-success"> Sửa </a>
                                             <p>
                                             <p>
     
                                             <a href="../admin/brandAdmin.php?del_id='.$id.'" class="btn btn-danger"> Xóa </a> 
                                             </p>
                                        </td>
                                        
                                        </tr>';
                              $dem++;
                         
                                
                    }
                         
                    echo ' </tbody>
                    </table>';
               }
               else
               {
                    echo "Khong co du lieu";	
               }
          }
          function userAdmin ($sql) {
               $link = $this->connect();
               $result = mysql_query($sql,$link);
               $n = mysql_num_rows($result);
               
               if($n>0)
               {
                    echo '
                         <table class="table table-striped table-hover ">
                         <tbody>
                              <tr>
                                   <td width="20" align="center" valign="middle"> STT </td>
                                   <td width="20" align="center" valign="middle"> ID </td>
                                   <td width="70" align="center" valign="middle"> TÊN NGƯỜI DÙNG </td>
                                   <td width="70" align="center" valign="middle"> EMAIL </td>
                                   
                                   <td width="70" align="center" valign="middle"> HÀNH ĐỘNG </td>
                              </tr>';
                    $dem=1;	
                    while($row=mysql_fetch_array($result))
                    {
                         $id = $row['id'];
                         $name = $row['name'];
                         $email= $row['email'];
                         $permission=$row['permission'];
                         
                         #$delSql= "DELETE FROM product where id = $id";
                         #$queryDel= mysql_query($sql,$delSql);
                         echo ' <tr>
                                        <td align="center" valign="middle">'.$dem.'</td>
                                        <td align="center" valign="middle">'.$id.'</td>
                                        <td align="center" valign="middle">'.$name.'</td>
                                        <td align="center" valign="middle">'.$email.'</td>
                                        
                                        <td align="center" valign="middle"> 
                                             <p>
                                             <a href="../admin/editUser.php?id='.$id.'"class="btn btn-success"> Sửa </a>
                                             <p>
                                             <p>
                                             <a href="../admin/userAdmin.php?del_id='.$id.'" class="btn btn-danger"> Xóa </a> 
                                             </p>
                                        </td>
                                        
                                        </tr>';
                              $dem++;
                         
                                
                    }
                    echo ' </tbody>
                    </table>';
               }
               else
               {
                    echo "Khong co du lieu";	
               }
          }
          function blogAdmin ($sql) {
               $link = $this->connect();
               $result = mysql_query($sql,$link);
               $n = mysql_num_rows($result);
               
               if($n>0)
               {
                    echo '
                         <table class="table table-striped table-hover">
                         <tbody>
                              <tr>
                                   <td width="70" align="center" valign="middle"> STT </td>
                                   <td width="140" align="center" valign="middle"> CHỦ ĐỀ </td>
                                   <td width="250" align="center" valign="middle"> NỘI DUNG </td>
                                   
                                   <td width="170" align="center" valign="middle"> NGÀY ĐĂNG BÀI </td>
                                   <td width="200" align="center" valign="middle"> HÌNH ẢNH </td>
                                   <td width="150" align="center" valign="middle"> HÀNH ĐỘNG </td>
                         </tr>';
                    $dem=1;	
                    while($row=mysql_fetch_array($result))
                    {
                         $id = $row['id'];
                         $title = $row['title'];
                         $content = $row['content'];
                         $img = $row['image'];
                         $date= $row['date'];
                         
                         #$delSql= "DELETE FROM product where id = $id";
                         #$queryDel= mysql_query($sql,$delSql);
                         echo ' <tr>
                                        <td align="center" valign="middle">'.$dem.'</td>
                                        <td align="left" valign="middle">'.$title.'</td>
                                        <td align="left" valign="middle">'.$content.'</td>
                                        <td align="center" valign="middle">'.$date.'</td>
                                        <td align="center" valign="middle" ><img src="../images/'.$img.'" width="200px" height="210px"></td>
                                        <td align="center" valign="middle"> 
                                            
                                             <p>
                                             <a href="../admin/editBlog.php?id='.$id.'"class="btn btn-success"> Sửa </a>
                                             <p>
                                             <p>
     
                                             <a href="../admin/blogAdmin.php?del_id='.$id.'" class="btn btn-danger"> Xóa </a> 
                                             </p>
                                        </td>
                                        
                                        </tr>';
                              $dem++;
                                
                    }
                    echo ' </tbody>
                    </table>';
               }
               else
               {
                    echo "Khong co du lieu";	
               }
          }

          function sendEmail ($email){
               
          }

          }


?>
