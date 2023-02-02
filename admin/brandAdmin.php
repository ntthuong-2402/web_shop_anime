<!DOCTYPE html>

<html lang="en">
<?php
    include('../class/clshome.php');
    $p= new myhome();
    $p->connect();

    switch($_POST['button']){
        case 'Lưu':
        {
            $name = $_REQUEST['name'];
        

        
            if($p->handle_db("insert into anime_db . brand (name)VALUES ( '$name')")==1){
                echo "<script type='text/javascript'>alert('Bạn đã thêm thương hiệu thành công');</script>";
                
            }else {
                echo "<script type='text/javascript'>alert('Thêm thương hiệu thất bại!!!');</script>";
            }
        
        
        break;
        }
   }

?>
<style>
    body{
       
        background: url("./dist/img/bgimg4.jpg") no-repeat fixed center;  
       
        /* no-repeat fixed center */
        
    }

</style>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <!-- <link rel="stylesheet" href="/css/style.bundle.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link type="image/png" sizes="16x16" rel="shortcut icon" href="https://img.icons8.com/ios-glyphs/30/000000/education.png">

    <title>Brand | Admin</title>
</head>

<body>
    <div style="margin-top: 2rem;" >
        <center>
            <h2>Danh sách thương hiệu</h2>
        </center>
        <div class="contentAdmin">
            <div class="container" style="margin-top: 0rem;" id="sanpham">
                <div class="row float-left">
                    <a class="btn btn-info" href="admin.php">Trang chủ</a>
                </div>
                <div class="row float-right">

                </div>
                <div class="row float-center" style="padding-top: 50px"  >
                <?php 
                    $p->brandAdmin("select* from brand");
                    if(isset($_GET['del_id']))
                         {
                              $p->handle_db("delete from brand where id = ".$_GET['del_id']."");
                              
                              echo "<meta http-equiv='refresh' content='0;url=".$_SERVER['PHP_SELF']."'>";
                              exit();
                         }
                         else{
                              //echo "<script type='text/javascript'>alert('Xóa không thành công');</script>";
                         }
                ?>
                </div>  
                <div class="modal fade" id="Add_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm Thương Hiệu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> -->
                            <div class="modal-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên Sản Phẩm" required><br>
                                    
                                    <!-- <label for="">Tên Thương Hiệu: </label>
                                    <select name="brand" id="brand">
                                        <option value="ONE PIECE">ONE PIECE</option>
                                        <option value="NARUTO">NARUTO</option>
                                        <option value="DRAGON BALL">DRAGON BALL</option>
                                    </select> -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <input type="submit" name="button" class="btn btn-danger" value="Lưu" />
                                    </div>
                                   
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>