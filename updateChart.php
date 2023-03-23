<?php
require_once __DIR__ . '/vendor/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
$customers = $client->selectCollection('SorcerySetting', 'MonitorList');
$pushLog = $client->selectCollection('SorcerySetting', 'LogSystem');
$array = $customers->find([]);
$Campaign= array();
date_default_timezone_set("Asia/Ho_Chi_Minh");
$today= (string)date("Y/m/d h:i:sa");
foreach($array as $item){
array_push($Campaign,$item['CampaignID']);
}
const max_size = 24;
foreach ( $Campaign as $camKey => $camValue){
    $document = $customers->findOne(['CampaignID' => $camValue]);
    $count = 0;
    if($document !== NULL){
        $array = $document['BKTList'];
        foreach ($array as $BKTKey => $BKTValue){
            $count += $BKTValue['Realtime'];
            
        }
        
        $Campaign[$camValue] = $count;
        $insertResult = $pushLog->updateOne(
            ['CampaignID' => $camValue],
            ['$push' => ['Value' => $Campaign[$camValue],'timestamp' => $today]],
            ['upsert' => true]
        );
    $result = $pushLog->createIndex(
    ['createdAt' => 1],
    ['expireAfterSeconds' => 4800]
    );  



    $insertResult = $pushLog->updateOne(
        [ 'CampaignID' => $camValue ],
        ['$push' => [  'Value'=> [
                '$each'=> [],
                '$slice' => -max_size
            ],
            'timestamp'=> [
                '$each'=> [],
                '$slice' => -max_size
            ],
            
            ]]
    );

    }
}
?>            
               

