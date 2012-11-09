$(document).ready(function()
{	
    $("#change_password").dialog({
		autoOpen:false,
		maxHeight:1000,
		width:230,
		height:200,
		modal: true, 
		resizable: false,
	});
    
});

function openDialogUser(){
	$("#change_password").dialog("open");
}
function ChangePassword(user_id){
    var new_pass = $("#newpass").val();
    var re_new_pass = $("#renewpass").val();
    if(new_pass == '' || re_new_pass == ''){
        $.alerts.dialogClass = $(this).attr('id'); // set custom style class
        jAlert(PASSWORD_NULL, WARNING, function () {
            $.alerts.dialogClass = null; // reset to default
        });
    }else{
        if(new_pass != re_new_pass){
            $.alerts.dialogClass = $(this).attr('id'); // set custom style class
            jAlert(PASSWORD_CHECK, WARNING, function () {
                $.alerts.dialogClass = null; // reset to default
            });
        }else{
            var loadUrl = ADM_HOST_PATH+"/index.php?r=aSystemUser/changepassword";
            var data = {'user_id':user_id,'password':new_pass};
                $.ajax({
                    url: loadUrl,
                    dataType: 'json',
                    type: 'POST',
                    data : data,
                    success:function(json){
                        if(json.status = true){
                            $.alerts.dialogClass = $(this).attr('id');
                            jAlert(json.msg, WARNING, function () {
                                $.alerts.dialogClass = null;
                            });
                             location.reload();
                        }else{
                            $.alerts.dialogClass = $(this).attr('id');
                            jAlert(json.msg, WARNING, function () {
                                $.alerts.dialogClass = null;
                            });
                        }
                        
        			}
                });    
        }
    }
        
}
