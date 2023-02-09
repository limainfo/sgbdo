<script type="text/javascript">
//<![CDATA[

function envia() {

	
  var dados = $("#habilitacoesform").serialize();
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/<cfoutput>#controllernome#</cfoutput>controller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#listagem").html(data);
      $("#spinner").css({'display':'none'});
      $( "#manipulacao" ).dialog( "close" );
    },
    error: function() {},
    data: dados ,
    datatype: 'text',
    contentType: 'application/x-www-form-urlencoded'
  });
 }
 
	/* jQuery */
jQuery(document).ready(function($) {

	 $( ".Datepicker" ).datepicker();
	 $( ".Datepicker" ).datepicker( $.datepicker.regional[ "pt-BR" ] ); 
	 $( ".Datepicker" ).datepicker("option","dateFormat","yy-mm-dd"); 
	 $( ".Datepicker" ).datepicker({
		 showButtonPanel: true,
		 buttonImage: "../images/calendario.png",
		 buttonImageOnly: true
		}); 
  });	

 

//]]>
</script>
