<?php
	session_start();
	include("./class/login_user.php");
?>
<?php
	$id = $_REQUEST['idBrand'];
	$origin = $_REQUEST['origin'];
	$material = $_REQUEST['material'];
	$size = $_REQUEST['size'];
	$sql = 'select * from brand where id ="'.$id.'"';
	$sql_origin = 'select DISTINCT origin from product';
	$sql_material = 'select DISTINCT material from product';
	$link = $p->connect();
	$ketqua = mysql_query($sql,$link);
	$n = mysql_num_rows($ketqua);
	if($n > 0 ) {
		while($row = mysql_fetch_array($ketqua)){
			$name = $row['name'];
			$des = $row['desc'];
			$banner = $row['banner'];
			$img1 = $row['img1'];
			$img2 = $row['img2'];
			$img3 = $row['img3'];
			$img4 = $row['img4'];
		}
	}
?>
<?php include("header.php") ; ?>
<div class="page-head" >
	<div class="container">	
		<?php echo '<h3>'.strtoupper($name).'</h3>';?>
	</div>
</div>
<!-- //banner -->
<!-- mens -->
<div class="men-wear">
	<div class="container">
		<div class="col-md-4 products-left">
			<div class="filter-price">
				<h3>Filter By Price</h3>
					<ul class="dropdown-menu6">
						<li>        
							<form method="post">
								<div id="slider-range"></div>							
								<!-- <input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
								<input type="hidden" name="option" value="brands"> -->
								<input name="range_price"  type="range" name="range" min="0" max="3000" step="1" oninput="document.getElementById('max').innerHTML=this.value"; /><span id="max"></span><br>
								<input name="button" type="submit" value="Search">
								<?php
									$range_price = $_REQUEST['range_price'];
								?>
							</form>
							
						</li>			
					</ul>
						<script type="text/javascript" src="js/jquery-ui.js"></script>
					 <!---->
			</div>

			<div class="css-treeview">
				<h4>Categories</h4>
				<ul class="tree-list-pad">
					<li><input type="checkbox" checked="checked" id="item-0" /><label for="item-0"><span></span>Kích Thước</label>
						<ul>
							<?php 
								echo '<li><input type="checkbox" id="item-0-0" /><a href="brand.php?idBrand='.$id.'&size=100"> Dưới 1m </a></li>
								<li><input type="checkbox"  id="item-0-1" /><a href="brand.php?idBrand='.$id.'&size=101"> Trên 1m </a></li>';
								
							?>
						</ul>
					</li>
					<li><input type="checkbox" id="item-1" checked="checked" /><label for="item-1">Chất Liệu</label>
						<ul>
							<?php
								$ketqua3 = mysql_query($sql_material,$link);
								while($row3 = mysql_fetch_array($ketqua3)){
									$vatlieu = $row3['material'];
									echo ' <li><input type="checkbox"   id="item-1-0" /><a href="brand.php?idBrand='.$id.'&material='.$vatlieu.'">'.$vatlieu.'</a></li>';
								}
							?>
							
						</ul>
					</li>
					<li><input type="checkbox" checked="checked" id="item-2" /><label for="item-2">Xuất Xứ</label>
						<ul>
							<?php
								$ketqua2 = mysql_query($sql_origin,$link);
								$n2 = mysql_num_rows($ketqua);
								if($n2 > 0 ) {
									while($row2 = mysql_fetch_array($ketqua2)){
										$country = $row2['origin'];
										echo ' <li><input type="checkbox"  id="item-2-0" /><a href="brand.php?idBrand='.$id.'&origin='.$country.'">'.$country.'</a></li>';
									}
								} 
							?>
						</ul>
					</li>
				</ul>
			</div>

			<div class="clearfix"></div>
		</div>	
		<div class="col-md-8 products-right">
			<h5>Product Compare(0)</h5>
			<div class="sort-grid">
				<div class="sorting">
					 <h6>Sort By</h6> <!--onchange="change_country(this.value)" -->
					 <select id="country1" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)" class="frm-field required sect"> 
						<option value="null">Default</option>
						<option value="?page=1&field=name&sort=desc">Name(A - Z)</option> 
						<option value="null">Name(Z - A)</option>
						<option value="?<?php echo $idBrand ?>&page=1&field=price&sort=desc">Price(High - Low)</option>
						<option value="null">Price(Low - High)</option>
					</select>
					<div class="clearfix"></div>
				</div>
				<div class="sorting">
					<h6>Showing</h6>
					<select id="country2" onchange="change_country(this.value)" class="frm-field required sect">
						<option value="null">7</option>
						<option value="null">14</option> 
						<option value="null">28</option>					
						<option value="null">35</option>								
					</select>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="men-wear-top">
				<script src="js/responsiveslides.min.js"></script>
				<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						 // Slideshow 4
						$("#slider3").responsiveSlides({
							auto: true,
							pager: true,
							nav: false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
						$('.events').append("<li>before event fired.</li>");
						},
						after: function () {
							$('.events').append("<li>after event fired.</li>");
							}
							});
						});
				</script>
				<div  id="top" class="callbacks_container">
					<ul class="rslides" id="slider3">
						<?php
							echo'<li>
									<img class="img-responsive img_brand " src="images/'.$img1.'" alt=" "/>
								</li>
								<li>
									<img class="img-responsive img_brand " src="images/'.$img2.'" alt=" "/>
								</li>
								<li>
									<img class="img-responsive img_brand " src="images/'.$img3.'" alt=" "/>
								</li>
								<li>
									<img class="img-responsive img_brand " src="images/'.$img4.'" alt=" "/>
								</li>
							';
						
						?>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="men-wear-bottom">
				<div class="col-sm-4 men-wear-left">
					<?php
						echo '<img class="img-responsive" src="images/'.$banner.'"/>';
					?>
				</div>
				<div class="col-sm-8 men-wear-right">
					<?php
						echo '<h4>'.strtoupper($name).'</h4>
						<p>'.$des.'</p>';
					
					?>
					
				</div>
				<div class="clearfix"></div>
			</div>
				
				
				<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<div class="single-pro" >
			
			<div class="resp-tabs-container" style="position: relative;">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item"  aria-controls="tab_item-0" role="tab"><span>PRODUCTS <?php echo strtoupper($name)  ?></span></li> 
				</ul>
						<?php 
							 
							$field = $_REQUEST['field'];
							$sort = $_REQUEST['sort'];
							$sql_render = 'select * from product where  idBrand ="'.$id.'"';
							
							if (isset($origin) ){
								$p->listProduct($sql_render.'and  origin ="'.$origin.'"');
							}elseif (isset($material)){
								$p->listProduct($sql_render.'and  material ="'.$material.'"');
							}elseif(isset($range_price)){
								$p->listProduct($sql_render.'and  price <= "'.$range_price.'"');
							}elseif(isset($size)){
								if($size==100){
									$p->listProduct($sql_render.'and  size <= 100');
								}else{
									$p->listProduct($sql_render.'and  size > 100');
								}
							}elseif(isset($field) && isset($sort)){
								$p->listProduct($sql_render.'ORDER BY product.'.$field.' '.$sort.'');
							}else{
								$p->listProduct($sql_render);
							}
						?>

					<div class="clearfix"></div>
				
					
				</div>	
			
			</div>	 
			<div class="clearfix"></div>
		</div>
		
	</div>
</div>	
<?php include("footer.php") ?>
</body>
</html>
