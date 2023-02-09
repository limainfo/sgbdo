
<?php




//print_r($turnos);
//echo $turnos[1]['Supervisorturno']['status'];

//echo $u[0]['Usuario']['militar_id'];
$militar_id = $u[0]['Usuario']['militar_id'];


	$privilegio=='EXECUTANTE';
	$acesso = 1;
	$aberta = 1;
	$cumprindoescala[0]['Escala']['livro']='ACCAZ';

?><?php
$cumprindoescala[0]['Escala']['livro']='ACCAZ';
if(1){
	//style="display:none;"
	?>
	
<script type="text/javascript">
function cienteNegativo(){
	v2 = $('DespachoRegionalCienteGerenteRegional').checked;
	v1 = $('DespachoLocalCienteGerenteLocal').checked;
	if(v1==false){
    	$('formDespachoLocal').reset();
  		$('despachoslocalform').hide();
	}
	if(v2==false){
    	$('formDespachoRegional').reset();
  		$('despachosregionalform').hide();
	}
}
function atualizaDestinatario() {
	var form = $('ldapForm');
	check = form.getInputs('checkbox');
	conteudo = '';
	i = 0;
	check.each(function(e){
		if(e.checked){
			if(i==0){
					conteudo = e.value; 
					i++;
			}else{
					conteudo = conteudo +' , '+e.value;
					
			}
		}
	
	});
	$('DespachoRegionalDestinatarios').value = conteudo;
	$('DespachoLocalDestinatarios').value = conteudo;
	$('mensagem').hide(); 

}
function setCheckedValue(formulario, valor) {
	var form = $(formulario);
	radios = form.getInputs('radio');
	radios.each(function(e){
	if(e.value==valor){
		e.checked = true; 
		}else{
		e.checked = false;
		}
	});

}

function esconde(){
    $('chefeequipe').hide();
    $('supervisorRegional').hide();
    $('supervisorgeral').hide();
    $('controladores').hide();
    $('supervisorRegionalMU').hide();
    $('supervisorRegionalBL').hide();
    $('supervisorRegionalPH').hide();
    $('controladoresMU').hide();
    $('controladoresBL').hide();
    $('controladoresPH').hide();
    
    for(i=0;i<100;i++){
	if(i<10){
	  nome = 'tabela00'+i;
	  d1 = 'despachosregional00'+i;
	  d2 = 'despachoregional00'+i;
	}else{
	  nome = 'tabela0'+i;
	  d1 = 'despachosregional0'+i;
	  d2 = 'despachoregional0'+i;
	}
    	if($(d1)!=null){
    		$(d1).hide();
		}    	
    	if($(d2)!=null){
    		$(d2).hide();
		}    	
    	if($(nome)!=null){
    		$(nome).hide();
    	}
    }
    $('despachoslocal').hide();
    $('despachosregional').hide();
 	$('mensagem').hide();
  	$('mensagem').hide();
}

function despacholocal(tabelaid, id, conteudo, dataDespacho){
    $('formDespachoLocal').reset();
    $('despachoslocalform').hide();
	$('DespachoLocalMotivo').value = decodeURIComponent(conteudo);
	$('DespachoLocalDataDespacho').value = dataDespacho;
	$('DespachoLocalId').value = id;
	$('DespachoLocalSupervisorturnoId').value = <?php echo $supervisorturnoid;  ?>;
	$('DespachoLocalTabelaid').value = tabelaid;
	//esconde();
    
    ShowContent('despachoslocal');
}

function despachoregional(tabelaid, id, conteudo, dataDespacho){

    $('formDespachoRegional').reset();
    $('despachosregionalform').hide();
	$('DespachoRegionalMotivo').value = decodeURIComponent(conteudo);
	$('DespachoRegionalDataDespacho').value = dataDespacho;
	$('DespachoRegionalId').value = id;
	$('DespachoRegionalSupervisorturnoId').value = <?php echo $supervisorturnoid;  ?>;
	var nome = '';
	if(tabelaid<10){
	  nome = 'tabela00'+tabelaid;
	}else{
		if(tabelaid<99){
	 		 nome = 'tabela0'+tabelaid;
	 	 }else{
		 	 nome = 'tabela'+tabelaid;
	 	 }
	}
	$('DespachoRegionalNomeTabela').value = nome;
	
    ShowContent('despachosregional');
}

function mostra(tabelaid){
	if(tabelaid<10){
	  nome = 'tabela00'+tabelaid;
	}else{
		if(tabelaid<99){
	 		 nome = 'tabela0'+tabelaid;
	 	 }else{
		 	 nome = 'tabela'+tabelaid;
	 	 }
	}
	  nomeDados = nome+'Dados';
	$(nome).show();
	$(nomeDados).show();
	  
	
}

function exibe(caixa){

	//esconde();

  if(caixa=='chefeequipe'){
    $('chefeEquipeEscalado').innerHTML = $('chefeEquipeAtual').innerHTML;
    ShowContent('chefeequipe');
  }
  if(caixa=='supervisorRegional'){
    $('supervisorRegionalEscalado').innerHTML = $('supervisorRegionalAtual').innerHTML;
    ShowContent('supervisorRegional');
  }
  if(caixa=='supervisorgeral'){
    $('supervisorGeralEscalado').innerHTML = $('supervisorGeralAtual').innerHTML;
    ShowContent('supervisorgeral');
  }
  
  if(caixa=='controladores'){
    ShowContent('controladores');
  }
  
  if(caixa=='controladoresPH'){
  	var nome = 'controladorPH'+$('militarIdControladorPH').value;
    $('controladorEscaladoPH').innerHTML = $(nome).innerHTML;
    ShowContent('controladoresPH');
  }
  if(caixa=='controladoresBL'){
  	var nome = 'controladorBL'+$('militarIdControladorBL').value;
    $('controladorEscaladoBL').innerHTML = $(nome).innerHTML;
    ShowContent('controladoresBL');
  }
  if(caixa=='controladoresMU'){
  	var nome = 'controladorMU'+$('militarIdControladorMU').value;
    $('controladorEscaladoMU').innerHTML = $(nome).innerHTML;
    ShowContent('controladoresMU');
  }
  if(caixa=='supervisorRegionalMU'){
  	var nome = 'supervisorRegionalMU'+$('militarIdSupervisorRegionalMU').value;
    ShowContent('supervisorRegionalMU');
    $('supervisorRegionalEscaladoMU').innerHTML = $(nome).innerHTML;
  }
  if(caixa=='supervisorRegionalBL'){
  	var nome = 'supervisorRegionalBL'+$('militarIdSupervisorRegionalBL').value;
    ShowContent('supervisorRegionalBL');
    $('supervisorRegionalEscaladoBL').innerHTML = $(nome).innerHTML;
  }
  if(caixa=='supervisorRegionalPH'){
  	var nome = 'supervisorRegionalPH'+$('militarIdSupervisorRegionalPH').value;
    ShowContent('supervisorRegionalPH');
    $('supervisorRegionalEscaladoPH').innerHTML = $(nome).innerHTML;
  }
  
  ShowContent('substitutos');


  

}



function submitForm(form, tabela, idatualizado) {
var dados = Form.serialize($(form));
new Ajax.Request('<?php echo $this->webroot; ?>ocorrencias/externoacoes/'+tabela+<?php echo "'/{$privilegio}'"; ?>+<?php echo "'/{$acesso}'"; ?>, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			if(tabela<10){
				tabela = "tabela00"+tabela;
			}else{
				tabela = "tabela0"+tabela;
			}
			var naohouve = tabela + "naohouve";
			var houve = tabela + "houve";
			
			if(resultado.total>0){
				setCheckedValue(form,'HOUVE');
				$(naohouve).hide();
			}
			
			
			 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = "<p>Registro não atualizado!</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
				//alert('Registro não atualizado!');
				$(idatualizado).innerHTML = resultado.mensagem;
			}else{
			 	$('alertaSistema').innerHTML = "<p>Registro atualizado!</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
				//alert('Registro atualizado!');
				$(idatualizado).innerHTML = resultado.mensagem;
							
			}
		}
				})
    }

