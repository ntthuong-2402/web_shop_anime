<!DOCTYPE html>
<html>
<head>
<?php
include('link_admin.php');
include('../class/clshome.php');
$p = new myhome();
?>
<style>
  .bx-check-circle{
    
    color: none;
  }
  .bxs-check-circle{
    color: green;

  }
  .bxs-x-circle{
    color: red;
  }
  td i {
    font-size: 26px;
  }
</style>
<script>
  function changeCheck () {
    let element = document.querySelector('.bx-check-circle')
    element.classList.remove('bx-check-circle');
  }
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  
<?php
include('header_admin.php');
include('sidebar_admin.php');
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Invoice</a></li>
      </ol>
    </section>

    

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      
      <!-- info row -->
      

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>STT</th>
              <th>OrderID</th>
              <th>Customer</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Subtotal</th>
              <th>Handle</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            
              $con = $p->connect();
              $sql = "SELECT a.id ,a.orderID,b.orderID, c.fullname, c.address, c.phone, a.status, a.price 
              FROM orderdetail a join orders b on a.orderID = b.orderID
              JOIN customer c ON b.userID = c.userID ";
              $result = mysql_query($sql,$con);
              $n = mysql_num_rows($result);
             
              $stt = 1;
              if($n>0){
                while($row = mysql_fetch_array($result)){
                  $id = $row['id'];
                  $orderID = $row['orderID'];
                  $name = $row['fullname'];
                  $address = $row['address'];
                  $phone = $row['phone'];
                  $status = $row['status'];
                  $price = $row['price'];
                  $totalPrice +=$price;
                  
                  ?>  
                  <tr>
                    <td><?php echo $stt++ ; ?></td>
                    <td><?php echo $orderID ; ?></td>
                    <td><?php echo $name ; ?></td>
                    <td><?php echo $address ; ?></td>
                    <td><?php echo $phone ; ?> </td>
                    <td><?php 
                            if($status==0 ||$status==""){echo'<span class="label label-warning">Delivery</span>';}
                            elseif($status==1){echo'<span class="label label-success">Delivered</span>';}
                            else {echo'<span class="label label-danger">Canceled</span>';}
                        ?> 
                    </td>
                    <td><?php echo $price ; ?></td>
                    <td> <?php 
                            if($status==0 || $status==""){
                              echo  '<a href="invoice.php?id='.$id.'&delivery" ><i  class="bx bx-check-circle"></i></a>';
                            }elseif($status==1){
                              echo  '<a href="invoice.php?id='.$id.'"><i class="bx bxs-check-circle"></i></a>';
                            }else{
                              echo  '<a href="invoice.php?id='.$id.'" ><i  class="bx bx-check-circle"></i></a>';
                            }
                            echo  '<a href="invoice.php?id='.$id.'&status='.$status.'&cancel"><i class="bx bxs-x-circle"></i></a>';
                          ?>
                    </td>
                    </tr>
                    
                  <?php
                }
              }
              
            ?> 
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php 
        $id2= $_REQUEST['id'];
        if(isset($_REQUEST['cancel']) && $_REQUEST['status']!=1 && $_REQUEST['status']!=2){
          if($p->handle_db('UPDATE anime_db.orderdetail SET status = 2 WHERE orderdetail.id ='.$id2.' LIMIT 1')==1){
            echo '<script type="text/javascript">alert("Đã huỷ đơn hàng thành công")</script>';
            echo "<meta http-equiv='refresh' content='0;url=".$_SERVER['PHP_SELF']."'>";
          }
        }elseif($_REQUEST['status']==1){
          echo '<script type="text/javascript">alert("Đơn hàng đã được giao không thể huỷ!")</script>';
          echo "<meta http-equiv='refresh' content='0;url=".$_SERVER['PHP_SELF']."'>";
        }elseif($_REQUEST['status']==2){
          echo '<script type="text/javascript">alert("Đơn hàng đã được huỷ từ trước đó!")</script>';
          echo "<meta http-equiv='refresh' content='0;url=".$_SERVER['PHP_SELF']."'>";
        }
        if(isset($_REQUEST['delivery'])){
          if($p->handle_db('UPDATE anime_db.orderdetail SET status = 1 WHERE orderdetail.id ='.$id2.' LIMIT 1')==1){
            // $p->handle_db('UPDATE `anime_db`.`orders` SET `payment` = 1 WHERE CONVERT( `orders`.`orderID` USING utf8 ) = '.$orderID.' LIMIT 1');
            echo '<script type="text/javascript">alert("Xác nhận giao hàng thành công")</script>';
            echo "<meta http-equiv='refresh' content='0;url=".$_SERVER['PHP_SELF']."'>";
          }
        }
                         
      ?>
      <div class="row">
        <!-- accepted payments column -->
        
        <!-- /.col -->
        <div class="col-xs-6">
          

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>$<?php echo $totalPrice?></td>
              </tr>
              <tr>
                <th>Tax (9.3%)</th>
                <td>$<?php echo $totalPrice*0.093 ;?></td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>$5.80</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$<?php echo $totalPrice + $totalPrice*0.093; ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>