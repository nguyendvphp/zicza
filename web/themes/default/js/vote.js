$(document).ready(function()
{	
	$("#dialogPost").dialog({
		autoOpen:false,
		maxHeight:700,
		width:400,
		height:220,
		modal: true, 
		resizable: false,
		buttons: {
		'Đóng lại':function(){$(this).dialog("close");},
		'Bình luận':function(){
			jConfirm(
					'Bạn có muốn lưu loại tài nguyên này không ?',
					'Xác thực',
					function(r){
						if(r==true){
							save();
						}
					});
		}
	}});
 });
function save(){
    var csrf = $('#csrf').val();
    var loadUrl = WEB_HOST_PATH+"/index.php?r=wUserItem/vote";
        var data = {'gameid':id,'YII_CSRF_TOKEN':csrf};
        $.ajax({
            url: loadUrl,
            dataType: 'json',
            type: 'POST',
            data : data,
            success:function(json){
                alert(json.msg);
                if(json.status == true){
                    $("#like_data"+id).html("");
                    $("#like_data"+id).html(json.total_like);
                }else{
                    
                }
                
			}
        });
}
function openDialog(){
	$("#dialogPost").dialog("open");
} 