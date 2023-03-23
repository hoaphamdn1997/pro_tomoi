
<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
// $customers = $client->selectCollection('SorcerySetting', 'MonitorList');
// $myData = $customers->find(['CampaignID']);
$log =$client->SorcerySetting->LogUser;

$loguser = $log->find([]);

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>


<?php
require "template/Admin/menuAdmin.php";
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css">
            <link href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
            <!--<button type="button" id="custom_clear" class="btn btn-danger">Clear</button>-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
            <script src="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.js"></script>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables Log User</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                            id="table"
                            data-toggle="table"
                            data-pagination="true"
                            data-search="true"
                            data-height="auto"
                            data-advanced-search="true">
                                <thead>
                                    <tr>
                                        <th data-sortable="true">UserName</th>
                                        <th data-sortable="true">LocationName</th>
                                        <th data-sortable="true">Action</th>
                                        <th data-sortable="true">Time</th>
                                    </tr> 
                                </thead>
                                
                                <tbody>
                                    <?php foreach ($loguser as $item){ ?>
                                        <tr>
                                            <td><?php echo $item['UserName']; ?></td>
                                            <td><textarea style="border: transparent;background: transparent;"><?php if(is_object($item['LocationName'])){for($i=0 ; $i<count($item['LocationName']);$i++){
                                            echo $item['LocationName'][$i];echo ','; }}else{echo 0;} ?></textarea></td>
                                            <td><?php if(is_object($item['Action'])){$bsonDocument =$item['Action'];
                                            $data = $bsonDocument->getArrayCopy();
                                            $string = '';
                                            foreach ($data as $key => $value) {
                                                $string .= $key . ': ' . $value . ',';
                                            }
                                            $string = rtrim($string, ','); 
                                            echo 'Update</br>';
                                            echo $string;
                                            }else{print_r($item['Action']);}; ?></td>
                                            <td><?php echo $item['Time']?></td>                                      
                                        </tr> 
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
 <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
       <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php
 require "template/Admin/footer.php";
?>
   
</body>

</html>