// $('#dataTable th').click(function() {
//   var columnIndex = $(this).index();
//   $('#dataTable tbody tr').each(function() {
//     $(this).find('td').eq(columnIndex).toggleClass('hide');
//   });
//   $('#dataTable thead th').eq(columnIndex).toggleClass('hide');
//   })
// var table = $('#dataTable1').DataTable();
// // $(".btn.btn-primary.update").on('click', function() {
//     $row = $(this).closest("tr");
//     td=table.row($row).data();
// td.forEach(e => console.log(e));

// });
//lấy dữ liệu từ hàng table sang modal
$("#huda").on('change', 'input.form-check-input.isMusic', function() {
     $row = $(this).closest("tr");
    if($row.find('td div input.form-check-input.isMusic').prop("checked")==true){
        $row.find('td div input.form-check-input.isFeed').attr('checked',false);
         $row.find('td div input.form-check-input.isAds').attr('checked',false);
    }else if($row.find('td div input.form-check-input.isFeed').prop("checked")==true){
          $row.find('td div input.form-check-input.isMusic').attr('checked',false);
         $row.find('td div input.form-check-input.isAds').attr('checked',false);
    }else if($row.find('td div input.form-check-input.isAds').prop("checked")==true){
          $row.find('td div input.form-check-input.isMusic').attr('checked',false);
         $row.find('td div input.form-check-input.isFeed').attr('checked',false);
    }
})
$("#huda").on('click', '.btn.btn-primary.update', function() {
    $row = $(this).closest("tr");
    td = $row.find('td');
    
    $('#CampaignID0').text(td[0].innerHTML);
    $('#ChangeClipFrom1').text(td[1].innerHTML);
    $('#ChangeClipTo2').text(td[2].innerHTML);
    $('#DurationFrom3').text(td[3].innerHTML);
    $('#DurationTo4').text(td[4].innerHTML);
    $('#BiliBiliPool5').text(td[5].innerHTML);
    $('#SubFrom6').text(td[6].innerHTML);
    $('#SubTo7').text(td[7].innerHTML);
    $('#YoutubePool8').text(td[8].innerHTML);
    tdchange = $row.find('td div input.isChangeClip').is(":checked");$('#isChangeClip9').attr('checked',tdchange);
    tdsend = $row.find('td div input.isSendMail').is(":checked");$('#isSendMail10').attr('checked',tdsend);
    tdsub = $row.find('td div input.isSub').is(":checked");$('#isSub11').attr('checked',tdsub);
    tdviewbili = $row.find('td div input.isViewBili').is(":checked");$('#isViewBili12').attr('checked',tdviewbili);
    tdviewnew = $row.find('td div input.isViewNews').is(":checked");$('#isViewNews13').attr('checked',tdviewnew);
    tdisViewYoutube = $row.find('td div input.isViewYoutube').is(":checked");$('#isViewYoutube14').attr('checked',tdisViewYoutube);
    tdisMobile = $row.find('td div input.isMobile').is(":checked");$('#isMobile15').attr('checked',tdisMobile);
    // tdSubPercent = $row.find('td div input.SubPercent').text();$('#SubPercent16').text(tdSubPercent);
     $('#SubPercent16').text(td[16].innerHTML);
    tdisMusic = $row.find('td div input.isMusic').is(":checked");$('#isMusic17').attr('checked',tdisMusic);
    tdisFeed = $row.find('td div input.isFeed').is(":checked");$('#isFeed18').attr('checked',tdisFeed);
    tdisAds = $row.find('td div input.isAds').is(":checked");$('#isAds19').attr('checked',tdisAds);
//      $('#isMusic17').on('change',function(){
//          if($('#isMusic17').prop("checked")==true){
//         return $('#isFeed18').attr('checked',false);
//     }else{
//          return $('#isFeed18').attr('checked',true);
//     }
// });
 if ($('input#isMusic17').is(':checked') == true) {
        return $('#isSelecttrurn option[value=1]').prop('selected', true);
    }
    if ($('input#isFeed18').is(':checked') == true) {
        return $('#isSelecttrurn option[value=2]').prop('selected', true);
    }
    if ($('input#isAds19').is(':checked') == true) {
        return $('#isSelecttrurn option[value=3]').prop('selected', true);
    }
    if ($('input#isMusic17').is(':checked') == false&&$('input#isFeed18').is(':checked') == false&&$('input#isAds19').is(':checked') == false) {
        return $('#isSelecttrurn option[value=0]').prop('selected', true);
    }
    
});