function despachaForm(form, tipo) {
var dados = Form.serialize($(form));
new Ajax.Request('<?php echo $this->webroot; ?>ocorrencias/externodespacho/'+tipo, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
    		 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = "<p>Registro não atualizado!"+resultado.mensagem+"</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
			}else{
			 	$('alertaSistema').innerHTML = "<p>Registro atualizado!"+resultado.mensagem+"</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
				location.reload(true);
			}
		}
	});
}

function listaLDAP() {
new Ajax.Request('<?php echo $this->webroot; ?>ocorrencias/externoldap/', {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
		
    		 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = resultado.mensagem;
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
			}else{
			 	$('alertaSistema').innerHTML = resultado.mensagem;
			 	ShowContent('mensagem');
				//location.reload(true);
			}
		}
	});
}

function enviaForm(form) {
var dados = Form.serialize($(form));
new Ajax.Request('<?php echo $this->webroot; ?>ocorrencias/externosubstituicao/', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
		
			 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = "<p>Registro não atualizado!"+resultado.mensagem+"</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
			}else{
				location.reload(true);
//				alert('Registro atualizado!');
			}
		}
				});
}


function excluiRegistro(form, tabela, id, idatualizado) {
var dados = Form.serialize($(form));
new Ajax.Request('<?php echo $this->webroot; ?>ocorrencias/externodelete/'+tabela+'/'+id+<?php echo "'/{$privilegio}'"; ?>, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			//esconde();

			var resultado = transport.responseText.evalJSON(true);
			if(tabela<10){
				tabela = "tabela00"+tabela;
			}else{
				tabela = "tabela0"+tabela;
			}
			var naohouve = tabela + "naohouve";
			var houve = tabela + "houve";
			
			if(resultado.total==0){
				setCheckedValue(form,'NÃO HOUVE');
				$(naohouve).show();
				$(tabela).hide();
			}
			
			 if (resultado.ok==0){
				$(idatualizado).innerHTML = resultado.mensagem;
			 	$('alertaSistema').innerHTML = "<p>Registro não excluído!</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
			}else{
				$(idatualizado).innerHTML = resultado.mensagem;
			 	$('alertaSistema').innerHTML = "<p>Registro excluído!</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
							
			}
		}
				})
        
       
    }

</script> 
<?php

$mtabela092 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela001 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela002 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela003 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela004 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela005 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela006 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela007 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela090 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);

$mtabela008 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela009 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela010 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
//$mtabela011 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela012 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela013 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela014 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela015 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela016 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela017 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela018 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela019 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela020 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela021 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela022 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela023 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela024 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela025 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela026 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela027 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela028 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela029 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela030 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela031 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela032 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela033 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela034 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela035 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela036 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela037 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela038 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela039 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela040 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela041 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela042 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela043 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela044 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela045 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela046 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela047 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela048 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela049 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela050 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela051 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela052 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela053 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela054 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela055 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela056 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela057 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela058 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela059 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela060 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela061 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela062 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela063 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela064 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela065 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela066 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela067 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela068 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela069 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela070 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela071 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela072 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela073 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela091 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);

$mtabela074 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela075 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela076 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela077 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela078 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela079 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela080 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela081 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela082 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela083 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela084 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela085 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela086 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela087 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);

$mtabela092 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);

$cumprindoescala[0]['Escala']['livro'] = 'ACCAZ';
//print_r($mtabela001);
?>
<table width="100%">
	<tbody>
		<tr>
			<td>
			<table width="100%">
				<tbody>
					<tr>
						<td align="center" style="background-color: #4986c2" height="40"><b>
						<font color="#ffff00" size="4">ATUALIZAÇÕES CADASTRAIS</font></b>
						</td>
					</tr>
				</tbody>
			</table>
			<?php

function exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $dados, $nivel, $acesso){
	
			
			if($dados>0){
				$houve = 'checked="true"';
				$f = 1;
				$naohouve = '';
			}else{
				$houve = '';
				$naohouve = 'checked="true"';
				$f = 0;
			}
			if($nivel==1){
				$cornivel = 'ffcc99';
				$corfont = '000080';
				$sizefont = '4';
				$padding = '';
			}
			if($nivel==2){
				$cornivel = 'EEDDBB';
				$sizefont = '3';
				$corfont = '0000D0';
				$padding = 'padding-left: 10px;';
			}
			if($nivel==3){
				$cornivel = 'EEDDDD';
				$sizefont = '2';
				$corfont = '2020e0';
				$padding = 'padding-left: 20px;';
			}
			$html  = '<tr><td  style="background-color: #EEDDBB;border:3px black;"><b>'.$numeracao.'</b></td><td align="center" style="background-color: #'.$cornivel.';'.$padding.'" height="23" width="100%"><b><font color="#'.$corfont.'" size="'.$sizefont.'">'.$titulo.'</font></b></td>';
				$html .= '<td style="background-color: #'.$cornivel.';" height="23">';
				if($aberta==1){
				$html .= '<div  style="font-size:8px;font-weight:bold;background-color:'.$corhouve.';" id="tabela'.$numeracao.'houve">HOUVE<input '.$houve.' type="radio" name=\'tabela'.$numeracao.'r\'  onclick="$(\'tabela'.$numeracao.'\').show();return true;" ';
				$html .= ' href="javascript:$(\'tabela'.$numeracao.'\').show();"  value="HOUVE"></div>';
				}
				$html .= '</td>	<td style="background-color: #'.$cornivel.';" height="23">';
				
				if($aberta==1){
				$html .= '<div  style="font-size:8px;font-weight:bold;background-color:'.$cornaohouve.';" id="tabela'.$numeracao.'naohouve">NÃO&nbsp;HOUVE<input ';
				$html .= $cornaohouve.' type="radio" name=\'tabela'.$numeracao.'r\'	onclick="$(\'tabela'.$numeracao.'\').hide();" value="NÃO HOUVE"></div>';
				}
				$html .= '</td><td style="background-color: #'.$cornivel.';" height="23">';
				$confirmaDespacho = 0;
				$confirmaCiente = 0;
				$dadosDespacho = array();
				foreach($despachos as $despacho){
					if($despacho['nome_tabela']==$tabela){
						if($despacho['ciente_gerente_regional']){
							$confirmaCiente = 1;
						}
						if($despacho['despacho_gerente_regional']){
							$confirmaDespacho = 1;
						}
						$dadosDespacho['id'] = $despacho['Lrodespacho']['id'];
						$dadosDespacho['destinatario'] = $despacho['Lrodespacho']['destinatario'];
						$dadosDespacho['assunto'] = $despacho['Lrodespacho']['assunto'];
						$dadosDespacho['despacho'] = $despacho['Lrodespacho']['despacho'];
						$dadosDespacho['data_despacho'] = $despacho['Lrodespacho']['data_despacho'];
						$dadosDespacho['despachante'] = $despacho['Lrodespacho']['despachante'];
					}
				}
				$ciente = 0;

				if($confirmaCiente){
					$ciente = 1;
					$imgRegional = $raiz.'img/visto_sem_despacho.png';
				}
				if($confirmaDespacho){
					$ciente = 1;
					$imgRegional = $raiz.'img/visto_com_despacho.png';
				}

				if(empty($dadosDespacho['id'])){
					$dadosDespacho['id'] = ' ';
					$dadosDespacho['destinatario'] = ' ';
					$dadosDespacho['assunto'] = ' ';
					$dadosDespacho['despacho'] = ' ';
					$dadosDespacho['data_despacho'] = ' ';
					$dadosDespacho['despachante'] = ' ';
				}

				if($ciente){
					$html .= '<div  style="font-size:8px;font-weight:bold;background-color:'.$corciente.';" id="tabela'.$numeracao.'ciente">Ciente ';
					$html .= '<a onclick="despachoregional(1, \''.$dadosDespacho['id'].'\', \''.rawurlencode($dadosDespacho['despacho']).'\', \''.rawurlencode($dadosDespacho['data_despacho']).'\');">';
					$html .= '<img border="0" title="Cadastrar" alt="Cadastrar"	src="'.$imgRegional.'" /></a></div>';
				}
				if($aberta==1 && $privilegio=='GERREGIONAL'){
					$html .= '<div  style="font-size:8px;font-weight:bold;background-color:'.$corciente.';" id="tabela'.$numeracao.'ciente">Ciente ';
					$html .= '<a onclick="despachoregional(1, \''.$dadosDespacho['id'].'\', \''.rawurlencode($dadosDespacho['despacho_gerente_regional']).'\', \''.rawurlencode($dadosDespacho['data_despacho']).'\');">';
					$html .= '<img border="0" title="Cadastrar" alt="Cadastrar"	src="'.$raiz.'img/despacho.gif" /></a></div>';

				}
					$html .= '</td></tr>';
					
					echo $html;
		

		} 
		
