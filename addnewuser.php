<?php
include( "template/Admin/menuAdmin.php");
?>
<?php 
require_once '/www/wwwroot/tomosolution.com/TomoV3HoaTest/vendor/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
$post =$client->SorcerySetting->DataLogin;
$result = $post->findOne(['ID' => $_SESSION[$user->token_login]['username']]);
if (!$user->is_logged()){ header('Location:index.php'); }
// if($result['Role']<2){ header('Location: index.php '); exit();}
// $currentPageUrl = 'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];$currentPageUrl==$lin &&
// $lin ="https://192.168.10.177/addnewuser.php";
if($result['Role']==2){
    include "404.php";
}else {
     include "protechtest.php";
    
};
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
<?php
 require "template/Admin/footer.php";
?>
</body>

</html>