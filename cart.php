<?php 
	error_reporting(E_ERROR | E_PARSE);
	require_once("config.php");
	include("./class/login_user.php");

	

	if(isset($_POST['update'])){ 
		foreach($_POST['quantity'] as $key => $val) { 
			if($val==0) { 
				unset($_SESSION['cart'][$key]); 
			}else{ 
				$_SESSION['cart'][$key]['quantity']=$val; 
			} 
		} 
	}

	if(isset($_GET['action']) && $_GET['action']=="remove"){ 

		$id=intval($_GET['id']);
		unset($_SESSION['cart'][$id]);
		
	}

	$user_id = $_SESSION['user_id'];
	$date_order = date('Y-m-d');
	$orderID = 'U'.$_SESSION['user_id'].'ID'.substr(time(),3,7);

?>

<body>
<?php include("header.php") ?>

<!-- banner -->
<div class="page-head">
	<div class="container">
		<h3>SHOPPING CART</h3>
	</div>
</div>
<!-- //banner -->
<!-- check out -->
<div class="checkout">
	<div class="container">
		<h3>My Shopping Bag</h3>
		<div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
		<form method="post" action="cart.php?page=cart">
			<table class="timetable_sub">
				<thead>
					<tr>
						<th>Remove</th>
						<th>Image product</th>
						<th>Quantity</th>
						<th>Product Name</th>
						<!-- <th>Brand</th> -->
						<th>Price</th>
						
					</tr>
			<?php 
				$con = $p->connect();
          		$sql="SELECT * FROM product WHERE id IN ("; 
                    
				if(isset($_SESSION['cart'])){
					foreach($_SESSION['cart'] as $id => $value) { 
						$sql.=$id.","; 
					} 
				}
				
					
				$sql=substr($sql, 0, -1).") ORDER BY name ASC"; 
				$query=mysql_query($sql,$con); 
				$totalprice=0;
				
			   	// $n = mysql_num_rows($query);
				// if($n>0){
					while($row=mysql_fetch_array($query)){
								
						$subtotal=$_SESSION['cart'][$row['id']]['quantity']*$row['price']; 
						$totalprice+=$subtotal; 
						
				?>
						</thead>
						<tr class="rem1">
							<td class="invert-closeb">
								<div class="rem">
									<a href="cart.php?page=products&action=remove&id=<?php echo $row ['id']?>">
										<div class="close1"></div>
									</a>
								</div>
							</td>
							<td class="invert-image"><a href=""><img src="images/<?php echo $row['image']?>" alt=" " class="img-responsive" /></a></td>
							<td class="invert"><input type="number" style="width:40px" min="0" name="quantity[<?php echo $row['id'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['id']]['quantity'] ?>" /></td>
							<td class="invert"><?php echo $row['name']?></td>
							<td class="invert"><?php echo $row['price']?></td>
						</tr>
				<?php
				}
				?>
				
				
					
				

				
					
			</table>
			<br /> 
  					<button type="submit" name="update">Update Cart</button>
			</from> 
		</div>
		<div class="checkout-left">	
				
				<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a href="index.php?page=1"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Back To Shopping</a>
				</div>
				<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
					<h4>Shopping basket</h4>
					<ul>
						<?php
							$con = $p->connect();
							$sql="SELECT * FROM product WHERE id IN ("; 
							
							foreach($_SESSION['cart'] as $id => $value) { 
								$sql.=$id.","; 
							} 
							
							$sql=substr($sql, 0, -1).") ORDER BY name ASC"; 
							$query=mysql_query($sql,$con);
							
							while($row=mysql_fetch_array($query)){
								$idProduct = $row['id'];
								$name_product = $row['name'];
								$price_product = $row['price'];
								echo '<li style="display:flex">'.$name_product.' <i style="margin:0 8px;">x</i><span>'.$_SESSION['cart'][$row['id']]['quantity'].'</span><i style="margin: 0px 34px 0 5px;">=</i> <span>$'.$price_product*$_SESSION['cart'][$row['id']]['quantity'].'</span></li>';
							
							}
						?>
						<li style="border-top: 1px solid #ccc;padding-top: 16px;">Total <i>=</i> <span>$<?php echo $totalprice ?></span></li>
						<div class="select_pay">
							<form action="" method="post">
								<p class="pay_cash">
									<input  type="radio" name="pay" id="" value="Thanh toán tiền mặt">
									<label for="">Thanh toán tiền mặt</label>
								</p>
								<p class="pay_online">
									<input  type="radio" name="pay" id="" value="Thanh toán trực tuyến">
									<label for="">Thanh toán trực tuyến</label>
								</p>

								<input name="btn" class="pay_btn" type="submit" value="Thanh Toán Hoá Đơn">
								<?php

									$length = count($_SESSION['cart']);
									$pay = $_REQUEST['pay'];
									
									foreach($_SESSION['cart'] as $key=>$value) {
										$quantity = strval($_SESSION['cart'][$key]['quantity']);
										$soluong +=$quantity;
									}
									switch ($_POST['btn']){
										case 'Thanh Toán Hoá Đơn':{
											
											$sql_user = 'select * from customer where userID ='.$user_id.'';
											$ketqua_user = mysql_query($sql_user,$con);
											$s = mysql_num_rows($ketqua_user);
											if($s>0){
												if(isset($pay)){
													if($pay =='Thanh toán trực tuyến'){
														$startTime = date("YmdHis");
														$expire = date('YmdHis',strtotime('+1 weeks',strtotime($startTime)));
					
														$madonhang = $orderID; // 'U'.$_SESSION['userid'].'T'.substr(time(),3,5);
														$vnp_TxnRef = time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
														$vnp_OrderInfo = 'Thanh toán đơn hàng ' . time();
														$vnp_OrderType = 'billpayment';
														$vnp_Amount =$totalprice * 2300000;
														$vnp_Locale = 'vn';
														$vnp_BankCode = 'NCB';
														$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
														//Add Params of 2.0.1 Version
														$vnp_ExpireDate = $expire;
					
														$inputData = array(
														"vnp_Version" => "2.1.0",
														"vnp_TmnCode" => $vnp_TmnCode,
														"vnp_Amount" => $vnp_Amount,
														"vnp_Command" => "pay",
														"vnp_CreateDate" => date('YmdHis'),
														"vnp_CurrCode" => "VND",
														"vnp_IpAddr" => $vnp_IpAddr,
														"vnp_Locale" => $vnp_Locale,
														"vnp_OrderInfo" => $vnp_OrderInfo,
														"vnp_OrderType" => $vnp_OrderType,
														"vnp_ReturnUrl" => $vnp_Returnurl,
														"vnp_TxnRef" => $vnp_TxnRef,
														"vnp_ExpireDate"=>$vnp_ExpireDate
														);
					
														if (isset($vnp_BankCode) && $vnp_BankCode != "") {
														$inputData['vnp_BankCode'] = $vnp_BankCode;
														}
														//var_dump($inputData);
														ksort($inputData);
														$query = "";
														$i = 0;
														$hashdata = "";
														foreach ($inputData as $key => $value) {
														if ($i == 1) {
															$hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
															} else {
																$hashdata .= urlencode($key) . "=" . urlencode($value);
																$i = 1;
															}
															$query .= urlencode($key) . "=" . urlencode($value) . '&';
														}
					
														$vnp_Url = $vnp_Url . "?" . $query;
														if (isset($vnp_HashSecret)) {
															$vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
															$vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
														}
														$returnData = array('code' => '00'
															, 'message' => 'success'
															, 'data' => $vnp_Url);
															if (isset($_POST['btn'])) {
																
																$p->handle_db("INSERT INTO anime_db.orders (userID ,quantity,totalprice ,payment ,date,orderID)VALUES ( '$user_id','$soluong', '$totalprice', 1, '$date_order','$orderID')");
																
																// tách các đơn hàng riêng lẻ để thêm vào db orderDetail
																foreach($_SESSION['cart'] as $key=>$value) {
	
																	$quantity2 = strval($_SESSION['cart'][$key]['quantity']);
																	$insertString .='("'.$_SESSION['cart'][$key]['productID'].'","'.$orderID.'","'.$quantity2.'","'.$_SESSION['cart'][$key]['price'].'")';
																	$insertString .= ',';
																}
																$arr_insert =  substr($insertString,0,-1);
																$p->handle_db('INSERT INTO anime_db.orderdetail (productID ,orderID,quantity ,price )VALUES '.$arr_insert.'');
																
																unset($_SESSION['cart']); // remove cart
																echo "<meta http-equiv='refresh' content='0;url=".$vnp_Url."'>";
																die();
															} else {
																echo json_encode($returnData);
															}
														
													}else {
														$p->handle_db("INSERT INTO anime_db.orders (userID ,quantity,totalprice ,payment ,date,orderID)VALUES ( '$user_id','$soluong', '$totalprice', 0, '$date_order','$orderID')");
														
														// tách các đơn hàng riêng lẻ để thêm vào db orderDetail
														foreach($_SESSION['cart'] as $key=>$value) {
	
															$quantity2 = strval($_SESSION['cart'][$key]['quantity']);
															$insertString .='("'.$_SESSION['cart'][$key]['productID'].'","'.$orderID.'","'.$quantity2.'","'.$_SESSION['cart'][$key]['price'].'")';
															$insertString .= ',';
														}
														$arr_insert =  substr($insertString,0,-1);
														if($p->handle_db('INSERT INTO anime_db.orderdetail (productID ,orderID,quantity ,price )VALUES '.$arr_insert.'')==1){
															echo '<script type="text/javascript">alert("Đặt đơn hàng thành công!")</script>';
															unset($_SESSION['cart']); // remove cart
															echo "<meta http-equiv='refresh' content='0;url=".$_SERVER['PHP_SELF']."'>";
														}
														
													}
												}else{
													echo "<script type='text/javascript'>alert('Bạn cần phải chọn phương thức thanh toán');</script>";
												}
											}else {
												echo '<script type="text/javascript">alert("Bạn cần cập nhật thông tin cá nhân để mua hàng!")</script>';
												echo "<meta http-equiv='refresh' content='0;url=editUser.php'>";
											}
											
											break;
										}
									}

									
									
								?>
							</form>
						</div>
					</ul>
				</div>
				<div class="clearfix"> </div>
		</div>
	</div>
</div>	
<!-- //check out -->

<!-- footer -->
<?php include ("footer.php") ?>
</body>
</html>

