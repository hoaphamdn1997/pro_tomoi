<?php require "./kiemtralogin.php";
if ($user->is_logged()){ header('Location:charts.php'); }
require_once __DIR__ . './vendor/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
$post =$client->SorcerySetting->DataLogin;
print_r(post);
?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="./images/tomo.png">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/fontawesome-free/css/font-awesome.min.css">
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
   <div class="login-form" >
    <form action="login.php" method="post" class="form-signin">
        <div class="form-group has-error">
            <img src="./images/tomo.png" width="200" height="100"/>
            <h3 class="text-center">TOMO SOLUTION</h3>
            <?php if(isset($_GET['error'])){ ?>
            <p class="error" style="color:red "><?php echo $_GET['error'] ?></p>
            <?php } ?>
            <input type="text" id="username" name="username" property="username"
                   placeholder="Username" class="form-control"
                   value=<?php
                   if(isset($_COOKIE['username'])){?><?php echo $_COOKIE['username'] ?>
                    <?php } ?>
            >
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password"
                   placeholder="Password" class="form-control"  <?php if(isset($_COOKIE['password'])){ echo 'value="',$_COOKIE['password'],'"'; } ?>
                    
                   />
        </div>
        <div class="form-group"><input type="checkbox" class="float-left" name="nmk" value=""  <?php if(isset($_COOKIE['username'])){echo "checked";} ?> /><label>Nhớ mật khẩu</label></div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" name="Submit" value="Login" type="Submit"
                    text="Login">Đăng nhập</button>
        </div>
    </form>
</div>
</body>
</html>