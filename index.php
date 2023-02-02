
<!-- header -->
<?php 
	include("./class/login_user.php");
	include("header.php");
	mysql_error();
	
	
?>

<!-- banner -->
<div class="banner-grid">
	<div id="visual">
			<div class="slide-visual">
				<!-- Slide Image Area (1000 x 424) -->
				<ul class="slide-group">
					<li><img class="img-responsive" src="images/bgball123.jpg" alt="Dummy Image" /></li>
					<li><img class="img-responsive" src="images/bg_header.jpg" alt="Dummy Image" /></li>
					<li><img class="img-responsive" src="images/bg_header4.jpg" alt="Dummy Image" /></li>
				</ul>

				<!-- Slide Description Image Area (316 x 328) -->
				<div class="script-wrap">
					<ul class="script-group">
						<li><div class="inner-script"><img class="img-responsive" src="images/bg_header2.jpg" alt="Dummy Image" /></div></li>
						<li><div class="inner-script"><img class="img-responsive" src="images/bg_header3.jpg" alt="Dummy Image" /></div></li>
						<li><div class="inner-script"><img class="img-responsive" src="images/bg_header5.jpg" alt="Dummy Image" /></div></li>
					</ul>
					<div class="slide-controller">
						<a href="#" class="btn-prev"><img src="images/btn_prev.png" alt="Prev Slide" /></a>
						<a href="#" class="btn-play"><img src="images/btn_play.png" alt="Start Slide" /></a>
						<a href="#" class="btn-pause"><img src="images/btn_pause.png" alt="Pause Slide" /></a>
						<a href="#" class="btn-next"><img src="images/btn_next.png" alt="Next Slide" /></a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	<script type="text/javascript" src="js/pignose.layerslider.js"></script>
	<script type="text/javascript">
	//<![CDATA[
		$(window).load(function() {
			$('#visual').pignoseLayerSlider({
				play    : '.btn-play',
				pause   : '.btn-pause',
				next    : '.btn-next',
				prev    : '.btn-prev'
			});
		});
	//]]>
	</script>

</div>
<!-- //banner -->
<!-- content -->

<div class="new_arrivals">
	<div class="container">
		<h3><span>new </span>arrivals</h3>
		<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium</p>
		<div class="new_grids">
			<div class="col-md-4 new-gd-left">
				<img src="images/robin.jpg" alt=" " />
				<div class="wed-brand simpleCart_shelfItem">
					
				</div>
			</div>
			<div class="col-md-4 new-gd-middle">
				<div class="new-levis">
					<div class="mid-img">
						<img src="images/logobrand.png" alt=" " />
					</div>
					<div class="mid-text">
						<h4>up to 40% <span>off</span></h4>
						<a class="hvr-outline-out button2" href="brand.php?idBrand=1">Shop now </a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="new-levis">
					<div class="mid-text">
						<h4>up to 50% <span>off</span></h4>
						<a class="hvr-outline-out button2" href="brand.php?idBrand=3">Shop now </a>
					</div>
					<div class="mid-img">
						<img src="images/logobrand2.png" alt=" " />
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4 new-gd-left">
				<img src="images/tanjiro.jpg" style="height: 465px" alt=" " />
				<div class="wed-brandtwo simpleCart_shelfItem">
					
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- //content -->
<!-- content-bottom -->

<!-- select productID, count(madonhang) from orders group by productID -->
<!-- SELECT productID, COUNT( madonhang ) AS soluong , p.name FROM orders o join product p on o.productID = p.id  GROUP BY productId ORDER BY COUNT( madonhang ) DESC LIMIT 0 , 3 -->

<?php 
	for ($i = 0 ; $i<3;$i++){
		$link = $p->connect();
		$sql_best_sell =  'SELECT o.productID, COUNT( o.quantity) AS soluong , p.name ,p.price, p.image FROM orderdetail o join product p on o.productID = p.id  GROUP BY o.productID ORDER BY COUNT( o.quantity) DESC LIMIT '.$i.' , 1';
		$result = mysql_query($sql_best_sell,$link);
		$n = mysql_num_rows($result);
		if($n>0){
			while($row = mysql_fetch_array($result)){
				$id_best_sell[$i] = $row['productID'];
				$name_best_sell[$i] = $row['name'];
				$price_best_sell[$i] = $row['price'];
				$img_best_sell[$i] = $row['image'];
			}
		}
	}
?>

