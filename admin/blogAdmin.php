<!DOCTYPE html>

<html lang="en">
<?php
    include('../class/clshome.php');
    $p= new myhome();
    $p->connect();

    switch($_POST['button']){
        case 'Lưu':
        {
            
            $content = $_REQUEST['content'];
            $title= $_REQUEST['title'];
            $date= $_REQUEST['date'];

            

            $img= $_FILES['img']['name'];
            $type= $_FILES['img']['type'];
            $tmpname= $_FILES['img']['tmp_name'];
           
            if($p->uploadIMG($tmpname,'../images',$img)==1)
            {
                if($p->handle_db("insert into anime_db . blogs (image, title, content, date)VALUES ( '$img', '$title','$content','$date')")==1){
                    echo "<script type='text/javascript'>alert('Bạn đã thêm bài viết thành công');</script>";
                    
                }else {
                    echo "<script type='text/javascript'>alert('Thêm bài viết thất bại!!!');</script>";
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
        background: url("./dist/img//bgblog.jpg") no-repeat fixed center 80%;
    }10
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

    <title>Blogs | Admin</title>
</head>

<body>
    <div style="margin-top: 2rem;">
        <center>
            <h2>Danh Sách Bài Viết</h2>
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
                    $p->blogAdmin("select* from blogs");
                  
                   
                    if(isset($_GET['del_id']))
                    {
                        $p->handle_db("delete from blogs where id = ".$_GET['del_id']."");
                        
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
                                <h5 class="modal-title" id="exampleModalLabel">Thêm Bài Viết</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Chủ đề" required><br>
                                    <input type="text" class="form-control" id="content" name="content" placeholder="Nội dung" required><br>
                                    <input type="date" class="form-control" id="date" name="date" placeholder="Thời gian đăng bài" required><br>
                    
                                    
                    
                                 
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