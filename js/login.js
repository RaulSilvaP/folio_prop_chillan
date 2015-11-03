$(document).ready(function(){
	$("#add_err").css('display', 'none', 'important');
	$("#add_war").css('display', 'none', 'important');
	 $("#login").click(function(){	
		  username=$("#usuario").val();
		  password=$("#password").val();
		  $.ajax({
		   type: "POST",
		   url: "login.php",
			data: "usuario="+username+"&password="+password,
		   success: function(html){    
			if(html=='true')    {
			 setTimeout("window.location='principal.php';",1500);
			}
			else    {
			setTimeout("$('#add_err').css('display', 'inline', 'important');",2000);
			setTimeout("$('#add_war').css('display', 'none', 'important');",2000);
			$("#add_err").html("<span class='glyphicon glyphicon-remove'> </span>  Login incorrecto...");
			}
		   },
		   beforeSend: function()
		   {
			$("#add_err").css('display', 'none', 'important');
			$("#add_war").css('display', 'inline', 'important');
			$("#add_war").html("<img src='images/loader.gif' alt='' /> Verificando contraseña...");
		   }
		  });
		return false;
	});
});