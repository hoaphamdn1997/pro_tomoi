<?php
   include( "template/Admin/menuAdmin.php");
   ?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
$logsys = $client->selectCollection('SorcerySetting', 'LogSystem');
$customers = $client->selectCollection('SorcerySetting', 'MonitorList');
$array = $customers->find([]);

// Find the documents and get the values
$cursor = $logsys->find(['CampaignID'=>$_GET['id']], ['projection' => ['Value' => 1, 'timestamp' => 1]]);
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
// echo $transposed . $transposedTime;
$json_transposed = json_encode($transposed);
$json_transposedTime = json_encode($transposedTime);


?>
<div class="container-fluid">
   <h1 class="h3 mb-2 text-gray-800">CHART <?php if(isset($_GET['id'])){echo $_GET['id'];}  ?> INFO</h1>
   <div class="card shadow mb-4">
      <!-- Bar Chart -->
      <div class="card shadow mb-4">
         <div class="card-header py-3">
             <div class="float-left" ><label class="text-primary">Show Big Chart 24h</label></div>
            <div class="float-right">
               <select class="form-select form-select-sm" aria-label="Default select example" style="border-color: white;">
                          <option selected> <label>Select Next Chart</label></option>
                          
                            <?php 
                                foreach($array as $item){
                                    echo '<option style="text-align:center;" value="'.$item['CampaignID'].'">'.$item['CampaignID'].'</option>';
                                }
                            ?>
                        </select></div>
         </div>
         
         <div class="card-body">
            <div class="chart-bar">
               <canvas id="myBarChart"></canvas>
            </div>
            <hr><div class="d-flex">
            <div> Thông tin chi tiết Campaign :
            <code><?php if(isset($_GET['id'])){echo $_GET['id'];}  ?></code> .
            </div>
             <a href="charts.php"class="float-right">Go Back Chart<i class="fas fa-fw fa-chart-area"></i></a></div>
         </div>
        
      </div>
   </div>
</div>
<?php
   require "template/Admin/footer.php";
   ?>
<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>
   <script src="vendor/jquery/jquery.min.js"></script>  
       <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
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
    let newArr = transposed.flat();
    let newArrTime = transposedTime.flat();
    // console.log(newArrTime);
    var ctx = document.getElementById('myBarChart');
    var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels:newArrTime,
        datasets: [{
          label: "Realtime",
          backgroundColor: "#4e73df",
          hoverBackgroundColor: "#2e59d9",
          borderColor: "#4e73df",
          data: newArr,
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

$('.form-select.form-select-sm').on('change',function(){ window.location.href ="https://192.168.10.177/chartinfo.php?id="+$(this).val()})
$(document).ready(function(){

   var url_string = window.location.search.substring(1),
    url_params = url_string.split('&'),
    param, i;

for (i = 0; i < url_params.length; i++) {
    param = url_params[i].split('=');

} 
 $('.form-select.form-select-sm option[value='+param[1]+']').prop('selected', true);
})
    </script>