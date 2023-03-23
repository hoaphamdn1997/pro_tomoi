<?
   require_once '/www/wwwroot/tomosolution.com/TomoV3HoaTest/vendor/autoload.php';
   require "../kiemtralogin.php";
   $client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
   $post =$client->SorcerySetting->DeviceList;
   $count = $post->countDocuments([]);
   $Profiles = $post->find(['Running' => true],['projection' => [
              'Profiles.Log'=>1,
              'LastUpdate'=>1,
              'DeviceName'=>1,
   ],]);
   
   
   $countkq=0;
   $countDeviceEr=0;
   $countDeviceDone=0;
   $countDeviceFail=0;
   $coutUpdate=0;
   $arrayDiss=array();
   $arrayFail=array();
   $arrayDone=array();
   $arrayErorr=array();
   foreach ($Profiles as $document) {
       $countDone =0;
       $countLogFail = 0;
       $countError = 0;
       // echo 'device';
       foreach ($document['Profiles'] as $product) {
           $Fail ="Log Fail 3 times ";
           $Done = "Done ";
           $Erorr = "Error ";
           $start = 0; 
           $length = strpos($product['Log'], "|") - $start; 
           $result = substr($product['Log'], $start, $length);
           if($result == $Fail){
               $countLogFail++;
           }elseif($result == $Done){
               $countDone++;
           }elseif($result == $Erorr){
               $countError++;
           }
        }
       foreach ($document['LastUpdate'] as $time) {
           $date = new DateTime();
           $date->setTimestamp($time/1000); 
           $three_hour_ago = new DateTime('-2 hour');
           $is_changed = ($date > $three_hour_ago);
           
           if ($is_changed) {
             array_push($arrayDiss,$document['DeviceName']);
             $coutUpdate++;
           }
       }
       
       $countkq++;
       if($countLogFail>=30){
           array_push($arrayFail,$document['DeviceName']);
           $countDeviceFail++;
       }elseif($countError>=50){
           array_push($arrayErorr,$document['DeviceName']);
           $countDeviceEr++;
       }elseif($countDone>=10){
           array_push($arrayDone,$document['DeviceName']);
           $countDeviceDone++;
       }
   
   }
