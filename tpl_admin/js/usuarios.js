$(function(){
	$("#email").change(function(){
		$.ajax({
			method: "POST",
		    url: "/admin/comprobar-email/",
		    data: { email: $(this).val(), type: $("#user_type").val() },
		    dataType: "html",
			success: function(existe){
				if(existe){
					if($("#email_rep").length){$("#email_rep").remove();}
					$("#email").after('<ul id="email_rep" class="parsley-error-list" style="display: block;"><li class="required" style="display: list-item;">'+$("#email").val()+' ya existe en base de datos.</li></ul>');
					$("#email").val('');
				}else{
					$("#email_rep").remove();
				}
			}
		});
	});
});