<?php 
require_once '/www/wwwroot/tomosolution.com/TomoV3HoaTest/vendor/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
$reg=$client->SorcerySetting->DataLogin;
require "./kiemtralogin.php";
 
 
if(isset($_POST['currentP'])&&isset($_POST['newpass']) &&isset($_POST['againpass']) ){
    function validate($data){
       $data = trim($data);
       $data = stripcslashes($data);
       $data = htmlspecialchars($data);
      return $data;
    }
    $cn = validate ($_POST['currentP']);
    $np = validate ($_POST['newpass']);
    $ap = validate ($_POST['againpass']);
    if(empty($cn)){
        header("Location: changePass.php?error=vui lòng nhập lại mật khẩu cũ");
         exit();
    }
    //validate mk trung mk cu
    if(empty($np)) {
        header("Location: changePass.php?error=vui lòng nhập  mật khẩu moi ");
         exit();
    }
    if(empty($ap)) {
        header("Location: changePass.php?error=vui lòng nhập vào confirm mật khẩu  đi =))&&newpass=$np");
         exit();
    }
    // if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $np)) {
    //     header("Location: changePass.php?error=bắt buột có độ dài 8 đến 12 kí tự có chữ cái và số bro =)) &&newpass=$np&&againpass=$ap");
    //      exit();
    // }
    
    if($np != $ap) {
        header("Location: changePass.php?error=Nhập giống mật khẩu mới đi bro =)))&&newpass=$np");
         exit();
    }else{
        header("Location: changePass.php?error=Thành công");
        $updatePass = $reg->updateOne(
            ['ID' => $_SESSION[$user->token_login]['username']],
            ['$set' => [
                    'Password'    =>$np ,
                ],
            ]
        );
    }
}
?>