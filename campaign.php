<?php
require "template/Admin/menuAdmin.php";
?>

<?php
require_once __DIR__ . '/vendor/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
$post =$client->SorcerySetting->CampaignList;
$log =$client->SorcerySetting->LogUser;
session_start();
// update
if(isset($_POST['update'])){
            $checkValue=[];
            if (isset($_POST['CampaignID'])) { $checkValue['CampaignID'] = (string)$_POST['CampaignID']; }
            if (isset($_POST['YoutubePool'])) { $checkValue['YoutubePool'] = (string)$_POST['YoutubePool']; }
            if (isset($_POST['ChangeClipFrom'])) { $checkValue['ChangeClipFrom'] = (int)$_POST['ChangeClipFrom']; }
            if (isset($_POST['ChangeClipTo'])) { $checkValue['ChangeClipTo'] = (int)$_POST['ChangeClipTo']; }
            if (isset($_POST['DurationFrom'])) { $checkValue['DurationFrom'] = (int)$_POST['DurationFrom']; }
            if (isset($_POST['DurationTo'])) { $checkValue['DurationTo'] = (int)$_POST['DurationTo']; }
            if (isset($_POST['BiliBiliPool'])) { $checkValue['BiliBiliPool'] = (string)$_POST['BiliBiliPool']; }
            if (isset($_POST['SubFrom'])) { $checkValue['SubFrom'] = (int)$_POST['SubFrom']; }
            if (isset($_POST['SubTo'])) { $checkValue['SubTo'] = (int)$_POST['SubTo']; }
            if (isset($_POST['isChangeClip'])) { $checkValue['isChangeClip'] = (boolean)$_POST['isChangeClip']; }else{ $checkValue['isChangeClip'] = (boolean)0;}
            if (isset($_POST['isSendMail'])) { $checkValue['isSendMail'] = (boolean)$_POST['isSendMail']; }else{ $checkValue['isSendMail'] = (boolean)0;}
            if (isset($_POST['isSub'])) { $checkValue['isSub'] = (boolean)$_POST['isSub']; }else{ $checkValue['isSub'] = (boolean)0;}
            if (isset($_POST['isViewBili'])) { $checkValue['isViewBili'] = (boolean)$_POST['isViewBili']; }else{ $checkValue['isViewBili'] = (boolean)0;}
            if (isset($_POST['isViewNews'])) { $checkValue['isViewNews'] = (boolean)$_POST['isViewNews']; }else{ $checkValue['isViewNews'] = (boolean)0;}
            if (isset($_POST['isViewYoutube'])) { $checkValue['isViewYoutube'] = (boolean)$_POST['isViewYoutube']; }else{ $checkValue['isViewYoutube'] = (boolean)0;}
            if (isset($_POST['isMobile'])) { $checkValue['isMobile'] = (boolean)$_POST['isMobile']; }else{ $checkValue['isMobile'] = (boolean)0;}
            if (isset($_POST['SubPercent'])) { $checkValue['SubPercent'] = (int)$_POST['SubPercent']; }
            // else{ $checkValue['SubPercent'] = (int)0;}
            if (isset($_POST['isMusic'])) { $checkValue['isMusic'] = (boolean)$_POST['isMusic']; }else{ $checkValue['isMusic'] = (boolean)0;}
            if (isset($_POST['isFeed'])) { $checkValue['isFeed'] = (boolean)$_POST['isFeed']; }else{ $checkValue['isFeed'] = (boolean)0;}
            if (isset($_POST['isAds'])) { $checkValue['isAds'] = (boolean)$_POST['isAds']; }else{ $checkValue['isAds'] = (boolean)0;}
            if (!empty($checkValue)) {
                            $insertResult = $post->updateOne(
                                ['CampaignID' => $_POST['CampaignID']],
                                [ '$set' => 
                                $checkValue]
                            );
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $today= (string)date("Y/m/d h:i:sa");
                $insertLog = $log->insertOne([
                    'UserName' => $_SESSION[$user->token_login]['username'],
                    'LocationName' =>$_POST['CampaignID'],
                    'Action'=> (array)$checkValue,
                    'Time'=> (string)$today,
                ]);
            }
         
        }
