<?php 
require_once __DIR__ . '/vendor/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
$reg=$client->SorcerySetting->DataLogin;
$log =$client->SorcerySetting->LogUser;
 require "./kiemtralogin.php";
if(isset($_POST['userName'])&&isset($_POST['password']) &&isset($_POST['rePassword']) ){
    function validate($data){
       $data = trim($data);
       $data = stripcslashes($data);
       $data = htmlspecialchars($data);
      return $data;
    }
    $userName = validate ($_POST['userName']);
    $password = validate ($_POST['password']);
    $rePassword = validate ($_POST['rePassword']);
    if(empty($userName)){
        header("Location: addnewuser.php?error=nhập UserName điiiiiii");
         exit();
     }
    // elseif(!preg_match('/^[a-z0-9_.]+$/',$userName)){
    //     header("Location: addnewuser.php?error=nhập sai kiểu rồi UserName k dấu và không in hoa nhé");
    //      exit();
    // }
    elseif(empty($password)) {
        header("Location: addnewuser.php?error=vui lòng nhập  mật khẩu");
         exit();
    }
    elseif(empty($rePassword)) {
        header("Location: addnewuser.php?error=vui lòng nhập vào Repeat mật khẩu  đi =))");
         exit();
    }
    // if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $np)) {
    //     header("Location: changePass.php?error=bắt buột có chữ cái và số bro =)) &&newpass=$np&&againpass=$ap");
    //      exit();
    // }
    
   elseif($password != $rePassword) {
        header("Location: addnewuser.php?error=Nhập giống mật khẩu mới đi bro =)))");
         exit();
    }else{
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $today= (string)date("Y/m/d h:i:sa");
        header("Location: addnewuser.php?error=Thành công");
        $insertResult = $reg->insertOne([
                 'ID' => $userName,
                 'Password' => $password,
                 'Role' => (int)0,
                 ]);
        $insertLog = $log->insertOne([
                    'UserName' => $_SESSION[$user->token_login]['$uname'],
                    'LocationName' =>$userName,
                    'Action'=> (string)"addUser",
                    'Time'=> (string)$today,
                ]);
    }
}
?>