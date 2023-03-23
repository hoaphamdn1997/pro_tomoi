<?php
require_once __DIR__ . './node_modules/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
require "./kiemtralogin.php";
$post =$client->SorcerySetting->DataLogin;
session_start();
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

if(isset($_POST['username'])&&isset($_POST['password'])){
    function validate($data){
       $data = trim($data);
       $data = stripcslashes($data);
       $data = htmlspecialchars($data);
      return $data;
       
    }
  $uname = validate ($_POST['username']);
  $pass = validate ($_POST['password']);
    if(empty($uname)){
         header("Location: index.php?error=Username không được để trống");
         exit();
    }else if (empty($pass)) {
        header("Location: index.php?error=Password Không được để trống &&username=$uname");
         exit();
    }else{
         $myID = $post->findOne(['ID' => $uname]);
         if($myID == 0){
             header("Location: index.php?error=Tên đăng nhập không tồn tại&&username=$uname");
            exit();
         }elseif ($pass != $myID['Password']) {
            header("Location:index.php?error=Sai mật khẩu");
            exit();
         }else{
             if(isset($_POST['nmk'])){
                 setcookie('username',$uname,time()+3600,'/','',0,0);
                 setcookie('password',$pass,time()+3600,'/','',0,0); 
             }else{
                 setcookie("user","",time()-3600,"/","",0,0);
                    setcookie("pass","",time()-3600,"/","",0,0);
             }
        $user->set_logged($uname);
        header('Location:./charts.php');
        exit();
         }
    }
}
