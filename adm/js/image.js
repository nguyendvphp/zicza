function delete_image(id,file_name,ext){
    loadUrl = ADM_HOST_PATH+"/index.php?r=aGamesImage/delete";
    var data = {'id':id,'file_name':file_name,'ext':ext};
    $.ajax({
            url: loadUrl,
            dataType: 'json',
            type: 'POST',
            data : data,
            success:function(json){
                $.alerts.dialogClass = $(this).attr('id'); // set custom style class
                jAlert(json.msg, WARNING, function () {
                    $.alerts.dialogClass = null; // reset to default
                });
                if(json.status == true){
                    $("#list_image").html("");
                    $(".delete_image").html("");
                    
                }else{
                }
			}
        });
}

function delete_screenshot(id,file_name,ext){
    loadUrl = ADM_HOST_PATH+"/index.php?r=aGamesImage/deletescreenshot";
    var data = {'id':id,'file_name':file_name,'ext':ext};
    $.ajax({
            url: loadUrl,
            dataType: 'json',
            type: 'POST',
            data : data,
            success:function(json){
                $.alerts.dialogClass = $(this).attr('id'); // set custom style class
                jAlert(json.msg, WARNING, function () {
                    $.alerts.dialogClass = null; // reset to default
                });
                if(json.status == true){
                    $("#shot"+id).html("");
                }else{
                }
			}
        });
}

function delete_video(id,file_name){
    loadUrl = ADM_HOST_PATH+"/index.php?r=aGamesImage/deleteVideo";
    var data = {'id':id,'file_name':file_name};
    $.ajax({
            url: loadUrl,
            dataType: 'json',
            type: 'POST',
            data : data,
            success:function(json){
                $.alerts.dialogClass = $(this).attr('id'); // set custom style class
                jAlert(json.msg, WARNING, function () {
                    $.alerts.dialogClass = null; // reset to default
                });
                if(json.status == true){
                    $("#video"+id).html("");
                }else{
                }
			}
        });
}

function delete_file(id,file_name){
    loadUrl = ADM_HOST_PATH+"/index.php?r=aGamesImage/deleteFile";
    var data = {'id':id,'file_name':file_name};
    $.ajax({
            url: loadUrl,
            dataType: 'json',
            type: 'POST',
            data : data,
            success:function(json){
                $.alerts.dialogClass = $(this).attr('id'); // set custom style class
                jAlert(json.msg, WARNING, function () {
                    $.alerts.dialogClass = null; // reset to default
                });
                if(json.status == true){
                    $("#file"+id).html("");
                }else{
                }
			}
        });
}