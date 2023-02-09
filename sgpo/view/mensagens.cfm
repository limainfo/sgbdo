<cfparam name="status" default="">
	<div class="mensagens"  style="margin:0px;padding:0px;">
<cfscript>
	switch (status){
	case 'OK':	WriteOutput("<div class='message info' id='sucesso'><p>" & mensagemstatus & "</p><span title='Dismiss' class='close' onclick=""$('.mensagens').hide('slow');""></span></div>");break;
	case 'ERRO':	WriteOutput("<div class='message errormsg' id='erro' ><p>" & mensagemstatus & "</p><span title='Dismiss' class='close' onclick=""$('.mensagens').hide('slow');""></span></div>");break;
	case 'WARNING':	WriteOutput("<div class='message warning' id='warning' ><p>" & mensagemstatus & "</p><span title='Dismiss' class='close' onclick=""$('.mensagens').hide('slow');""></span></div>");break;
		
	}
</cfscript>	
<script>
	$( "#manipulacao" ).dialog( "close" );
</script>
</div>
