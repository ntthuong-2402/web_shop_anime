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
            $price = $_REQUEST['price'];
            $des = $_REQUEST['des'];
            $idBrand= $_REQUEST['idBrand'];
            $quantity= $_REQUEST['quantity'];

            $lastPrice= $_REQUEST['lastPrice'];
            $origin= $_REQUEST['origin'];
            $size= $_REQUEST['size'];
            $material= $_REQUEST['material'];
           # $img = $_REQUEST['img'];

            $img= $_FILES['img']['name'];
            $type= $_FILES['img']['type'];
            $tmpname= $_FILES['img']['tmp_name'];
           
            if($p->uploadIMG($tmpname,'../images',$img)==1)
            {
                if($p->handle_db("insert into anime_db . product (name,price,des,idBrand,quantity,image,lastPrice,origin,size,material)VALUES ( '$name', '$price','$des','$idBrand', '$quantity','$img', '$lastPrice','$origin','$size','$material')")==1){
                    echo "<script type='text/javascript'>alert('Bạn đã thêm sản phẩm thành công');</script>";
                    
                }else {
                    echo "<script type='text/javascript'>alert('Thêm sản phẩm thất bại!!!');</script>";
                }
            }
            else
            {
                echo "<script type='text/javascript'>alert('Upload ảnh thất bại!');</script>";
            }
        
        
        break;
        }
   }

?>
<style>
    body{
        background: url("./dist/img//bgimg6.jpg") no-repeat fixed center 100%;
    }
</style>

<script type="text/javascript" src="../js/responsiveslides.min.js"></script>
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

    <title>Product | Admin</title>
</head>

<body>
    <div style="margin-top: 2rem;">
        <center>
            <h2>Danh sách sản phẩm</h2>
        </center>
        <div class="contentAdmin">
            <div class="container" style="margin-top: 0rem;" id="sanpham">
                <div class="row float-left">
                    <a class="btn btn-info" href="admin.php">Trang chủ</a>
                </div>
                <div class="row float-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Add_new">
                        Thêm mới
                    </button>
                </div>
                <div class="row float-center" style="padding-top: 50px"  >
                <?php 
                    $p->productAdmin("select* from product");
                  
                   
                    if(isset($_GET['del_id']))
                    {
                        $p->handle_db("delete from product where id = ".$_GET['del_id']."");
                        
                        echo "<meta http-equiv='refresh' content='0;url=".$_SERVER['PHP_SELF']."'>";
                        exit();
                    }
                    
                    else
                    {

                    }
                ?>
                
                </div>  
                <div class="modal fade" id="Add_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên Sản Phẩm" required><br>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Giá " required><br>
                                    <input type="text" class="form-control" id="des" name="des" placeholder="Mô tả" required><br>
                    
                                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Số lượng" required><br>
                                    <label for="">Mã Thương Hiệu: </label>
                                    <select name="idBrand" id="idBrand">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <input type="text" class="form-control" id="lastPrice" name="lastPrice" placeholder="Giá Cũ" required><br>
                                    <input type="text" class="form-control" id="origin" name="origin" placeholder="Xuất sứ" required><br>
                                    <input type="text" class="form-control" id="size" name="size" placeholder="Chiều cao" required><br>
                                    <input type="text" class="form-control" id="material" name="material" placeholder="Chất liệu" required><br>
                    
                                 
                                    <input type="file" class="form-control" id="img" name="img" placeholder="Hình ảnh" required><br>
                                        
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