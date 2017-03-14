	
	$(function(){
		var profile_init_password_val = $("#hidden_pass").val();		
		$("#profile_password").keyup(function(){
			var me = $(this);			
			
			if(me.val()){
				$("#hidden_pass").val(me.val());
				$("#hidden_pass_status").val('changed');
			}else{
				$("#hidden_pass").val(profile_init_password_val);
				$("#hidden_pass_status").val('unchanged');
			}			
		});
	});