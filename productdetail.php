<?php 
	include("./class/login_user.php");
	include("header.php");
?>
<!-- header -->
<!-- banner -->
<div class="page-head">
	<div class="container">
		<h3>Product Details</h3>
	</div>
</div>
<!-- //banner -->
<!-- single -->
<div class="single">
	<div class="container">
				<?php
					$id = $_REQUEST['id'];
					$p->productDetail("select * from product where id = '$id'");
				?>
				<div class="resp-tabs-container" style="position: relative;padding-top:60px">
					<ul class="resp-tabs-list">
						<li class="resp-tab-item"  aria-controls="tab_item-0" role="tab"><span>Sản Phẩm Liên Quan</span></li> 
					</ul>
						<?php 
							$sql_render = 'select * from product order by rand() limit 4';
							
							$p->listProductSearch($sql_render);
							?>

						<div class="clearfix"></div>
				
					
				</div>	
			
			</div>	 
			<div class="clearfix"></div>
				
				
	</div>
</div>
<!-- //single -->
<!-- //product-nav -->
<!-- footer -->
<?php include("footer.php") ?>
</body>
</html>
