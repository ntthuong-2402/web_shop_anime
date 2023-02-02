<?php

include('../class/clshome.php');
    $p = new myhome();
    $sqlConnect = $p->connect();
    $id = $_REQUEST['id'];
    //echo $id;
    $sql_up= "select *from product where id=".$id."";
    $query_up= mysql_query($sql_up,$sqlConnect);
    $row_up= mysql_fetch_assoc($query_up);
   
    switch($_REQUEST['submit'])   
    {
        case 'Submit':
        {

            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $price = $_REQUEST['price'];
            $image = $_REQUEST['image'];
            $des= $_REQUEST['des'];
            $idBrand= $_REQUEST['idBrand'];
            $quantity= $_REQUEST['quantity'];

            $lastPrice= $_REQUEST['lastPrice'];
            $origin= $_REQUEST['origin'];
            $size= $_REQUEST['size'];

            #$upfile = $_REQUEST['upfile'];//Biến của upfile ảnh
            #echo 'test';
            #$nameFile= $_FILES['upfile']['name'];
           #$tmpname= $_FILES['upfile']['tmp_name'];

           $sql= 'UPDATE product SET name= "'.$name.'", price="'.$price.'", des="'.$des.'", idBrand="'.$idBrand.'", image="'.$image.'", quantity="'.$quantity.'", origin="'.$origin.'", lastPrice="'.$lastPrice.'", size="'.$size.'" where id="'.$id.'" ';
           $p->handle_db($sql);
            // if(strcmp($image,$upfile)!=0)
            // {
            //     $sql= 'UPDATE product SET name= "'.$name.'", price="'.$price.'", des="'.$des.'", brand="'.$brand.'", image="'.$image.'" where id="'.$id.'" ';
            //     $p->handle_db($sql);
            // }
            // else
            // {
            //     $sql= 'UPDATE product SET name= "'.$name.'", price="'.$price.'", des="'.$des.'", brand="'.$brand.'", image="'.$upfile.'" where id="'.$id.'" ';
            //     $p->handle_db($sql);
            //     echo 'test';
                
            // }
               
            #$query= mysql_query($sqlConnect, $sql);
            header('location:productAdmin.php');
        }
    }

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container text-left" style="width: 70%; margin-bottom: 3rem;">
        <br>
        <h4>
            Chỉnh sửa sản phẩm
        </h4>
        <br>
        <form method="POST" action="" enctype="multipart/form-data">

            <div class="form-group">
                <label for="formGroupExampleInput4">ID</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['id'] ?>" name="id" disabled>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Tên Sản Phẩm</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['name'] ?>" name="name">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput2">Giá</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['price'] ?>" name="price">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput4">Mô tả</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['des'] ?>" name="des">
            </div>
            

            <div class="form-group">
                <label for="formGroupExampleInput2">Số Lượng</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['quantity'] ?>" name="quantity">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput2">Giá Cũ</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['lastPrice'] ?>" name="lastPrice">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput2">Mã Thương Hiệu</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['idBrand'] ?>" name="idBrand">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput2">Xuất sứ</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['origin'] ?>" name="origin">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput2">Chiều Cao</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['size'] ?>" name="size">
            </div>
            
            
            <div class="form-group" >
                <label for="formGroupExampleInput2">Hình ảnh</label>
                <!-- <input type="file" name="upfile" id="" > -->
                <input type="text" class="form-control" required value="<?php echo $row_up['image'] ?>" name="image" >
            </div>
            <input type="submit" class="btn btn-danger" value="Submit" name="submit">
        </form>
    </div>
</body>
</html>