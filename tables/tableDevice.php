<?php
   require_once '/www/wwwroot/tomosolution.com/TomoV3HoaTest/vendor/autoload.php';
   $client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
   // $customers = $client->selectCollection('SorcerySetting', 'MonitorList');
   // $myData = $customers->find(['CampaignID']);
   require "../kiemtralogin.php";
   $post =$client->SorcerySetting->DeviceList;
   $data = $client->SorcerySetting->CampaignList;
   $camp = $data->find([],['projection' => [
               'CampaignID' => 1,
           ],]);
   $myData = $post->find([],['projection' => [
               'Guid'=>1,
               'DeviceName' => 1,
               'Thread' => 1,
               'Action' => 1,
               'CampaignID' => 1,
               'Running' => 1,
               'LastUpdate' =>1,
               'Busy' => 1,
           ],]);
//   foreach ($myData as $item){
//       var_dump($item);
//   }
   // 'LastUpdate'->toDateTime()->format("d M Y m:s:i")
   ?>  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css">
<link href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.2/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.3/dist/extensions/toolbar/bootstrap-table-toolbar.min.js"></script
<div class="container-fluid">
   <!-- Page Heading -->
   <!-- DataTales Example --><h1 class="h3 mb-2 text-gray-800">Device Table</h1>
   
   <div class="card shadow mb-4">
      <div class="card-header py-3">
          
         <div class="row">
            <div class="col-sm-12 col-md-10">
                <form action="importDevice.php" class="form-group" method="post" enctype="multipart/form-data">
                    <label class="showmessup"></label><br>
                   <label for="csv_file">Choose a CSV file to upload:
                   <input  type="file" id="csv_file" name="csv_file" accept=".csv"></label><br>
                   <input class="btn-sm btn btn-outline-primary "  type="submit" value="Upload" name="submit">
                   
                </form>
                    
                     
            </div>
           
            <div class="col-sm-12 col-md-2" style="text-align:right">
               <!-- Button trigger modal -->
               <!--them-->
               <button class="btn btn-primary" data-toggle="modal" data-target="#myModal4" disabled>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                     <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
                     <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                  </svg>
               </button>
               <!--sua-->
               <button class="btn btn-primary " id="sua" data-toggle="modal" data-target="#myModal5" disabled>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                     <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                     <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                  </svg>
               </button>
               <!--xoa-->
               <button class="btn btn-danger" id="xoa3" data-toggle="modal" data-target="#myModal6" disabled>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                     <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                     <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                  </svg>
               </button>
               <!-- add -->
               <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <span>Add Device</span>
                           <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×</span><span class="sr-only">Close</span>
                           </button>
                        </div>
                        <div class="modal-body modal-addDev">
                           <div id="modal-content">
                              <form action="" method="post" accept-charset="utf-8">
                                 <label>DeviceName</label>
                                 <input type="text" class="float-right" id="Device" name="Device"/><br>
                                 <label>Thread    </label>
                                 <input type="text" class="float-right" id="Thread" name="Thread"/><br>
                                 <label>Choose Action</label>
                                 <select class="float-right" name="Action" id="Action">
                                    <option value="Campaign">Campaign</option>
                                    <option value="Monitor">Monitor</option>
                                    <option value="Campaign">Campaign</option>
                                 </select>
                                 <br>
                                 <label>Choose CampaignID </label>
                                 <select class="float-right" name="CampaignID" id="CampaignID">
                                 </select><br>
                                 <label>Running </label>
                                 <select class="float-right" name="Running" >
                                    <option value="1">Run</option>
                                    <option value="0">Stop</option>
                                 </select>
                                 <br>
                                 <button type="submit" class="btn btn-primary btn-update" value="Submit" id="them" name="add">ADD</button>
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end add -- Update-->
               <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <span>Update Device</span>
                           <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×</span><span class="sr-only">Close</span>
                           </button>
                        </div>
                        <div class="modal-body modal-update">
                           <div id="modalContent">
                              <form method="post" accept-charset="utf-8">
                                 <div>
                                    <select id="selector"  class="form-select form-select-sm" onchange="yesnoCheck(this);" style="float:left;">
                                       <option value="select">__Select__</option>
                                       <!--<option value="DeviceName">DeviceName</option>-->
                                       <option value="Thread">Thread</option>
                                       <option value="Action">Action</option>
                                       <option value="CampaignID">CampaignID</option>
                                       <option value="Run">Run</option>
                                    </select>
                                 </div>
                                 <!--<div id="adc" style="display: none;">-->
                                 <!--    <input type="text" id="DeviceName1" value="DeviceName"/>-->
                                 <!--    <button id="removeDeviceName" onclick="deleteName()" type="button">X</button><br>-->
                                 <!--</div>-->
                                 <div class="card-body">
                                    <div id="pc" style="display: none;" class="mt-3" >
                                       <p  style="display:inline-block; " >Thread </p>
                                       <input  type="number" min="1" id="Thread1" value="99"/>
                                       <button class="close"  id="removeThread" type="button"  onclick="deleteThread()">x</button><br>
                                    </div>
                                    <div id="ps" style="display: none; "  class="mt-3">
                                       <p style="display:inline-block; " >Action</p>
                                       <select id="Action1">
                                          <option value="99">Choose</option>
                                          <option value="Campaign">Campaign</option>
                                          <option value="Monitor">Monitor</option>
                                       </select>
                                       <button class="close"  id="removeAction" type="button" onclick="deleteAction()">x</button><br>
                                    </div>
                                    <div id="pg" style="display: none; " class="mt-3">
                                       <p  style="display:inline-block; ">CampaignID</p>
                                       <select  id="CampaignIDChange">
                                          <option value="99">--Choose Campaign--</option>
                                          <?php foreach($camp as $key){ ?>
                                          <option value="<?php echo $key["CampaignID"]; ?>"><?php echo $key["CampaignID"]; ?></option>
                                          <?php }?>
                                       </select>
                                       <button class="close"  id="removeCampaignID" type="button" onclick="deleteCampaignID()">x</button><br>
                                    </div>
                                    <div id="run" style="display: none; " class="mt-3">
                                       <p style="display:inline-block;">Run</p>
                                       <select id="run1">
                                          <option value="99">--Choose Campaign--</option>
                                          <option value="1">True</option>
                                          <option value="0">False</option>
                                       </select>
                                       <button class="close "  id="removeRun" type="button" onclick="deleteRun()">x</button><br>
                                    </div>
                                 </div>
                                 <div class="card">
                                    <button type="submit" class="btn btn-primary btn-update" value="Update" id="suar" name="update">Save Change</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--End update - Delete -->
               <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <span>Delete Campaign</span>
                           <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×</span><span class="sr-only">Close</span>
                           </button>
                        </div>
                        <div class="modal-body modal-update">
                           <div id="modalContent">
                              <form role="form" name="update" method="POST" id="delete">
                                 <div class="form-group" style="text-align:center"><label for="CampaignID">Chắc chưa ?</label><br></div>
                                 <button type="submit" class="btn btn-primary btn-update" value="Submit" id="xoa" name="delete">Yup!</button>
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end dele-->
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<div class="card-body">
    <div id="toolbar" class="select">
      <select class="form-control">
        <option value="">Export Basic</option>
        <option value="all">Export All</option>
        <option value="selected">Export Selected</option>
      </select>
    </div>
            <table
                id="table"
               data-show-columns="true"
               data-show-export="true"
               data-toolbar="#toolbar"
               data-toggle="table"
               data-pagination="true"
               data-search="true"
               data-height="auto"
               data-advanced-search="true"
               data-id-table="advancedTable"
               data-escape="false"
              data-multiple-select-row="true"
              data-click-to-select="true"
              data-remember-order="true">
      <thead id="headerDash">
         <tr>
            <th data-field="state" data-checkbox="true"></th>
            <th data-field="1" data-sortable="true">DeviceName</th>
            <th data-field="2" data-sortable="true">Thread</th>
            <th data-field="3" data-sortable="true">Action</th>
            <th data-field="4" data-sortable="true">CampaignID</th>
            <th data-field="5" data-sortable="true">LastUpdate</th>
            <th data-field="6" data-sortable="true">Guid</th>
            <th data-sortable="true">Running</th>
         </tr>
      </thead>
      <tbody id="bodyDash">
         <?php foreach ($myData as $item){
            ?>
         <tr>
            <td></td>
            <td class="getDeviceName"><?php echo $item['DeviceName']; ?></td>
            <td><?php if(isset($item['Busy'])){echo $item['Busy'];}else echo "0"; ?>/<?php echo $item['Thread']; ?></td>
            <td><?php echo $item['Action']; ?></td>
            <td><?php echo $item['CampaignID']; ?></td>
            <td> <?php   if(isset($item['LastUpdate'])){echo  date("d-m-Y H:i:s",strtotime('+7 hours',strtotime($item['LastUpdate']->toDateTime()->format("d M Y m:s:i "))));}else echo "0"; ?></td>
            <td><?php if(isset($item['Guid'])){echo $item['Guid'];}else echo "0"; ?></td>
            <td>
               <div class="form-check form-switch" style="margin-left: 12px;">
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php if($item['Running']){ echo "checked";} else { echo "";}?> />  
               </div>
            </td>
         </tr>
         <?php } ?>
      </tbody>
   </table>
