<?php

    include('../class/clshome.php');
    $p = new myhome();
    $sqlConnect = $p->connect();
    $id = $_REQUEST['id'];
    #echo $id;
    $sql_up= "select *from user where id=".$id."";
    $query_up= mysql_query($sql_up,$sqlConnect);
    $row_up= mysql_fetch_assoc($query_up);
   
    switch($_REQUEST['submit'])   
    {
        case 'Submit':
        {

            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $email= $_REQUEST['email'];
            $password= $_REQUEST['password'];
       
            $sql= 'UPDATE user SET name="'.$name.'", email="'.$email.'", password="'.$password.'"where id="'.$id.'" limit 1';
            $p->handle_db($sql);
            
            #$query= mysql_query($sqlConnect, $sql);
            header('location:userAdmin.php');
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
        <form method="POST" action=""  >

            <div class="form-group">
                <label for="formGroupExampleInput4">ID</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['id'] ?>" name="id" disabled>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">TÊN NGƯỜI DÙNG</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['name'] ?>" name="name">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">EMAIL</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['email'] ?>" name="email">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">PASSWORD</label>
                <input type="text" class="form-control" required value="<?php echo $row_up['password'] ?>" name="password">
            </div>

            <input type="submit" class="btn btn-danger" value="Submit" name="submit">
        </form>
    </div>
</body>
</html>