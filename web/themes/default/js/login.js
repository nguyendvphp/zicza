$(document).ready(function(){
    $("#dialoglogin").dialog({
		autoOpen:false,
		maxHeight:700,
		width:300,
		height:200,
		modal: true, 
		resizable: false
		
   });

 });
function openDialogLogin(){
	$("#dialoglogin").dialog("open");
}
function submitLogin(){
    var user = $("#txtuser").val();
    var pass = $("#txtpass").val();
    if(user == '' || pass == ''){
        $.alerts.dialogClass = $(this).attr('id'); // set custom style class
        jAlert(PASSWORD_NULL, WARNING, function () {
            $.alerts.dialogClass = null; // reset to default
        });
    }else{
        var loadUrl = WEB_HOST_PATH+"/index.php?r=Site/loginhome";
            var data = {'username':user,'password':pass};
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
                             location.reload(WEB_HOST_PATH+"/index.php?r=Site/index");
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