</div>
</div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script src="js/demo/datatables-demo.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script src="js/scripts.js"></script>
      <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->
      <!-- Bootstrap core JavaScript-->
      <!--<script src="vendor/jquery/jquery.min.js"></script>-->
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script >
$(document).ready(function(){

   var url_string = window.location.search.substring(1),
    url_params = url_string.split('&'),
    param, i;

for (i = 0; i < url_params.length; i++) {
    param = url_params[i].split('=');

}
if (param[1] == 1) {
    // alert('chưa có file')
    $('.showmessup').append('<p style="color:red">chưa có file</p>');
}
if (param[1] == 2) {
   $('.showmessup').append('<p style="color:red">Lỗi File không đúng fomat</p>');
}
if (param[1] == 3) {
     $('.showmessup').append('<p style="color:green">Up thành công</p>');
}
});
   function yesnoCheck(that) 
     {
         if (that.value == "DeviceName") 
         {
             document.getElementById("adc").style.display = "block";
             var select = document.getElementById("selector");
             select.remove(select.selectedIndex);
             document.getElementById("DeviceName1").setAttribute("name", "DeviceName")
         }
         if (that.value == "Thread")
         {
             document.getElementById("pc").style.display = "block";
            var select = document.getElementById("selector");
             select.remove(select.selectedIndex);
             document.getElementById("Thread1").setAttribute("name", "Thread")
         }
         
         if (that.value == "Action")
         {
             document.getElementById("ps").style.display = "block";
             var select = document.getElementById("selector");
             select.remove(select.selectedIndex);
             document.getElementById("Action1").setAttribute("name", "Action")
         }
         if (that.value == "CampaignID")
         {
             document.getElementById("pg").style.display = "block";
             var select = document.getElementById("selector");
             select.remove(select.selectedIndex);
             document.getElementById("CampaignID1").setAttribute("name", "CampaignID")
         }
         if (that.value == "Run")
              {
                  document.getElementById("run").style.display = "block";
                  var select = document.getElementById("selector");
                  select.remove(select.selectedIndex);
                  document.getElementById("run1").setAttribute("name", "Run")
              }
     }
     function deleteName() {
         //show option
             var select = document.getElementById("selector");
             var option = document.createElement("option");
             option.text = "DeviceName";
             option.value = "DeviceName";
             select.add(option);
         //hide input & remove
         document.getElementById("adc").style.display = "none";
         document.getElementById("DeviceName1").removeAttribute("name");
     }
     function deleteThread() {
         //show option
             var select = document.getElementById("selector");
             var option = document.createElement("option");
             option.text = "Thread";
             option.value = "Thread";
             select.add(option);
         //hide input & remove
         document.getElementById("pc").style.display = "none";
         document.getElementById("pc").removeAttribute("name");
     }
     function deleteAction() {
         //show option
             var select = document.getElementById("selector");
             var option = document.createElement("option");
             option.text = "Action";
             option.value = "Action";
             select.add(option);
         //hide input & remove
         document.getElementById("ps").style.display = "none";
         document.getElementById("ps").removeAttribute("name");
     }
     function deleteCampaignID() {
         //show option
             var select = document.getElementById("selector");
             var option = document.createElement("option");
             option.text = "CampaignID";
             option.value = "CampaignID";
             select.add(option);
         //hide input & remove
         document.getElementById("pg").style.display = "none";
         document.getElementById("pg").removeAttribute("name");
     }
       function deleteRun() {
              //show option
                  var select = document.getElementById("selector");
                  var option = document.createElement("option");
                  option.text = "Run";
                  option.value = "Run";
                  select.add(option);
              //hide input & remove
              document.getElementById("run").style.display = "none";
              document.getElementById("run").removeAttribute("name");
          }
     // click action
   
      //action
         $(document).ready(function() {
             
   //  click body $('#dataTableCam tbody').on('click', 'tr', function() {
        $('#suar').on("click",function(){
              var arrayLink=[];
                  const getTD = document.querySelectorAll('.selected');
                  for(let i=0;i<getTD.length;i++){
                      var a =getTD[i].querySelector('.getDeviceName');
                      var getDeviceName = a.innerHTML;
                      arrayLink.push(getDeviceName);
                      
                  }
              var sua= 2;
              var data ={values:arrayLink,sua:sua};
              if($('#Thread1').val()!=99){
                  data['Thread'] = $('#Thread1').val();
              }
              if($('#Action1').val()!=99){
                  data['Action'] = $('#Action1').val();
              }
              if($('#CampaignIDChange').val()!=99){
                  data['CampaignID'] = $('#CampaignIDChange').val();
              }
              if($('#run1').val()!=99){
                  data['Run'] = $('#run1').val();
              }
          $.ajax({
             url: 'process.php',
             type: 'POST',
             data: data,
             success: function(response) {
             },
             error: function() {
             alert('An error occurred');
             }
             });
        }) 
        //xoa
         $('#xoa').on("click",function(){
              var arrayLink=[];
                  const getTD = document.querySelectorAll('.selected');
                  for(let i=0;i<getTD.length;i++){
                      var a =getTD[i].querySelector('.getDeviceName');
                      var getDeviceName = a.innerHTML;
                      arrayLink.push(getDeviceName);
                      
                  }
              var xoa= 2;
              var data ={values:arrayLink,xoa:xoa};
              $.ajax({
                 url: 'process.php',
                 type: 'POST',
                 data: data,
                 success: function(response) {
                 },
                 error: function() {
                 alert('An error occurred');
                 }
                });
        }); 
        
      });
      $('#bodyDash').on('change','input:checkbox',function() {
          if (this.checked == true) {
              $('#sua').removeAttr('disabled', '');
              $('#xoa3').removeAttr('disabled', '');
          } else {
              $('#sua').attr('disabled', '');
              $('#xoa3').attr('disabled', '');
          }
     
   }); 
   $('#headerDash').on('change','input:checkbox',function() {
         
      if (this.checked == true) {
              $('#sua').removeAttr('disabled', '');
              $('#xoa3').removeAttr('disabled', '');
          } else {
              $('#sua').attr('disabled', '');
              $('#xoa3').attr('disabled', '');
          }
   }); 
   
  $('#bodyDash').on('change', 'input[name=btSelectItem]', function() {
      $row = $(this).closest("tr");
      $tds = $row.find('td');
      $bd=$tds[2].innerHTML.split('/')
  $('#Thread1').attr("value",$bd[1]);
  	b=$tds[3].innerHTML
    $('#Action1 option[value='+b+']').prop('selected', true);
  c=$tds[4].innerHTML
    $('#CampaignIDChange option[value='+c+']').prop('selected', true);
    $checked = $row.find('td div input#flexSwitchCheckChecked').is(":checked");
    if($checked==true){
        return   $('#run1 option[value=1]').prop('selected', true);
    }else{
        return   $('#run1 option[value=0]').prop('selected', true);
    }
  })
  $('#export').click(function() {
   var titles = [];
  var data = [];
  
        $('.table tr').each(function() {
                data.push($(this));
            });

    csv_data = []

  data.forEach(function(item,index){
    td = item[0].children
    for(i=0;i<td.length;i++){
     
      csv_data.push(td[i].innerText)
    }
   
    csv_data.push('\r\n')
  })

  var downloadLink = document.createElement("a");
  var blob = new Blob(["\ufeff", csv_data]);
  var url = URL.createObjectURL(blob);
  downloadLink.href = url;
  downloadLink.download = "minicrawl.csv";
  document.body.appendChild(downloadLink);
  downloadLink.click();
  document.body.removeChild(downloadLink);
  
})
   /*
* Convert data array to CSV string
* @param arr {Array} - the actual data
* @param columnCount {Number} - the amount to split the data into columns
* @param initial {String} - initial string to append to CSV string
* return {String} - ready CSV string
*/
function prepCSVRow(arr, columnCount, initial) {
  var row = ''; // this will hold data
  var delimeter = ','; // data slice separator, in excel it's `;`, in usual CSv it's `,`
  var newLine = '\r\n'; // newline separator for CSV row

  /*
   * Convert [1,2,3,4] into [[1,2], [3,4]] while count is 2
   * @param _arr {Array} - the actual array to split
   * @param _count {Number} - the amount to split
   * return {Array} - splitted array
   */
  function splitArray(_arr, _count) {
    var splitted = [];
    var result = [];
    _arr.forEach(function(item, idx) {
      if ((idx + 1) % _count === 0) {
        splitted.push(item);
        result.push(splitted);
        splitted = [];
      } else {
        splitted.push(item);
      }
    });
    return result;
  }
  var plainArr = splitArray(arr, columnCount);
  // don't know how to explain this
  // you just have to like follow the code
  // and you understand, it's pretty simple
  // it converts `['a', 'b', 'c']` to `a,b,c` string
  plainArr.forEach(function(arrItem) {
    arrItem.forEach(function(item, idx) {
      row += item + ((idx + 1) === arrItem.length ? '' : delimeter);
    //   (idx + 1)
    });
    row += newLine;
  });
  return initial + row;
} 
// $('input#csv_file').on('mouseleave', function() {
//     var fileName = $(this).val();
//     if (fileName != "") {
//         $('input.btn-sm.btn.btn-outline-primary').removeAttr('disabled')
//     } else {
//       $('input.btn-sm.btn.btn-outline-primary').attr('disabled', '');
//     }
// });

</script>