function exibeDados($campos, $nomeVetor, $tabela,	$privilegio, $idDiv, $numeracao, $raiz, $controller, $campoExcluir, $acesso){ 
	$html = '<div id="'.$idDiv.'">'; 
	$mensagem= "<table cellpadding='0' cellspacing='0'>	<tr>";
	
	foreach($campos as $chave=>$valor){
		$mensagem .= '<th>'.$valor.'</th>';
	}
	$mensagem .= '<th>Ações</th></tr>';

	$i = 0; 
    $tabelas = $tabela; 
    
	$tabelasql = $numeracao;
    
    
    foreach ($tabelas as $resultado){ 
    	$class = null; 
    	if ($i++ % 2 == 0) { 
    		$class = ' style="background-color:#e0e0f0;"'; 
    	} 
   // 	$excluir = '<a onclick=\'return false;\' onmousedown=\"dialogo('Deseja realmente excluir o registro #".$resultado[$nomeVetor][$campoExcluir].' ?" ,"javascript:var tabela=\"'.$idDiv.'\";var form=\"lrotabela'.$numeracao.'LroForm\";excluiRegistro(form,'.$numeracao.','.$resultado[$nomeVetor]['id'].',tabela);");\' href="'.$raiz.$controller.'"><img border="0" title="Excluir" alt="Excluir" src="'.$raiz.'img/lixo.gif" /></a>';
		$despacho = '<a href="javascript:despacholocal('.$tabelasql.', '.$resultado[$nomeVetor]['id'].', \''.rawurlencode($resultado[$nomeVetor]['despacho_gerente_local']).'\', \''.rawurlencode($resultado[$nomeVetor]['data_despacho']).'\');" onclick="despacholocal('.$tabela.', '.$resultado[$nomeVetor]['id'].', \''.rawurlencode($resultado[$nomeVetor]['despacho_gerente_local']).'\', \''.rawurlencode($resultado[$nomeVetor]['data_despacho']).'\');"><img border="0" title="Despacho" alt="despacho" src="'.$raiz.'img/despacho.gif"/></a>';
    	
    	if(empty($resultado[$nomeVetor]['despacho_gerente_local'])){
    		if(!empty($resultado[$nomeVetor]['ciente_gerente_local'])){
    			$ciente = '<img border="0" title="Ciente" alt="ciente"	src="'.$raiz.'img/visto_sem_despacho.png" />';
	    	}
    	}else{
    		$ciente = '<img border="0" title="Ciente" alt="ciente"	src="'.$raiz.'img/visto_com_despacho.png" />';
    	} 
    	$acao = ''; 
        if(($privilegio=='EXECUTANTE')&&($acesso == 1)){ $acao .= $excluir; }
		if($privilegio=='GERLOCAL'){ $acao .= $despacho; } 
		$acao .= $ciente;
		//$acao = $ciente.$despacho; 
		
		$mensagem .= '<tr>';
		foreach($campos as $chave=>$valor){
			$mensagem .= '<td'.$class.'>'.$resultado[$nomeVetor][$chave].'</td>';
		}
		$mensagem .= '<td'.$class.'>'.$acao.'</td></tr>';		
     } 
     $mensagem.="</table><br>";
     $html .= $mensagem.'</div></div><script language="javascript">';
						
						
	if($i){
		$html .= "\$('tabela".$numeracao."').show();";
		$html .= "\$('tabela".$numeracao."naohouve').hide();";
	}else{
		$html .= "\$('tabela".$numeracao."').hide();";
		$html .= "\$('tabela".$numeracao."naohouve').show();";
	}
	$html .= '</script>';
	
	echo $html; 
} 

