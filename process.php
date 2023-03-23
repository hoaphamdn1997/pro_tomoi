<?php
require_once __DIR__ . '/vendor/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
require "./kiemtralogin.php";
$post =$client->SorcerySetting->DeviceList;
$log =$client->SorcerySetting->LogUser;
$reg=$client->SorcerySetting->DataLogin;
//update
    if(isset($_POST['sua'])){
        if(isset($_POST['values'])){
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $today= (string)date("Y/m/d h:i:sa");
            $checkValue = [];
            if (!empty($_POST['Thread'])) { $checkValue['Thread'] = (int)$_POST['Thread']; }
            if (!empty($_POST['Action'])) { $checkValue['Action'] = (string)$_POST['Action']; }
            if (!empty($_POST['CampaignID'])) { $checkValue['CampaignID'] = (string)$_POST['CampaignID']; }
             if (isset($_POST['Run'])) { $checkValue['Running'] = (bool)$_POST['Run']; }
            echo $checkValue;
            if (!empty($checkValue)) {
                for ($x = 0; $x < count($_POST['values']); $x++) {
                            $insertResult = $post->updateOne(
                                ['DeviceName' => $_POST['values'][$x]],
                                [ '$set' => 
                                $checkValue]
                            );
                        }
                $insertLog = $log->insertOne([
                    'UserName' => $_SESSION[$user->token_login]['username'],
                    'LocationName' =>(array)$_POST['values'],
                    'Action'=> (array)$checkValue,
                    'Time'=> (string)$today,
                ]);
            }
        };
        unset($_POST['sua']);
    }
   
    //dele 
   if(isset($_POST['xoa'])){
        if(isset($_POST['values'])){
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $today= (string)date("Y/m/d h:i:sa");
            
                for ($x = 0; $x < count($_POST['values']); $x++) {
                            $post->deleteOne([ 'DeviceName'=> $_POST['values'][$x]]);
            }
            $insertLog = $log->insertOne([
                    'UserName' => $_SESSION[$user->token_login]['username'],
                    'LocationName' =>(array)$_POST['values'],
                    'Action'=> (string)"deleteDevice",
                    'Time'=> (string)$today,
                ]);
            
        
    }}
?>
