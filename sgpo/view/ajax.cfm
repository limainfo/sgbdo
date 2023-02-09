<script language="javascript">
$.fx.speeds._default = 1000;
	$(function() {
		$( "#manipulacao" ).dialog({autoOpen: false,modal: true, widht: window.innerWidth * 7/10, show: 'highlight',hide: 'fade'
});
	});	

function edita(id) {
	$( "#manipulacao" ).dialog({
		autoOpen: false,
		position: { my: "center", at: "center", of: window },
		title:'Alterar <cfoutput>#controllernome#</cfoutput>',
		height: window.innerHeight * 10/10,
		width: window.innerWidth * 6/10,
		modal: true,
		buttons: {},
		close: function() {}
	}); 
  var parametros = {'controller':'<cfoutput>#controllernomeplural#</cfoutput>','action':'veredit', 'id':id, 'pagina': '<cfoutput>#url.pagina#</cfoutput>' };
  var dados = parametros;
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/<cfoutput>#controllernome#</cfoutput>controller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#manipulacao").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
      $( "#manipulacao" ).dialog( "open" );

    },
    error: function() {},
    data: dados ,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
 }
 
function cad() {
	$( "#manipulacao" ).dialog({
		autoOpen: false,
		title:'Cadastrar <cfoutput>#controllernome#</cfoutput>',
		position: { my: "center", at: "center", of: window },
		height: window.innerHeight * 10/10,
		width: window.innerWidth * 6/10,
		buttons: {},
		modal: true,
		close: function() {
		}
	}); 
  var parametros = {'controller':'<cfoutput>#controllernomeplural#</cfoutput>','action':'vercad', 'pagina':'<cfoutput>#url.pagina#</cfoutput>'};
  var dados = parametros;
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/<cfoutput>#controllernome#</cfoutput>controller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#manipulacao").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
      $( "#manipulacao" ).dialog( "open" );

    },
    error: function() {},
    data: dados ,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
 }
 
 
function exclui(id, nome) {
		var parametros = {'controller':'<cfoutput>#controllernomeplural#</cfoutput>','action':'exclui', 'id':id, 'pagina': '<cfoutput>#url.pagina#</cfoutput>', 'nome':nome  };
		var dados = parametros;
	
		$( "#manipulacao" ).dialog({title:'Excluir <cfoutput>#controllernome#</cfoutput>'});
		$( "#manipulacao" ).html('Tem certeza que deseja excluir o <cfoutput>#controllernome#</cfoutput> ->'+nome+' ?');
		$( "#manipulacao" ).dialog({
			resizable: false,
			widht: window.innerWidth * 3/10,
			position: { my: "center", at: "center", of: window },
			height:200,
			modal: true,
			buttons: {
				"Excluir": function() {
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

						},
						error: function() {},
						data: dados ,
						datatype: 'html',
						contentType: 'application/x-www-form-urlencoded'
					  });
					
					$( this ).dialog( "close" );
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			}
		});
      $( "#manipulacao" ).dialog( "open" );
  
  
 }
 
 function assinagerente(id, nome, processo) {
		var parametros = {'controller':'<cfoutput>#controllernomeplural#</cfoutput>','action':'assinagerente', 'id':id, 'pagina': '<cfoutput>#url.pagina#</cfoutput>', 'nome':nome  };
		var dados = parametros;
	
		$( "#manipulacao" ).dialog({title:'Assinar o processo de número:'+processo});
		$( "#manipulacao" ).html('O processo do estagiário '+nome+' já foi conferido e está OK ? Se precisar, confira abaixo:<br><br><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=processocompleto&pesquisa='+processo+'" title="PDF do Processo"><img src="images/pdf.png" alt="Editar"></a>');
		$( "#manipulacao" ).dialog({
			resizable: false,
			widht: window.innerWidth * 3/10,
			position: { my: "center", at: "center", of: window },
			height:400,
			modal: true,
			buttons: {
				"Assinar": function() {
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

						},
						error: function() {},
						data: dados ,
						datatype: 'html',
						contentType: 'application/x-www-form-urlencoded'
					  });
					
					$( this ).dialog( "close" );
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			}
		});
      $( "#manipulacao" ).dialog( "open" );
  
  
 }