<div class="content-bottom">
	<div class="col-md-7 content-lgrid">
		<div class="col-sm-6 content-img-left text-center">
			<div class="content-grid-effect slow-zoom vertical">
				<div class="img-box"><img src="images/<?php echo $img_best_sell[0] ?>" style="height: 341px; width: 506px;" alt="image" class="img-responsive zoom-img"></div>
					<div class="info-box">
						<div class="info-content simpleCart_shelfItem">
									<h4><?php echo $name_best_sell[0] ?></h4>
									<span class="separator"></span>
									<p><span class="item_price">$<?php echo $price_best_sell[0] ?></span></p>
									<span class="separator"></span>
									<a class="item_add hvr-outline-out button2" href="index.php?pages=products&action=add&id=<?php echo $id_best_sell[0] ?>">add to cart </a>
						</div>
					</div>
			</div>
		</div>
		<div class="col-sm-6 content-img-right">
			<h3>Top 3 Best Selling<span>Discount On</span> Up to 50% off</h3>
		</div>
		
		<div class="col-sm-6 content-img-right">
			<h3>Buy 1 get 1  free on <span> Branded</span> One Piece</h3>
		</div>
		<div class="col-sm-6 content-img-left text-center">
			<div class="content-grid-effect slow-zoom vertical">
				<div class="img-box"><img src="images/<?php echo $img_best_sell[1] ?>" style="width: 507px;height: 343px;" alt="image" class="img-responsive zoom-img"></div>
					<div class="info-box">
						<div class="info-content simpleCart_shelfItem">
							<h4><?php echo $name_best_sell[1] ?></h4>
							<span class="separator"></span>
							<p><span class="item_price">$<?php echo $price_best_sell[1] ?></span></p>
							<span class="separator"></span>
							<a class="item_add hvr-outline-out button2" href="index.php?pages=products&action=add&id=<?php echo $id_best_sell[1] ?>">add to cart </a>
						</div>
					</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="col-md-5 content-rgrid text-center">
		<div class="content-grid-effect slow-zoom vertical">
				<div class="img-box"><img src="images/<?php echo $img_best_sell[2] ?>" style ="height: 686px;width: 507px;" alt="image" class="img-responsive zoom-img"></div>
					<div class="info-box">
						<div class="info-content simpleCart_shelfItem">
								<h4><?php echo $name_best_sell[2] ?></h4>
								<span class="separator"></span>
								<p><span class="item_price">$<?php echo $price_best_sell[2] ?></span></p>
								<span class="separator"></span>
								<a class="item_add hvr-outline-out button2" href="index.php?pages=products&action=add&id=<?php echo $id_best_sell[2] ?>">add to cart </a>
						</div>
					</div>
			</div>
	</div>
	<div class="clearfix"></div>
</div>
<!-- //content-bottom -->
<!-- product-nav -->

<div class="product-easy">
	<div class="container">
		
		<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
		<script type="text/javascript">
							$(document).ready(function () {
								$('#horizontalTab').easyResponsiveTabs({
									type: 'default', //Types: default, vertical, accordion           
									width: 'auto', //auto or any width like 600px
									fit: true   // 100% fit in a container
								});
							});
							
		</script>
		<div class="sap_tabs">
			<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item"  aria-controls="tab_item-0" role="tab"><span>ALL PRODUCTS</span></li> 
				</ul>				  	 
				<div class="resp-tabs-container" style="position: relative;">
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
						<!-- <div class="col-md-3 product-men"> -->
						<?php
							if(isset($_GET['action']) && $_GET['action']=="add"){ 
          
								$id=intval($_GET['id']);
								
								echo "<meta http-equiv='refresh' content='0;url=".$_SERVER['PHP_SELF']."'>";
								  
								if(isset($_SESSION['cart'][$id])){ 
									  
									$_SESSION['cart'][$id]['quantity']++;  
									  
								}else{ 
									$con = $p->connect(); 
									$sql_s="SELECT * FROM product
										WHERE id={$id}"; 
									$query_s=mysql_query($sql_s,$con);
								
									if(mysql_num_rows($query_s)!=0){ 
										$row_s=mysql_fetch_array($query_s); 
										  
										$_SESSION['cart'][$row_s['id']]=array( 
												"quantity" => 1, 
												"price" => $row_s['price'],
												"productID"=>$row_s['id']
											); 
									}else{ 
										  
										$message="This product id it's invalid!"; 
										  
									} 
									  
								} 
								  
							} 
						?>
						<?php  $p->listProduct("select * from product ") ?>
						<!-- </div> -->
						
						
						<div class="clearfix"></div>
					</div>
					
				</div>	
			</div>
		</div>
	</div>
</div>
<!-- //product-nav -->
<!-- footer -->
<?php include "footer.php" ?>
<!-- //footer -->

</body>
</html>
