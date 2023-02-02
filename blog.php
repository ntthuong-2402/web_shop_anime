<?php
    include("./class/login_user.php");
    // include("link.php");
    include("header.php");
?>


<div class="page-head">
	<div class="container">
		<h3>BLOG</h3>
	</div>
</div>

<div class="container">
        <div id="header">
            <div id="nav">
                <li><a href="#tintuc">Tin tức</a></li>
                <li><a href="#contact-form">Liên hệ</a></li>
                <li><a href=""></a></li>
            </div>
        </div>

        <?php
            $sql = "select * from blogs";
            $con = $p->connect();
            $result = mysql_query($sql,$con);
            $n = mysql_num_rows($result);
            if($n>0){
                while($row = mysql_fetch_array($result)){
                    $img = $row['image'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $date = $row['date'];
                    ?>
                    <div id="tintuc" class="section">
                    <div class="card mb-3" style="max-width: 1140px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="images/<?php echo $img ?>" class="img-fluid rounded-start" alt="..." style="width: 378px;height: 399px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $title ?></h5>
                                    <p class="card-text"><?php echo $content ?>
                                    </p>
                                    <p class="card-text down"><small class="text-muted">Last updated <?php $time= strtotime(date('Y-m-d'))-strtotime($date); echo strval($time) ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            }
        ?>
        
            

</div>
<hr>
    <div class="page-center">
        <h3>Liên Hệ với chúng tôi</h3>
    </div>
    
<div class="container">
        <div id="contact-form" class="section" style="height:700px">
        <h2 class="text-center"></h2>
        <form class="form-contact">
                    <label for="">Last Name:</label>
                    <input type="text" class="form-control" id="" placeholder="Last Name" style ="max-width:1168px;height:42px;margin-bottom:20px;margin-top:12px">
                    <label for="">First Name: </label>
                    <input type="text" class="form-control" id="" placeholder="First Name" style ="max-width:1168px;height:42px;margin-bottom:20px;margin-top:12px">
                    <label for="">Email </label>
                    <input type="text" class="form-control" id="" placeholder="Email" style ="max-width:1168px;height:42px;margin-bottom:20px;margin-top:12px">
                    <label for="">Ý kiến của bạn:</label>
                    <textarea rows="5" cols="16" class="form-control" id="" placeholder="Ý kiến của bạn" style ="max-width:1168px;;margin-bottom:20px;margin-top:12px"></textarea>
            <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
</div>

<div class="clearfix"></div>
<?php include "footer.php" ?>


<style>

#header{
    top: 470px;
    width: 100%;
    height: 45px;
    background-color: #000;
}
#nav{
    display: flex;
    justify-content: center;
    background-color: orange;
}
#nav >li{
    display: inline-block;
    position: relative;
}
#nav li a{
    color: #fff;
    text-decoration: none;
    line-height: 45px;
    padding: 0 20px;
    display: block;
}
#nav >li >a{
    text-transform: uppercase;
}
#nav >li >a:hover {
    text-decoration: underline;

}
.section {
    margin-top: 42px;
}
.card {
        border: 1px solid #ccc;
        height: 400px;
        margin-bottom: 32px;
        border-radius: 5px;
        box-shadow: 15px 10px orange;
        background: #fff;
    }
.card:hover {
    cursor: pointer;
}
.card img {
    height: 100%;
}
.card-title {
    font-weight: bold;
    font-size: 32px;
    margin: 32px 0;
}
.card-text {
    font-size: 24px;
    margin: 24px 0;
}
.page-center {
    background: url(./images/center.jpg) no-repeat center;
    background-size: cover;
    -webkit-background-size: cover;
    -o-background-size: cover;
    -ms-background-size: cover;
    -moz-background-size: cover;
    min-height: 350px;
    padding-top: 120px;
    }

    .page-center h3 {
    color: #fff;
    text-align: center;
    text-transform: uppercase;
    font-size: 48px;
    }
    .form-contact {
        font-size: 24px;
    }
</style>