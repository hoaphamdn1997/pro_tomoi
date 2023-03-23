<?php
   require_once '/www/wwwroot/tomosolution.com/TomoV3HoaTest/vendor/autoload.php';
   require "../kiemtralogin.php";
   $client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
   $post =$client->SorcerySetting->CampaignList;
   $Loguser =$client->SorcerySetting->LogUser;
   $myData = $post->find([]);
   
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

<div class="container-fluid">
   <!-- Page Heading -->
   <!-- DataTales Example -->
   <h1 class="h3 mb-2 text-gray-800">Campaign Page</h1>
   <div class="card shadow mb-4">
      <div class="card-header py-3 row">
         <div class="col-sm-12 col-md-10">
            <form action="import.php" class="form-group" method="post" enctype="multipart/form-data">
               <label for="csv_file">Choose a CSV file to upload:
               <input  type="file" id="csv_file" name="csv_file" accept=".csv"></label><br>
               <input class="btn-sm btn btn-outline-primary"  type="submit" value="Upload" name="submit" disabled>
            </form>
         </div>
         <div class="col-sm-12 col-md-2" style="text-align: center;">
            <button class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#myModal3">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                  <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
                  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
               </svg>
            </button>
         </div>
      </div>
      <div class="card-body">
         <div class="table-responsive">
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
               data-escape="false">
               <thead id="headerDash">
                  <tr>
                     <th data-sortable="true" class="data CampaignID">CampaignID</th>
                     <th data-sortable="true" class="data ChangeClipFrom">ChangeClipFrom</th>
                     <th data-sortable="true" class="data ChangeClipTo">ChangeClipTo</th>
                     <th data-sortable="true" class="data DurationFrom">DurationFrom</th>
                     <th data-sortable="true" class="data DurationTo">DurationTo</th>
                     <th data-sortable="true" class="data BiliBiliPool" >BiliBiliPool</th>
                     <th data-sortable="true" class="data SubFrom">SubFrom</th>
                     <th data-sortable="true" class="data SubTo">SubTo</th>
                     <th data-sortable="true" class="data YoutubePool" >YoutubePool</th>
                     <th data-sortable="true" class="data isChangeClip">isChangeClip</th>
                     <th data-sortable="true" class="data isSendMail">isSendMail</th>
                     <th data-sortable="true" class="data isSub" >isSub</th>
                     <th data-sortable="true" class="data isViewBili" >isViewBili</th>
                     <th data-sortable="true" class="data isViewNews" >isViewNews</th>
                     <th data-sortable="true" class="data isViewYoutube" >isViewYoutube</th>
                     <th data-sortable="true" class="data isMobile" >isMobile</th>
                     <th data-sortable="true" class="data SubPercent" >SubPercent</th>
                     <th data-sortable="true" class="data isMusic" >isMusic/isFeed/isAds</th>
                     
                     <th>Edit</th>
                     <th>Clone</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody id="huda">
                  <?php foreach ($myData as $item): ?>
                  <tr>
                     <td class="data CampaignID"><?php echo $item['CampaignID'] ?></td>
                     <td class="data ChangeClipFrom"><?php echo $item['ChangeClipFrom']; ?></td>
                     <td class="data ChangeClipTo"><?php echo $item['ChangeClipTo']; ?></td>
                     <td class="data DurationFrom"><?php echo $item['DurationFrom']; ?></td>
                     <td class="data DurationTo"><?php echo $item['DurationTo']; ?></td>
                     <td class="data BiliBiliPool"><?php echo $item['BiliBiliPool'];?></td>
                     <td class="data SubFrom"><?php echo $item['SubFrom'] ?></td>
                     <td class="data SubTo"><?php echo $item['SubTo'] ?></td>
                     <td class="data YoutubePool" ><?php echo $item['YoutubePool'] ?></td>
                     <!--<td class="data isChangeClip" ><?php echo $item['isChangeClip'] ?></td>-->
                      <td class="data isChangeClip" >
                         <div class="form-check form-switch" style="margin-left: 12px;">
                             <input class="form-check-input isChangeClip" type="checkbox" role="switch" id="isChangeClip" <?php if($item['isChangeClip']==1){ echo "checked";} else { echo "";}?> />  
                         </div>
                    </td>
                     <!--<td class="data isSendMail" ><?php echo $item['isSendMail'] ?></td>-->
                             <td class="data isSendMail">
                        <div class="form-check form-switch" style="margin-left: 12px;">
                            <input class="form-check-input isSendMail" type="checkbox" role="switch" id="isSendMail"
                            <?php if($item['isSendMail']==1){ echo "checked";} else { echo "";}?>
                            />
                        </div>
                        </td>

                     <!--<td class="data isSub" ><?php echo $item['isSub'] ?></td>-->
                     <td class="data isSub">
                            <div class="form-check form-switch" style="margin-left: 12px;">
                                <input class="form-check-input isSub" type="checkbox" role="switch" id="isSub"
                                <?php if($item['isSub']==1){ echo "checked";} else { echo "";}?>
                                />
                            </div>
                        </td>

                     <!--<td class="data isViewBili" ><?php echo $item['isViewBili'] ?></td>-->
                     <td class="data isViewBili">
                        <div class="form-check form-switch" style="margin-left: 12px;">
                            <input class="form-check-input isViewBili" type="checkbox" role="switch" id="isViewBili"
                            <?php if($item['isViewBili']==1){ echo "checked";} else { echo "";}?>
                            />
                        </div>
                    </td>

                     <!--<td class="data isViewNews" ><?php echo $item['isViewNews'] ?></td>-->
                     <td class="data isViewNews">
                        <div class="form-check form-switch" style="margin-left: 12px;">
                            <input class="form-check-input isViewNews" type="checkbox" role="switch" id="isViewNews"
                            <?php if($item['isViewNews']==1){ echo "checked";} else { echo "";}?>
                            />
                        </div>
                    </td>

                     <!--<td class="data isViewYoutube" ><?php echo $item['isViewYoutube'] ?></td>-->
                             <td class="data isViewYoutube">
                            <div class="form-check form-switch" style="margin-left: 12px;">
                                <input class="form-check-input isViewYoutube" type="checkbox" role="switch" id="isViewYoutube"
                                <?php if($item['isViewYoutube']==1){ echo "checked";} else { echo "";}?>
                                />
                            </div>
                        </td>

                     <!--<td class="data isMobile" ><?php echo $item['isMobile'] ?></td>-->
                     <td class="data isMobile">
                        <div class="form-check form-switch" style="margin-left: 12px;">
                            <input class="form-check-input isMobile" type="checkbox" role="switch" id="isMobile"
                            <?php if($item['isMobile']==1){ echo "checked";} else { echo "";}?>
                            />
                        </div>
                    </td>

                     <!--<td class="data SubPercent" ><?php echo $item['SubPercent'] ?></td>-->
                     <td class="data SubPercent">
                       
                        <?php echo $item['SubPercent'] ?>
                    </td>

                     <!--<td class="data isMusic"><?php echo $item['isMusic'] ?></td>-->
                     <td class="data isMusic">
                        <div class="d-flex">
                            <div class="form-check form-switch" style="margin-left: 12px;">
                            <input class="form-check-input isMusic" type="checkbox" role="switch" id="isMusic"
                            <?php if($item['isMusic']==1){ echo "checked";} else { echo "";}?>
                            />
                        </div>
                        <div class="form-check form-switch" style="margin-left: 12px;">
                            <input class="form-check-input isFeed" type="checkbox" role="switch" id="isFeed"
                            <?php if($item['isFeed']==1){ echo "checked";} else { echo "";}?>
                            />
                        </div>
                         <div class="form-check form-switch" style="margin-left: 12px;">
                            <input class="form-check-input SubPercent" type="checkbox" role="switch" id="isAds"
                            <?php if($item['isAds']==1){ echo "checked";} else { echo "";}?>
                            />
                        </div>
                        </div>
                    </td>
                   

                     <td style="text-align:center;">
                        <button class="btn btn-primary update" data-toggle="modal" data-target="#myModal" >
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                              <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                           </svg>
                        </button>
                     </td>
                     <td style="text-align:center;">
                        <button class="btn btn-primary clone" data-toggle="modal" data-target="#myModal1" >
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
                              <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
                           </svg>
                        </button>
                     </td>
                     <td style="text-align:center;">
                        <button class="btn btn-danger"  data-toggle="modal" data-target="#myModal2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                           </svg>
                        </button>
                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
            <!--update-->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <span>Update Campaign</span>
                        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×</span><span class="sr-only">Close</span>
                        </button>
                     </div>
                     <div class="modal-body modal-update">
                        <div id="modalContent">
                           <form role="form" name="update" method="POST" id="updateF">
                              <div class="form-group"><label for="CampaignID">CampaignID</label><textarea class="form-control" name="CampaignID" id="CampaignID0" ></textarea> </div>
                              <div class="form-group"><label for="ChangeClipFrom">ChangeClipFrom</label><textarea class="form-control" name="ChangeClipFrom" id="ChangeClipFrom1"> </textarea></div>
                              <div class="form-group"><label for="ChangeClipTo">ChangeClipTo</label><textarea class="form-control" name="ChangeClipTo" id="ChangeClipTo2"> </textarea></div>
                              <div class="form-group"><label for="DurationFrom">DurationFrom</label><textarea class="form-control" name="DurationFrom" id="DurationFrom3"> </textarea></div>
                              <div class="form-group"><label for="DurationTo">DurationTo</label><textarea class="form-control" name="DurationTo" id="DurationTo4"> </textarea></div>
                              <div class="form-group"><label for="BiliBiliPool">BiliBiliPool</label><textarea class="form-control" name="BiliBiliPool" id="BiliBiliPool5"> </textarea></div>
                              <div class="form-group"><label for="SubFrom">SubFrom</label><textarea class="form-control" name="SubFrom" id="SubFrom6"> </textarea></div>
                              <div class="form-group"><label for="SubTo">SubTo</label><textarea class="form-control" name="SubTo" id="SubTo7"> </textarea></div>
                              <div class="form-group"><label for="YoutubePool">YoutubePool</label><textarea class="form-control" name="YoutubePool" id="YoutubePool8"> </textarea></div>
                              <div class="form-group"><label for="isChangeClip">isChangeClip</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isChangeClip" id="isChangeClip9"/></div></div>
                              <div class="form-group"><label for="isSendMail">isSendMail</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isSendMail" id="isSendMail10"/></div></div>
                              <div class="form-group"><label for="isSub">isSub</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isSub" id="isSub11"/></div></div>
                              <div class="form-group"><label for="isViewBili">isViewBili</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isViewBili" id="isViewBili12"/></div></div>
                              <div class="form-group"><label for="isViewNews">isViewNews</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isViewNews" id="isViewNews13"/></div></div>
                              <div class="form-group"><label for="isViewYoutube">isViewYoutube</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isViewYoutube" id="isViewYoutube14"/></div></div>
                              <div class="form-group"><label for="isMobile">isMobile</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isMobile" id="isMobile15"/></div></div>
                              <div class="form-group"><label for="SubPercent">SubPercent</label><br><div class="d-flex"><textarea name="SubPercent" id="SubPercent16"class="form-control"  style="height: 25px;width:70px;"></textarea><label style="margin-left:10px;">%</label></div></div>
                              <div class="form-group">
                                      <label for="">Choose a is... update:</label>
                                        <select name="" id="isSelecttrurn" class="form-select form-select-sm">
                                            <option value="0">Default</option>
                                            <option value="1">isMusic</option>
                                            <option value="2">isFeed</option>
                                            <option value="3">isAds</option>
                                        </select>
                                </div>
                              <div class="form-group">
                              <div class="d-flex">
                                 <div class="form-check form-switch ml-4"> <input class="form-check-input SubPercent" type="checkbox" role="switch" name="isMusic" id="isMusic17" hidden=""/></div>
                                 <div class="form-check form-switch ml-4"> <input class="form-check-input SubPercent" type="checkbox" role="switch" name="isFeed" id="isFeed18" hidden=""/></div>
                                 <div class="form-check form-switch ml-4"> <input class="form-check-input SubPercent" type="checkbox" role="switch" name="isAds" id="isAds19"  hidden=""/></div>
                                  </div>
                                  </div>
                                
                              
                              <button type="submit" class="btn btn-primary btn-update" value="Submit" name="update">Save changes</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--clone-->
         <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content" method="post">
                  <div class="modal-header">
                     <span>Clone Campaign</span>
                     <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×</span><span class="sr-only">Close</span>
                     </button>
                  </div>
                  <div class="modal-body modal-clone">
                     <div id="modalContent">
                        <form role="form" name="update" method="POST" id="clone">
                           <div class="form-group"><label for="CampaignID">CampaignID</label><textarea class="form-control" name="CampaignID" id="CampaignIDclone"  readonly="true"></textarea></div>
                           <div class="form-group"><label for="ChangeClipFrom">ChangeClipFrom</label><textarea class="form-control" name="ChangeClipFrom" id="ChangeClipFromclone"> </textarea></div>
                           <div class="form-group"><label for="ChangeClipTo">ChangeClipTo</label><textarea class="form-control" name="ChangeClipTo" id="ChangeClipToclone"> </textarea></div>
                           <div class="form-group"><label for="DurationFrom">DurationFrom</label><textarea class="form-control" name="DurationFrom" id="DurationFromclone"> </textarea></div>
                           <div class="form-group"><label for="DurationTo">DurationTo</label><textarea class="form-control" name="DurationTo" id="DurationToclone"> </textarea></div>
                           <div class="form-group"><label for="BiliBiliPool">BiliBiliPool</label><textarea class="form-control" name="BiliBiliPool" id="BiliBiliPoolclone"> </textarea></div>
                           <div class="form-group"><label for="SubFrom">SubFrom</label><textarea class="form-control" name="SubFrom" id="SubFromclone"> </textarea></div>
                           <div class="form-group"><label for="SubTo">SubTo</label><textarea class="form-control" name="SubTo" id="SubToclone"> </textarea></div>
                           <div class="form-group"><label for="YoutubePool">YoutubePool</label><textarea class="form-control" name="YoutubePool" id="YoutubePoolclone"> </textarea></div>
                          <div class="form-group"><label for="isChangeClip">isChangeClip</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isChangeClip" id="isChangeClipclone"/></div></div>
                              <div class="form-group"><label for="isSendMail">isSendMail</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isSendMail" id="isSendMailclone"/></div></div>
                              <div class="form-group"><label for="isSub">isSub</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isSub" id="isSubclone"/></div></div>
                              <div class="form-group"><label for="isViewBili">isViewBili</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isViewBili" id="isViewBiliclone"/></div></div>
                              <div class="form-group"><label for="isViewNews">isViewNews</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isViewNews" id="isViewNewsclone"/></div></div>
                              <div class="form-group"><label for="isViewYoutube">isViewYoutube</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isViewYoutube" id="isViewYoutubeclone"/></div></div>
                              <div class="form-group"><label for="isMobile">isMobile</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isMobile" id="isMobileclone"/></div></div>
                              <!--<div class="form-group"><label for="SubPercent">SubPercent</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="SubPercent" id="SubPercentclone"/></div></div>-->
                               <div class="form-group"><label for="SubPercent">SubPercent</label><br><div class="d-flex"><textarea name="SubPercent" id="SubPercentclone"class="form-control"  style="height: 25px;width:70px;"></textarea><label style="margin-left:10px;">%</label></div></div>
                              <div class="form-group">
                                      <label for="">Choose a is... Clone:</label>
                                        <select name="" id="isSelecttrurnClone"  class="form-select form-select-sm">
                                            <option value="0">Default</option>
                                            <option value="1">isMusic</option>
                                            <option value="2">isFeed</option>
                                            <option value="3">isAds</option>
                                        </select>
                                </div>
                              <div class="form-group">
                              <div class="d-flex">
                                  <div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isMusic" id="isMusicclone"  hidden=""/></div>
                                  <div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isFeed" id="isFeedclone" hidden /></div>
                                  <div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isAds" id="isAdsclone" hidden  /></div>
                                  </div>
                                  </div>
                                  
                           <button type="submit" class="btn btn-primary btn-clone" value="Submit" name="clone">Clone Now</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--dele-->
         <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                           <div class="form-group"><label for="CampaignID">Bạn có muốn xóa tệp này không</label><input type="text" class="form-control" name="CampaignID" id="CampaignIDxoa"></input></div>
                           <button type="submit" class="btn btn-primary btn-update" value="Submit" name="delete">Yup!</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal">Không xóa nữa</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--add-->
         <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <span>ADD Campaign</span>
                     <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×</span><span class="sr-only">Close</span>
                     </button>
                  </div>
                  <div class="modal-body modal-update">
                     <div id="modalContent">
                        <form role="form" name="update" method="POST" id="add">
                           <div class="form-group"><label for="CampaignID">CampaignID</label><textarea class="form-control" name="CampaignID" id="CampaignID0"></textarea></div>
                           <div class="form-group"><label for="ChangeClipFrom">ChangeClipFrom</label><textarea class="form-control" name="ChangeClipFrom" id="ChangeClipFrom1"> </textarea></div>
                           <div class="form-group"><label for="ChangeClipTo">ChangeClipTo</label><textarea class="form-control" name="ChangeClipTo" id="ChangeClipTo2"> </textarea></div>
                           <div class="form-group"><label for="DurationFrom">DurationFrom</label><textarea class="form-control" name="DurationFrom" id="DurationFrom3"> </textarea></div>
                           <div class="form-group"><label for="DurationTo">DurationTo</label><textarea class="form-control" name="DurationTo" id="DurationTo4"> </textarea></div>
                           <div class="form-group"><label for="BiliBiliPool">BiliBiliPool</label><textarea class="form-control" name="BiliBiliPool" id="BiliBiliPool5"> </textarea></div>
                           <div class="form-group"><label for="SubFrom">SubFrom</label><textarea class="form-control" name="SubFrom" id="SubFrom6"> </textarea></div>
                           <div class="form-group"><label for="SubTo">SubTo</label><textarea class="form-control" name="SubTo" id="SubTo7"> </textarea></div>
                           <div class="form-group"><label for="YoutubePool">YoutubePool</label><textarea class="form-control" name="YoutubePool" id="YoutubePool8"> </textarea></div>
                           <div class="form-group"><label for="isChangeClip">isChangeClip</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isChangeClip" id="isChangeClip9"/></div></div>
                              <div class="form-group"><label for="isSendMail">isSendMail</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isSendMail" id="isSendMail10"/></div></div>
                              <div class="form-group"><label for="isSub">isSub</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isSub" id="isSub11"/></div></div>
                              <div class="form-group"><label for="isViewBili">isViewBili</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isViewBili" id="isViewBili12"/></div></div>
                              <div class="form-group"><label for="isViewNews">isViewNews</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isViewNews" id=""/></div></div>
                              <div class="form-group"><label for="isViewYoutube">isViewYoutube</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isViewYoutube" id=""/></div></div>
                              <div class="form-group"><label for="isMobile">isMobile</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isMobile" id=""/></div></div>
                              <!--<div class="form-group"><label for="SubPercent">SubPercent</label><div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="SubPercent" id=""/></div></div>-->
                               <div class="form-group"><label for="SubPercent">SubPercent</label><br><div class="d-flex"><textarea name="SubPercent" id="SubPercentadd"class="form-control"  style="height: 25px;width:70px;"></textarea><label style="margin-left:10px;">%</label></div></div>
                               <div class="form-group">
                                      <label for="">Choose a is... Add:</label>
                                        <select name="" id="isSelecttrurnAdd" class="form-select form-select-sm">
                                            <option value="0">Default</option>
                                            <option value="1">isMusic</option>
                                            <option value="2">isFeed</option>
                                            <option value="3">isAds</option>
                                        </select>
                                </div> 
                                <div class="form-group"><div class="d-flex">
                                  <div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isMusic" id="isMusicadd" hidden=""/></div>
                                 <div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isFeed" id="isFeedadd" hidden=""/></div>
                              <div class="form-check form-switch ml-4"><input class="form-check-input SubPercent" type="checkbox" role="switch" name="isAds" id="isAdsadd" hidden=""/></div>
                              </div></div>
                           <button type="submit" class="btn btn-primary btn-add" value="Submit" name="add">Add Campaign</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--<script src="js/demo/datatables-demo.js"></script>-->
      <script src="js/scripts.js"></script>
      <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->
      <!-- Bootstrap core JavaScript-->
      <!--<script src="vendor/jquery/jquery.min.js"></script>-->
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      
      <script>
         var $table = $('#table')
         
         $(function() {
           $('#toolbar').find('select').change(function () {
             $table.bootstrapTable('destroy').bootstrapTable({
               exportDataType: $(this).val(),
               exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
               columns: []
             })
           }).trigger('change')
         })
      </script>
      <style>
         .hide {
         display: none;
         }
      </style>
   </div>
</div>
</div>
</div>
<style>
   table {
   table-layout: fixed;
   width: 100%;
   white-space: nowrap;
   overflow: hidden;  
   }
   table th {
   white-space: nowrap;
   overflow: hidden;
   }
   table td {
   white-space: nowrap;
   overflow: hidden;
   text-overflow: ellipsis;
   }
</style>