//		$privilegios = 1;

		if($privilegios){
			$permissaos = array('readonly'=>'readonly');
		}else{
			$permissao = '';
			$permissaos = array();
		}
		$corhouve = "#f00000";
		$cornaohouve = "#00f000";
		$corciente = "#00b000";


		?>



		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Apresentação por motivo de movimentação ou classificação na OM, de oficial CTA, graduado BCT, civil DACTA e ATCO contratado no mês.';
					$tabela = 'lrotabela001s';
					$vetorTabela = 'Lrotabela001';
					$numeracao = "001";
					$numero = 1;
					$tabelaDados = $tabela01;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela001" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('local',array('class'=>'formulario','type'=>'textarea','label'=>'Local',$permissaos));
							echo $datePicker->Timer('data_apresentacao',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','local'=>'Local','data_apresentacao'=>'Apresentação');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','local'=>'Local','data_apresentacao'=>'Apresentação');
							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>


		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA que foram desligados da OM no mês, informando o número do Boletim e a data do desligamento';
					$tabela = 'atualizacaocadastral002s';
					$vetorTabela = 'Atualizacaocadastral002';
					$numeracao = "002";
					$numero = 2;
					$tabelaDados = $tabela02;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela002" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('boletim',array('class'=>'formulario','type'=>'textarea','label'=>'Local',$permissaos));
							echo $datePicker->Timer('data_desligamento',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','boletim'=>'Boletim','data_desligamento'=>'Desligamento');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Designação de função para oficial CTA, graduado BCT, civil DACTA e ATCO contratado no mês.';
					$tabela = 'atualizacaocadastral003s';
					$vetorTabela = 'Atualizacaocadastral003';
					$numeracao = "003";
					$numero = 1;
					$tabelaDados = $tabela03;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela003" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('funcao',array('class'=>'formulario','type'=>'textarea','label'=>'Local',$permissaos));
							echo $datePicker->Timer('data_designacao',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','funcao'=>'Função','data_designacao'=>'Designação');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA que mudaram de cargo ou função (operacional ou administrativa) no mês.';
					$tabela = 'atualizacaocadastral004s';
					$vetorTabela = 'Atualizacaocadastral004';
					$numeracao = "004";
					$numero = 1;
					$tabelaDados = $tabela04;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela004" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('funcao',array('class'=>'formulario','type'=>'textarea','label'=>'Local',$permissaos));
							echo $datePicker->Timer('data_mudanca',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','funcao'=>'Função','data_mudanca'=>'Mudança');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA que solicitaram reserva remunerada ou aposentadoria no mês.';
					$tabela = 'atualizacaocadastral005s';
					$vetorTabela = 'Atualizacaocadastral005';
					$numeracao = "005";
					$numero = 1;
					$tabelaDados = $tabela05;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela005" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							//echo $form->input('funcao',array('class'=>'formulario','type'=>'textarea','label'=>'Local',$permissaos));
							echo $datePicker->Timer('data',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							echo $datePicker->Timer('data_solicitacao',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','data'=>'Data','data_solicitacao'=>'Solicitação');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA e ATCO contratados que iniciaram Estágio em órgão operacional no mês.';
					$tabela = 'atualizacaocadastral006s';
					$vetorTabela = 'Atualizacaocadastral006';
					$numeracao = "006";
					$numero = 1;
					$tabelaDados = $tabela06;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela006" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('orgao',array('class'=>'formulario','type'=>'textarea','label'=>'Órgão',$permissaos));
							echo $datePicker->Timer('data_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','orgao'=>'Órgão','data_inicio'=>'Início');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA e ATCO contratados que foram habilitados em órgão operacional no mês.';
					$tabela = 'atualizacaocadastral007s';
					$vetorTabela = 'Atualizacaocadastral007';
					$numeracao = "007";
					$numero = 1;
					$tabelaDados = $tabela07;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela007" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('orgao',array('class'=>'formulario','type'=>'textarea','label'=>'Órgão',$permissaos));
							echo $datePicker->Timer('data_homologacao',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','orgao'=>'Órgão','data_homologacao'=>'Homologação');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA e ATCO contratados que tiveram o CHT revalidado no mês.';
					$tabela = 'atualizacaocadastral008s';
					$vetorTabela = 'Atualizacaocadastral008';
					$numeracao = "008";
					$numero = 1;
					$tabelaDados = $tabela08;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela008" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('orgao',array('class'=>'formulario','type'=>'textarea','label'=>'Órgão',$permissaos));
							echo $datePicker->Timer('nova_validade',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','orgao'=>'Órgão','nova_validade'=>'Validade');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>


		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA e ATCO contratados que tiveram, no mês, o CHT suspenso e o motivo da suspensão.';
					$tabela = 'atualizacaocadastral009s';
					$vetorTabela = 'Atualizacaocadastral009';
					$numeracao = "009";
					$numero = 1;
					$tabelaDados = $tabela09;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela009" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('orgao',array('class'=>'formulario','type'=>'textarea','label'=>'Órgão',$permissaos));
							echo $form->input('motivo',array('class'=>'formulario','type'=>'textarea','label'=>'Motivo',$permissaos));
							echo $datePicker->Timer('data_suspensao',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','orgao'=>'Órgão','motivo'=>'Motivo','data_suspensao'=>'Suspensão');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>



		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA e ATCO contratados que tiveram, no mês, as inspeções de saúde revalidadas.';
					$tabela = 'atualizacaocadastral010s';
					$vetorTabela = 'Atualizacaocadastral010';
					$numeracao = "010";
					$numero = 1;
					$tabelaDados = $tabela10;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela010" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('orgao',array('class'=>'formulario','type'=>'textarea','label'=>'Órgão',$permissaos));
							echo $form->input('motivo',array('class'=>'formulario','type'=>'textarea','label'=>'Motivo',$permissaos));
							echo $datePicker->Timer('data_suspensao',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','orgao'=>'Órgão','motivo'=>'Motivo','data_suspensao'=>'Suspensão');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>



		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA e ATCO contratados que foram afastados, no mês, por motivo de saúde, informando a Ata da JES e o período de afastamento.';
					$tabela = 'atualizacaocadastral011s';
					$vetorTabela = 'Atualizacaocadastral011';
					$numeracao = "011";
					$numero = 1;
					$tabelaDados = $tabela11;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela011" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('orgao',array('class'=>'formulario','type'=>'textarea','label'=>'Órgão',$permissaos));
							echo $form->input('ata',array('class'=>'formulario','type'=>'textarea','label'=>'Ata',$permissaos));
							echo $datePicker->Timer('dt_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							echo $datePicker->Timer('dt_termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','orgao'=>'Órgão','ata'=>'Ata','dt_inicio'=>'Início','dt_termino'=>'Término');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>





		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA e ATCO contratados que foram afastados, no mês, por motivos operacionais, informando a Ata do Conselho Operacional e a data de afastamento.';
					$tabela = 'atualizacaocadastral012s';
					$vetorTabela = 'Atualizacaocadastral012';
					$numeracao = "012";
					$numero = 1;
					$tabelaDados = $tabela12;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela012" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('orgao',array('class'=>'formulario','type'=>'textarea','label'=>'Órgão',$permissaos));
							echo $form->input('ata',array('class'=>'formulario','type'=>'textarea','label'=>'Ata',$permissaos));
							echo $datePicker->Timer('dt_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							echo $datePicker->Timer('dt_termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','orgao'=>'Órgão','ata'=>'Ata','dt_inicio'=>'Início','dt_termino'=>'Término');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>




		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA, aos quais foram concedidos, no mês, quaisquer tipos de dispensa, informando o período de afastamento.';
					$tabela = 'atualizacaocadastral013s';
					$vetorTabela = 'Atualizacaocadastral013';
					$numeracao = "013";
					$numero = 1;
					$tabelaDados = $tabela13;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela013" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('orgao',array('class'=>'formulario','type'=>'textarea','label'=>'Órgão',$permissaos));
							echo $form->input('dispensa',array('class'=>'formulario','type'=>'textarea','label'=>'Dispensa',$permissaos));
							echo $datePicker->Timer('dt_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							echo $datePicker->Timer('dt_termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','orgao'=>'Órgão','dispensa'=>'Dispensa','dt_inicio'=>'Início','dt_termino'=>'Término');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>



		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA indicados para curso (Aluno/Instrutor), no mês, informando o período de curso.';
					$tabela = 'atualizacaocadastral014s';
					$vetorTabela = 'Atualizacaocadastral014';
					$numeracao = "014";
					$numero = 1;
					$tabelaDados = $tabela14;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela014" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('orgao',array('class'=>'formulario','type'=>'textarea','label'=>'Órgão',$permissaos));
							echo $form->input('curso',array('class'=>'formulario','type'=>'textarea','label'=>'Curso',$permissaos));
							echo $datePicker->Timer('dt_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							echo $datePicker->Timer('dt_termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','orgao'=>'Órgão','curso'=>'Curso','dt_inicio'=>'Início','dt_termino'=>'Término');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>



		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'Oficial CTA, graduado BCT e civil DACTA matriculado em curso (Aluno/Instrutor), no mês, informando o período de curso.';
					$tabela = 'atualizacaocadastral015s';
					$vetorTabela = 'Atualizacaocadastral015';
					$numeracao = "015";
					$numero = 1;
					$tabelaDados = $tabela15;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td colspan="2">

					<div class="ocorrenciastecnicas form" id="tabela015" style="display: false;">
					<?php
							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('posto',array('class'=>'formulario','label'=>'Posto/Grad',$permissaos));
							echo $form->input('nome',array('class'=>'formulario','type'=>'textarea','label'=>'Nome',$permissaos));
							echo $form->input('orgao',array('class'=>'formulario','type'=>'textarea','label'=>'Órgão',$permissaos));
							echo $form->input('curso',array('class'=>'formulario','type'=>'textarea','label'=>'Curso',$permissaos));
							echo $datePicker->Timer('dt_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							echo $datePicker->Timer('dt_termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
							$campos = array('posto'=>'Posto/Grad','nome'=>'Nome','orgao'=>'Órgão','curso'=>'Curso','dt_inicio'=>'Início','dt_termino'=>'Término');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';

							//$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>




<table border="2" bordercolor="#808080" cellpadding="0"
		cellspacing="0" width="100%">
	<tbody>
	<tr>
		<td colspan="4" align="center"
			style="background-color: #6699ff"><b><font color="#ffffff"
			size="4">RECEBIMENTO E ASSINATURA DAS ATUALIZAÇÕES CADASTRAIS</font></b></td>
	</tr>
	<tr>
		<th>Recebimento do Serviço</th>
	</tr>
	<tr>
		<td>Recebi o Serviço do <?php
			foreach($todosSpvChefeEquipe as $supervisor){
				$chfEquipeTodos[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
			}
			echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosrecebimento', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formRecebimento'));
			echo $form->select('militar_id', $chfEquipeTodos ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
			?> Ciente das ordens em vigor <input type="checkbox"
			id="notam" name="data[Ocorrencia][notam]">, NOTAM <input
			type="checkbox"> e material carga <input type="checkbox">
			<?php
			echo $form->end(array('label'=>'Assinar Livro', 'class'=>'botoes','onclick'=>'enviaForm(\'formDespacho\');'));
		?></td>
	</tr>
</tbody>
</table>




										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</div>


					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="mudamilitar">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('mudamilitar')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">


						<?php echo $form->create('Usuario',array('action'=>'login'));?><b>SUBSTITUTO:</b>
					
					</td>
					<select id='supervisor'>
					<?php
					$i = 0;
					foreach ($cumprindoescala as $escalado):
					?>

					<?php

					$nome = $escalado['Posto']['sigla_posto'].' '.$escalado['Especialidade']['nm_especialidade'].'  '.$escalado['Militar']['nm_completo'];
					$nome = str_replace($escalado['Militar']['nm_guerra'], "<b>".$escalado['Militar']['nm_guerra']."</b>", $nome);
					$nome = str_replace($escalado['Posto']['sigla_posto'], "<b>".$escalado['Posto']['sigla_posto']."</b>", $nome);
					$link =$this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false);
					$nome .= $link;


					echo '<option>'.$nome.'</option>';


					?>
					<?php endforeach;
					?>

					</select>
					<br>
					<b>MOTIVO DA SUBSTITUIÇÃO:</b>
					<input type="password" id="UsuarioSenha" class="formulario"
						value="" name="data[Usuario][senha]" />
					<div id='privilegio'></div>
					<?php echo $form->end(array('label'=>'Acessar','class'=>'botoes'));?>
					</div>
					<script type="text/javascript">
<!--
new Draggable('mudamilitar');
//-->
</script>
					</div>




					<script language="javascript">
/*
	var formulario = this;
	var x =formulario.getInputs('checkbox');
	for(i=0;i<x.size();i++){
		nome = x[i].id; 
		   if(x[i].checked){
		    x[i].checked = false;
		    }else{
		    x[i].checked = true;
		    }
	}
	*/

</script>
<?php
			}
			?>

					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="chefeequipe">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('chefeequipe')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="chfeqp"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formChefeEquipe'));
						foreach($todosSpvChefeEquipe as $supervisor){
							$supervisores3[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
						}
						?> <b>ESCALADO:</b>
					<div id="chefeEquipeEscalado">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdChefeEquipe" value="0"
						name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdChefeEquipe" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataChefeEquipe" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $supervisores3 ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formChefeEquipe\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						?></div>
					<script type="text/javascript">
<!--
new Draggable('chefeequipe');
//-->
</script></div>



					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="supervisorgeral">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('supervisorgeral')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="supger"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formSupervisorGeral'));
						if($cumprindoescala[0]['Escala']['livro']=='ACCAZ'){
							foreach($todosSpvGeralMN as $supervisor){
								$supervisores1[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
							}
						}else{
							foreach($todosSpvGeral as $supervisor){
								$supervisores1[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
							}
						}
						?> <b>ESCALADO:</b>
					<div id="supervisorGeralEscalado">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdSupervisorGeral"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdSupervisorGeral" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataSupervisorGeral" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $supervisores1 ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formSupervisorGeral\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						?></div>
					<script type="text/javascript">
<!--
new Draggable('supervisorgeral');
//-->
</script></div>



					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="supervisorRegional">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('supervisorRegional')"><img
						border="0" width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="supreg"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formSupervisorRegional'));
						foreach($todosSpvRegional as $supervisor){
							$supervisores2[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
						}
						?> <b>ESCALADO:</b>
					<div id="supervisorRegionalEscalado">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdSupervisorRegional"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdSupervisorRegional" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataSupervisorRegional" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $supervisores2 ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formSupervisorRegional\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						?></div>
					<script type="text/javascript">
<!--
new Draggable('supervisorRegional');
//-->
</script></div>



					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="controladores">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('controladores')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="control"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formControlador'));
						foreach($todosControladores as $supervisor){
							$controladoresTodos[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
						}
						?> <b>ESCALADO:</b>
					<div id="controladorEscalado">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdControlador" value="0"
						name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdControlador" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataControlador" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $controladoresTodos ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'controladores\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						
						?></div>
<script type="text/javascript">
<!--
new Draggable('controladores');
//-->
</script></div>

					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="controladoresMU">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('controladoresMU')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="controlmu"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formControladorMU'));
						foreach($todosControladoresMU as $supervisor){
							$controladorMU[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
						}
						?> <b>ESCALADO:</b>
					<div id="controladorEscaladoMU">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdControladorMU"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdControladorMU" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataControladorMU" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $controladorMU ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formControladorMU\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						
						?></div>
					<script type="text/javascript">
<!--
new Draggable('controladoresMU');
//-->
</script></div>


					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="controladoresBL">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('controladoresBL')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="controlbl"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formControladorBL'));
						foreach($todosControladoresBL as $supervisor){
							$controladorBL[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
						}
						?> <b>ESCALADO:</b>
					<div id="controladorEscaladoBL">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdControladorBL"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdControladorBL" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataControladorBL" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $controladorBL ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formControladorBL\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						
						?></div>
					<script type="text/javascript">
<!--
new Draggable('controladoresBL');
//-->
</script></div>


					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="controladoresPH">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('controladoresPH')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="controlph"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
					<?php
				echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formControladorPH'));
				foreach($todosControladoresPH as $supervisor){
					$controladorPH[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
				}
				?> <b>ESCALADO:</b>
					<div id="controladorEscaladoPH">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdControladorPH"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdControladorPH" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataControladorPH" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
					<?php
					echo $form->select('substituto_id', $controladorPH ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
					echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
					echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formControladorPH\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
					
					?></div>
					<script type="text/javascript">
<!--
new Draggable('controladoresPH');
//-->
</script></div>


					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="supervisorRegionalMU">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('supervisorRegionalMU')"><img
						border="0" width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="supregmn"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
					<?php
				echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formRegionalMU'));
				foreach($todosSpvRegionalMN as $supervisor){
					$regionalMU[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
				}
				?> <b>ESCALADO:</b>
					<div id="supervisorRegionalEscaladoMU">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdSupervisorRegionalMU"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdSupervisorRegionalMU" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataSupervisorRegionalMU"
						value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
					<?php
				echo $form->select('substituto_id', $regionalMU ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
				echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
				echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formRegionalMU\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
				?></div>
					<script type="text/javascript">
<!--
new Draggable('supervisorRegionalMU');
//-->
</script></div>




					</div>
					</div>
					</td>
				</tr>
			</tbody>
		</table>
		</td>
		</tr>
	</tbody>
</table>
</div>
<div
	style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
	id="supervisorRegionalBL" class="fixed">
<p
	style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
	href="javascript:HideContent('supervisorRegionalBL')"><img border="0"
	width="15" height="15" title="Excluir" alt="Excluir"
	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
<div id="supregbl"
	style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
<?php
				echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formRegionalBL'));
				foreach($todosSpvRegionalBL as $supervisor){
				   $regionalBL[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
				}
				?> <b>ESCALADO:</b>
<div id="supervisorRegionalEscaladoBL">FULANO DE TAL</div>
<br>
<input type="hidden" id="cumprimentoEscalaIdSupervisorRegionalBL"
	value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
	type="hidden" id="militarIdSupervisorRegionalBL" value="0"
	name="data[Ocorrencia][militar_id]" /> <input type="hidden"
	id="dataSupervisorRegionalBL" value="<?php echo $dataReferencia; ?>"
	name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
<?php
				echo $form->select('substituto_id', $regionalBL ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
				echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
				echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formRegionalBL\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
				?></div>
<script type="text/javascript">
<!--
new Draggable('supervisorRegionalBL');
//-->
</script></div>

<div
	style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
	id="supervisorRegionalPH" class="fixed">
<p
	style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
	href="javascript:HideContent('supervisorRegionalPH')"><img border="0"
	width="15" height="15" title="Excluir" alt="Excluir"
	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
<div id="supregph"
	style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
<?php
				echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formRegionalPH'));
				foreach($todosSpvRegionalPH as $supervisor){
				   $regionalPH[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
				}
				?> <b>ESCALADO:</b>
<div id="supervisorRegionalEscaladoPH">FULANO DE TAL</div>
<br>
<input type="hidden" id=cumprimentoEscalaIdSupervisorRegionalPH
	value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
	type="hidden" id="militarIdSupervisorRegionalPH" value="0"
	name="data[Ocorrencia][militar_id]" /> <input type="hidden"
	id="dataSupervisorRegionalPH" value="<?php echo $dataReferencia; ?>"
	name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
<?php
				echo $form->select('substituto_id', $regionalPH ,false ,array('onChange'=>"",'class'=>'formulario'), false);
				echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
				echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formRegionalPH\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
				?></div>
<script type="text/javascript">
<!--
new Draggable('supervisorRegionalPH');
//-->
</script></div>


<?php
				echo $form->create('variaveis',array('onsubmit'=>'return false;', 'action'=>'','controller'=>'', 'type'=>'file', 'onsubmit'=>'return false;'));
				echo $form->hidden('id');
				echo $form->end();
				
?>
<br>
<div
	style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
	id="despachosregional">
<p
	style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">DESPACHO
DOS GERENTES<a style="float: right; margin: 0px;" id="fechar"
	href="javascript:HideContent('despachosregional')"><img border="0"
	width="15" height="15" title="Excluir" alt="Excluir"
	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
<div id="despachoregional"
	style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;"><?php
				echo $form->create('DespachoRegional',array('onsubmit'=>'return false;', 'action'=>'externociente','controller'=>'ocorrencias', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formDespachoRegional'));
				?> <?php
				$conteudo = $form->label('ciente_gerente_regional','CIENTE').$form->checkbox('ciente_gerente_regional',array('class'=>'formulario','onclick'=>'cienteNegativo();'));
				echo $this->Html->div(array('class'=>'input checkbox'),$conteudo);
				$conteudo = $form->label('despacho_gerente_regional','DESPACHO').$form->checkbox('despacho_gerente_regional',array('class'=>'formulario','onclick'=>'var x=$(\'DespachoRegionalDespachoGerenteRegional\').checked;if(x){$(\'despachosregionalform\').show();$(\'DespachoRegionalCienteGerenteRegional\').checked=true;}else{$(\'despachosregionalform\').hide();}'));
				echo $this->Html->div(array('class'=>'input checkbox'),$conteudo);
				
				$link =$this->Html->link($this->Html->image('lupa.png', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'externoldap'),array('style'=>'float:left;','onclick'=>'listaLDAP();return false;', 'escape'=>false), null,false);
								
				$formulario  = $form->input('remetente',array('class'=>'formulario','style'=>'width:150px;'));
				$formulario .= $form->input('senha',array('class'=>'formulario','style'=>'width:150px;','type'=>'password'));
				$formulario .= $form->input('destinatarios',array('class'=>'formulario','size'=>'60','style'=>'float:left;')).$link;
				$formulario .= $form->input('assunto',array('class'=>'formulario','size'=>'60'));
				$formulario .= $form->input('motivo',array('cols'=>'60','class'=>'formulario'));
				$formulario .= $form->hidden('supervisorturno_id');
				$formulario .= $form->hidden('nome_tabela');
				$formulario .= $form->hidden('gerente_regional',array('value'=>$militar_id));
				$formulario .= $form->hidden('data_despacho');
				$formulario .= $form->hidden('id');
				echo $this->Html->div(array('class'=>'formulario'),$formulario,array('id'=>'despachosregionalform','style'=>'display:none;'));
				
				
				
				if($aberta==1 && $privilegio=='GERREGIONAL'){
					$despForm = 'despachaForm(\'formDespachoRegional\',\'Regional\');';
				}else{
					$despForm = 'esconde();$(\'alertaSistema\').innerHTML = "<p>Operação não autorizada!</p>";ShowContent(\'mensagem\');';
				}
				echo $form->end(array('label'=>'Despacho', 'class'=>'botoes','onclick'=>$despForm));
?></div>
<script type="text/javascript">
<!--
new Draggable('despachosregional');
//-->
</script></div>




<div
	style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
	id="despachoslocal" class="fixed">
<p
	style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">DESPACHO
DOS GERENTES<a style="float: right; margin: 0px;" id="fechar"
	href="javascript:HideContent('despachoslocal')"><img border="0"
	width="15" height="15" title="Excluir" alt="Excluir"
	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
<div id="despacholocal"
	style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;"><?php
				echo $form->create('DespachoLocal',array('onsubmit'=>'return false;', 'action'=>'externociente','controller'=>'ocorrencias', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formDespachoLocal'));
				$conteudo = $form->label('ciente_gerente_local','CIENTE').$form->checkbox('ciente_gerente_local',array('class'=>'formulario','onclick'=>'cienteNegativo();'));
				echo $this->Html->div(array('class'=>'input checkbox'),$conteudo);
				$conteudo = $form->label('despacho_gerente_local','DESPACHO').$form->checkbox('despacho_gerente_local',array('class'=>'formulario','onclick'=>'var x=$(\'DespachoLocalDespachoGerenteLocal\').checked;if(x){$(\'despachoslocalform\').show();$(\'DespachoLocalCienteGerenteLocal\').checked=true;}else{$(\'despachoslocalform\').hide();}'));
				echo $this->Html->div(array('class'=>'input checkbox'),$conteudo);
				
				$link =$this->Html->link($this->Html->image('lupa.png', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'externoldap'),array('style'=>'float:left;','onclick'=>'listaLDAP();return false;', 'escape'=>false), null,false);

				$formulario  = $form->input('remetente',array('class'=>'formulario','style'=>'width:150px;'));
				$formulario .= $form->input('senha',array('class'=>'formulario','style'=>'width:150px;','type'=>'password'));
				$formulario .= $form->input('destinatarios',array('class'=>'formulario','size'=>'60','style'=>'float:left;')).$link;
				$formulario .= $form->input('assunto',array('class'=>'formulario','size'=>'60'));
				$formulario .= $form->input('motivo',array('cols'=>'60','class'=>'formulario'));
				$formulario .= $form->hidden('supervisorturno_id');
				$formulario .= $form->hidden('tabelaid');
				$formulario .= $form->hidden('data_despacho');
				$formulario .= $form->hidden('id');
				echo $this->Html->div(array('class'=>'formulario'),$formulario,array('id'=>'despachoslocalform','style'=>'display:none;'));
				
				
				if($aberta==1 && $privilegio=='GERLOCAL'){
					$despForm = 'despachaForm(\'formDespachoLocal\',\'Local\');';
				}else{
					$despForm = 'esconde();$(\'alertaSistema\').innerHTML = "<p>Operação não autorizada!</p>";ShowContent(\'mensagem\');';
				}
							
				echo $form->end(array('label'=>'Despacho', 'class'=>'botoes','onclick'=>$despForm));
				
?></div>
<script type="text/javascript">
<!--
new Draggable('despachoslocal');
//-->
</script></div>



<script language="javascript">
	$('despachoslocal').hide();
	$('despachosregional').hide();
	$('mensagem').hide();
    $('chefeequipe').hide();
    $('supervisorRegional').hide();
    $('supervisorgeral').hide();
    $('controladores').hide();
    $('supervisorRegionalMU').hide();
    $('supervisorRegionalBL').hide();
    $('supervisorRegionalPH').hide();
    $('controladoresMU').hide();
    $('controladoresBL').hide();
    $('controladoresPH').hide();
    $('despachoslocal').hide();
 	$('mensagem').hide();

</script>

