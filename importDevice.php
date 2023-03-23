<?php
require_once __DIR__ . '/vendor/autoload.php';
//import.php
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csv_file"])) {
  
    // Xóa hết các tài liệu trong collection
    $collection = $client->SorcerySetting->DeviceList;

       $file = $_FILES["csv_file"]["tmp_name"];
    if($file==""){ 
        header('Location: /device.php?message=1');
        exit();
    }
    else{
        $rows = array_map('str_getcsv', file($file));
        
        $headers = array_shift($rows);
    
        // Chèn dữ liệu vào MongoDB
        $documents = [];
        foreach ($rows as $row) {
            $doc = array_combine($headers, $row);
            $documents[] = $doc;
        }
        foreach ($documents as $document1) {
            if(empty($document1['Guid'])){
                header('Location: /device.php?message=2');
                exit();
                break;
            }
                $filter = ['Guid' => $document1['Guid']];
                $update = ['$set' => $document1];
                $options = ['multi' => false, 'upsert' => false];
                $result = $collection->updateMany($filter, $update, $options);
                }
                header('Location: /device.php?message=3');
            exit();
}
}

?>