function ver(id, nome) {
		  var parametros = {'controller':'<cfoutput>#controllernomeplural#</cfoutput>','action':'ver', 'id':id, 'pagina': '<cfoutput>#url.pagina#</cfoutput>' };
		  var dados = parametros;
	
		$( "#manipulacao" ).dialog({
			autoOpen: false,
			title:'Visualizar dados do <cfoutput>#controllernome#</cfoutput>',
			resizable: true,
			modal: true,
			position: { my: "center", at: "center", of: window },
			height: window.innerHeight * 10/10,
			width: window.innerWidth * 6/10,
			buttons: {
				"OK": function() {
					$( this ).dialog( "close" );
				}
			}
		});
	  $.ajax({
		type: 'POST',
		 processData: true,
		url: 'controller/<cfoutput>#controllernome#</cfoutput>controller.cfm',
		beforeSend: function(){
		  $("#spinner").css({'display':'block'});
		},
		success: function(data) {
		  $("#manipulacao").html(data);
		  $("#spinner").css({'display':'none'});
		  $( "#manipulacao" ).dialog( "open" );

		},
		error: function() {},
		data: dados ,
		datatype: 'html',
		contentType: 'application/x-www-form-urlencoded'
	  });
		
  
  
 }


function buscar(nome) {
		  var parametros = {'controller':'<cfoutput>#controllernomeplural#</cfoutput>','action':'busca', 'pagina': '<cfoutput>#url.pagina#</cfoutput>', 'busca':nome };
		  var dados = parametros;
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

		},
		error: function() {},
		data: dados ,
		datatype: 'html',
		contentType: 'application/x-www-form-urlencoded'
	  });
 }
 
 function designa(id) {
	$( "#manipulacao" ).dialog({
		autoOpen: false,
		title:'RN003 -> Gerente-> Designar estagiário',
		position: { my: "center", at: "center", of: window },
		height: window.innerHeight * 10/10,
		width: window.innerWidth * 6/10,
		buttons: {},
		modal: true,
		close: function() {
		}
	}); 
  var parametros = {'controller':'<cfoutput>#controllernomeplural#</cfoutput>','action':'vercaddesigna', 'id':id, 'pagina':'<cfoutput>#url.pagina#</cfoutput>'};
  var dados = parametros;
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/<cfoutput>#controllernome#</cfoutput>controller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#manipulacao").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
      $( "#manipulacao" ).dialog( "open" );

    },
    error: function() {},
    data: dados ,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
 }

function designarestagiario() {
	$( "#manipulacao" ).dialog({
		autoOpen: false,
		title:'Designar',
		position: { my: "center", at: "center", of: window },
		height: window.innerHeight * 10/10,
		width: window.innerWidth * 6/10,
		buttons: {},
		modal: true,
		close: function() {
		}
	}); 
  var parametros = {'controller':'estagiarios','action':'vercad', 'pagina':'<cfoutput>#url.pagina#</cfoutput>'};
  var dados = parametros;
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/estagiariocontroller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#manipulacao").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
      $( "#manipulacao" ).dialog( "open" );

    },
    error: function() {},
    data: dados ,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
 }
	

function avaliaficha(id) {
	$( "#manipulacao" ).dialog({
		autoOpen: false,
		title:'Avaliar Estagiário',
		position: { my: "center", at: "center", of: window },
		height: window.innerHeight * 10/10,
		width: window.innerWidth * 6/10,
		buttons: {},
		modal: true,
		close: function() {
		}
	}); 
  var parametros = {'controller':'fichas','action':'avaliaficha', 'id':id, 'pagina':'<cfoutput>#url.pagina#</cfoutput>'};
  var dados = parametros;
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/fichacontroller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#manipulacao").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
      $( "#manipulacao" ).dialog( "open" );

    },
    error: function() {},
    data: dados ,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
 }
	

</script>