//dele
    if(isset($_POST['delete'])){
        if(isset($_POST['CampaignID'])){
             $insertResult = $post->deleteOne(['CampaignID' => $_POST['CampaignID']]);
        }
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $today= (string)date("Y/m/d h:i:sa");
        $insertLog = $log->insertOne([
                    'UserName' => $_SESSION[$user->token_login]['username'],
                    'LocationName' =>$_POST['CampaignID'],
                    'Action'=> 'DeleteCampaign',
                    'Time'=> (string)$today,
                ]);
        }
//add
if(isset($_POST['add'])){
            $checkValue=[];
            if (isset($_POST['CampaignID'])) { $checkValue['CampaignID'] = (string)$_POST['CampaignID']; }
            if (isset($_POST['YoutubePool'])) { $checkValue['YoutubePool'] = (string)$_POST['YoutubePool']; }
            if (isset($_POST['ChangeClipFrom'])) { $checkValue['ChangeClipFrom'] = (int)$_POST['ChangeClipFrom']; }
            if (isset($_POST['ChangeClipTo'])) { $checkValue['ChangeClipTo'] = (int)$_POST['ChangeClipTo']; }
            if (isset($_POST['DurationFrom'])) { $checkValue['DurationFrom'] = (int)$_POST['DurationFrom']; }
            if (isset($_POST['DurationTo'])) { $checkValue['DurationTo'] = (int)$_POST['DurationTo']; }
            if (isset($_POST['BiliBiliPool'])) { $checkValue['BiliBiliPool'] = (string)$_POST['BiliBiliPool']; }
            if (isset($_POST['SubFrom'])) { $checkValue['SubFrom'] = (int)$_POST['SubFrom']; }
            if (isset($_POST['SubTo'])) { $checkValue['SubTo'] = (int)$_POST['SubTo']; }
            if (isset($_POST['isChangeClip'])) { $checkValue['isChangeClip'] = (boolean)$_POST['isChangeClip']; }else{ $checkValue['isChangeClip'] = (boolean)0;}
            if (isset($_POST['isSendMail'])) { $checkValue['isSendMail'] = (boolean)$_POST['isSendMail']; }else{ $checkValue['isSendMail'] = (boolean)0;}
            if (isset($_POST['isSub'])) { $checkValue['isSub'] = (boolean)$_POST['isSub']; }else{ $checkValue['isSub'] = (boolean)0;}
            if (isset($_POST['isViewBili'])) { $checkValue['isViewBili'] = (boolean)$_POST['isViewBili']; }else{ $checkValue['isViewBili'] = (boolean)0;}
            if (isset($_POST['isViewNews'])) { $checkValue['isViewNews'] = (boolean)$_POST['isViewNews']; }else{ $checkValue['isViewNews'] = (boolean)0;}
            if (isset($_POST['isViewYoutube'])) { $checkValue['isViewYoutube'] = (boolean)$_POST['isViewYoutube']; }else{ $checkValue['isViewYoutube'] = (boolean)0;}
            if (isset($_POST['isMobile'])) { $checkValue['isMobile'] = (boolean)$_POST['isMobile']; }else{ $checkValue['isMobile'] = (boolean)0;}
            if (isset($_POST['SubPercent'])) { $checkValue['SubPercent'] = (int)$_POST['SubPercent']; }
            // else{ $checkValue['SubPercent'] = (boolean)0;}
            if (isset($_POST['isMusic'])) { $checkValue['isMusic'] = (boolean)$_POST['isMusic']; }else{ $checkValue['isMusic'] = (boolean)0;}
            if (isset($_POST['isFeed'])) { $checkValue['isFeed'] = (boolean)$_POST['isFeed']; }else{ $checkValue['isFeed'] = (boolean)0;}
            if (isset($_POST['isAds'])) { $checkValue['isAds'] = (boolean)$_POST['isAds']; }else{ $checkValue['isAds'] = (boolean)0;}
        $addResult = $post->insertOne($checkValue);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $today= (string)date("Y/m/d h:i:sa");
        $insertLog = $log->insertOne([
                    'UserName' => $_SESSION[$user->token_login]['username'],
                    'LocationName' =>$_POST['CampaignID'],
                    'Action'=> (array)$checkValue,
                    'Time'=> (string)$today,
                ]);
}
//ckibe
if(isset($_POST['clone'])){
            $checkValue=[];
            if (isset($_POST['CampaignID'])) { $checkValue['CampaignID'] = (string)$_POST['CampaignID']; }
            if (isset($_POST['YoutubePool'])) { $checkValue['YoutubePool'] = (string)$_POST['YoutubePool']; }
            if (isset($_POST['ChangeClipFrom'])) { $checkValue['ChangeClipFrom'] = (int)$_POST['ChangeClipFrom']; }
            if (isset($_POST['ChangeClipTo'])) { $checkValue['ChangeClipTo'] = (int)$_POST['ChangeClipTo']; }
            if (isset($_POST['DurationFrom'])) { $checkValue['DurationFrom'] = (int)$_POST['DurationFrom']; }
            if (isset($_POST['DurationTo'])) { $checkValue['DurationTo'] = (int)$_POST['DurationTo']; }
            if (isset($_POST['BiliBiliPool'])) { $checkValue['BiliBiliPool'] = (string)$_POST['BiliBiliPool']; }
            if (isset($_POST['SubFrom'])) { $checkValue['SubFrom'] = (int)$_POST['SubFrom']; }
            if (isset($_POST['SubTo'])) { $checkValue['SubTo'] = (int)$_POST['SubTo']; }
            if (isset($_POST['isChangeClip'])) { $checkValue['isChangeClip'] = (boolean)$_POST['isChangeClip']; }else{ $checkValue['isChangeClip'] = (boolean)0;}
            if (isset($_POST['isSendMail'])) { $checkValue['isSendMail'] = (boolean)$_POST['isSendMail']; }else{ $checkValue['isSendMail'] = (boolean)0;}
            if (isset($_POST['isSub'])) { $checkValue['isSub'] = (boolean)$_POST['isSub']; }else{ $checkValue['isSub'] = (boolean)0;}
            if (isset($_POST['isViewBili'])) { $checkValue['isViewBili'] = (boolean)$_POST['isViewBili']; }else{ $checkValue['isViewBili'] = (boolean)0;}
            if (isset($_POST['isViewNews'])) { $checkValue['isViewNews'] = (boolean)$_POST['isViewNews']; }else{ $checkValue['isViewNews'] = (boolean)0;}
            if (isset($_POST['isViewYoutube'])) { $checkValue['isViewYoutube'] = (boolean)$_POST['isViewYoutube']; }else{ $checkValue['isViewYoutube'] = (boolean)0;}
            if (isset($_POST['isMobile'])) { $checkValue['isMobile'] = (boolean)$_POST['isMobile']; }else{ $checkValue['isMobile'] = (boolean)0;}
            if (isset($_POST['SubPercent'])) { $checkValue['SubPercent'] = (int)$_POST['SubPercent']; }
            // else{ $checkValue['SubPercent'] = (boolean)0;}
            if (isset($_POST['isMusic'])) { $checkValue['isMusic'] = (boolean)$_POST['isMusic']; }else{ $checkValue['isMusic'] = (boolean)0;}
            if (isset($_POST['isFeed'])) { $checkValue['isFeed'] = (boolean)$_POST['isFeed']; }else{ $checkValue['isFeed'] = (boolean)0;}
             if (isset($_POST['isAds'])) { $checkValue['isAds'] = (boolean)$_POST['isAds']; }else{ $checkValue['isAds'] = (boolean)0;}
        $addResult = $post->insertOne($checkValue);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $today= (string)date("Y/m/d h:i:sa");
        $insertLog = $log->insertOne([
                    'UserName' => $_SESSION[$user->token_login]['username'],
                    'LocationName' =>$_POST['CampaignID'],
                    'Action'=> (array)$checkValue,
                    'Time'=> (string)$today,
                ]);
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>
<div id="root" hidden></div>


<script type="application/javascript">
    // tables campaign
    $(document).ready(function(){
    function fetch_data(){
        $.ajax({
        url: "./tables/tableCampaign.php",
        success: function (data){
            $("#root").html(data);
        }});
    }
      fetch_data();
      setTimeout(function() {
        document.getElementById('root').removeAttribute("hidden")
    }, 5000);  
    })
</script>
   
<?php
require "template/Admin/footer.php";
?>