//   var_dump($arrayFail);var_dump($arrayErorr);var_dump($arrayDone);
?>
 
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      
   </div>
   <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <a data-toggle="modal" data-target="#ModalPcRunning">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Số máy đang Running (Tổng hệ thống)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <div class="row mt-5">
                                    <div class="col-3 text-center">
                                        <div class="con">
                                            <div class="percent-circle percent-circle-left">
                                                <div class="left-content"></div>
                                            </div>
                                            <div class="percent-circle percent-circle-right">
                                                <div class="right-content"></div>
                                            </div>
                                            <div class="text-circle"><?php echo round($countkq/$count,2)*100 ?>%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            <br />
                            <label> <?php echo $countkq ?>/<?php echo $count ?> </label>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Modal SỐ MÁY ĐANG RUNNING (TỔNG HỆ THỐNG) -->
    <div class="modal fade" id="ModalPcRunning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SỐ MÁY ĐANG RUNNING (TỔNG HỆ THỐNG)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                 <a data-toggle="modal" data-target="#ModalPcDone">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Số máy Đang Done (Tổng số máy Running)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <div class="row mt-5">
                                <div class="col-3 text-center">
                                    <div class="con">
                                        <div class="percent-circle percent-circle-left">
                                            <div class="left-content"></div>
                                        </div>
                                        <div class="percent-circle percent-circle-right">
                                            <div class="right-content"></div>
                                        </div>
                                        <div class="text-circle"><?php echo round($countDeviceDone/$countkq,2)*100 ?>%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i><br />
                        <label> <?php echo $countDeviceDone ?>/<?php echo $countkq?></label>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
     <!-- Modal Số máy Đang Done (Tổng số máy Running) -->
    <div class="modal fade" id="ModalPcDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Số máy Đang Done (Tổng số máy Running)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        foreach($arrayDone as $key){
                            echo $key . '<br>';   
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <a data-toggle="modal" data-target="#ModalPcLogFail">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số máy đang Log Fail(Tổng số máy Running)</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold t">
                                    <div class="row mt-5">
                                        <div class="col-3 text-center">
                                            <div class="con">
                                                <div class="percent-circle percent-circle-left">
                                                    <div class="left-content"></div>
                                                </div>
                                                <div class="percent-circle percent-circle-right">
                                                    <div class="right-content"></div>
                                                </div>
                                                <div class="text-circle"><?php echo round($countDeviceFail/$countkq,2)*100 ?>%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        <br />
                        <label><?php echo $countDeviceFail ?>/<?php echo $countkq?></label>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
     <!-- Modal Số máy đang Log Fail(Tổng số máy Running) -->
    <div class="modal fade" id="ModalPcLogFail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Số máy đang Log Fail(Tổng số máy Running)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        foreach($arrayFail as $key){
                            echo $key . '<br>';   
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <a data-toggle="modal" data-target="#ModalPcDisconnect">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Số máy đang Disconnect (Tổng Máy Running)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <div class="row mt-5">
                                <div class="col-3 text-center">
                                    <div class="con">
                                        <div class="percent-circle percent-circle-left">
                                            <div class="left-content"></div>
                                        </div>
                                        <div class="percent-circle percent-circle-right">
                                            <div class="right-content"></div>
                                        </div>
                                        <div class="text-circle"><?php echo round($coutUpdate/$countkq,2)*100 ?>%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i><br />
                        <label><?php echo $coutUpdate ?>/<?php echo $countkq ?></label>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>
 <!-- Modal Số máy đang Disconnect (Tổng Máy Running) -->
    <div class="modal fade" id="ModalPcDisconnect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Số máy đang Disconnect (Tổng Máy Running)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        foreach($arrayDiss as $key){
                            echo $key . '<br>';   
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Content Row -->

   <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-8 col-lg-7">
         <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
               class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               <h6 class="m-0 font-weight-bold text-primary"> Overview</h6>
               <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                     aria-labelledby="dropdownMenuLink">
                     <div class="dropdown-header">Dropdown Header:</div>
                     <a class="dropdown-item" href="#">Action</a>
                     <a class="dropdown-item" href="#">Another action</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="#">Something else here</a>
                  </div>
               </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
               <h4 class="small font-weight-bold">SỐ MÁY ĐANG ERROR<span
                  class="float-right"><?php echo ($countDeviceEr / $countkq) * 100   ?>%</span></h4>
               <div class="progress mb-4">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo ($countDeviceEr / $countkq) * 100   ?>%"
                     aria-valuenow="<?php echo ($countDeviceEr / $countkq) * 100  ?>" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <h4 class="small font-weight-bold">SỐ MÁY ĐANG DISCONNECT (TỔNG MÁY RUNNING) <span
                  class="float-right"><?php echo ($coutUpdate / $countkq) * 100   ?>%</span></h4>
               <div class="progress mb-4">
                  <div class="progress-bar bg-warning" role="progressbar" style="width:<?php echo ($coutUpdate / $countkq) * 100   ?>%"
                     aria-valuenow="<?php echo ($coutUpdate / $countkq) * 100   ?>" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <h4 class="small font-weight-bold">SỐ MÁY ĐANG RUNNING (TỔNG HỆ THỐNG) <span
                  class="float-right"><?php echo ($countkq / $count) * 100   ?>%</span></h4>
               <div class="progress mb-4">
                  <div class="progress-bar" role="progressbar" style="width: <?php echo ($countkq / $count) * 100   ?>%"
                     aria-valuenow="<?php echo ($countkq / $count) * 100   ?>" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <h4 class="small font-weight-bold">SỐ MÁY ĐANG LOG FAIL(TỔNG SỐ MÁY RUNNING)<span
                  class="float-right"><?php echo ($countDeviceFail / $countkq ) * 100   ?>%</span></h4>
               <div class="progress mb-4">
                  <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo ($countDeviceFail / $countkq )* 100   ?>%"
                     aria-valuenow="<?php echo ($countDeviceFail / $countkq ) * 100   ?>" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <h4 class="small font-weight-bold">SỐ MÁY ĐANG DONE (TỔNG SỐ MÁY RUNNING)<span
                  class="float-right"><?php echo ($countDeviceDone / $countkq )* 100   ?>%</span></h4>
               <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo ($countDeviceDone / $countkq )* 100   ?>%"
                     aria-valuenow="<?php echo ($countDeviceDone / $countkq )* 100   ?>" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
            </div>
            
         </div>
      </div>
      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5">
      
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <a data-toggle="modal" data-target="#ModalPcError">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-danger mb-1">SỐ MÁY ĐANG ERROR(TỔNG MÁY RUNNING)</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold t">
                                    <div class="row mt-5">
                                        <div class="col-3 text-center">
                                            <div class="con">
                                                <div class="percent-circle percent-circle-left">
                                                    <div class="left-content"></div>
                                                </div>
                                                <div class="percent-circle percent-circle-right">
                                                    <div class="right-content"></div>
                                                </div>
                                                <div class="text-circle"><?php echo round($countDeviceEr/$countkq,2)*100 ?>%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        <br />
                        <label><?php echo $countDeviceEr ?>/<?php echo $countkq ?></label>
                    </div>
                </div>
                </a>
            </div>
        
    </div>
     <!-- Modal SỐ MÁY ĐANG ERROR(TỔNG MÁY RUNNING)-->
    <div class="modal fade" id="ModalPcError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SỐ MÁY ĐANG ERROR(TỔNG MÁY RUNNING)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        foreach($arrayErorr as $key){
                            echo $key . '<br>';   
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
      </div>
   </div>
</div>
 <script src="js/demo/dashboad.js"></script>
  <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- /.container-fluid -->