<?php

include('../class/clshome.php');
    $p = new myhome();
    $sqlConnect = $p->connect();
    $id = $_REQUEST['id'];
    //echo $id;
    $sql_up= "select *from blogs where id=".$id."";
    $query_up= mysql_query($sql_up,$sqlConnect);
    $row_up= mysql_fetch_assoc($query_up);
   
    switch($_REQUEST['submit'])   
    {
        case 'Submit':
        {

            $content = $_REQUEST['content'];
            $title= $_REQUEST['title'];
            $date= $_REQUEST['date'];
            $image = $_REQUEST['image'];
            
            //Biến của upfile ảnh
            // $upfile = $_REQUEST['upfile'];
            
            // echo 'test';
            // $nameFile= $_FILES['upfile']['name'];
            // $tmpname= $_FILES['upfile']['tmp_name'];

           $sql= 'UPDATE blogs SET content= "'.$content.'", title="'.$title.'", date="'.$date.'", image="'.$image.'"where id="'.$id.'" ';
           $p->handle_db($sql);
            // if(strcmp($image,$upfile)!=0)
            // {
            //     $sql= 'UPDATE blogs SET content= "'.$content.'", title="'.$title.'", date="'.$date.'"where id="'.$id.'" ';
            //     $p->handle_db($sql);
            // }
            // else
            // {
            //     if($p->uploadIMG($tmpname,'../images',$nameFile)==1)
            //     {
            //         $sql= 'UPDATE blogs SET content= "'.$content.'", title="'.$title.'", date="'.$date.'", image="'.$nameFile.'"where id="'.$id.'" ';
            //         $p->handle_db($sql);
                        
            //     }
            //     else
            //     {
            //         echo "<script type='text/javascript'>alert('Upload ảnh thất bại!');</script>";
            //     }
            
            // }
               
            #$query= mysql_query($sqlConnect, $sql);
            header('location:blogAdmin.php');
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
            Chỉnh sửa bài viết
        </h4>
        <br>
        <form method="POST" action="" enctype="multipart/form-data">

        <div class="form-group">
                <label for="formGroupExampleInput">Mã Bài Viết</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['id'] ?>" name="id" disabled>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Chủ Đề</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['title'] ?>" name="title">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput2">Nội Dung</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['content'] ?>" name="content">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput4">Ngày Đăng Bài</label>
                <input type="date" class="form-control" required value="<?php echo $row_up['date'] ?>" name="date">
            </div>
            
            
            <div class="form-group" >
                <label for="formGroupExampleInput2">Hình Ảnh</label>
                <!-- <input type="file" name="upfile" id="" > -->
                <input type="text" class="form-control" required value="<?php echo $row_up['image'] ?>" name="image" >
            </div>
            <input type="submit" class="btn btn-danger" value="Submit" name="submit">
        </form>
    </div>
</body>
</html>