$("#huda").on('click', '.btn.btn-primary.update', function() {
   
    
    $('div select#isSelecttrurn').on('change', function() {
        if ($('#isSelecttrurn option:selected').val() == 0) {
            $('#isMusic17').attr('checked', false);
            $('#isFeed18').attr('checked', false);
            $('#isAds19').attr('checked', false);
        } else if ($('#isSelecttrurn option:selected').val() == 1) {
            $('#isMusic17').attr('checked', true);
            $('#isFeed18').attr('checked', false);
            $('#isAds19').attr('checked', false);
        } else if ($('#isSelecttrurn option:selected').val() == 2) {
            $('#isMusic17').attr('checked', false);
            $('#isFeed18').attr('checked', true);
            $('#isAds19').attr('checked', false);
        } else {
            $('#isMusic17').attr('checked', false);
            $('#isFeed18').attr('checked', false);
            $('#isAds19').attr('checked', true);
        }
    });



})
$("#huda").on('click', '.btn.btn-primary.clone', function() {
      $row = $(this).closest("tr");
    td = $row.find('td');

    $('#CampaignIDclone').text(td[0].innerHTML);;
    $('#ChangeClipFromclone').text(td[1].innerHTML);
    $('#ChangeClipToclone').text(td[2].innerHTML);
    $('#DurationFromclone').text(td[3].innerHTML);
    $('#DurationToclone').text(td[4].innerHTML);
    $('#BiliBiliPoolclone').text(td[5].innerHTML);
    $('#SubFromclone').text(td[6].innerHTML);
    $('#SubToclone').text(td[7].innerHTML);
    $('#YoutubePoolclone').text(td[8].innerHTML);
    // $('#isChangeClipclone').text(td[9].innerHTML);
    // $('#isSendMailclone').text(td[10].innerHTML);
    // $('#isSubclone').text(td[11].innerHTML);
    // $('#isViewBiliclone').text(td[12].innerHTML);
    // $('#isViewNewsclone').text(td[13].innerHTML);
    // $('#isViewYoutubeclone').text(td[14].innerHTML);
    // $('#isMobileclone').text(td[15].innerHTML);
    // $('#SubPercentclone').text(td[16].innerHTML);
    // $('#isMusicclone').text(td[17].innerHTML);
    // $('#isFeedclone').text(td[18].innerHTML);
    tdchange = $row.find('td div input.isChangeClip').is(":checked");$('#isChangeClipclone').attr('checked',tdchange);
    tdsend = $row.find('td div input.isSendMail').is(":checked");$('#isSendMailclone').attr('checked',tdsend);
    tdsub = $row.find('td div input.isSub').is(":checked");$('#isSubclone').attr('checked',tdsub);
    tdviewbili = $row.find('td div input.isViewBili').is(":checked");$('#isViewBiliclone').attr('checked',tdviewbili);
    tdviewnew = $row.find('td div input.isViewNews').is(":checked");$('#isViewNewsclone').attr('checked',tdviewnew);
    tdisViewYoutube = $row.find('td div input.isViewYoutube').is(":checked");$('#isViewYoutubeclone').attr('checked',tdisViewYoutube);
    tdisMobile = $row.find('td div input.isMobile').is(":checked");$('#isMobileclone').attr('checked',tdisMobile);
    // tdSubPercent = $row.find('td div input.SubPercent').is(":checked");$('#SubPercentclone').attr('checked',tdSubPercent);
     $('#SubPercentclone').text(td[16].innerHTML);
    tdisMusic = $row.find('td div input.isMusic').is(":checked");$('#isMusicclone').attr('checked',tdisMusic);
    tdisFeed = $row.find('td div input.isFeed').is(":checked");$('#isFeedclone').attr('checked',tdisFeed);
    tdisAds = $row.find('td div input.isAds').is(":checked");$('#isAdsclone').attr('checked',tdisFeed);
        //         $('#isMusicclone').on('change',function(){
        //          if($('#isMusicclone').prop("checked")==true){
        //         return $('#isFeedclone').attr('checked',false);
        //     }else{
        //          return $('#isFeedclone').attr('checked',true);
        //     }
        // });

 if ($('input#isMusicclone').is(':checked') == true) {
        return $('#isSelecttrurnClone option[value=1]').prop('selected', true);
    }
    if ($('input#isFeedclone').is(':checked') == true) {
        return $('#isSelecttrurnClone option[value=2]').prop('selected', true);
    }
    if ($('input#isAdsclone').is(':checked') == true) {
        return $('#isSelecttrurnClone option[value=3]').prop('selected', true);
    }
     if ($('input#isMusicclone').is(':checked') == false&&$('input#isFeedclone').is(':checked') == false&&$('input#isAdsclone').is(':checked') == false) {
        return $('#isSelecttrurn option[value=0]').prop('selected', true);
    }
});
$("#huda").on('click', '.btn.btn-primary.update', function() {
$('#SubPercent16').on('mousemove', function() {
    if ($(this).val() < 0) {
       $(this).css("color","red");
       $('.btn.btn-primary.btn-update').attr("disabled","");
    }
    if ($(this).val() > 100) {
        $(this).css("color","red");
        $('.btn.btn-primary.btn-update').attr("disabled","");
    }
    if($(this).val() >= 0 && $(this).val() <= 100){
         $(this).css("color","");
        $('.btn.btn-primary.btn-update').removeAttr("disabled","");
        
    }
})
});
$("#huda").on('click', '.btn.btn-primary.clone', function() {
$('#SubPercentclone').on('mousemove', function() {
    if ($(this).val() < 0) {
         $(this).css("color","red");
       $('.btn.btn-primary.btn-clone').attr("disabled","");
    }
    if ($(this).val() > 100) {
       $(this).css("color","red");
        $('.btn.btn-primary.btn-clone').attr("disabled","");
    }
    if($(this).val() >= 0 && $(this).val() <= 100){
        $('.btn.btn-primary.btn-clone').removeAttr("disabled","");
         $(this).css("color","");
    }
})
});
$("#huda").on('click', '.btn.btn-primary.update', function() {
    $('.btn.btn-primary.btn-update').on('hover',function(){
        if($('#SubPercent16').val < 0) {
         $('#SubPercent16').css("color","red");
            $(this).attr("disabled","");
        }
         if ($('#SubPercent16').val >100) {
         $('#SubPercent16').css("color","red");
            $(this).attr("disabled","");
        }
        if($('#SubPercent16').val() >= 0 && $('#SubPercent16').val() <= 100){
        $(this).removeAttr("disabled","");
         $('#SubPercent16').css("color","");
    }
    })
});
$("#huda").on('click', '.btn.btn-primary.clone', function() {
    $('.btn.btn-primary.btn-clone').on('hover',function(){
       if ( $('#SubPercentclone').val< 0) {
         $('#SubPercentclone').css("color","red");
            $(this).attr("disabled","");
        }
       if   ($('#SubPercent16').val >100) {
         $('SubPercentclone').css("color","red");
            $(this).attr("disabled","");
        }
        if($('#SubPercentclone').val() >= 0 && $('#SubPercentclone').val() <= 100){
        $(this).removeAttr("disabled","");
         $('#SubPercentclone').css("color","");
    }
    });
});
$("#huda").on('click', '.btn.btn-primary.update', function() {
   
    
    $('div select#isSelecttrurnClone').on('change', function() {
        if ($('#isSelecttrurnClone option:selected').val() == 0) {
            $('#isMusicclone').attr('checked', false);
            $('#isFeedclone').attr('checked', false);
            $('#isAdsclone').attr('checked', false);
        } else if ($('#isSelecttrurnClone option:selected').val() == 1) {
            $('#isMusicclone').attr('checked', true);
             $('#isFeedclone').attr('checked', false);
           $('#isAdsclone').attr('checked', false);
        } else if ($('#isSelecttrurnClone option:selected').val() == 2) {
           $('#isMusicclone').attr('checked', false);
             $('#isFeedclone').attr('checked', true);
             $('#isAdsclone').attr('checked', false);
        } else {
            $('#isMusicclone').attr('checked', false);
            $('#isFeedclone').attr('checked', false);
             $('#isAdsclone').attr('checked', true);
        }
    });
});
$("#huda").on('click', '.btn.btn-danger', function() {
    $row = $(this).closest("tr");
    td = table.row($row).data();
    $('#CampaignIDxoa').attr("value", td[0]);
})
// table=$("#table").data()
// $('#bodyDash').on('change','input[name=btSelectItem]',function () {
//   $row = $(this).closest("tr");
//     td = table.row($row).data(); 
// })
$('button.btn.btn-outline-primary.float-right').on('click',function(){
    $('div select#isSelecttrurnAdd').on('change', function() {
        if ($('#isSelecttrurnAdd option:selected').val() == 0) {
            $('#isMusicadd').attr('checked', false);
            $('#isFeedadd').attr('checked', false);
            $('#isAdsadd').attr('checked', false);
        } else if ($('#isSelecttrurnAdd option:selected').val() == 1) {
            $('#isMusicadd').attr('checked', true);
             $('#isFeedadd').attr('checked', false);
           $('#isAdsadd').attr('checked', false);
        } else if ($('#isSelecttrurnAdd option:selected').val() == 2) {
           $('#isMusicadd').attr('checked', false);
             $('#isFeedadd').attr('checked', true);
             $('#isAdsadd').attr('checked', false);
        } else {
            $('#isMusicadd').attr('checked', false);
            $('#isFeedadd').attr('checked', false);
             $('#isAdsadd').attr('checked', true);
        }
    });
   
});
$('button.btn.btn-outline-primary.float-right').on('click',function(){
    $('#SubPercentadd').on('mousemove', function() {
    if ($(this).val() < 0) {
         $(this).css("color","red");
       $('.btn.btn-primary.btn-add').attr("disabled","");
    }
    if ($(this).val() > 100) {
       $(this).css("color","red");
        $('.btn.btn-primary.btn-add').attr("disabled","");
    }
    if($(this).val() >= 0 && $(this).val() <= 100){
        $('.btn.btn-primary.btn-add').removeAttr("disabled","");
         $(this).css("color","");
    }
})
});
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