<?php
require "template/Admin/menuAdmin.php";
?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
$customers = $client->selectCollection('SorcerySetting', 'MonitorList');
$logsys = $client->selectCollection('SorcerySetting', 'LogSystem');
$thread = $client->selectCollection('SorcerySetting', 'DeviceList');
$array = $customers->find([]);
$Campaign= array();
foreach($array as $item){
array_push($Campaign,$item['CampaignID']);
}
// Find the documents and get the values
$cursor = $logsys->find([], [
    // 'sort' => ['timestamp' => -1],
    'limit' => 24,
    // 'skip' => 1,
    'projection' => ['Value' => 1, 'timestamp' => 1]
]);

// var_dump($cursor);
$values = [];
$timestamp =[];
foreach ($cursor as $document) {
    $values[] = $document->Value;
    $timestamp[] = $document->timestamp;
}
$transposed = [];
$transposedTime = [];
foreach ($values as $subArray) {
    foreach ($subArray as $key => $value) {
        $transposed[$key][] = $value;
    }
}
foreach ($timestamp as $subArray) {
    foreach ($subArray as $key => $value) {
        $transposedTime[$key][] = $value;
    }
}
$json_transposed = json_encode($transposed);
$json_transposedTime = json_encode($transposedTime);


?>
<script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
<!-- Page Heading -->
<div class="container-fluid" >
                    <!--<div class="d-sm-flex align-items-center justify-content-between mb-4">-->
                    <!--    <h1 class="h3 mb-0 text-gray-800">CHART</h1>-->
                       
                    <!--</div>-->

                    <div class="card-body row" id="contai">
                        
                        <?php
                            foreach ( $Campaign as $camKey => $camValue){
                                $document = $customers->findOne(['CampaignID' => $camValue]);//document[1] campaign vs value
                                   if($document !== NULL){
                                       $array = $document['BKTList'];
                                       $count = 0;
                                       foreach ($array as $BKTKey => $BKTValue){
                                           $count += $BKTValue['Realtime'];
                                       }
                                       $Campaign[$camValue] = $count; ?>
                                        <div class="col-3 mt-1 mb-2 " style="">
                                       <!--<a href="chartinfo.php" class="mb-0 " style="text-decoration: none">-->
                                         <a href="/chartinfo.php?id=<?php  echo $camValue ?>" class="infochart" style="text-decoration: none">
                                        <div class="card border-left-primary shadow h-100 py-2" aria-haspopup="true" aria-expanded="false">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2" >
                                                        <div class=" font-weight-bold text-primary text-uppercase mb-0 countCam" ><?php echo $camValue?>
                                                             </div>
                                                        <div class="Gp h5 mb-1 font-weight-bold text-gray-800 " ><?php 
                                $getThread=$thread->find(['CampaignID'=>$camValue,'Running'=>true],['projection' => ['Thread' => 1]]);
                                $countThread =0;
                                foreach ($getThread as $key){
                                  $countThread += $key['Thread'];
                                }
                                echo $Campaign[$camValue] . '/' . $countThread; ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <canvas id="myBarChart<?php echo $camKey?>"></canvas>
                                                    </div>
                                                   
                                                </div>
                                               
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                        
                                   <?php }
                              
                               }
                        ?>
                      
                    
                   
                    
               
</div>
<div class="card align-items-center">
<div id = "clock" onload="currentTime()"></div>
</div>
<?php
 require "template/Admin/footer.php";
?>
    <script>
    		 $(document).ready(function() {
          var container = $('#contai');
          var divs = container.children();
          divs.sort(function(a, b) {
            return $(a).text().localeCompare($(b).text());
          });
          container.empty();
          divs.each(function() {
            container.append(this);
          });
        });

      setInterval(function(){
		  window.location.reload();
	},300000)
	function currentTime() {
  let date = new Date(); 
  let hh = date.getHours();
  let mm = date.getMinutes();
  let ss = date.getSeconds();
  let session = "AM";

  if(hh === 0){
      hh = 12;
  }
  if(hh > 12){
      hh = hh - 12;
      session = "PM";
   }

   hh = (hh < 10) ? "0" + hh : hh;
   mm = (mm < 10) ? "0" + mm : mm;
   ss = (ss < 10) ? "0" + ss : ss;
    
   let time = hh + ":" + mm + ":" + ss + " " + session;

  document.getElementById("clock").innerText = time; 
  let t = setTimeout(function(){ currentTime() }, 1000);
}

currentTime();
    </script>
    
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
var transposed = <?php echo $json_transposed; ?>;
var transposedTime = <?php echo $json_transposedTime; ?>;
function transpose(arr) {
  // Initialize a new 2D array with the transposed dimensions
  const result = new Array(arr[0].length);
  for (let i = 0; i < result.length; i++) {
    result[i] = new Array(arr.length);
  }
  
  // Iterate over the original array and swap rows and columns
  for (let i = 0; i < arr.length; i++) {
    for (let j = 0; j < arr[0].length; j++) {
      result[j][i] = arr[i][j];
    }
  }
  
  return result;
}
const newtransposedTime = transpose(transposedTime);
const newtransposed = transpose(transposed);

for(let i = 0 ; i<=document.getElementsByClassName('countCam').length; i++){

    var ctx = document.getElementById(`myBarChart${i}`);
    var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels:newtransposedTime[i],
        datasets: [{
          label: "Realtime",
          backgroundColor: "#4e73df",
          hoverBackgroundColor: "#2e59d9",
          borderColor: "#4e73df",
          data: newtransposed[i],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
            x: {
                ticks: {
                    display: false // đặt giá trị display của ticks là false
                },
                min: ''
            },
          xAxes: [{
            time: {
              unit: 'day'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 6,
              display: false
            },
            maxBarThickness: 25,
          }],
          yAxes: [{
            ticks: {
              min: 0,
              suggestedMax: null,
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return   number_format(value) + ' view';
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ' : ' + number_format(tooltipItem.yLabel) +' view';
            }
          }
        },
      }
    });
}//end for

    </script>
    <!--<script src="js/demo/chart-area-demo.js"></script>-->
        <script src="js/demo/chart-bar-demo.js"></script>
       <script src="vendor/jquery/jquery.min.js"></script>  
       <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>