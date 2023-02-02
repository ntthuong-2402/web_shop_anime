<!DOCTYPE html>
<html lang="en">
<?php
	include("./class/login_user.php");
     include("header.php");
?>
 
<div class="container" style = "margin: 64px;">
     <?php
          $p->search();
     ?>
</div>

<?php include("footer.php");?>

</body>
</html>