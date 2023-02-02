
<!DOCTYPE html>
<html>
<?php include("link.php") ?>
<body>
     <!-- header -->
	<div class="header">
	<div class="container">
		<ul class="container_top">
			<li><span class="glyphicon glyphicon-time" aria-hidden="true"></span>Free and Fast Delivery</li>
			<li><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Free shipping On all orders</li>
			<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:animestore@gmail.com">anime@gmail.com</a></li>
			<?php
			if(!isset($_SESSION['myname']) && !isset($_SESSION['mypass'])){
				echo '<li><span class="glyphicon icon-login" aria-hidden="true"></span><a href="login.php">Log In</a></li>
				<li><span class="glyphicon icon-reg" aria-hidden="true"></span><a href="register.php">Sign Up</a></li>';
			}else {
				echo '
				<li class="info_user"><span class="glyphicon icon-login " aria-hidden="true"></span><a href=""><span class="bx bxs-user" style="transform: translateY(1px);"></span>'.$_SESSION['myname'].'</a>
					<ul class="user_menu">
						<li class="user_item"><a href="info_user.php">Tài khoản của tôi</a></li>
						<li class="user_item"><a href="">Đơn mua</a></li>
						<li class="user_item"><a href="index.php?out">Đăng xuất</a></li>
					</ul>
				</li>
				<li><span class="glyphicon icon-reg" aria-hidden="true"></span><a href="index.php?out">Log Out <span class="bx bx-log-out bx-rotate-180" style="transform: translateY(1px);"></span></a></li>';
			
				if(isset($_GET['out'])){
					session_destroy();
					echo "<meta http-equiv='refresh' content='0;url=".$_SERVER['PHP_SELF']."'>";
					exit();
				}
			}

				
			?>
				
			<!-- <li><span class="glyphicon icon-reg" aria-hidden="true"></span><a href="index.php?out">Log Out <span class="bx bx-log-out bx-rotate-180" style="transform: translateY(1px);"></span></a></li> -->
          </ul>
	</div>
</div>
<!-- //header -->
<!-- header-bot -->
<div class="header-bot">
	<div class="container">
		<div style="transform: translateY(-8px);" class="col-md-3 header-left">
			<h1 style=" margin: 0;"><a href="index.php?page=1"><img src="images/logo3.jpg" style="width: 100px;height: 90px;margin-left: 45px;"></a></h1>
		</div>
		<div class="col-md-6 header-middle">
			<form method="post" action="searchProduct.php">
				<div class="search">
					<input type="search" name="search">
				</div>
				<div class="section_room">
					<select id="country" onchange="change_country(this.value)" class="frm-field required">
						<option value="null">All categories</option>
					</select>
				</div>
				<div class="sear-sub">
					<input type="submit" name="ok" value=" " >
				</div>
				<div class="clearfix"></div>
			</form>
			
		</div>
		<div class="col-md-3 header-right footer-bottom">
			<ul>
				<!-- <li><a href="#" data-toggle="modal" data-target="#myModal4"><span>Login</span></a>
					
				</li> -->
				<li><a class="fb" href="https://www.facebook.com/"></a></li>
				<li><a class="twi" href="https://twitter.com/"></a></li>
				<li><a class="insta" href="https://www.instagram.com/"></a></li>
				<li><a class="you" href="https://www.youtube.com/"></a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //header-bot -->
<div class="ban-top">
	<div class="container">
		<div class="top_nav_left">
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav menu__list">
					<li class="active menu__item menu__item--current"><a class="menu__link" href="index.php?page=1">Home <span class="sr-only">(current)</span></a></li>
					<?php
						$p->renderBrand("select name,id from brand group by name");
					?>
					<li class=" menu__item"><a class="menu__link" href="blog.php">Anime Blogs</a></li>
					<li class=" menu__item"><a class="menu__link" href="contact.php">contact</a></li>
				  </ul>
				</div>
			  </div>
			</nav>	
		</div>
		<div class="top_nav_right">
			<div class="cart box_1">
						<?php 
							if(isset($_SESSION['myname']) && isset($_SESSION['mypass'])){
								$count_cart = count($_SESSION['cart']);
								echo'<a href="cart.php">
										<h3> <div class="total">
											<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
											<span class=""></span> (<span id="" class="">'.$count_cart.'</span> items)</div>
										</h3>
									</a>
									';
							}else{
								echo'<a href="login.php">
										<h3> <div class="total">
											<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
											<span class=""></span> (<span id="" class=""></span> items)</div>
										</h3>
									</a>
									<p><a href="javascript:;" class="simpleCart_empty"></a></p>';
							}
						?>
						
						
			</div>	
		</div>
		<div class="clearfix"></div>
	</div>
</div>
